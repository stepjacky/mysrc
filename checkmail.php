<?php
  require_once "included/database.php";
  if(isset($_GET['email'])){
  	$email = urlencode($_GET['email']);
  	$count = getCountByWhere("user","email='".$email."'");
  	if($count==0){
  		echo 'no';
  	}else{
  		echo 'yes';
  	}
  	
  }
?>