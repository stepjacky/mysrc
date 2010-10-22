<?php
  if(!isset($_GET['userId'])){
  	exit(0);
  }
  $userId = urlencode($_GET['userId']);
  require_once "included/database.php";
  $sql = "select usertype from user where email='$userId'";
  loginfo($sql);
  $utype = getFieldValue($sql);
  loginfo("用户类型 : ".$utype);
  //exit(0);
  $url='';
  if($utype=='T'){
  	$url = "teacher-index.php?userId=".urldecode($userId);
	
  }else{
  	$url = "student-index.php?userId=".urldecode($userId);
  }
  header ("HTTP/1.1 303 See Other");
  header ("Location: $url");
?>