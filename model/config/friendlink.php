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
      case "delete" : doDelete();break;
      case "create" : doCreate();break;
      case "update" : doUpdate();break;
      case "list"   : doList();break;
     
      default:
          echo 'error action code';
          exit(0);
          break;     
      
  }

function doDelete(){
	$util = new Utils();
	$entityName = $util->getEntryName(basename(__FILE__));
    $dao = new BaseDao($entityName);
    $dao->remove($_POST);    
    $rst = new Result();
    $rst->SUCCESS();   
}  
  
  
function doCreate(){
    $util = new Utils();
	$entityName = $util->getEntryName(basename(__FILE__));
    $dao = new BaseDao($entityName);
    $dao->create($_POST);
    $rst = new Result();
    $rst->SUCCESS();
    
    
}
  
function doUpdate(){
    $util = new Utils();
	$entityName = $util->getEntryName(basename(__FILE__));
    $dao = new BaseDao($entityName);
   
    $id = $_POST['id'];
 	unset($_POST['id']);
    $dao->update($_POST,"id=$id");
    $rst = new Result();
    $rst->SUCCESS();
    
    
}
  
function doList(){
	   header("Content-type: text/json;charset=utf-8");
    $responce = new Response();
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $dao = new BaseDao($entryName);
    if(isset($_POST['actionparam']) && $_POST['actionparam']=='all'){
        $SQL = "SELECT id,name,href FROM $entryName";
        $result = $dao->query($SQL);
        $i=0;
        while($row = mysql_fetch_assoc($result)) {
            $responce->rows[$i]['id']=$row['id'];
            $responce->rows[$i]['name']=$row['name'];
            $responce->rows[$i]['href']=$row['href'];
            $i++;
        }
        $str = jsonEncode($responce);
        echo $str;
        exit (0);

    }
    $page = $_POST['page']; // get the requested page
    $limit = $_POST['rows']; // get how many rows we want to have into the grid
    $sidx = $_POST['sidx']; // get index row - i.e. user click to sort
    $sord = $_POST['sord']; // get the direction
    if(!$page) $page=0;
    if(!$limit) $limit=10;
    if(!$sidx) $sidx =1;
    $count = $dao->getCount();
    // calculate the total pages for the query
    if( $count > 0 && $limit > 0) {
        $total_pages = ceil($count/$limit);
    } else {
        $total_pages = 0;
    }
    // if for some reasons the requested page is greater than the total
    // set the requested page to total page
    if ($page > $total_pages) $page=$total_pages;

    // calculate the starting position of the rows
    $start = $limit*$page - $limit;

    // if for some reasons start position is negative set it to 0
    // typical case is that the user type 0 for the requested page
    if($start <0) $start = 0;

    // the actual query for the grid data
    $SQL = "SELECT * FROM $entryName ORDER BY $sidx $sord LIMIT $start , $limit";
    $result = $dao->query($SQL);
    // we should set the appropriate header information. Do not forget this.
     
    $responce = new Response();
    $responce->page = $page;
    //logInfo($responce);
    $responce->total = $total_pages;
    $responce->records = $count;
    $i=0;
    while($row = mysql_fetch_assoc($result)) {
        //print_r($row);exit(0);
        $responce->rows[$i]['id']=$row['id'];
        $responce->rows[$i]['name']=$row['name'];
        $responce->rows[$i]['href']=$row['href'];
        $i++;
    }
    //print_r($responce);exit(0);
    $str = jsonEncode($responce);
    echo $str;
	
}

?>