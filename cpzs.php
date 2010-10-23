<?php 
  require_once 'tools/utils.php';
  
  $sql = "select id,name from catalog";
  $catalogs = queryForEntities($sql);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上海良宇</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
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
				<div class="xptj">
				<dl class="tit1">
					<dt>产品展示</dt>				
				</dl>
				<div style="width:200px;height:300px;">
				
                <dd><img src="pic/ban6.jpg" /></dd>
                <dd><span class="blue">产品名称</span></dd>
				</div>
				
				<div class="blank9"></div>
				<p align="right"><a href="#"><img src="pic/more.gif" align="absmiddle" /> 查看更多></a></p>	

				</div>
				
								
				
		</div>
		
		<div class="clear"></div>

  </div>
  
  
  <?php include 'footer.php';?>
  
</div>
</body>
</html>
