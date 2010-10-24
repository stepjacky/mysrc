<?php
    use utils\Utils;
header("Content-Type:text/html;charset=utf-8");
    
    require_once 'tools/utils.php';
    
    use utils\MySmarty;
    
    use data\BaseDao;
    
    $util = new Utils();
    
    $dao = new BaseDao("cookroom");
    
    $smarty = new MySmarty();
    
    if(!isset($_GET['id'])){ 
      echo "指定文章不存在";
      exit(0);
    }
    
    
    
    $id = $_GET['id'];
    if(function_exists("date_default_timezone_set") and function_exists("date_default_timezone_get"))
@date_default_timezone_set(@date_default_timezone_get());
    
    $sql = "select * from artitle where id=$id";
    
    $artitle = $dao->executeForObject($sql);
 
    $cnt = $artitle[0]['content'];
    $entities = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($entities);
    $artitle[0]['content']=  strtr($cnt, $trans);
    
    $smarty->assign("artitle",$artitle[0]);
    
    $config['date'] = '%Y 年  %m 月  %d 日  %H:%M:%S';
    $config['time'] = '%H:%M:%S'; 
    
    
    $smarty->assign("config",$config);
   
    
    
   // 计算上下邻居
    $sql="select id,title from artitle";
   
   
   $sblingShoppers = $dao->getSblings($sql,$id);
   
   $smarty->assign("sblingartitles",$sblingShoppers);
    
   //$util->logArray($sblingShoppers);

   $sql="select id,shopImage,name,pcc_min pccmin,pcc_max pccmax from shopper order by moods desc limit 0,5";
   
   $hotShoppers = $dao->executeQuery($sql);
   
   $smarty->assign("hotShoppers",$hotShoppers);
   
   
   $sql="select id,title from artitle order by moods limit 0,20";
   
   $hotArtitles = $dao->executeQuery($sql);
   
   $smarty->assign("hotArtitles",$hotArtitles);
   
   
   $smarty->display("artitle.tpl");
    
?>