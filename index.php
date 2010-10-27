<?php 
   use utils\Utils;
require_once 'tools/utils.php';
   use utils\MySmarty;
   use data\BaseDao;
   
   $entityName="shopper";
   $util = new Utils();
   $dao = new BaseDao($entityName);

    $smarty = new MySmarty();
  
   $smarty->caching = 1;
   
   $smarty->compile_check = true;
   //1  本月最受欢迎商家
   $monthShoppers  =  $dao->getBeansWithCondition("newshoppers=true  order by id desc limit 0,10 ");
   
   $smarty->set("monthShoppers", $monthShoppers);
   
   
   //2   本周推荐商家
   $weekShoppers  = $dao->getBeansWithCondition("weekshoppers=true order by id desc limit 0,9 ");
   $weekLine = array(0,1,2);
   
   $smarty->set("weekshoppers",  $weekShoppers);
   
   //$util->logArray($weekShoppers);
   
   //3  最新推荐商家
   $newRecommends = $dao->getBeansWithCondition("newrecommend=true limit 0,5");
   
   $smarty->set("newRecommends", $newRecommends);
   
   $dao->setEntityName("artitle");
   
   //4   最新优惠信息
   $sql = "select a.id as id ,title,pickword,moods from artitle a inner join artitlecatalog ac on 
     (ac.id=a.artitlecatalog_id  and ac.newsasa=true) limit 0,7";
   $newsasa = $dao->executeQuery($sql);
   
   $smarty->set("newsasa", $newsasa);
   //5    最新美食信息
   $sql = "select a.id as id,title,pickword,moods from artitle a inner join artitlecatalog ac on 
     (ac.id=a.artitlecatalog_id  and ac.newfoods=true) limit 0,10";
   $newfoods = $dao->executeQuery($sql);
   
   $smarty->set("newfoods", $newfoods);
   
   //$util->logArray($newfoods);
   
   $dao->setEntityName("advertisment");
   
   //6   主页广告
   $sql = "select * from advertisment";
   $advers = $dao->executeKeyedQuery("pos", $sql);
   
   $smarty->set("ad", $advers);

   //$util->logArray($advers);   
   
   
   
   
   //7    菜谱信息
   //7.1  热门菜谱
   
   $sql = "select a.id as id,title,a.titleImage titleImage from artitle a inner join artitlecatalog ac on 
     (ac.id=a.artitlecatalog_id  and (ac.cookMenu=true or ac.eastCook=true or ac.westCook=true) ) 
     order by moods desc
     limit 0,10";
   $hotCook = $dao->executeQuery($sql);
   
   $smarty->set("hotCook", $hotCook);
   
   
   //$util->logArray($hotCook);
   //7.2  中餐菜谱
    
   $sql = "select a.id as id,title,a.titleImage titleImage from artitle a inner join artitlecatalog ac on 
     (ac.id=a.artitlecatalog_id  and  ac.eastCook=true ) 
     order by moods desc
     limit 0,10";
   $eastCook = $dao->executeQuery($sql);
   
   $smarty->set("eastCook", $eastCook);
   //7.3  西餐菜谱
    
   $sql = "select a.id as id,title ,a.titleImage titleImage from artitle a inner join artitlecatalog ac on 
     (ac.id=a.artitlecatalog_id  and  ac.westCook=true ) 
     order by moods desc
     limit 0,10";
   $westCook = $dao->executeQuery($sql);
   
   $smarty->set("westCook", $westCook);
   $cookLine = array(0,1,2,3,4);
   
   $smarty->set("hotLine", $cookLine);
   
   
   //8   主页店家信息

   $dao->setEntityName("shopper");
   $poslist = range("a", "l");
   $smarty->set("poslist", $poslist);
   $rightlist = range(0,11);
   $smarty->set("rightlist", $rightlist);
   $catalogShoppers = array();
   foreach ($poslist as $pos){
       //重点推荐
       $sql = "select s.id id ,s.name name ,sc.name cataname, shopImage , sc.homepos pos 
               from shopper s inner join shoppercatalog sc on (sc.homepos='$pos' and sc.id = s.type) 
               where s.twoofcatalog=true limit 0,2";
       
        $catalogShoppers[$pos]['head'] =$dao->executeQuery($sql);
    
       
       //列表推荐
       $sql = "select s.id id ,s.name name ,sc.name cataname, shopImage , sc.homepos pos 
               from shopper s inner join shoppercatalog sc on (sc.homepos='$pos' and sc.id = s.type) 
               where s.listofcatalog=true limit 0,12";
      $catalogShoppers[$pos]['list']= $dao->executeQuery($sql);
      
   }
   
   //$util->logArray($catalogShoppers);
   //$util->logInfo($catalogShoppers);
   
   $smarty->set("catalogShoppers", $catalogShoppers);
   $cookpos = range('x', 'z');
   
   
   //9 主页推荐餐饮新闻
   $cookRecommend = array();
   
   foreach ($cookpos as $cpos){
      $sql="select a.id id ,a.title title, a.remark remark, ac.name as cataname from artitle a inner join artitlecatalog ac
           on (ac.homepos='$cpos' and ac.id = a.artitleCatalog_id) limit 0,11";
      
      $cookRecommend['head'][$cpos]=$dao->executeQuery($sql);

   }
   
   $cookposx = range("a", "f");
   
   foreach ($cookposx as $cpos){
      $sql="select a.id id ,a.title title, a.remark remark,ac.name as cataname from artitle  a inner join artitlecatalog ac
           on (ac.homepos='$cpos' and ac.id = a.artitleCatalog_id) limit 0,6";
      
      $cookRecommend['list'][$cpos]=$dao->executeQuery($sql);

   }
   
   $smarty->set("cookRecommend", $cookRecommend);
   
   // $util->logArray($cookRecommend['list']);
   
   
   
   //10  最新加盟商家
   $dao->setEntityName("shopper");
   $newjoins = $dao->getBeansWithCondition(" 1=1  order by joindate desc limit 0,9");
   
   $smarty->set("newjoins", $newjoins);
   
   $sql = "select imagepath,word from homenewshopper";
   $homenewshopper = $dao->executeQuery($sql);
   
   $smarty->set("homenewshopper", $homenewshopper);
   
   //$util->logArray($homenewshopper);
   
  $smarty->allow_php_tag = true;
   

   //$smarty->display('index.tpl');
  $smarty->display('index.tpl');

?>