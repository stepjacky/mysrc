<?php 
use utils\Result;
require_once '../../tools/utils.php';
require_once '../../tools/jsonutil.php';
use utils\Utils;
use utils\Response;
use data\BaseDao;
  
  if(!isset($_POST['action'])){
      echo 'NoAction Set';
      exit(0);
  }
  $action =$_POST['action'];
  unset($_POST['action']);
  switch ($action){
      case "updateFoodfash": doUpdateFoodfash();break;
      case "updateflash" : doUpdateFlash();break;
      case "loadnamepos":  doLoadNamePos();break;
      case "updateNewFoods" : doUpdateNewFoods();break; 
      case "updateAd" : doUpdateAd();break;
      case "addindicate" : doAddindicate();break;
      case "updateflash" : doUpdateFlash();break;
      default:
          echo 'error action code';
          exit(0);
          break;     
      
  }

function doUpdateFoodfash(){
    
	$util = new Utils();
	$entityName = $util->getEntryName(basename(__FILE__));
	$dao = new BaseDao($entityName);
	$cnt = $dao->getCountByWhere(" pos='".$_POST['pos']."'");
	$pos = $_POST['pos'];
	if($cnt==0){	
     	$dao->create($_POST);
	}else{
		
		unset($_POST['pos']);
		
		$dao->update($_POST,"pos='$pos'");
	}
	$rst =  new Result();
	$rst->SUCCESS();
   
}  

function doLoadNamePos(){
	$sql = "select * from foodmap";
	$util = new Utils();
	$entityName = $util->getEntryName(basename(__FILE__));
	$dao = new BaseDao($entityName);
	
	$blist = $dao->getBeansByColumnKey("pos");
	
	echo jsonEncode($blist);
	
}
  
function doUpdateAd(){
	$util = new Utils();
	$entityName = $util->getEntryName(basename(__FILE__));
	$dao = new BaseDao($entityName);
	$image = $_POST['image'];
	$pos = $_POST['pos'];
	$sql = "update $entityName set image='$image' where pos='$pos'";
	$dao->executeUpdate($sql);
	$rst = new Result();
	$rst->SUCCESS("更新图片成功");
}

function doAddindicate(){
   $name = $_POST['name'];
   $indicate = $_POST['indicate'];
   $indicates  = explode(",", $indicate);
   $SQL = "insert into indicatesection (name,indicate) values";
   foreach ($indicates as $ids){
   	 if($ids!=""){
   	    $SQL = $SQL."('$name','$ids'),";
   	 }
   }
   
   $SQL= substr($SQL, 0,strrpos($SQL,','));
   
   $dao = new BaseDao("indicatesection");
   $dao->executeUpdate($SQL);
   
   $rst = new Result();
   $rst->SUCCESS("操作成功");
	
	

}

	  
?>