<?php 
  require_once 'tools/utils.php';
  
  $sql = "select id,name from catalog";
  $catalogs = queryForEntities($sql);
  $products = range(0, 12);
  if(isset($_GET['page'])){
  	$page = $_GET['page'];
  }else{
  	$page = 1;
  }
   $count = getCount("news");
   $limit=10;
    // calculate the total pages for the query
    if( $count > 0 && $limit > 0) {
        $total_pages = ceil($count/$limit);
    } else {
        $total_pages = 0;
    }
    // if for some reasons the requested page is greater than the total
    // set the requested page to total page
    if ($page > $total_pages) $page=$total_pages;

    // calculate the starting position of the rows
    $start = $limit*$page - $limit;

    // if for some reasons start position is negative set it to 0
    // typical case is that the user type 0 for the requested page
    if($start <0) $start = 0;
    // the actual query for the grid data
    
    
  if(isset($_GET['cataid'])){
  	  $id=$_GET['cataid'];
  	  $sql = "select id,image from product where catalogId=$id limit $start,16";
  	  $products = queryForEntities($sql);
  	
  }
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上海良宇</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="scripts/zoomer/zoomer.css" media="screen" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
<script type="text/javascript" src="scripts/zoomer/zoomer.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
	$('table.thumb td').Zoomer(
			{
				speedView:200,
				speedRemove:300,
				//altAnim:true,
				//speedTitle:400,
				debug:false
			});
});

</script>
</head>

<body>
<div class="main">
	<?php include "header.php"; ?>
  
  <div class="content">
  		
		<div class="w217 left">

				<div class="cpzs">
				<h3 style='background:url("pic/cpzl.jpg") repeat scroll 0 0 transparent'></h3>
					<div class="con">
						
				<div class="cpzl lh160">
				<ol>
				  <?php foreach ($catalogs as $cata){ ?>
				  <li><a href="?cataid=<?php echo $cata['id'];?>" ><?php echo $cata['name'];?></a></li>
				  <?php }?>
				</ol>
				</div>
				  </div>
				</div>
				
				
				
		</div>
		 
		<div class="ww400 right">
			<table class="thumb">
			   <?php 
			     $columnNum = 4;
			     for($i=0;$i<count($products);$i++){
			     	if($i%$columnNum==0){
			     		echo "<tr>";
			     	}
			     	
			     
			   ?>
			       <td align="center">
			        <dl>
			        <dd><img src="pic/ban6.jpg" /></dd>
			        <dd><span class="blue">产品名称</span></dd>
			        </dl>
			        
			       </td>
			     
			   
			   <?php 
			     if(($i+1)%$columnNum==0){
			     		echo "</tr>";
			     	}
			     
			     }?>
			</table>	
			
		</div>
		
		<div class="clear"></div>

  </div>
  
  
  <?php include 'footer.php';?>
  
</div>
</body>
</html>
