<?php 
    require_once 'tools/utils.php';
  if(!isset($_GET['page'])){
  	$page=1;
  }else{
  	$page = $_GET['page'];
  }
   $count = getCount("leaveword");
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
    $sql = "SELECT user,content,leavedate 
            FROM leaveword order by leavedate desc LIMIT $start , 10";
    $newslist =  queryForEntities($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上海良宇</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
<link type="text/css" href="scripts/blockui/style.css" rel="stylesheet" />
<script type="text/javascript" src="scripts/blockui/jquery.blockUI.js"></script> 
<script type="text/javascript" src="scripts/myutils.js"></script> 
    
<script type="text/javascript">
$(document).ready(function(){
   var tb = $(".lybox");
  
   $("#saveAction").click(function(){
       var user = $("#user").val();
       var word = $("#word").val();
       if(word==""){
           confirm("请您填写留言内容!");
           return false;
       }
       block(tb,"正在提交留言...");
       $.ajax({
            "type":"post",
            "url":"dataaccess/leaveword.php",
            "data":$.param({"user":user,"content":word,"action":"create"}),
            "success":function(msg){
                unblock(tb); 
                document.forms[0].reset(); 
            },
            "error":function(msg){}

       });

	    return false;

   });


});
</script>
</head>

<body>
<div class="main">
<?php include "header.php"; ?>
  
  <div class="content">
   
		
		<dl class="tit1">
					<dt>留言列表</dt>
		</dl>
				
				<ul class="nweList">
				
				<?php foreach ($newslist as $leaveword){?>
				<li>
				<table width="100%" cellspacing="0" cellpadding="0" bordercolor="#ffffff" border="1" bgcolor="#f5f5f5" class="lh22" style="border-collapse: collapse;font-size:12px;" id="commitShow">

    <tbody><tr bgcolor="#E3E3E3">
        <td width="28%" height="28"><label style="color:#999999">
        用户 <?php echo $leaveword['user'];?> 说:</label>
        </td>
        <td width="72%">
        <span style="padding-right: 30px;" class="right">
        <span class="floor"><?php echo $leaveword['leavedate'];?></span> </span> <span class="publishdate">留言日期</span>

        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $leaveword['content'];?></td>
        </tr>
</tbody></table>
				<?php }?>
				</li>
				</ul>
				
				<p align="left">
				
				<a href="?page=1">首页</a>　
				<a href="?page=<?php echo ($page-1);?>">上一页</a>　
				<a href="?page=<?php echo ($page+1)?>">下一页</a>　
				<a href="?page=<?php echo ($total_pages);?>">尾页</a>
				<label>显示<?php echo $page."/".$total_pages."页，共 $count 条留言";?></label>
				</p>	
				
		<div class="blank15"></div>
		<hr />
    <div class="lybox">
    <form action="?">
       	  <div class="con" >
       	    <dd><label>用户:<input name="user" id="user" /></label></dd>
           	<dd>留言:<textarea id="word" style="width:450px; height:140px;font-size:12px;"></textarea></dd>
            <dd style="text-align:right;margin-right:40px">
              <a href="javascript:;" onclick="document.forms[0].reset();"><img src="pic/btnQc.jpg" align="absmiddle" /></a>
              <a href="javascript:;"   id="saveAction"><img src="pic/btnTj.jpg" align="absmiddle" /></a></dd>
          </div>
          </form>
    </div>
       
		
  </div>
  
  
   
  
   <?php include 'footer.php';?>
 
  
</div>
</body>
</html>
