<?php 
header("content-type","text/html;charset=utf-8"); 
require_once 'tools/utils.php';

use utils\Utils;

use data\BaseDao;

$dao = new BaseDao("artitle");

$util = new Utils();

//此页面是给搜索引擎用来爬行本站资源所用
//列出所有文章
$sql = "select id,title from artitle";

$artitles = $dao->executeQuery($sql);

foreach ($artitles as $artitle){
      
   $id     = $artitle['id'];
   $title  = $artitle['title'];
   echo "<a href='artitle.php?id=$id'>$title</a>";
   
    
}
//所有公告
$sql="select id,title from indexmessage";
$indexmessages = $dao->executeQuery($sql);

foreach($indexmessages as $message){
    $id     = $message['id'];
    $title  = $message['title'];
    echo "<a href='artitle.php?id=$id'>$title</a>";    
}

$sql="select id,name from shopper ";
$shoppers = $dao->executeQuery($sql);

foreach ($shoppers as $shopper){
    $id = $shopper['id'];
    $name=$shopper['name'];

     echo "<a href='shopper.php?id=$id'>$title</a>";    
    
    
    
}
  


















?>