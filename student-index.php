<?php
session_start();
$email='';
$avatar='';
$guestView= false;
$postFix = '';
require_once "included/database.php";
$userId='';
if(isset($_GET['userId'])){
	//外部用户浏览
	$email = $_GET['userId'];
	$userId = $email;
   	$guestView= true;
}else{
	//自己登录
	$email = $_SESSION['loginuser'];
}
//loginfo("当前登录email:$email");
$postFix = '?userId='.$email;
$tmail = urlencode($email);
//loginfo("当前登录email:$email");
$sql = "select avatar from user where email='$tmail'";
$avatar = getFieldValue($sql);
if(!isset($_GET['userId']) && !isset($_SESSION['loginuser'])){
	//如果没有自己登录,也没有通过点击链接则视为非法访问
	$url = LOGIN_URL;
	header ("HTTP/1.1 303 See Other");
	header ("Location: ".LOGIN_URL);
}

//获取在线学习时间
//今天的

$tsum = getTodayTime($tmail);
//昨天的
$ysum = getYestodayTime($tmail);

$wsum = getTheWeekTime($tmail);
//累积的
$ssum = getTotalTime($tmail);
//获取在线时间结束
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>学生主页</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<style type="text/css">
body {
	margin: 0;
	font-size: 14px;
}

#header {
	width: 1024px;
	height: 60px;
	background-image: url(images/header.png);
	margin-left: auto;
	margin-right: auto;
	position: relative;
}

#wrap {
	width: 1024px;
	height: 800px;
	margin-left: auto;
	margin-right: auto;
}

#column {
	float: left;
	width: 820px;
	height: 800px;
	
}

#column1 {
	float: left;
	width: 220px;
	height: 800px;
	background-color: #eee;
}

#column2 {
	float: right;
	width: 595px;
	height: 800px;
	background-color: #fff;
	position: relative;
}

#column3 {
	float: right;
	width: 200px;
	height: 800px;
	background-color: #eee
}

.clear {
	clear: both;
}

#footer {
	width: 1024px;
	height: 50px;
	margin-left: auto;
	margin-right: auto;
	background-color: #CCC;
}

#content-top #content-r-top {
	margin-left: auto;
	margin-right: auto;
	width: 100%;
}

#content-mid #content-r-mid {
	margin-left: auto;
	margin-right: auto;
	width: 100%;
}

#content-end #content-r-end {
	margin-left: auto;
	margin-right: auto;
	width: 100%;
}

</style>

<link rel="stylesheet" type="text/css" media="screen"
	href="scripts/jquery_ui/flicker/css/smoothness/jquery-ui-1.7.2.custom.css" />

<script language="javascript" type="text/javascript"
	src="scripts/jquery-1.3.2.min.js"></script>

<script type="text/javascript"
	src="scripts/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>

<script type="text/javascript"
	src="scripts/jquery_ui/js/i18n/jquery-ui-i18n.js"></script>
	
<link  rel="stylesheet" href="styles/SexyButtons/sexybuttons.css"  type="text/css" />


<script language="javascript"
	type="text/javascript" 
	src="scripts/jGrowl-1.2.4/jquery.jgrowl_minimized.js"></script>
<link href="styles/table.css" rel="stylesheet" type="text/css">
<link href="styles/menu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="scripts/jquery_panel/panel.css" />
<link
	rel="stylesheet" type="text/css" media="screen"
	href="scripts/jGrowl-1.2.4/jquery.jgrowl.css" />
</head>
<body>
<div id="menu_wrapper" class="black">
			<ul id="menu">
				<li><a href="loginout.php">退出</a></li>
		    </ul>
</div>
<div id="header"></div>
<div id="wrap">
<div id="column">
<div id="column1">
<div id="content-top">
<div style="margin-top: 30px;">
<center><span><br />
</span> <img src="<?php  echo $avatar;?>" alt="头像" /><br />
<img src="images/spector.png" /></center>
</div>
</div>
<div id="content-mid">
<div style="margin-top: 10px"></div>



</div>
<div id="content-end">
<div style="margin-top: 10px">
<center></center>

</div>



</div>
</div>
<div id="column2">
<div id="myinfopage"
	style="background-color: #fff; width: 590px; height: 785px;">
<UL style="background-color: #Fc3; margin: auto">
	<LI><A href="myfirstpage.php<?php echo $postFix;?>">我的首页</A></LI>
	<?php if($guestView==false){?>
	<LI><A href="myprofile.php<?php echo $postFix;?>">个人资料</A></LI>
	<LI><A href="myfriends-view.php<?php echo $postFix;?>">我的朋友</A></LI>
	<?php }?>
</UL>
</div>
</div>
<div class="clear"></div>
</div>
<div id="column3">
<div class="mg10 exhibiton ex03">
	<div class="exHead">
		<div class="hTxt">
			<div class="hTxtContent"><h2>学习时间统计</h2></div>
		</div>
		<div class="hLeft"></div>
		<div class="hRight"></div>
	</div>
	<div class="exBody" style="background-color:#FFF;height:120px">
		<div class="content" style="background-color:#FFF">
       <ul style="margin-top: 10px; padding-left: 20px; list-style: none">
	<li style="height: 20px;">今日学习时间:<label id="atime"><?php echo $tsum;?> 分钟</label></li>
	<li style="height: 20px;">昨日学习时间:<label id="btime"><?php echo $ysum;?> 分钟</label></li>
	<li style="height: 20px;">本周学习时间:<label id="ctime"><?php echo $wsum;?> 分钟</label></li>
	<li style="height: 20px;">累计学习时间:<label id="dtime"><?php echo $ssum;?> 分钟</label></li>
</ul>
</div>
	</div>
	<div class="exFoot" style="background-color:#FFF">

		<div class="fLeft"></div>
		<div class="fRight"></div>
	</div>
</div>

<!-- 来访好友 -->
<div class="mg10 exhibiton ex03" >
	<div class="exHead">
		<div class="hTxt">
			<div class="hTxtContent"><h2>来访好友</h2></div>
		</div>
		<div class="hLeft"></div>
		<div class="hRight"></div>
	</div>
	<div class="exBody" style="background-color:#FFF;height:500px">
		<div class="content" style="background-color:#FFF">
        <?php 
           if(isset($_SESSION['loginuser'])){
           $luser = urlencode($_SESSION['loginuser']);
           $sql = "select f.friend fm ,u.avatar avt,u.localname lname
                   from myfriend f,user u
                   where f.email='$luser'
                      and u.email = f.friend
                   limit 0,9"; 
           //echo ($sql);
           $result = query($sql);
             $r=0;
             while($row=mysql_fetch_assoc($result)){
           	    $fm = $row['fm'];
           	    $avt = $row['avt'];
           	    $lname = $row['lname'];
           	    echo "<a href='findfriend.php?userId=$fm' target='_blank'>
           	          <image src='$avt' width='60' height='65' alt='$lname' /></a>";
           	     $r++;
           	    if($r%3==0)echo "<br/>";
           	    
           	     
             }
           }
        
        ?>
</div>
	</div>
	<div class="exFoot" style="background-color:#FFF">

		<div class="fLeft"></div>
		<div class="fRight"></div>
	</div>
</div>

</div>
<div class="clear"></div>
</div>
<div id="footer"><br />

</div>
<script language="javascript">
<!--
  $(loadPage);
  
  var mtabs = '';
  function loadPage(){
	 mtabs = $("#myinfopage").tabs();  
  }  
  function addFriend(){
	  var guest = '<?php echo $_SESSION['loginuser'];?>';
	  var userId = $("#fmail").val();
	  if(guest=='' || userId=='' || guest==userId){
		  $.jGrowl("请填写朋友email!!",
				  { life: 1000,
                    position:"center",
                    theme:'smoke'});
		  return;
	  }	
      var myparam = {action:"add",email:guest,friend:userId};
      $.ajax({
           type:"POST",
           url:"myfriend.php",
           data:$.param(myparam),
           success:function(msg){
    	  $.jGrowl("添加好友成功!!",{ life: 1000,
              position:"center",
              theme:  'smoke'
               });
           },
           error:function(msg){
              alert("错误:\n"+msg);
               }


          });
	  
  }
  function deletefriend(email ,friend){
	  //alert(email);return;
      var myparam = {action:"del",email:email,friend:friend};
      alert($.param(myparam));
      $.ajax({
           type:"POST",
           url:"myfriend.php",
           data:$.param(myparam),
           success:function(msg){
    	  $.jGrowl("好友已经删除成功!!",{ life: 1000,
              position:"center",
              theme:  'smoke'
               });
           },
           error:function(msg){
              alert("错误:\n"+msg);
               }


          });
  }
//-->
</script>
</body>
</html>
