<?php
$path= dirname(__FILE__);
require_once ($path.'/../fckeditor/fckeditor.php');
require_once ($path.'/firephpcore/fb.php');
require_once ($path.'/firephpcore/FirePHP.class.php');

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

function close(){

	mysql_close();

}
function getQueryMetadata($result){
	$columns = array();
	$i = 0;
	while ($i < mysql_num_fields($result)){
		$meta = mysql_fetch_field($result, $i);
		if (!$meta) {
			echo "No column meta information available<br />\n";
		}
		array_push($columns, $meta->name);
		$i++;

	}

	return $columns;

}

function queryForEntities($sql){
	$result =  query($sql);
	$entryList = array();
	$columns = getQueryMetadata($result);
	///logInfo(count($columns));
	while($row = mysql_fetch_assoc($result)){
		$entry = array();
		// logInfo('列长度:'.count($columns));

		for ($i=0;$i<count($columns);$i++){
			$name = $columns[$i];
			//logInfo($name.'='.$row[$name]);
			if(isset($row[$name]))
			$entry[$name] = $row[$name];
		}
		array_push($entryList,$entry);
	}
	return $entryList;
}


function  getProperty($bean,$property){
	if(isset($bean[$property]))return $bean[$property];
	else return "";

}

function getEntityName($baseName){
	return substr($baseName,0, strrpos($baseName, '.'));
}
/**
 * @deprecated
 * @uses getEntityName(baseName) 
 * @see 
 * getEntityName(baseName)
 */

function getEntryName($baseName){
	return substr($baseName,0, strrpos($baseName, '.'));
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

function getDBInfo(){
	$dbinfo = array();
	$dbinfo['host']="127.0.0.1";
	$dbinfo['user']="root";
	$dbinfo['pass']="";
	$dbinfo['dbname']="liangyu";
	return $dbinfo;

}
function connect(){
	$dbinfo = getDBInfo();
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


function strutSQLInsertor($tableName,$values){
	if(!is_array($values)){
		throw new Exception("values must a key-value array ");

	}
	$columns = "";
	$datas = "";
	while($key = key($values)){
		$columns = $columns . "," . $key . "";
		$datas.= ",'" . htmlspecialchars($values[$key], ENT_QUOTES) . "'";
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
	// echo $sql;
	mysql_query($sql) or exit(mysql_error()." with sql [$sql]");
	$id = getLastInsertId();
	close();
	return $id;
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
		$datas = $datas . "," . $key . "='" . htmlspecialchars($values[$key], ENT_QUOTES) . "'";
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


function listFiles($dir,$excludeExt){
	// Open a known directory, and proceed to read its contents
	$files = array();
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if ($file!="." && $file!="..") {
					$ext = parseFileExt($file);
					if($ext==false){
						continue;
					}else{
						$excludeExt =strtolower($excludeExt);
						if($ext == $excludeExt){
							continue;

						}else{
							array_push($files, $file);
						}


					}

				}
			}
			closedir($dh);
		}
	}
	return $files;
}
function  parseFileExt($file_name){
	$extend = pathinfo($file_name);
	if(isset($extend["extension"]))
	$extend = strtolower($extend["extension"]);
	else
	$extend = false;

	return $extend;
}
function getClientIp(){
	//php获取ip的算法

	if(getenv('HTTP_CLIENT_IP')) {
		$onlineip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR')) {
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR')) {
		$onlineip = getenv('REMOTE_ADDR');
	} else {
		$onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
	}
	return $onlineip;
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

function createFckeditor($name,$value){

	$sBasePath = "../fckeditor/" ;
	$oFCKeditor = new FCKeditor($name) ;
	$oFCKeditor->BasePath	= $sBasePath ;

	$oFCKeditor->Height	=400 ;
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

class Plain{

}
?>