<?php 
   require_once 'tools/utils.php';
   use utils\MySmarty;
   use utils\HtmlUtils;
   use data\BaseDao;
   $id = isset($_GET['id'])?$_GET['id']:($_POST['id']?$_POST['id']:NULL);
   if($id==NULL) {
       echo "非法请求";
       exit(0);
   }
   
   $smarty = new MySmarty();
   $smarty->allow_php_tag=true;

   
   $util = new HtmlUtils();
   $entityName="shopper";
   $dao = new BaseDao($entityName);
   
   $shopper = $dao->getBean($id);
   
   $sql = "select c.id id ,c.name name from shopper_has_cookstyle shc right join cookstyle c on shc.cookstyle_id=c.id
        where shc.shopper_id=$id";
   $cookstyles = array();
   $cresult = $dao->query($sql);
   while($crow= mysql_fetch_assoc($cresult)){
      array_push($cookstyles, $crow);
   }
      
   
   $typeId = $util->getProperty($shopper, "type");// type id;
   
   $dao->setEntityName("shoppercatalog");

   $type = $dao->getBean($typeId);
   
   
   $dao->setEntityName("votedetail");
   
   //该店该项目投票平均值
   
   // 口味
   $sql="select avg(votevalue) as vl from votedetail where shopperId=$id and type='vote_taste'";
   $voteTasteValue = $dao->executeForValue($sql);
   
   $smarty->assign("vote_taste_avg",$voteTasteValue);
   
   
   //环境
   $sql="select avg(votevalue) as vl from votedetail where shopperId=$id and type='vote_env'";
   $voteEnvValue = $dao->executeForValue($sql);
   
   $smarty->assign("vote_env_avg",$voteEnvValue);
   
   // 服务
   $sql="select avg(votevalue) as vl from votedetail where shopperId=$id and type='vote_serve'";
   $voteServeValue = $dao->executeForValue($sql);
   
   $smarty->assign("vote_serve_avg",$voteServeValue);
   
   //对该店投票人总数
   $voteCount = $dao->getCountByWhere(" shopperid=$id ");
   $smarty->assign("voteCount",$voteCount);
   
   
   
   
   $sql = "select avg(voteValue) from votedetail where shopperId=$id";
   
   $voteavg = $dao->executeForValue($sql);
   
   $smarty->assign("voteAvg",$voteavg);
   
   //对该店家的评论
   
   $sql="select usernick,content,publishdate from commoncommit where shopper_id=$id order by publishdate desc limit 0,5";
   
   $commitlist = $dao->executeQuery($sql);
   
   $smarty->assign("usercommit",$commitlist);
   
   
   //同类店家
   $sql="select id,name from shopper where type=$typeId order by joindate desc";
   
     
   $samecatalog = $dao->executeQuery($sql);
   
   
   $smarty->assign("samecatalog",$samecatalog);
   
   
   $sql = "select word from queryword ";
   
   $queryWords = $dao->executeQuery($sql);
   
   
   $smarty->assign("queryWords",$queryWords);
   
   
   //附近商家20 km 之内的
   $lon = $util->getProperty($shopper, "longitude");
   $lan = $util->getProperty($shopper, "lantitude");
   
   $sql="select id,shopImage,name,pcc_min pccmin,pcc_max pccmax from shopper where 
        getDis(longitude,lantitude,$lon,$lan)<=20";
   
   //111.12*cos(1/(   sin(lana)*sin(lanb)  + cos(lana)* cos(lanb)* cos(lonb-lona)   ))

   $nearShoppers = $dao->executeQuery($sql);
   
   $smarty->assign("nearShoppers",$nearShoppers);
   
   
   $sql="select id,name from shopper";
  
   
   $sblingShoppers = $dao->getSblings($sql,$id);
   
   
   $smarty->assign("sblingShoppers",$sblingShoppers);
   
   
   
   
   
   
   
      
   $smarty->assign("cookstyles",$cookstyles);
   
   $smarty->assign("type",$type);
  
   $shopper['sectionabout']=$util->encodeSearch($shopper['sectionabout'],",","search.php?word=");
   $shopper['buildingabout']=$util->encodeSearch($shopper['buildingabout'],",","search.php?word=");
   $shopper['buslines']=$util->encodeSearch($shopper['buslines'],",","search.php?word=");
   
   //$util->logArray($shopper['sectionabout']);
  
      
   $smarty->assign("shopper",$shopper);
   
 
   $imagelist = $dao->executeQuery("select * from shopper_has_picture where shopperId=$id");
   
   $smarty->set("imageList", $imagelist);
   
   //$smarty->caching = 1;
   
   //$smarty->compile_check = true;
   
   $smarty->display('shopper.tpl');
   
   
   
?>