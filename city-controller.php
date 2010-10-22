<?php
require_once "included/database.php";
$tableName='city';


if(isset($_GET['action']))
{	
	switch($_GET['action']){
		case 'getprov':
			loadProvince();
			break;
		case 'getcity':
			$id=$_GET['pid'];
			loadCityByPid($id);
			break;
		default :
			break;
	}
}
function loadProvince(){
   $sql = "select p_id id ,p_nm name from district_phonecode group by p_id";
   $result = query($sql);
   $i=0;
   $responce= array();
   while($row = mysql_fetch_assoc($result)){
   	  $responce[$i]['id']=$row['id'];
   	  $responce[$i]['name']=$row['name'];
   	  $i++;
   }
   echo jsonEncode($responce);

}

function loadCityByPid($pid){
   $sql = "select p_id id,c_nm name from district_phonecode where p_id=$pid group by c_nm";
   $result = query($sql);
   $i=0;
   $responce= array();
   while($row = mysql_fetch_assoc($result)){
   	  $responce[$i]['id']=$row['id'];
   	  $responce[$i]['name']=$row['name'];
   	  $i++;
   }
   echo jsonEncode($responce);
}

?>