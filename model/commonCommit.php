<?php
use utils\Result;
require_once '../tools/utils.php';
require_once '../tools/jsonutil.php';
use utils\Utils;
use utils\Response;
use data\BaseDao;
session_start();
if(!isset($_POST['action'])){
	echo '{"message":"没有设置活动"}';
	exit(0);
}
$action =$_POST['action'];
unset($_POST['action']);
switch ($action){
	case "create" : doCreate();break;
	case "delete" : doDelete();break;
	case "search" : doSearch();break;
	case "update" : doUpdate();break;
	case "list"   : doList();break;
	default:
		echo '{"message":"错误的action参数"}';
		exit(0);
		break;
			
}

function doCreate(){
	$util = new Utils();
	$entryName = $util->getEntryName(basename(__FILE__));
	$dao  =new BaseDao($entryName);
	$_POST['ip'] = $_SERVER['REMOTE_ADDR'];

	$acode  = strtolower($_POST['acode']);
	$scode  = strtolower($_SESSION['code']);

	unset($_POST['acode']);
	$rst = new Result();
	if($acode!=$scode){
		$rst->FAILURE("验证码错误");
		return ;
	}

	$dao->create($_POST);
	$rst->CREATE_SUCCESS();

}

function doDelete(){
	$util = new Utils();
	$entryName = $util->getEntryName(basename(__FILE__));
	$dao  =new BaseDao($entryName);
	$shopperId = $_POST["id"];
	$dao->remove("id=$shopperId");
	$rst = new Result();
	echo $rst->SUCCESS();

}

function doSearch(){


}

function doUpdate(){
	 
}
function doList(){
	header("Content-type: text/json;charset=utf-8");
	$responce = new Response();
	$util = new Utils();
	$entryName = $util->getEntryName(basename(__FILE__));
	$dao = new BaseDao($entryName);
	if(isset($_POST['actionparam']) && $_POST['actionparam']=='all'){
		$SQL = "SELECT id FROM $entryName";
		$result = $dao->query($SQL);
		$i=0;
		while($row = mysql_fetch_assoc($result)) {
			$responce->rows[$i]['id']=$row['id'];
			$i++;
		}
		$str = jsonEncode($responce);
		echo $str;
		exit (0);

	}
	$page  = $_POST['page']; // get the requested page
	$limit = $_POST['rows']; // get how many rows we want to have into the grid
	$sidx  = $_POST['sidx']; // get index row - i.e. user click to sort
	$sord  = $_POST['sord']; // get the direction
	if(!$page) $page=0;
	if(!$limit) $limit=10;
	if(!$sidx) $sidx =1;
	$count = $dao->getCount();
	//calculate the total pages for the query
	if( $count > 0 && $limit > 0) {
		$total_pages = ceil($count/$limit);
	} else {
		$total_pages = 0;
	}
	// if for some reasons the requested page is greater than the total
	// set the requested page to total page
	if ($page > $total_pages) $page=$total_pages;

	// calculate the starting position of the rows
	$start = $limit*$page - $limit;

	// if for some reasons start position is negative set it to 0
	// typical case is that the user type 0 for the requested page
	if($start <0) $start = 0;

	// the actual query for the grid data

	$SQL = "SELECT * FROM $entryName ORDER BY $sidx $sord LIMIT $start , $limit";
	$result = $dao->query($SQL);
	// we should set the appropriate header information. Do not forget this.
	$responce->page = $page;
	//logInfo($responce);
	$responce->total = $total_pages;
	$responce->records = $count;
	$responce->start  = $start;
	$responce->limit   = $limit;
	$i=0;
	while($row = mysql_fetch_assoc($result)) {
		$responce->rows[$i]['id']=$row['id'];
		$responce->rows[$i]['publishdate']=$row['publishdate'];
		$responce->rows[$i]['ip']=$row['ip'];
		$responce->rows[$i]['usernick']=$row['usernick'];
		$responce->rows[$i]['content']=$row['content'];
		$responce->rows[$i]['artitle_id']=$row['artitle_id'];
		$responce->rows[$i]['shopper_id']=$row['shopper_id'];
		$responce->rows[$i]['indexmessage_id'] = $row['indexmessage_id'];
		$i++;
	}

	//print_r($responce);exit(0);
	$str = jsonEncode($responce);
	echo $str;
}
?>