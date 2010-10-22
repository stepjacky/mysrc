<?php
   if(!isset($_GET['action']) || !isset($_GET['from']) || !isset($_GET['to']) || !isset($_GET['content'])){
   	  exit(0);
   }
   require_once "included/database.php";
   
   switch($_GET['action']){
   	case "add":doAdd();break;
   	case "del":doDel();break;
   	case "list":doList();break;
   	default:;break;
   	
   }
function doAdd(){
	$from = urlencode($_GET['from']);
   $to   = urlencode($_GET['to']);
   $content = strip_tags($_GET['content']);
	create("message",array("from"=>$from,"to"=>$to,"content"=>$content));
}
function doDel(){
	remove("message",array("id"=>$_GET['id']));
}
function doList(){
	$to = urlencode($_GET['to']);
	$start = $_GET['start'];
	$sql="select id,from ,to,content ,firetime from message where to='$to' order by firetime desc limit $start,10";
	$result = query($sql);
	$response=array();
	$i=0;
	
	while($row=mysql_fetch_assoc($result)){
		$response[$i]['id']=$row['id'];
		$response[$i]['from']=$row['from'];
		$response[$i]['to']=$row['to'];
		$response[$i]['content']=$row['content'];
		$response[$i]['firetime']=strftime("%Y-%m-%e:%X",$row['firetime']);
		
	}
	echo jsonEncode($response);
}
?>