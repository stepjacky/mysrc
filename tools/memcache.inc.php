<?php

$MEMCH_HOST = '127.0.0.1';
$MEMCH_PORT = 11211;
$MEMCH_DEBUG_ENABLED = FALSE;
$MEMCH_compression = TRUE;
$MEMCH_default_time_cache = 300;

function memch_init()
{
    global $memch_srv;

    if(isset($memch_srv))
	memcache_close($memch_srv);

    $memch_srv = memch_get_db();
}

function memch_get_db()
{
    global $MEMCH_DEBUG_ENABLED;
    global $MEMCH_DEBUG_ENABLED;
    global $MEMCH_HOST;
    global $MEMCH_PORT;
    if ( function_exists( 'memcache_connect' ) )
    {
    	$memch_srv = @memcache_connect($MEMCH_HOST, $MEMCH_PORT, 5);
    }
    else 
    {
    	die( "FATAL ERROR: memcache_connect() function does not exist \n" );
    }

    return $memch_srv;
}

function memch_close()
{
    global $memch_srv;

    if(isset($memch_srv))
    memcache_close($memch_srv);
}

function memch_get($query)
{
    global $memch_srv, $MEMCH_DEBUG_ENABLED;

    $start = microtime(true);
    if ($MEMCH_DEBUG_ENABLED)
    {
        $start = microtime(true);
    }

    if( !isset($memch_srv) )
	$memch_srv = memch_get_db();

	if ($memch_srv)
	{
	    $end = microtime(true);
	    return memcache_get($memch_srv, $query);
	}
	else
	{
	    return false;
	}
}

function memch_add($key, $value, $timeToLiveInSeconds)
{
    global $memch_srv, $MEMCH_compression;

    if(!isset($memch_srv))
    {
		$memch_srv = memch_get_db();
    }

	if ($memch_srv)
	{
	   return memcache_add($memch_srv, $key, $value, $MEMCH_compression, time()+$timeToLiveInSeconds);
	}
	else
	{
	    return false;
	}
}

function memch_get_stats()
{
    global $memch_srv;

    if(!isset($memch_srv))
	$memch_srv = memch_get_db();

	if ($memch_srv)
	{
	   return memcache_get_stats($memch_srv);
	}
	else
	{
	    return false;
	}
}

function memch_del($key)
{
    global $memch_srv;

    if(!isset($memch_srv))
	$memch_srv = memch_get_db();

    if ($memch_srv)
    {
        memcache_delete($memch_srv, $key);
    }
}

function memch_get_query($query, $cache_time = 600, $db_class)
{
    global $memch_srv, $MEMCH_DEBUG_ENABLED;
    
    if ( $MEMCH_DEBUG_ENABLED )
    {
        $start = microtime(true);
    }

    $memch_key = md5( $query );
    $result = memch_get( $memch_key );
    
    if ( $result )
    {
    	$result['memcached'] = TRUE;
        return $result;
    }
    else
    {
    	$data_block = $db_class->private_db_query( $query );
    	
        $retrieveGenericResult = $db_class->private_db_result_breakdown( $data_block );
        if (count($retrieveGenericResult['data']) > 0)
        {
            memch_add($memch_key, $retrieveGenericResult, $cache_time);
        }
        $retrieveGenericResult['memcached'] = FALSE;
        return $retrieveGenericResult;
    }
    return NULL;
}
?>