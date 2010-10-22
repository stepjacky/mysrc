<?php 
  session_start();
  $nick='';
  if(isset($_SESSION['loginuser']) && isset($_SESSION['usertype'])){
	  if($_SESSION['usertype']!='U'){
	     $url = "login.php";
		 header ("HTTP/1.1 303 See Other");
		 header ("Location: $url");
		 exit(0);
	  }else{
		 $nick=$_SESSION['localname'];
	  }
   }else{
   	     $url = "login.php";
		 header ("HTTP/1.1 303 See Other");
		 header ("Location: $url");
		 exit(0);
   }
?>