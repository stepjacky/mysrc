<?php 
require_once 'tools/utils.php';
if(!isset($_GET['id'])){
	echo "非法请求";
	exit(0);
}
$id = $_GET['id'];
$sql = "select * from news where id=$id";
$entitylist = queryForEntities($sql);
$entity = $entitylist==null?NULL:$entitylist[0];

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
  		<div class="left">
				
				
				<dl class="tit1">
					<a href="gsxw.html">公司新闻</a>><?php echo $entity['title'];?>
					<dd></dd>
				</dl>
				
				<div class="news_detail">
				   <h2 class="textcenter"><?php echo $entity['title'];?></h2>
				   <div class=" textcenter fontnormal fontcolorGray pubdate">发布时间：<?php echo $entity['publishdate'];?></div>
				   <hr>
				   <?php 
				       $ess = get_html_translation_table(HTML_ENTITIES);
                       $trans = array_flip($ess);
                       $cn=  strtr($entity['content'], $trans);
				   
				       echo $cn;
				   
				   ?>
				   
				   </div>
				</div>

		</div>
	
		
		<div class="clear"></div>
  
  <?php include 'footer.php';?>
</div>
</body>
</html>
