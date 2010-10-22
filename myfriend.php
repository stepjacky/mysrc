<?php 
 require_once "included/database.php";
 if(!isset($_POST['action']))exit(0);
 $action = $_POST['action'];
 
 switch($action){
 	case "add": doAddFriend();
 	break;
 	case "del": doDel();break;
 	default :
 	 exit(0);	
 	;
 }
 
 
 function doDel(){
 	$email = urlencode($_POST['email']);
 	$friend = urlencode($_POST['friend']);
 	remove("myfriend",array("email"=>$email,"friend"=>$friend)); 	
 }
 
 function doAddFriend(){
 	$email = urlencode($_POST['email']);
 	$friend = urlencode($_POST['friend']);
    $count = getCountByWhere("myfriend","email='$email' and  friend='$friend'");
    if($count!=0){
    	return "已在好友列表,无需再加";
    }else{
    	create("myfriend",array("email"=>$email,"friend"=>$friend));
    	return "添加好友成功!";
    }
    
 }

?>