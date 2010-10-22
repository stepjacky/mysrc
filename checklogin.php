<?php
session_start();
define("LOGIN_URL","login.php");
require_once "included/database.php";
$rcode  =  strtolower($_POST['rcode']);
$scode  =  strtolower($_SESSION['code']);
loginfo("生成的验证码是:$rcode");
loginfo("Session验证码:$scode");
if($rcode!=$scode){
	$url = "login.php?msg=codeerror";
	header ("HTTP/1.1 303 See Other");
	header ("Location: $url");
	exit(0);
}
if(isset($_POST['email']) && isset($_POST['pwd'])){
	
	if(emailValidate($_POST['email'])){	
		$email  = urlencode($_POST['email']);
	    $pwd    = urlencode($_POST['pwd']);	
		$count = getCountByWhere("user", "email='$email' and pwd='$pwd'");
		if($count==0){
			$url = "login.php?msg=nouser";
			header ("HTTP/1.1 303 See Other");
			header ("Location: $url");
			exit(0);
		}else{
			$locked = getFieldValue("select locked from user where email='$email'");
			if($locked=='y'){
				$url = "login.php?msg=userlocked";
				header ("HTTP/1.1 303 See Other");
				header ("Location: $url");
				exit(0);
			}
			$url = "student-index.php";
			$utype = getFieldValue("select usertype from user where email='$email'");
			if($utype=='T'){
				$url = 'teacher-index.php';
			}
			$_SESSION['usertype'] =$utype;
			$_SESSION['loginuser']=urldecode($email);
			header ("HTTP/1.1 303 See Other");
			header ("Location: $url");
			exit(0);
		}
    }else{
    	$url = "login.php?msg=mailerror";
		header ("HTTP/1.1 303 See Other");
		header ("Location: $url");
		exit(0);
    }
    
}else{

	$url = "login.php?msg=noinput";
	header ("HTTP/1.1 303 See Other");
	header ("Location: $url");
	exit(0);

}
?>