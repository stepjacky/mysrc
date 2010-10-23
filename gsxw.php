<?php 
  require_once 'tools/utils.php';
  if(!isset($_GET['page'])){
  	$page=1;
  }else{
  	$page = $_GET['page'];
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
    $sql = "SELECT id ,title ,DATE(publishdate) publishdate 
            FROM news order by publishdate LIMIT $start , 12";
    $newslist =  queryForEntities($sql);

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
					<dt>公司新闻</dt>
					<dd></dd>
				</dl>
				
				<ul class="nweList">
					<?php foreach ($newslist as $news){?>
					<li><span>
                      <?php echo $news['publishdate'];?>
                    </span>·<a href="newsdetail.php?id=<?php echo $news['id'];?>">
                                                    <?php echo $news['title'];?>
                                                     
                                                     </a></li>
					<?php }?>
				</ul>
				
				
				<div class="blank9"></div>
				<p align="right">
				
				<a href="?page=1">首页</a>　
				<a href="?page=<?php echo ($page-1);?>">上一页</a>　
				<a href="?page=<?php echo ($page+1)?>">下一页</a>　
				<a href="?page=<?php echo ($total_pages);?>">尾页</a></p>	

		</div>

	
		
		<div class="clear"></div>
  </div>
  
  
 <?php include 'footer.php';?>
</div>
</body>
</html>
