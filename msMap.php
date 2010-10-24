<?php
    use utils\Utils;
header("Content-Type:text/html;charset=utf-8");
    
    require_once 'tools/utils.php';
    
    use utils\MySmarty;
    
    use data\BaseDao;
    $util = new Utils();
    $smarty  =  new MySmarty();
    
    $dao = new BaseDao("queryword");
    
    $queryWords = $dao->getBeans();

    $smarty->assign("queryWords",$queryWords);
    
    //吃环境
    $sql="select name from building where isstreet='d'";
    
    $envs = $dao->executeQuery($sql);
    
    $smarty->assign("envs",$envs);
    
    // $util->logArray($envs);
    //热门菜
    $sql = "select name from building where isstreet='e'";
    
    $hotcooks = $dao->executeQuery($sql);
    
    $smarty->assign("hotcooks",$hotcooks);
    
    //最新加入
    
    $sql="select id,name from shopper order by joindate desc limit 0,6";
    
    $newjoins = $dao->executeQuery($sql);
    
    $smarty->assign("newjoins",$newjoins);
    
    //人气最旺
    $sql = "select id ,name from shopper order by moods desc limit 0,6";
    
    $hotmoods = $dao->executeQuery($sql);
    
    $smarty->assign("hotmoods",$hotmoods);
    
    //热门评论
    $sql="select s.id id ,s.name name from shopper s inner join commoncommit c on s.id=c.shopper_id order by count(s.id) desc;";
    
    $hotcommits = $dao->executeQuery($sql);
    
    $smarty->assign("hotcommits",$hotcommits);
    
    //会员店家
    
    $sql="select id,name,shopImage from shopper where membersupported=true limit 0,20";
    
    $cardShoppers = $dao->executeQuery($sql);
    
    $smarty->assign("cardShoppers",$cardShoppers);
    
    $dao->setEntityName("shopper");
    
    $weekShoppers  = $dao->getBeansWithCondition("weekshoppers=true order by id desc limit 0,9 ");
    
    $smarty->assign("weekShoppers",$weekShoppers);
    
    //美食专题
    
    $sql = "select * from foodmap";
    
    $foodfavs = $dao->executeQuery($sql);
    
    $smarty->assign("foodfavs",$foodfavs);
    
    //$util->logArray($foodfavs);
    
    //关键路段
    $insec = array();
    $sql = "select * from indicatesection";
    $insec = $dao->executeKeyedQuery("name", $sql);
      
    $smarty->assign("insecs",$insec);
    
    //$util->logArray($insec);
    
    
    $smarty->display("msMap.tpl");
    

?>