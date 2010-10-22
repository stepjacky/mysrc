<?php
require_once '../tools/utils.php';

if(!isset($_POST['action'])){
    echo '{"message":"没有设置操作类型"}';
    exit(0);
}
$action =$_POST['action'];

unset($_POST['action']);
switch ($action){
    case "create" : doCreate();break;
    case "delete" : doDelete();break;
    case "search" : doSearch();break;
    case "update" : doUpdate();break;
    case "list" : doList();break;
    default:
        
        echo '{"message":"错误的action代码"}';
        
        exit(0);
        break;
         
}
function doCreate(){
    $entryName = getEntryName(basename(__FILE__));
    create($entryName,$_POST);
    echo '{"message":"添加操作成功"}';

}

function doDelete(){
	
	$entryName = getEntryName(basename(__FILE__));
	$id = $_POST['id'];
	$values = array("id"=>$id);
	remove($entryName,$values);
    echo '{"message":"删除操作成功"}';;

}

function doSearch(){


}

function doUpdate(){
	
	$entryName = getEntryName(basename(__FILE__));
	$id = $_POST['id'];
    unset($_POST['id']);
	update($entryName, $_POST, "id=$id");
    echo '{"message":"更新操作成功"}';

}
function doList(){
    header("Content-type: text/json;charset=utf-8");
    $responce = new Plain();
    $entryName =  getEntryName(basename(__FILE__));
    if(isset($_POST['actionparam']) && $_POST['actionparam']=='all'){
        $SQL = "SELECT id,name FROM $entryName";
        $result = query($SQL);
        $i=0;
        while($row = mysql_fetch_assoc($result)) {
            $responce->rows[$i]['id']=$row['id'];
            $responce->rows[$i]['name']=$row['name'];
            $i++;
        }
        echo jsonEncode($responce);
        exit (0);

    }
    $page = $_POST['page']; // get the requested page
    $limit = $_POST['rows']; // get how many rows we want to have into the grid
    $sidx = $_POST['sidx']; // get index row - i.e. user click to sort
    $sord = $_POST['sord']; // get the direction
    if(!$page) $page=0;
    if(!$limit) $limit=10;
    if(!$sidx) $sidx =1;
    $count = getCount($entryName);
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
    $SQL = "SELECT id ,name ,intro 
            FROM $entryName ORDER BY $sidx $sord LIMIT $start , $limit";
   
    $result = query($SQL);
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
        $responce->rows[$i]['intro']=$row['intro'];
        $i++;
    }
    //print_r($responce);exit(0);
    echo jsonEncode($responce);
}
?>