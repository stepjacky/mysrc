<?php

include_once ('fckeditor/fckeditor.php');
require_once ('firephpcore/fb.php');
require_once ('firephpcore/FirePHP.class.php');

function logInfo($msg){
	fb($msg);
}
//15910543919 崔正
//database query
function query($sql){
	connect();
	$result = mysql_query($sql) or die(mysql_error());
	close();
	return $result ;
	
}
/**
 * $field 列显示名
 * $sql   sql 语句 
 */
function getFieldValue($sql){
	$result = query($sql);
	$rst = '';
	if($result)
	while($row = mysql_fetch_array($result,MYSQL_NUM)){
		$rst = $row[0];
	}
	return strip_tags($rst);
}

function getDBInfo($local){
	$dbinfo = array();
	$dbinfo['host']="localhost";
	$dbinfo['user']="root";
	$dbinfo['pass']="";
	$dbinfo['dbname']="mydb";
		
	$dbinfoRemote = array();
	$dbinfoRemote['host']="117.34.72.2";
	$dbinfoRemote['user']="root";
	$dbinfoRemote['pass']="xueban";
	$dbinfoRemote['dbname']="mydb";
	if($local==true)return $dbinfo;
	else return $dbinfoRemote;

}
function connect(){
	$dbinfo = getDBInfo(true);
	$dbhost = $dbinfo['host'];   //'localhost';
	$dbuser = $dbinfo['user']; //'root';
	$dbpass = $dbinfo['pass'];//'';
	$dbname = $dbinfo['dbname'];//'mydb';
	mysql_connect($dbhost, $dbuser, $dbpass) or die("Could not connect to MySQL Server");
	mysql_query("SET NAMES 'UTF8'");
	mysql_query("SET CHARACTER_SET 'UTF8'");
	mysql_query("SET CHARACTER_SET_RESULTS 'UTF8'");
	mysql_select_db($dbname) or die("Could not select database!!");
}
/**
 * @desc
 * 带事务执行所有sql
 * @param  $sql是一个数组
 */

function queryWithTransaction($SQL){
    if(!is_array($SQL)){
    	return "参数应该是SQL数组";
    }
	$dbinfo = getDBInfo(true);
	$dbhost = $dbinfo['host'];   //'localhost';
	$dbuser = $dbinfo['user']; //'root';
	$dbpass = $dbinfo['pass'];//'';
	$dbname = $dbinfo['dbname'];//'mydb';
	$link_id = @mysql_connect($dbhost, $dbuser, $dbpass) or exit(mysql_error());
	mysql_query("SET NAMES 'UTF8'");
	mysql_query("SET CHARACTER_SET 'UTF8'");
	mysql_query("SET CHARACTER_SET_RESULTS 'UTF8'");
	mysql_select_db($dbname, $link_id) or exit(mysql_error());
    /* 创建事务 */
    mysql_query('START TRANSACTION', $link_id) or exit(mysql_error());
	for($i = 0; $i < count($SQL); $i++) {
		if(! mysql_query($SQL[$i], $link_id)) {
			/*
			 * 按理每次更新查询都应该进行判断，前两个例子都没做处理。
			 * 若 SQL 执行出错，回卷本次事务操作。
			 */
			$err_msg = mysql_error();
			mysql_query('ROLLBACK', $link_id) or exit(mysql_error());
			return "执行有错误在 [$SQL[$i]] : <br/> 信息: $err_msg <br/>事务被回滚";
			exit(0);
		}
	}
	mysql_query('COMMIT', $link_id) or exit(mysql_error());
	close();
	return "所有操作成功完成";

}

function print_result(&$result, $caption) {
	    $msg = '';
        $msg.= '<table width="500" border="1">';
        $msg.= '<caption>' . $caption . '</caption>';
        $msg.= '<tr height="22"><td>ID</td><td>AGE</td></tr>';

        $rows = mysql_num_rows($result);
        switch($rows) {
        case 0:
                $msg.= '<tr><td colspan=\'2\'>无记录</td></tr>';
                break;
        default :
                for($i = 0; $i< $rows; $i++) {
                        $row = mysql_fetch_array($result);
                        $msg.= '<tr><td>' . $row['id'] . '</td><td>' . $row['age'] . '</td></tr>';
                }
                break;
        }

        $msg.= '</table>';
        $msg.= '<br>';
        return $msg;
}



function strutSQLInsertor($tableName,$values){
	if(!is_array($values)){
		throw new Exception("values must a key-value array ");

	}
	$columns = "";
	$datas = "";
	while($key = key($values)){
		$columns = $columns . "," . $key . "";
		$datas.= ",'" . strip_tags($values[$key],"<img/>") . "'";
		next($values);
	}
	$sql = "insert into " . $tableName . "(" . substr($columns, 1) . ")\t values(" .  substr($datas, 1) . ")";
	return $sql;
}

function getLastInsertId(){
$sid = mysql_query("SELECT LAST_INSERT_ID() as lid");
	$lastId=-1;
	while($row=mysql_fetch_assoc($sid)){
		$lastId=$row["lid"];
	}
	return $lastId;
}
/**
 *
 * $values array("id"=>"id","name"=>"name");
 * */
function create($tableName , $values){
	if(!is_array($values)){
		throw new Exception("values must a key-value array ");
        return;
	}
	connect();
	$sql = strutSQLInsertor($tableName,$values);
	mysql_query($sql) or exit(mysql_error()." with sql [$sql]");
	close();	
	return getLastInsertId();
}

function remove($tableName, $values){
	connect();
	$datas = "";
	while($key = key($values)){
		$datas = $datas . $key . "='" . $values[$key] . "'\t and ";
		next($values);
	}
	$datas = substr($datas,0,strlen($datas)-4);
	$sql = "delete from \t" . $tableName . " \t where \t " . $datas;
	//loginfo($sql);
	$result = mysql_query($sql);
	if(!$result) echo "$sql executed failed!</p>";
	close();
}

function deleteBatch($tableName , $idName, $values){
	connect();
	$datas = "";
	while($key = key($values)){
		$datas = $datas . ",'" . $values[$key] . "'";
		next($values);
	}
	$sql = "delete from \t" . $tableName . "\twhere\t" . $idName . "\tin (" . substr($datas, 1) . ")";
	close();
}

/**
 *@desc
 *构造更新语句
 *@param $tableName 表格名字
 *@param $value 数组键值对,列名=>列值
 *@param $condition 更新条件的sql片段 
 * 
 **/
function strutSQLUpdator($tableName, $values, $conditions){
	$datas = "";
	while($key = key($values)){
		$datas = $datas . "," . $key . "='" . strip_tags($values[$key],"<img/>") . "'";
		next($values);
	}
	$sql = "update " . $tableName . " set " . substr($datas, 1) . " where  " .$conditions;
	return $sql;
}

function strutSQLDeletor($tableName,$conditions){
	$sql = "delete from  " . $tableName ." where  " .$conditions;
	return $sql;
}

/**
 * update records
 */
function update($tableName, $values, $conditions){
	if(!is_array($values)) die("either $values is not array ");
	connect();
	$sql = strutSQLUpdator($tableName, $values, $conditions);
	$result = mysql_query($sql);
	if(!$result) echo "error while execute the flowing  sql please check :<br/>" . $sql;
	close();

}

function getCountByWhere($tableName, $where){
	$sql = "select count(*) as count from " . $tableName . " where " . $where;
	//echo  ($sql)."<br/>";
	connect();	
	$result = mysql_query($sql);
	$count = 0;
	while($row = mysql_fetch_assoc($result)){
		$count = $row["count"];
	}
	close();
	return $count;

}



function getCount($tableName){
	connect();
	$sql = "select count(*) as count from " . $tableName;
	$result = mysql_query($sql);
	$count = 0;
	while($row = mysql_fetch_array($result)){
		$count = $row["count"];
	}
	close();
	return $count;
}
/**
 * query by page
 */
function queryPage($tableName, $conditions , $index, $offset){
	connect();
	$cdatas = "";
	while($key = key($conditions)){
		$cdatas = $cdatas . "  " . $key . "='" . $conditions[$key] . "' and";
		next($conditions);
	}
	$sql = "select * from " . $tableName . "  where " . substr($cdatas, 0, strlen($cdatas)-4);
	$result = mysql_query($sql);
	close();
	return $result;
}

function close(){
	mysql_close();
}


/**
 * 返回数据库记录的起始索引
 */
function getStartIndex($pageIndex, $rowCount, $rowsInpage){
	if (($pageIndex <= 0) || ($pageIndex >= $rowCount))
	return 0;
	return (($pageIndex - 1) * $rowsInpage);

}

/**
 * 返回总页数
 */
function getPageCount($rowCount, $rowsInPage){
	$base = $rowCount / $rowsInPage;
	if ($rowCount % $rowsInPage == 0)
	$pageCount = $base;
	else
	$pageCount = ($base + 1);
	return $pageCount;
}

function getParameter($name){
	if(isset($_GET[$name])){
		return $_GET[$name];
	}else{
		if(isset($_POST[$name])){
			return $_POST[$name];
		}else{
			return null;

		}
	}
}
/**
 * 返回当前页的记录数
 */
function getRowsInPage($pageIndex, $rowCount, $rowsInPage){
	$pCount = getPageCount($rowCount, $rowsInPage);
	if($pageIndex < $pCount){
		return $rowsInPage;
	}else{
		return $rowCount % $rowsInPage;
	}
}

/**
 * PHP4 JSON Encode 函数
 */

/**
 * 用了很多callback,本来想用create_function(lambda style)的,但那种方式内存占用过大
 而且最别扭的是PHP 函数里的static变量不能设为函数返回值,而且函数(包括lambda)
 * 始终是全局访问权限,不能以类似closure的方式读取嵌套在外层的函数里的变量的值
 最好只好多声明几个全局函数了
 针对PHP4的json_encode与json_decode实现,官方有一个pear包 Services_JSON
 * 特地两者进行对比:
 * jsonEncode函数执行速度是 Services_JSON->encode的3倍
 jsonDecode函数执行速度是 Services_JSON->decode的6倍
 唯一不足的是jsonEncode函数内存占用要超过Services_JSON->encode
 * 而jsonDecode内存占用则要比 Services_JSON->decode少得多(少了一位数)
 *
 * jsonDecode函数支持无限层嵌套的数组(只要机器吃得消就行)
 * 主要得益于使用了eval,而且速度也快了许多

 * 可以在PHP5使用下面的方式测试,几乎与内置的函数输出结果一样

 * echo jsonEncode($_SERVER)==json_encode($_SERVER);
 * echo jsonEncode(jsonDecode(json_encode($_SERVER)))==json_encode($_SERVER);
 * echo print_r(jsonDecode(jsonEncode($_SERVER)),true)==print_r($_SERVER,true);
 *
 * 不同的一点是PHP5中json_decode返回一个stdClass,而这里的jsonDecode返回的是数组
 */
function jsonEncode($data){
	//return json_encode($data);
	if (2 == func_num_args()){
		$callee = __FUNCTION__;
		return json_format_scalar(strval(func_get_arg(1))) . ":" . $callee($data);
	}
	is_object($data) && $data = get_object_vars($data);
	if (is_scalar($data)){
		return json_format_scalar($data);
	}
	if (empty($data)){
		return '[]';
	}
	$keys = array_keys($data);
	if (is_numeric(join('', $keys))){
		$data = array_map(__FUNCTION__, $data);
		return '[' . join(',', $data) . ']';
	}else{
		$data = array_map(__FUNCTION__, array_values($data), $keys);
		return '{' . join(',', $data) . '}';
	}
}
function json_format_scalar($value){
	if (is_bool($value)){
		$value = $value?'true':'false';
	}else if (is_int($value)){
		$value = (int)$value;
	}else if (is_float($value)){
		$value = (float)$value;
	}else if (is_string($value)){
		$value = addcslashes($value, "\n\r\"\/\\");
		$value = '"' . preg_replace_callback('|[^\x00-\x7F]+|', 'json_utf_slash_callback', $value) . '"';
	}else{
		$value = 'null';
	}
	return $value;
}
function json_utf_slash_callback($data){
	if (is_array($data)){
		$chars = str_split(iconv("UTF-8", "UCS-2", $data[0]), 2);
		$chars = array_map(__FUNCTION__, $chars);
		return join("", $chars);
	}else{
		$char1 = dechex(ord($data{0}));
		$char2 = dechex(ord($data{1}));
		return sprintf("\u%02s%02s", $char1, $char2);
	}
}
function json_utf_slash_strip($data){
	if (is_array($data)){
		return iconv("UCS-2", "UTF-8", chr(hexdec($data[1])) . chr(hexdec($data[2])));
	}else{
		return preg_replace_callback('/(?<!\\\)\\\u([a-f0-9]{2})([a-f0-9]{2})/', __FUNCTION__, $data);
	}
}
function jsonDecode($data){
	static $strings, $count = 0;
	if (is_string($data)){
		$data = trim($data);
		if ($data{0} != '{' && $data{0} != '[') return json_utf_slash_strip($data);
		$strings = array();
		$data = preg_replace_callback('/"([\s\S]*?(?<!(?<!\\\)\\\))"/', __FUNCTION__, $data);
		// 简单的危险性检测
		$cleanData = str_ireplace(array('true', 'false', 'undefined', 'null', '{', '}', '[', ']', ',', ':', '#'), '', $data);
		if (!is_numeric($cleanData)){
			throw new Exception('Dangerous!The JSONString is dangerous!');
			return NULL;
		}
		$data = str_replace(
		array('{', '[', ']', '}', ':', 'null'),
		array('array(', 'array(', ')', ')', '=>', 'NULL')
		, $data);
		$data = preg_replace_callback('/#\d+/', __FUNCTION__, $data);
		// 抑制错误,诸如{123###}这样错误的JSON是不能转换成PHP数组的
		@$data = eval("return $data;");
		$strings = $count = 0;
		return $data;
	}elseif (count($data) > 1){ // 存储字符串
		$strings[] = json_utf_slash_strip(str_replace(array('$', '\\/'), array('\\$', '/'), $data[0]));
		return '#' . ($count++);
	}else{ // 读取存储的值
		$index = substr($data[0], 1);
		return $strings[$index];
	}
}


/**
 * 产生随机字符串 
 *
 * 产生一个指定长度的随机字符串,并返回给用户
 *
 * @access public
 * @param int $len 产生字符串的位数
 * @return string
 */
function randString($len){
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; // characters to build the password from
	$string = '';
	for(;$len >= 1;$len--){
		$position = rand() % strlen($chars);
		$string .= substr($chars, $position, 1);
	}
	return $string;
}
function makeSelect($id,$sql){
	$result = query($sql);
	$selector = "<select id='".$id."' name='".$id."'>";
	$selector.="<option value='-1'>请选择...</option>";
	while($row = mysql_fetch_array($result,MYSQL_NUM)){
		$selector=$selector."<option value='".$row[0]."'>".$row[1]."</option>";
			
	}
	$selector=$selector."</select>";
	return $selector;

}

function createFckeditor($name,$value){

	$sBasePath = "fckeditor/" ;
	$oFCKeditor = new FCKeditor($name) ;
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Height	=180 ;
	$oFCKeditor->Value	= $value ;
	$oFCKeditor->Create() ;
}
/**
 * 验证 email合法性
 * */
function emailValidate($email){
	return eregi("^([_a-z0-9-]+)(.[_a-z0-9-]+)*@([a-z0-9-]+)(.[a-z0-9-]+)*(.[a-z]{2,4})$", $email);
	//return preg_match("/^([\w{1,}])([\w-]*(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i" , $inEmailStr);
}

function checklogin(){
	session_start();
	if(isset($_SESSION['loginuser'])){
		return;
	}
	$url = "login.php";
	header ("HTTP/1.1 303 See Other");
	header ("Location: $url");
	exit(0);
}
function is_valid_email($email, $test_mx = false){
    if(eregi("^([_a-z0-9-]+)(.[_a-z0-9-]+)*@([a-z0-9-]+)(.[a-z0-9-]+)*(.[a-z]{2,4})$", $email))
	if($test_mx){
      list($username, $domain) = split("@", $email);
      return getmxrr($domain, $mxrecords);
    }else
      return true;
    else
    return false;
}





function getTodayTime($email){
	$timeTotal = "sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))/60";
	$format=" %d ";
    return  sprintf($format,getFieldValue("select $timeTotal as t from user_result where email='$email' 
            and YEAR(start_time)=YEAR(curdate()) 
			and MONTH(start_time)=MONTH(curdate())
			and DAY(start_time)=DAY(curdate())"));
}

function getYestodayTime($tmail){
	$format=" %d ";
	$timeTotal = "sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))/60";
	return sprintf($format,getFieldValue("select $timeTotal as t from user_result where email='$tmail'
	and YEAR(start_time)=YEAR(curdate()) 
	and MONTH(start_time)=MONTH(curdate())
	and DAY(start_time)=DAY(DATE_ADD(curdate(), INTERVAL -1 DAY))"));
}
function getTheWeekTime($tmail){
	$format=" %d ";
	$timeTotal = "sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))/60";
	return sprintf($format,getFieldValue("select $timeTotal as t from user_result where email='$tmail' 
	and YEAR(start_time) = YEAR(curdate())
	and WEEK(start_time)=WEEK(curdate())"));
}
function getTotalTime($tmail){
	$format=" %d ";
	$timeTotal = "sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))/60";
	return sprintf($format,getFieldValue("select $timeTotal as t from user_result where email='$tmail'"));
}
function convertOpr($opr){
	$ropr='';
	switch($opr){
		case 'eq':$ropr='=' ;break;
		case 'ne':$ropr='!=';break;
		case 'lt':$ropr='<';break;
		case 'le':$ropr='<=';break;
		case 'gt':$ropr='>';break;
		case 'ge':$ropr='>=';break;
		case 'bn':$ropr=' NOT LIKE ';break;
		case 'in':$ropr=' IN ';break;
		case 'ni':$ropr=' NOT IN ';break;
		default :$ropr=' LIKE ';break;
	}
	return $ropr;
}
function trunc($n1,$n2){
	if($n2==0)return 0;
	else
	return floor($n1/$n2);
}
?>