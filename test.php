<?php 
   require_once 'tools/utils.php';
   use utils\MySmarty;
   
   
   $smarty = new MySmarty();
   
   $smarty->assign("lnum",10);
   
   $sc = "sliverlight";
   
   $tmp = isset($sc)?:"flash";
   
   echo $tmp;
   
   $smarty->display("test.tpl");
   
   function asdf(){
   	 
   	
   }
  
?>