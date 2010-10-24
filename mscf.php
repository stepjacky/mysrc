<?php
    use utils\Utils;
header("Content-Type:text/html;charset=utf-8");
    
    require_once 'tools/utils.php';
    
    use utils\MySmarty;
    
    use data\BaseDao;
    
    $util = new Utils();
    
    $dao = new BaseDao("cookroom");
    
    $smarty = new MySmarty();
    
    
    $sql = "select a.id cataid,a.name cataname ,al.remark remark,al.id artid,al.title arttitle, c.pos pos  
			from artitlecatalog a 
			inner join  cookroom c on c.artitlecatalogid=a.id 
			inner join  artitle al on al.artitlecatalog_id = a.id";
    
    $artitles = $dao->executeKeyedQuery("pos", $sql);
 
 //  echo  "<pre>";
  //  
   // print_r($artitles);
    
  //  echo "</pre>";
    
    
    $smarty->assign("artitles",$artitles);
    
    
    $dao->setEntityName("cookroom");
    
    $ad = $dao->getBean("z","pos");
    
    $smarty->assign("ad",$ad);
    
    
    
    
    
    
    $smarty->display("mscf.tpl");
    
?>