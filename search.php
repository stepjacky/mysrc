<?php 
    header("Content-Type:text/html;charset=utf-8");
    
    require_once 'tools/utils.php';
    
    use utils\MySmarty;
    
    use data\BaseDao;
    
    $dao = new BaseDao("shopper");
    
    $smarty = new MySmarty();
    
    
    $word  = '';
    if(isset($_POST['word'])){
    	$word = $_POST['word'];
    	
    }else if(isset($_GET['word'])){
    	$word = $_GET['word'];
    }
    
    
    
    $street    = isset($_POST["street"])?$_POST["street"]:false;
    $build     = isset($_POST["build"])?$_POST["build"]:false;
    $cookstyle = isset($_POST["cookstyle"])?$_POST["cookstyle"]:false;

    
    $smarty->assign("street",$street);
    $smarty->assign("build",$build);
    $smarty->assign("cookstyleId",$cookstyle);
    
    
    
    $page = isset($_POST['page'])?:1;
    
    
    
    
    
    $street    = $street==false || $street=="0"?"":$street;
    $build     = $build==false || $build=="0"  ?"":$build;
    $cookstyle = $cookstyle==false || $cookstyle=="0" ?"":$cookstyle;
    
    
    $pcc_min   = isset($_POST['pcc_min'])?$_POST['pcc_min']:false;
    $pcc_max   = isset($_POST['pcc_max'])?$_POST['pcc_max']:false;
    
    $smarty->assign("pccMin",$pcc_min);
    $smarty->assign("pccMax",$pcc_max);
    
    
    
    $carport   = isset($_POST['carport']);
    $ledge     = isset($_POST['ledge']);
    $swiping_card   = isset($_POST['swiping_card']);
    $wireless  = isset($_POST['wireless']);
    $souper    = isset($_POST['souper']);
    $take_out  = isset($_POST['take_out']);
    
    $psort = isset($_POST['psort'])?$_POST['psort']:"";
    
    if($psort!=""){
    	$psort = "order by pcc_min $psort,pcc_max $psort";
    	
    	
    }
    
    $otherCdt = array(
         "carport"=>$carport,
         "ledge"=>$ledge,
         "swiping_card"=>$swiping_card,
         "wireless"=>$wireless,
         "souper"=>$souper,
         "take_out"=>$take_out                               
     );
    
     $smarty->assign("otherCdt",$otherCdt);
    
    $smarty->assign("carport",$carport);
    $smarty->assign("ledge",$ledge);
    $smarty->assign("swiping_card",$swiping_card);
    $smarty->assign("wireless",$wireless);
    $smarty->assign("souper",$souper);
    $smarty->assign("take_out",$take_out);
   
    $wheretmp = '';
    
    if($street!=""){
       $wheretmp=$wheretmp." or s.address like '%".$street."%' or s.sectionabout like '%$street%' "; 	
    }
    
    if($build!=""){
       $wheretmp=$wheretmp." or s.buildingabout like '%".$street."%' "; 	
    }
    
    if($pcc_min!=false){
       $wheretmp=$wheretmp." or s.pcc_min>".$pcc_min; 	
      
    }
    
    if($pcc_max!=false){
       $wheretmp=$wheretmp." or s.pcc_max>".$pcc_max; 	
    }

    $wheretmp = $wheretmp." and ( true ";
    
    if($carport==true){
    	$wheretmp=$wheretmp." and s.carport=true ";
    }
    if($ledge==true){
    	$wheretmp=$wheretmp." and s.ledge=true ";
    }
    if($swiping_card==true){
    	$wheretmp=$wheretmp." and s.swiping_card=true ";
    }
    if($wireless==true){
    	$wheretmp=$wheretmp." and s.wireless=true ";
    }
    if($souper==true){
    	$wheretmp=$wheretmp." and s.souper=true ";
    }
    if($take_out==true){
    	$wheretmp=$wheretmp." and s.take_out=true ";
    }
   
    
       
    $cookwhere='';
    
    if($cookstyle!=false){
        $cookwhere=" and c.id=".$cookstyle; 	
    }
    
    if(isset($_POST['cookWord'])){
    	$cw  = $_POST['cookWord'];
        $cookstyle=" and c.name like '%$cw%'";
    }
    
    $wheretmp = $wheretmp.$cookwhere." ) ";
    
    $mem   = isset($_GET['memberSupported']);

    $keywords = preg_split("/\s+/", $word);
    
    
        
        $sql = "
        select s.pcc_min pccmin,s.pcc_max pccmax, s.shopImage shopImage, 
               s.id id,s.name name,s.address address,s.introduction intro, 
               s.phone phone";
        $fromClause = " from shopper s 
          	   inner join shopper_has_cookstyle sc on sc.shopper_id=s.id 
               inner join cookstyle c on c.id = sc.cookstyle_id ".$cookwhere ;

        $sql = $sql.$fromClause;
        
        $where = "";
        
        $cdts = array("name","introduction");
        
        foreach ($keywords as $key){
            foreach ($cdts as $ct){
                $where =$where."s.".$ct."  like '%".$key."%' or ";
            }
        }
        
        foreach ($keywords as $key){
            
            $where.="c.name like '%".$key."%' or ";
            
        }
        
        
        
        $where =  substr($where, 0, strrpos($where, "or"));
        
        
        if($mem) $where." and memberSupported=true";

        
        
        $sql = $sql." where ".$where." ".$wheretmp." ".$psort;
        
        //echo $sql;

        //符合条件的记录总数      
        $records = $dao->executeForValue("select count(*) ".$fromClause." where ".$where." ".$wheretmp." ");
        
        $limit = 10;
        $total_pages=0;
        //计算总页数
        //calculate the total pages for the query
		if( $records > 0 && $limit > 0) {
			$total_pages = ceil($records/$limit);
		} else {
			$total_pages = 0;
		}
		// if for some reasons the requested page is greater than the total
		// set the requested page to total page
		if ($page > $total_pages){
			if($total_pages==0){
				$page = 1;
			} else{
		        $page=$total_pages;
		    }
		}
        
		// calculate the starting position of the rows
	    $start = $limit*$page - $limit;
		

	    $smarty->assign("start",$start);
	    
	    $smarty->assign("totalPages",$total_pages);
	 
        
        $smarty->assign("total",$records);
        
        $smarty->assign("page",$page);
        
        $smarty->assign("word",$word);
        
        
        $qShoppers = $dao->executeQuery($sql." limit $start,$limit");
        
        
        $smarty->assign("qShoppers",$qShoppers);
        
        
        //建筑物信息
        $sql="select id,name from building where isStreet='b'";
        
        $buildings = $dao->executeQuery($sql);
        
        $smarty->assign("buildings",$buildings);
        
        
        //街道信息
        $sql="select id,name from building where isStreet='a'";
        
        $streets = $dao->executeQuery($sql);
        
        $smarty->assign("streets",$streets);
        
        
        //美食圈信息
        $sql="select id,name from building where isStreet='c'";
        
        $pfoods = $dao->executeQuery($sql);
        
        $smarty->assign("pfoods",$pfoods);
        
        //热门词
        $sql="select id,word from queryword";
        
        $hotWords = $dao->executeQuery($sql);
        
        $smarty->assign("hotwords",$hotWords);
        
        
        //热门店家
        
        $sql = "select id,shopImage,name,pcc_min,pcc_max ,moods from shopper order by moods desc limit 0,4";
        
        $hotShoppers = $dao->executeQuery($sql);
        
        $smarty->assign("hotshoppers",$hotShoppers);
        
        
        
        $sql = "select id,name from cookstyle";
        
        $cookstyles = $dao->executeQuery($sql);
        
        $smarty->assign("cookstyles",$cookstyles);
        
        
        
        $smarty->display("msSearch.tpl");        
        

    
    
    
?>