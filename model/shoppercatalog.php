<?php
use utils\Result;
require_once '../tools/utils.php';
require_once '../tools/jsonutil.php';
use utils\Utils;
use utils\Response;
use data\BaseDao;

if(!isset($_POST['action'])){
    echo '{"message":"没有设置操作类型"}';
    exit(0);
}
$action =$_POST['action'];
switch ($action){
    case "updatePos": doUpdatePos();break;
    case "create" : doCreate();break;
    case "delete" : doDelete();break;
    case "search" : doSearch();break;
    case "update" : doUpdate();break;
    case "list" : doList();break;
    default:
        echo '{"message":"错误的action代码,请联系管理员"}';
        exit(0);
        break;
         
}


function doUpdatePos(){
    unset($_POST['action']);
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $dao = new BaseDao($entryName);
    $id = $_POST['id'];
    unset($_POST['id']);
    
    $dao->update($_POST," id=$id ");
    $rst = new Result();
    echo $rst->SUCCESS();
    
}


function doCreate(){
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $dao  =new BaseDao($entryName);
    $values = $_POST;
    unset($values['action']);
    $dao->create($values);
    echo '{"message":"添加操作成功"}';

}

function doDelete(){
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $dao  =new BaseDao($entryName);
    $values = array("id"=>$_POST["id"]);
    $dao->remove($values);
    echo '{"message":"成功删除ID['.$_POST['id'].']"}';

}

function doSearch(){


}

function doUpdate(){
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $dao  =new BaseDao($entryName);
    $vals = array("name"=>$_POST['name'],'remark'=>$_POST['remark']);
    $dao->update($vals, "id=".$_POST["id"]);
    echo '{"message":"更新操作成功"}';

}
function doList(){
 header("Content-type: text/json;charset=utf-8");
    $responce = new Response();
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $dao = new BaseDao($entryName);
    if(isset($_POST['actionparam']) && $_POST['actionparam']=='all'){
        $SQL = "SELECT id,name FROM $entryName";
        $result = $dao->query($SQL);
        $i=0;
        while($row = mysql_fetch_assoc($result)) {
            $responce->rows[$i]['id']=$row['id'];
            $responce->rows[$i]['name']=$row['name'];
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
    $SQL = "SELECT id,name,remark FROM $entryName ORDER BY $sidx $sord LIMIT $start , $limit";
    $result = $dao->query($SQL);
    // we should set the appropriate header information. Do not forget this.
    $responce->page = $page;
    //logInfo($responce);
    $responce->total = $total_pages;
    $responce->records = $count;
    $i=0;
    while($row = mysql_fetch_assoc($result)) {
        //print_r($row);exit(0);
        $responce->rows[$i]['id']=$row['id'];
        $responce->rows[$i]['name']=$row['name'];
        $responce->rows[$i]['remark']=$row['remark'];
        $i++;
    }
    //print_r($responce);exit(0);
    $str = jsonEncode($responce);
    echo $str;   
}
?>