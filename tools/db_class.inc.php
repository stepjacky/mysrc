<?php

/********************************************************************************

DB_mysql - class for PHP working with a MySQL Database

Simple example:

---------------------CODE------------------------------
include( 'db_class.inc.php' );
$db_link = new DB_mysql( '127.0.0.1', 'root', 'password', 'mysql' );
$result = $db_link->db_query( "SELECT `user`.`user`, `user`.`password` FROM `user` LIMIT 2" );
print_r( $result );
---------------------CODE------------------------------


---------------------OUTPUT------------------------------
Array
(
    [data] => Array
        (
            [0] => Array
                (
                    [user] => root
                    [password] => *114312C1322ED1BB956D10FE05CB32A47D38CBA3
                )

            [1] => Array
                (
                    [user] => root
                    [password] => *114312C1322ED1BB956D10FE05CB32A47D38CBA3
                )

        )

    [num_fields] => 2
    [num_rows] => 2
    [affected_rows] => 2
    [insert_id] => 0
    [info] =>
    [error] =>
    [memcached] =>
    [query_string] => SELECT `user`.`user`, `user`.`password` FROM `user` LIMIT 2
    [time] => 0.000640153884888
)
---------------------OUTPUT------------------------------

The variable $result contains
$result['data']             : the rows containing the requested data
                              for example $result['data'][0] - the first row
                                          $result['data'][1] - the second row
$result['affected_rows']    : the number of affected rows, useful with UPDATE / DELETE queries
$result['num_fields']       : number of fields ( column number ) the result has, for SELECT queries
$result['num_rows']         : number of rows the result has, for SELECT queries
$result['insert_id']        : inserted id number the result has, for INSERT queries
$result['error']            : the error the query returned ( empty when no error )
$result['info']             : the return of mysql_info()
$result['memcached']        : TRUE if the result is retrieved from memcached
$result['query_string']     : the query that was executed
$result['time']             : run time of the query and result processing

For profiling you need to create the `sql_log` table. It is recommended to use this query:
CREATE TABLE IF NOT EXISTS `sql_log` (
  `sql_id` int(11) NOT NULL auto_increment,
  `sql` text NOT NULL,
  `time` float NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`sql_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

*/

class DB_mysql
{
    public $DB_ERROR = NULL;

    private $DB = NULL;
    private $MEMCH_default_time_cache=60;
    private $PROFILE_SQL = FALSE;

    /**
     * db_connect : Private function to try and connect to the specified database in the parameters
     *
     * @param string $DB_HOST
     * IP or hostname of the MySQL server ( usually 'localhost' )
     *
     * @param string $DB_USER
     * User to use to connect to MySQL server
     *
     * @param string $DB_PASS
     * Password for user
     *
     * @param string $DB_DATABASE
     * Database to use
     *
     * @return boolean
     * TRUE on success
     * FALSE otherwise
     */

    private function db_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_DATABASE)
    {
    	if ($this->DB != NULL)
    	{
    		@mysql_close($DB);
    	}

    	$this->DB = @mysql_connect($DB_HOST, $DB_USER, $DB_PASS);

    	if ( !$this->DB )
    	{
    	   $this->DB_ERROR = mysql_error();
    	}
    	if ( $this->DB != FALSE )
    	{
    		$res = mysql_select_db( $DB_DATABASE );
    		if ($res == FALSE)
    		{
    			return FALSE;
    		}
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }


    /**
     * __construct : Constructor for class, sets internal variables and runs db_connect.
     *
     * @param string $DB_HOST
     * @param string $DB_USER
     * @param string $DB_PASS
     * @param string $DB_DATABASE
     * @param boolean $PROFILE_SQL
     * @return boolean
     * TRUE on success
     * FALSE otherwise
     */

    function __construct($DB_HOST, $DB_USER, $DB_PASS, $DB_DATABASE, $PROFILE_SQL = FALSE)
    {
        $this->PROFILE_SQL = $PROFILE_SQL;

    	if ($this->DB == FALSE)
    	{
    		if ($this->db_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_DATABASE) != TRUE)
    		{
    			return FALSE;
    		}
    		else
    		{
    		    return TRUE;
    		}
    	}
    }

    /**
     * __destruct : Destructor for class, closes the MySQL connection
     *
     */

    function __destruct()
    {
        if ($this->DB)
        {
            @mysql_close($this->DB);
        }
    }

    /**
     * private_db_query : Function used internally, should not be run directly. Does the actual mysql_query
     *
     * @param string $query
     * The query to be run
     * @param boolean $memcache
     *
     * @return mysql_resource
     */

    function private_db_query($query, $memcache = NULL)
    {
    	if (!$this->DB)
    	{
    	    return NULL;
    	}

    	$res = mysql_query($query, $this->DB);
    	$this->DB_ERROR = mysql_error($this->DB);
    	return $res;
    }

    /**
     * Extracts the data from the mysql query resource
     *
     * @param mysql_resource $result
     *
     * @return array()
     * part of the final result returned by db_query()
     */

    function private_db_result_breakdown( $result, $retr_type = MYSQL_ASSOC )
    {
    	$block = array();
    	if ($result == FALSE)
    	{
    		return NULL;
    	}

    	$data = array();
    	if ($result === TRUE)
    	{
    		$data = array();
    	}
    	else
    	{
    	    //Extracts row by row and adds to the $data variable
    		while ( $r = mysql_fetch_array( $result, $retr_type ) )
    		{
    			$data[] = $r;
    		}
    	}

    	$block['data'] = $data;
    	if (is_resource($result))
    	{
    		$block['num_fields'] = mysql_num_fields($result);
    		$block['num_rows'] = mysql_num_rows($result);
    	}
    	$block['affected_rows'] = mysql_affected_rows($this->DB);
    	$block['insert_id'] = mysql_insert_id($this->DB);
    	$block['info'] = mysql_info($this->DB);
    	$block['error'] = mysql_error($this->DB);
    	return $block;
    }

    /**
     * db_query : The public function that should be used to run queries from outside
     *
     * @param string $query
     * The query that
     * @param int $memcache_time
     * Don't set it to anything not to cache the query
     * Set it to 0 ( zero ) to use the default time
     * Or set it to the number of seconds you want the query to be cached
     * @param string $retrieve_type
     * ASSOC - retrieve the result as an associative array
     * 				$data = array ( 
     * 									'username' => 'root', 
     * 									'password' => '*114312C1322ED1BB956D10FE05CB32A47D38CBA3'
     * 								);
     * INDEX - retrieve the result as an indexed array
     * 				$data = array ( 
     * 									'0' => 'root', 
     * 									'1' => '*114312C1322ED1BB956D10FE05CB32A47D38CBA3'
     * 								);			
     * BOTH - retrieve the result as an associative also as an indexed array
     * 				$data = array ( 
     * 									'0' => 'root', 
     * 									'username' => 'root', 
     * 									'1' => '*114312C1322ED1BB956D10FE05CB32A47D38CBA3'
     * 									'password' => '*114312C1322ED1BB956D10FE05CB32A47D38CBA3'     
     * 								);			
     * @return array()
     *
     */

    function db_query($query, $memcache_time = 0, $retrieve_type = 'assoc')
    {
    	$block = array();
    	
    	switch ( strtolower( $retrieve_type ) )
    	{
    		case 'assoc':
    		case 'associated':
    		case 'MYSQL_ASSOC':
    			$retr_type = MYSQL_ASSOC;
    			break;
    		case 'index':
    		case 'indexed':
    		case 'MYSQL_NUM':
    			$retr_type = MYSQL_NUM;
    			break;
    		case 'both':
    		case 'assoc index':
    		case 'associated index':
    		case 'assoc indexed':
    		case 'associated indexed':
    		case 'MYSQL_BOTH':
    			$retr_type = MYSQL_BOTH;
    			break;
    		default:
    			$retr_type = MYSQL_ASSOC;
    			break;
    	}

    	$timeStart = microtime(TRUE);

    	if ( ( $memcache_time != NULL ) )
    	{
    	    if ( ( ( int )$memcache_time ) == 0 )
    	    {
    	        $memcache_time = $this->MEMCH_default_time_cache;
    	    }
    	    if ( function_exists( 'memch_get_query' ) )
    	    {
				$block = memch_get_query( $query, $memcache_time, $this );
    	    }
    	    else
    	    {
    	        $block = array('error' => 'memch_get_query is not defined');
    	    }
    	}
    	else
    	{
    		$result = $this->private_db_query( $query, $memcache );
    		$block = $this->private_db_result_breakdown( $result, $retr_type );
    		$block['memcached'] = FALSE;
    		$block['query_string'] = $query;
    	}
    	$block['time'] = microtime(TRUE) - $timeStart;

    	if ( $this->PROFILE_SQL )
    	{
    	    $sql_to_log = $this->db_real_escape_string( $query );
    	    $log_sql = sprintf( "INSERT INTO `sql_log` ( `sql`, `time`, `date` ) VALUES ( '%s', '%f', NOW() )", $sql_to_log, $block['time'] );
    	    $log_sql_data = $this->private_db_result_breakdown( $this->private_db_query( $log_sql ) );
    	}

    	return $block;
    }
    
    public function db_query_indexed( $query, $memcache_time = 0 )
    {
    	
    }

    /**
     * db_real_escape_string : Public function to escape strings before added to the running query
     *
     * @param string $string
     * The parameter to be escaped
     * @return string
     * The escaped parameter
     */


    function db_real_escape_string($string)
    {
    	if ($this->DB)
    	{
    	   return mysql_real_escape_string($string);
    	}
    	else
    	{
    	    return NULL;
    	}
    }

}

?>