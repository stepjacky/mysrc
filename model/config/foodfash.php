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
      case "delete" : doDelete();break;
      case "search" : doSearch();break;
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
	$sql = "select * from foodfash";
	$util = new Utils();
	$entityName = $util->getEntryName(basename(__FILE__));
	$dao = new BaseDao($entityName);
	
	$blist = $dao->getBeansByColumnKey("pos");
	
	echo jsonEncode($blist);
	
}
  
function doUpdateFlash(){
	$ids = array(1=>'e',2=>'f',3=>'g',4=>'h');
	print_r($_POST);
	//TODO 设置flash图片
}
	  
?>