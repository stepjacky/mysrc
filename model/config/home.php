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
      case "updateCookMenu": doUpdateCookMenu();break;
      case "updateAd" : doUpdateAd();break;
      case "updateSasa": doUpdateSasa();break;
      case "updateNewFoods" : doUpdateNewFoods();break; 
      case "delete" : doDelete();break;
      case "search" : doSearch();break;
      case "updateflash" : doUpdateFlash();break;
      case "deleteImage" : doDeleteImage();break;
      case "updateNewShopper":doUpdateNewShopper();break;
      default:
          echo 'error action code';
          exit(0);
          break;     
      
  }

function doUpdateCookMenu(){
    $entityName = "artitleCatalog";
    $dao = new BaseDao($entityName);
    $SQL=array();
    $fieldName = $_POST['fieldName'];
    $SQL[]= "update $entityName set $fieldName=false";
    foreach ($_POST['id'] as $id){
        $SQL[] = "update $entityName set $fieldName=true where id=$id";
    }
    $dao->queryWithTransaction($SQL);    
   
}  
  
  
function doUpdateSasa(){
    $entityName = "artitleCatalog";
    $dao = new BaseDao($entityName);
    $id = $_POST['id'];
    unset($_POST['id']);
    unset($_POST['action']);
    $dao->executeUpdate("update $entityName set newsasa=true where id=$id ");
    
    $rst = new Result();
    $rst->SUCCESS();
    
    
}

function doUpdateNewShopper(){
	$entityName="homenewshopper";
	$image = $_POST['image'];
	$word = $_POST['newword'];
    $sql[]="truncate table $entityName";
	$sql[] = "insert into homenewshopper(imagepath,word) values('$image','$word')";
	$dao =new BaseDao($entityName);
	$dao->queryWithTransaction($sql);
}
  
function doUpdateNewFoods(){
    $entityName = "artitleCatalog";
    $dao = new BaseDao($entityName);
    $id = $_POST['id'];
    unset($_POST['id']);
    unset($_POST['action']);
    $dao->executeUpdate("update $entityName set newfoods=true where id=$id ");
    
    $rst = new Result();
    echo $rst->SUCCESS();
    
    
    
}

  
function doUpdateAd(){
    $entityName="advertisment";
    $pos = $_POST['pos'];
    //unset($_POST['pos']);
    $dao = new BaseDao($entityName);
    $entity = $dao->getBean($pos,"pos");
    if($entity!=null){
       $dao->update($_POST," pos='$pos' ");
    }else{
       $dao->create($_POST); 
    }
    $rst = new Result();
    $rst->SUCCESS();
    
}  

function doDeleteImage(){
    $util = new Utils();
    $img = $_POST['image'];
    $file = "D:/website/htdocs/". $img;
   
    if(file_exists($file)){
    	unlink($file);
    }
    $rst = new Result();
    $rst->SUCCESS("删除图片". $img ."成功!");
    
}

function doSearch(){
    
    
}

function doUpdateFlash(){
    $entityName="flashstatus";
    $id = $_POST['id'];
    unset($_POST['id']);
    $dao = new BaseDao($entityName);
    $dao->update($_POST," id=$id ");
    $rst = new Result();
    echo $rst->SUCCESS();
    
    
}
?>