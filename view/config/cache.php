<?php 
   use utils\MySmarty;
   use utils\Utils;
   require_once '../../tools/utils.php';
   
   $smarty = new MySmarty();
   $smarty->cache->clearAll();
   
   echo "所有页面缓存都被清空";
   
   
?>