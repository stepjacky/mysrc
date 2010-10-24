<?php
    use utils\Utils;
    header("Content-Type:text/html;charset=utf-8");
    
    require_once 'tools/utils.php';
    
    use utils\MySmarty;
    
    use data\BaseDao;
    
    $util = new Utils();
    
    $dao = new BaseDao("shopper");
    
    $smarty = new MySmarty();
    //////////////////////////////////////////////////////////
    
    if(!isset($_POST['sameid'])) {
    	echo "参数非法，请选择要对比的店家";
    	exit(0);
    }
    
    $sids = $_POST['sameid'];
    
    
    $idstr = join(",", $sids);
   
    
    //店家基本信息
    $sql ="select id,name,phone,pcc_min,pcc_max,feature,worktime,introduction from shopper where id in ($idstr)";
    
    $shoppers = $dao->executeQuery($sql);
    
    $sql="select sc.shopper_id id,name from cookstyle c inner join shopper_has_cookstyle sc on sc.shopper_id in ($idstr) and c.id=sc.cookstyle_id ";
    
    $cookstyles = $dao->executeKeyedQuery("id", $sql);
    
    $smarty->set("cookstyles", $cookstyles);
    	 
   // $util->logArray($cookstyles);
    //投票平均值
    
    $sql = "select floor(avg(voteValue)) avgvalue ,shopperid id from votedetail where shopperid in ($idstr) group by shopperid";
    
    $voteavgs = $dao->executeKeyedQuery("id", $sql);
    
    $smarty->set("avgvalues", $voteavgs);
    
    //$util->logArray($voteavgs);
    
   
    
    
    $smarty->set("shoppers", $shoppers);
    
    //$util->logArray($shoppers);
    
    
    $sql = "select id,shopImage,name,pcc_min,pcc_max ,moods from shopper order by moods desc limit 0,10";
        
    $hotShoppers = $dao->executeQuery($sql);

    $smarty->set("hotshoppers", $hotShoppers);
    
    $tmp = $util->getEntryName(basename(__FILE__)).".tpl";
    $smarty->show($tmp);
    
    
    
    
?>