<?php 
 /**
  * 用来显示本目录中的图片
  * 
  * */
 use utils\Response;
 require_once '../../../tools/utils.php';
 require_once '../../../tools/jsonutil.php';
 use utils\Utils;
 $dir = $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'];
 //echo $dir;
 $util= new Utils();
 $files = $util->listFiles($dir);
 echo jsonEncode($files);
?>