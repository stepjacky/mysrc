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
    case "updateVote" :doUpdateVote();break;
    case "homeCatalog":doHomeCatalog();break; 
    case "create" : doCreate();break;
    case "delete" : doDelete();break;
    case "search" : doSearch();break;
    case "update" : doUpdate();break;
    case "config" : doConfig();break;
    case "list"   :
        {
            $searchOn =$_POST['_search'];
            if($searchOn=='true') {
                doSearch();
                break;
            }else {

                doList();
                break;
            }
        }
    default:
        echo '{"message":"错误的action代码,请联系管理员"}';
        exit(0);
        break;
         
}

function doUpdateVote(){
    $rst = new Result();
    unset($_POST['action']);
    $shopperId = $_POST['shopperId'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $type = $_POST['fieldName'];
    $value = $_POST['fieldValue'];
    $where = " voterIp='$ip' 
             and shopperId=$shopperId
             and type='$type' 
             and year(voteTime)=year(now())
             and month(voteTime)=month(now())
             and day(voteTime)=day(now())";
    $dao = new BaseDao("votedetail");
    $count = $dao->getCountByWhere($where);
    if($count==0){
        $sql = "insert into votedetail (type,voterIp,voteValue,shopperId) 
                                 values('$type','$ip','$value','$shopperId')";
        $dao->executeUpdate($sql);
        
        $rst->SUCCESS("投票成功,谢谢参与");
        
    }else{
        $rst->SUCCESS("对不起,您今日该项目已经投过票");
    }
    
    
}


function doHomeCatalog(){
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    unset($_POST['action']);
    $col = $_POST['fieldName'];
    $SQL = array();
    foreach ($_POST['id'] as $id){
       $SQL[] = "update $entryName set $col=true where id=$id"; 
    }
    
    $dao = new  BaseDao($entryName);
    $dao->queryWithTransaction($SQL);
    
}

function doCreate(){
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $dao  =new BaseDao($entryName);
    $values = $_POST;
    unset($values['action']);
    //print_r($values);
    $cookstyle = $values['cookstyle'];
    unset($values['cookstyle']);
    $seedarray = microtime(); 
    $seedstr = preg_split("/\s+/",$seedarray,5); 
    $seed =$seedstr[0]*10000;
    srand($seed); 
    $random =rand(1000,10000); 
    $values['moods']=$random;
    $shoperId = $dao->create($values);
    $values = array("shopper_id"=>$shoperId,"cookstyle_id"=>$cookstyle);
    $dao = new BaseDao("shopper_has_cookstyle");
    
    $dao->create($values);
    $rst = new Result();
    $rst->CREATE_SUCCESS();
}

function doDelete(){
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $dao  =new BaseDao($entryName);
    $shopperId = $_POST['id'];
    $SQL = array();
    $deleteshc = "delete from shopper_has_cookstyle where shopper_id=$shopperId";
    array_push($SQL, $deleteshc);
    $deleteshc = "delete from commoncommit where shopper_id=$shopperId";
    array_push($SQL, $deleteshc);
    $deleteshc = "delete from shopper where id=$shopperId";
    array_push($SQL, $deleteshc);
    $dao->queryWithTransaction($SQL);
    echo '{"message":"成功删除ID['.$_POST['id'].']"}';

}

function doSearch(){
    if(isset($_POST['name'])){ 
        $sf = $_POST['name'];
        $wh =  "where name like '%$name%' ";
        doList($wh);
        exit(0);
    }else{
        $sf = $_POST['searchField'];
        $wh = "where $sf=true ";
        doList($wh);
        exit(0);        
    } 
    //echo $wh;

}

function doConfig(){
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $ctype = $_POST['ctype'];
    $shopids = $_POST['shoppers'];
    $features = array();
    //$SQL[0] = "update $entryName set $ctype=false";
    $i=1;
    foreach ($shopids as $id){
        $SQL[$i++] = "update $entryName set $ctype=true where id=$id";
    }
    $dao  =new BaseDao($entryName);
    echo $dao->queryWithTransaction($SQL);

}

function doUpdate(){
    $util = new Utils();
    $entryName = $util->getEntryName(basename(__FILE__));
    $dao  =new BaseDao($entryName);
    $id = $_POST['id'];
    unset($_POST['cookstyle']);
    unset($_POST['id']);
    unset($_POST['action']);
    //print_r($_POST);
    $dao->update($_POST, "id=$id");
    echo '{"message":"更新操作成功"}';

}
function doList(){
    $where="";
    $args = func_get_args();
    if(func_num_args()==1) $where=$args[0];
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
    $page  = $_POST['page']; // get the requested page
    $limit = $_POST['rows']; // get how many rows we want to have into the grid
    $sidx  = $_POST['sidx']; // get index row - i.e. user click to sort
    $sord  = $_POST['sord']; // get the direction


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
    //colNames:['名称','店主','电话','菜系','类型','环境','修改','删除'],
    $SQL = "SELECT s.id as id,
    s.name as name,
    s.master as master,
    s.phone as phone,
    s.environment as environment,
    sc.name as type,
    s.memberSupported as memberSupported,
    s.newrecommend as newrecommend,
    s.newshoppers as newshoppers,
    s.weekshoppers as weekshoppers
    FROM $entryName as s inner join shoppercatalog sc on sc.id=s.type $where  ORDER BY $sidx $sord LIMIT $start , $limit";
    $util->logInfo($SQL);
    $result = $dao->query($SQL);
    
    // we should set the appropriate header information. Do not forget this.
    $responce->page = $page;
    //logInfo($responce);
    $responce->total = $total_pages;
    $responce->records = $count;
    $i=0;
    while($row = mysql_fetch_assoc($result)) {
        //print_r($row);exit(0);
        $shopperId = $row['id'];
        $responce->rows[$i]['id']=$shopperId;
        $responce->rows[$i]['name']=$row['name'];
        $responce->rows[$i]['master']=$row['master'];
        $responce->rows[$i]['type']=$row['type'];
        $responce->rows[$i]['phone']=$row['phone'];
        $responce->rows[$i]['memberSupported']=$row['memberSupported'];
        $responce->rows[$i]['environment']=$row['environment'];
        $responce->rows[$i]['newrecommend']=$row['newrecommend'];
        $responce->rows[$i]['newshoppers']=$row['newshoppers'];
        $responce->rows[$i]['weekshoppers']=$row['weekshoppers'];
        $SQL = "select c.id,c.name from shopper_has_cookstyle shc right join cookstyle c on shc.cookstyle_id=c.id
        where shc.shopper_id=$shopperId";
        $cookstyles = array();
        $cresult = $dao->query($SQL);
        while($crow= mysql_fetch_assoc($cresult)){
            array_push($cookstyles, $crow);
        }
        $responce->rows[$i]['cookstyles'] = $cookstyles;
        $i++;
    }

    //print_r($responce);exit(0);
    $str = jsonEncode($responce);
    echo $str;
}
?>