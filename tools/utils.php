<?php
namespace utils;
$path= dirname(__FILE__);
require_once ($path.'/../fckeditor/fckeditor.php');
require_once ($path.'/firephpcore/fb.php');
require_once ($path.'/firephpcore/FirePHP.class.php');
require_once ("jsonutil.php");

class Response{
	public $page;
	public $total;
	public $records;
	public $rows = array();
	public function __construct(){

	}
	public function __destruct(){
			
	}
}

class NameValue{
	public $name;
	public $value;
	public function __construct(){

	}
	public function __destruct(){
			
	}
}

class Message{
	public  $message;
	public function __construct($msg){
		$this->message = $msg;
	}
}

use utils\HtmlUtils;
class Result{
	private $log;
	private $message;
	public function __construct(){
		$this->log = new  HtmlUtils();
	}

	public function SUCCESS(){
		$args = func_get_args();
		$args_num = func_num_args();
		if($args_num>1) {
			throw new Exception("参数只能有一个");
			exit(0);
		}
		if($args_num==1)
		$this->message = new Message("$args[0]");
		else
		$this->message = new Message("操作成功完成");
		echo jsonEncode($this->message);
	}


	public function CREATE_SUCCESS(){
		$args = func_get_args();
		$args_num = func_num_args();
		if($args_num>1) {
			throw new Exception("参数只能有一个");
			exit(0);
		}
		if($args_num==1)
		$this->message = new Message("$args[0]");
		else
		$this->message = new Message("添加操作成功完成");
		echo jsonEncode($this->message);
	}


	public function FAILURE(){
		$args = func_get_args();
		$args_num = func_num_args();
		if($args_num>1) {
			throw new Exception("参数只能有一个");
			exit(0);
		}
		$this->message = new Message("操作出错 原因:$args[0]");
		echo jsonEncode($this->message);
	}

}

class Utils{

	public $homeImageBase = "/cs78/view/config/jquery_upload_crop/upload_pic/";

	public function getHomeImageDir(){
		return $_SERVER['DOCUMENT_ROOT'].$this->homeImageBase;
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
	public function randString($len){
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; // characters to build the password from
		$string = '';
		for(;$len >= 1;$len--){
			$position = rand() % strlen($chars);
			$string .= substr($chars, $position, 1);
		}
		return $string;
	}

	/**
	 * @param $dir 父目录
	 * @param $excludeExt  要排除的文件扩展名
	 **/
	public  function listFiles($dir,$excludeExt){
		// Open a known directory, and proceed to read its contents
		$files = array();
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if ($file!="." && $file!="..") {
						$ext = $this->parseFileExt($file);
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

	public  function  parseFileExt($file_name){
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

	public function  logArray($array){
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}


	public function  getProperty($bean,$property){
		if(isset($bean[$property]))return $bean[$property];
		else return "";
			
	}

	public function getEntryName($baseName){
		return substr($baseName,0, strrpos($baseName, '.'));
	}


	public function createFckeditor($name,$value){

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
	public function emailValidate($email){
		return eregi("^([_a-z0-9-]+)(.[_a-z0-9-]+)*@([a-z0-9-]+)(.[a-z0-9-]+)*(.[a-z]{2,4})$", $email);
		//return preg_match("/^([\w{1,}])([\w-]*(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i" , $inEmailStr);
	}

	public function checklogin(){
		session_start();
		if(isset($_SESSION['loginuser'])){
			return;
		}
		$url = "login.php";
		header ("HTTP/1.1 303 See Other");
		header ("Location: $url");
		exit(0);
	}
	public function is_valid_email($email, $test_mx = false){
		if(eregi("^([_a-z0-9-]+)(.[_a-z0-9-]+)*@([a-z0-9-]+)(.[a-z0-9-]+)*(.[a-z]{2,4})$", $email))
		if($test_mx){
			list($username, $domain) = split("@", $email);
			return getmxrr($domain, $mxrecords);
		}else
		return true;
		else
		return false;
	}

	public function redirect($url){
		header( "HTTP/1.1 301 Moved Permanently" );
		header ("Location:".$url);
		exit(0);
	}
	/**
	 * @desc 转换jqgrid的查询标示符为sql字符
	 * @param $opr 比较符号
	 * @return sql对比符号
	 **/
	public function jQGridOperator2Sql($opr){
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
	/**
	 * @desc 相除取整数部分
	 * */
	public function trunc($n1,$n2){
		if($n2==0)return 0;
		else
		return floor($n1/$n2);
	}

	/**
	 * @desc 输出firephp日志
	 * */
	function logInfo($msg){
		ob_start();
		fb($msg);
	}


	/**
	 * 一下是ppedu网站的某些业务方法
	 * */

	protected  function getTodayTime($email){
		$timeTotal = "sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))/60";
		$format=" %d ";
		return  sprintf($format,getFieldValue("select $timeTotal as t from user_result where email='$email'
            and YEAR(start_time)=YEAR(curdate()) 
			and MONTH(start_time)=MONTH(curdate())
			and DAY(start_time)=DAY(curdate())"));
	}

	protected  function getYestodayTime($tmail){
		$format=" %d ";
		$timeTotal = "sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))/60";
		return sprintf($format,getFieldValue("select $timeTotal as t from user_result where email='$tmail'
	and YEAR(start_time)=YEAR(curdate()) 
	and MONTH(start_time)=MONTH(curdate())
	and DAY(start_time)=DAY(DATE_ADD(curdate(), INTERVAL -1 DAY))"));
	}
	protected  function getTheWeekTime($tmail){
		$format=" %d ";
		$timeTotal = "sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))/60";
		return sprintf($format,getFieldValue("select $timeTotal as t from user_result where email='$tmail'
	and YEAR(start_time) = YEAR(curdate())
	and WEEK(start_time)=WEEK(curdate())"));
	}
	protected   function getTotalTime($tmail){
		$format=" %d ";
		$timeTotal = "sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)))/60";
		return sprintf($format,getFieldValue("select $timeTotal as t from user_result where email='$tmail'"));
	}
}
class HtmlUtils extends  Utils{
	/**
	 * @desc 为html页面添加某些header
	 * */
	public  function htmlHeader(){
		header('content-Type=text/html;charset=utf-8');
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	}
}
Class ImageUpload{

	public function upload($dir){
		$names = array();
		$util = new Utils();
		if(function_exists("date_default_timezone_set") and function_exists("date_default_timezone_get"))
		@date_default_timezone_set(@date_default_timezone_get());
		if(isset($_POST["Submit"])){
			$an = count($_FILES["myImagefile"]["name"]);
			for($i=0;$i<$an;$i++){
				$extname = $util->parseFileExt($_FILES["myImagefile"]["name"][$i]);
				if($extname!=false){
					$fileName = $util->randString(20).".".$extname;
					array_push($names,$util->homeImageBase."/".$fileName);
					$save_name = $dir."/".$fileName;
					move_uploaded_file($_FILES["myImagefile"]["tmp_name"][$i],$save_name);
				}
			}
		}
		return join($names, ",");
	}
}
require ('Smarty.class.php');
use Smarty;
define("SMARTY_TEMP","d:/website/htdocs/cs78/smarty/templates");
define("SMARTY_CFG","d:/website/htdocs/cs78/smarty/config");
define("SMARTY_CACHE","d:/website/smarty/smarty_cache");
define("SMARTY_TEMP_C","d:/website/smarty/smarty_templates_c");
class MySmarty extends Smarty{
	public function __construct() {
		parent::__construct();
		$this->template_dir = SMARTY_TEMP;
		$this->config_dir = SMARTY_CFG;
		$this->cache_dir = SMARTY_CACHE;
		$this->compile_dir = SMARTY_TEMP_C;
			
	}

	public function set($name,$var){
		parent::assign($name,$var);
	}

	public function show($page){
		parent::display($page);
	}
}
namespace data;
use utils\Utils;
use utils\Result;
class DBConnection{
	private  $host;     //'localhost';
	private  $user;     //'root';
	private  $password; //= $dbinfo['pass'];//'';
	private  $database; // = $dbinfo['dbname'];//'mydb';
	public function __construct(){
		$this->database='cs78';
		$this->host='127.0.0.1';
		$this->user='root';
		$this->password='';
	}

	public function Host(){
		return $this->host;
	}
	public function User(){
		return $this->user;
	}
	public function Password(){
		return $this->password;
	}
	public function Database(){
		return $this->database;
	}

	public function __destruct(){

	}
}
class BaseDao{
	private $entryName;
	private $db;
	private $result;

	public  function __construct($entityName){
		$this->entryName = $entityName;
		$this->db = new DBConnection();
		$this->result = new Result();
	}

	public function setEntityName($entityName){

		$this->entryName = $entityName;
	}

	/**
	 * @desc
	 * 构成 条件为 $ind=$id的条件查询
	 * 返回一行
	 * @param $id 条件值
	 * @param $ind 列名
	 * @return
	 * 返回条件限制的结果的一行
	 *
	 */
	public function getBean($id){
		$args = func_get_args();
		$ind = "id";
		if(func_num_args()>2){
			throw new Exception("参数不正确");
			return null;
		}
		if(func_num_args()==2){
			$ind = $args[1];
		}

		$sql = "select * from  $this->entryName  where $ind='$id'";
		$util = new Utils();
		$ts = $this->queryForEntity($sql);
		///$util->logInfo(count($ts));
		if(count($ts)==0)return null;
		return $ts[0];
	}

	/**
	 * @desc
	 * 求一个sql语句的值，就是一个列值
	 * @param
	 * $sql  sql 语句 不管多少列，总取第一个列
	 * @return
	 * 返回列值
	 */

	public function executeForValue($sql){
		$this->connect();
		$result = mysql_query($sql);
		$count = null;
		while($row = mysql_fetch_row($result)){
			$count = $row[0];
		}
		$this->close();
		return $count;
	}


	public  function  getBeans(){
		$sql = 'select * from '.$this->entryName;
		return $this->queryForEntity($sql);
	}

	/**
	 * 返回一个以$keyCol代表的列值作为
	 * hash的 对象数组
	 *
	 *
	 *
	 * */
	public function getBeansByColumnKey($keyCol){
		if(func_num_args()==2){
			$sql = func_get_arg(1);
		}else{
			$sql = "select * from $this->entryName";
		}
		$result = $this->query($sql);
		$entryList = array();
		$columns = $this->getQueryMetadata($result);
		///logInfo(count($columns));
		while($row = mysql_fetch_assoc($result)){
			$entry = array();
			// logInfo('列长度:'.count($columns));
			$key = '';
			for ($i=0;$i<count($columns);$i++){
				$name = $columns[$i];
				if(isset($row[$name])){
					if(strtolower($name) == strtolower($keyCol)){

						$key = $row[$name];

					}
					$entry[$name] = $row[$name];
				}
			}
			$entryList[$key] =$entry;

		}
		return $entryList;
	}


	/**
	 * @param $cons Sql 条件
	 * @return 返回对象数组
	 * */
	public function getBeansWithCondition($cons){
		$sql = 'select * from '.$this->entryName.' where '.$cons;
		return $this->queryForEntity($sql);
	}

	/**
	 *  @return
	 *  <dd>返回数组列表每个数组元素
	 *  <dd>代表查询结果的一行,用数组
	 *  <dd>表示,而每个数组的haskey代
	 *  <dd>表查询字段的值
	 *  @param
	 *  $sql 查询语句
	 * */
	public function executeQuery($sql){

		return $this->queryForEntity($sql);

	}
	/**
	 * 获取以某列值作为key的数组
	 * @param $keyCol  列名
	 * @param $sql 可选,要执行的sql
	 * @return
	 * 数组对象
	 *
	 **/
	public function executeKeyedQuery($keyCol,$sql){
			
		if(func_num_args()==2){
			$sql = func_get_arg(1);
		}else{
			$sql = "select * from $this->entryName";
		}
		$result = $this->query($sql);
		$entryList = array();
		$columns = $this->getQueryMetadata($result);
		///logInfo(count($columns));
		while($row = mysql_fetch_assoc($result)){
			$entry = array();

			$key = '';
			// 提取列数据
			for ($i=0;$i<count($columns);$i++){
				$name = $columns[$i];
				if(isset($row[$name])){
					if(strtolower($name) == strtolower($keyCol)){

						$key = $row[$name];
							
					}
					$entry[$name] = $row[$name];

				}
			}
			//列数据提取完毕
			if(!isset($entryList[$key])) $entryList[$key] = array();
			array_push($entryList[$key], $entry);
		}
		return $entryList;
	}

	public function executeForObject($sql){
		return $this->queryForEntity($sql);
			
	}

	public function getBeansPage($index,$size){
		$sql = 'select * from '.$this->entryName.' limit '.$index.','.$size;
		return  $this->queryForEntity($sql);
	}

	public function create(){
		$args_num = func_num_args();
		if($args_num==0|| $args_num>2)return '{"message":"添加操作参数错误"}';
		$args = func_get_args();
		$values = $args[0];
		$skipHtml = false;
		if($args_num==2)$skipHtml = $args[1];
		if(!is_array($values)){
			throw new Exception("values must a key-value array ");
			return;
		}
		$this->connect();
		$sql = $this->strutSQLInsertor($values,$skipHtml);
		$util = new Utils();
		$util->logInfo($sql);
		mysql_query($sql) or exit(mysql_error()." with sql [$sql]");
		$lastId = $this->getLastInsertId();
		$this->close();
		return $lastId;
	}

	public function remove($values){
		$this->connect();
		$datas = "";
		if(is_array($values)){
			while($key = key($values)){
				$datas = $datas . $key . "='" . $values[$key] . "'\t and ";
				next($values);
			}
			$datas = substr($datas,0,strlen($datas)-4);
		}else {
			$datas = $values;

		}
			
		$sql = "delete from \t" . $this->entryName. " \t where \t " . $datas;
		//loginfo($sql);
		$result = mysql_query($sql);
		if(!$result) echo "$sql executed failed!</p>";
		$this->close();
	}


	public function deleteBatch($idName, $values){
		$this->connect();
		$datas = "";
		while($key = key($values)){
			$datas = $datas . ",'" . $values[$key] . "'";
			next($values);
		}
		$sql = "delete from \t" . $this->entryName. "\twhere\t" . $idName . "\tin (" . substr($datas, 1) . ")";
		$this->close();
	}


	public function executeUpdate($sql){

		$this->connect();
		$result = mysql_query($sql);
		$this->close();
		if(!$result) echo "error while execute the flowing  sql please check :<br/>" . $sql;
	}

	/**
	 * 更新一个记录,可以选择条件,如果不添加条件则全部更新
	 * <DD>可能参数两个
	 * <DD>
	 * @param
	 *     $values 要跟新的key-value对
	 * @param
	 *     $condition 更新条件 可选
	 */
	public function update(){
		$args_num = func_num_args();
		if($args_num<2) return '{"message":"更新操作参数错误"}';
		$args = func_get_args();
		$values = $args[0];
		$conditions = $args[1];
		$skipHtml = false;
		if(isset($args[2]))$skipHtml = $args[2];
		if(!is_array($values)) die("either $values is not array ");
		$this->connect();
		$sql = $this->strutSQLUpdator($values, $conditions,$skipHtml);
		$result = mysql_query($sql);
		if(!$result) echo "error while execute the flowing  sql please check :<br/>" . $sql;
		$this->close();

	}

	public function getCountByWhere($where){
		$sql = "select count(*) as count from " . $this->entryName . " where " . $where;
		//echo  ($sql)."<br/>";
		$this->connect();
		$result = mysql_query($sql);
		$count = 0;
		while($row = mysql_fetch_assoc($result)){
			$count = $row["count"];
		}
		$this->close();
		return $count;

	}

	/**
	 * @desc
	 * 取得该条记录的相邻记录
	 * @param
	 *   $sql 执行的sql语句
	 * @param
	 *   $id 当前记录id
	 * @return
	 *   相邻记录
	 */
	public function getSblings($sql,$id){
			
		$allShoppers = $this->executeQuery($sql);
			
		$shopperIndex = -1;
		$prevShopper;
		$nextShooper;
		for($s=0;$s<count($allShoppers);$s++){
			if($id==$allShoppers[$s]['id']){
				$shopperIndex = $s;
				break;
			}
		}
			
		if($shopperIndex!=(count($allShoppers)-1)){
			if($shopperIndex==0){
				//这是第一个商家
				$prevShopper = null;
					
					
			}else{
					
				$prevShopper = $allShoppers[$shopperIndex-1];
					
			}

			$nextShopper = $allShoppers[$shopperIndex+1];


		}else{
			//这是最后一个商家

			if($shopperIndex==0){
				//也是是第一个商家
				$prevShopper = null;

					
			}else{
					
				$prevShopper = $allShoppers[$shopperIndex-1];
					
			}
			$nextShopper = null;


		}
			
		$sblingShoppers['next'] = $nextShopper;
		$sblingShoppers['prev'] = $prevShopper;
		return $sblingShoppers;
	}

	public function getCount(){
		$this->connect();
		$sql = "select count(*) as count from " . $this->entryName;
		$result = mysql_query($sql);
		$count = 0;
		while($row = mysql_fetch_array($result)){
			$count = $row["count"];
		}
		$this->close();
		return $count;
	}

	private function getLastInsertId(){
		$sid = mysql_query("SELECT LAST_INSERT_ID() as lid");
		$lastId=-1;
		while($row=mysql_fetch_assoc($sid)){
			$lastId=$row["lid"];
		}
		return $lastId;
	}

	/**
	 * @param $field 列显示名
	 * @param $where   条件语句,不包括 where
	 */
	public function getFieldValue($field,$where){
		$sql = "select ".$field." from ".$this->entryName." where ".$where;
		$result = query($sql);
		$rst = '';
		if($result)
		while($row = mysql_fetch_array($result,MYSQL_NUM)){
			$rst = $row[0];
		}
		return strip_tags($rst);
	}

	/**
	 *@desc
	 *构造更新语句
	 *@param $tableName 表格名字
	 *@param $value 数组键值对,列名=>列值
	 *@param $condition 更新条件的sql片段
	 *
	 **/
	private function strutSQLUpdator($val, $conditions,$skipHtml){
		// print_r($val);
		$datas = "";
		while($key = key($val)){
			if($skipHtml==false){
				$datas = $datas . "," . $key . "='" . htmlspecialchars($val[$key])."'";
			}else if($skipHtml==true){
				$datas = $datas . "," . $key . "='" . strip_tags($val[$key]) . "'";
			}
			next($val);
		}
		$sql = "update " . $this->entryName . " set " . substr($datas, 1) . " where  " .$conditions;

		return $sql;
	}

	private function strutSQLDeletor($conditions){
		$sql = "delete from  " . $this->entryName  ." where  " .$conditions;
		return $sql;
	}
	private function strutSQLInsertor($values,$skipHtml){
		if(!is_array($values)){
			throw new Exception("values must a key-value array ");

		}
		$columns = "";
		$datas = "";
		while($key = key($values)){
			$columns = $columns . "," . $key . "";
			if ($skipHtml==false) {
				$datas.= ",'" . htmlspecialchars($values[$key]) . "'";
			}elseif ($skipHtml==true){
				$datas.= ",'" . strip_tags($values[$key]) . "'";
			}
			next($values);
		}
		$sql = "insert into " . $this->entryName . "(" . substr($columns, 1) . ")\t values(" .  substr($datas, 1) . ")";
		return $sql;
	}

	private function connect(){

		mysql_connect($this->db->Host(), $this->db->User(), $this->db->Password()) or die("Could not connect to MySQL Server");
		mysql_query("SET NAMES 'UTF8'");
		mysql_query("SET CHARACTER_SET 'UTF8'");
		mysql_query("SET CHARACTER_SET_RESULTS 'UTF8'");
		mysql_select_db($this->db->Database()) or die("Could not select database!!");
	}
	//15910543919
	//database query
	public  function query($sql){
		$this->connect();
		$result = mysql_query($sql) or die(mysql_error());
		$this->close();
		return $result ;

	}

	private function queryColumns($table){
		$columns = array();
		$fields = mysql_list_fields($this->db->Database(), $table);
		$colNums = mysql_num_fields($fields);
		for($i = 0;$i<$colNums;$i++)   {
			$name = mysql_field_name($fields,$i);
			array_push($columns, $name);
		}
		$this->close();
		return $columns;

	}


	private function getQueryMetadata($result){
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


	private function queryForEntity($sql){
		$result = $this->query($sql);
		$entryList = array();
		$columns = $this->getQueryMetadata($result);
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



	private function close(){
		mysql_close();
	}



	/**
	 * @desc
	 * 带事务执行所有sql
	 * @param  $SQL是一个放了sql语句的数组
	 */

	public function queryWithTransaction($SQL){

		if(!is_array($SQL)){
			$this->result->FAILURE("参数应该是SQL数组");
			return ;
		}
		$link_id = @mysql_connect($this->db->Host(),$this->db->User(), $this->db->Password()) or exit(mysql_error());
		mysql_query("SET NAMES 'UTF8'");
		mysql_query("SET CHARACTER_SET 'UTF8'");
		mysql_query("SET CHARACTER_SET_RESULTS 'UTF8'");
		mysql_select_db($this->db->Database(), $link_id) or exit(mysql_error());
		/* 创建事务 */
		mysql_query('START TRANSACTION', $link_id) or exit(mysql_error());
		for($i = 0; $i < count($SQL); $i++) {
			if(! mysql_query($SQL[$i], $link_id)) {
				/*
				 * 按理每次更新查询都应该进行判断
				 * 若 SQL 执行出错，回卷本次事务操作。
				 */
				$err_msg = mysql_error();
				mysql_query('ROLLBACK', $link_id) or exit(mysql_error());
				$this->result->FAILURE("执行有错误在 [$SQL[$i]] : <br/> 信息: $err_msg <br/>事务被回滚");
				exit(0);
			}
		}
		mysql_query('COMMIT', $link_id) or exit(mysql_error());
		$this->close();
		$this->result->SUCCESS();

	}
}
?>