<?php
    use utils\Utils;
header("Content-Type:text/html;charset=utf-8");
    
    require_once 'tools/utils.php';
    
    use utils\MySmarty;
    
    use data\BaseDao;
    
    
    $smarty = new MySmarty();
    
    $util = new Utils();
    $dao = new BaseDao("foodfash");
    
    $sql = "select a.id cataid,a.name cataname ,al.remark remark,al.id artid,al.title arttitle, c.pos pos ,
            al.titleImage artimage 
			from artitlecatalog a 
			inner join  foodfash c on c.artitlecatalogid=a.id 
			inner join  artitle al on al.artitlecatalog_id = a.id";
    
    
    $artitles = $dao->executeKeyedQuery("pos", $sql);
    

    $sql = "select a.id artid,a.title arttitle,a.remark remark from artitle a inner join foodfash f on a.id = f.artitleid";
    
    $firstart =  $dao->executeForObject($sql);
    
    $artitles['z'] = $firstart;
    
    
   //$util->logArray($artitles);
    
    
    $smarty->assign("artitles",$artitles);    
    
    $smarty->display("jcss.tpl");
?>