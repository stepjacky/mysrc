<?php
session_start();
$email='';
$avatar='';
$guestView= false;
$postFix = '';
$userId='';
require_once "included/database.php";
//登录用户
if(isset($_GET['userId'])){
	//外部用户浏览
	$email = $_GET['userId'];
	$userId = $email;
	$guestView = true;
}else{
	//自己登录
	$email = $_SESSION['loginuser'];
}
$postFix = '?userId='.$email;
$tmail = urlencode($email);
$avatar = getFieldValue("select avatar from user where email='$tmail'");
$qtotal = getCountByWhere("question","owner='$tmail' and locked='n'");
if(!isset($_GET['userId']) && !isset($_SESSION['loginuser'])){
	//如果没有自己登录,也没有通过点击链接则视为非法访问
	$url = LOGIN_URL;
	header ("HTTP/1.1 303 See Other");
	header ("Location: ".LOGIN_URL);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>教师主页</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<?php
include_once "included/static-resource.php";
?>
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
	text-align: right;
}

#wrap {
	width: 1024px;
	height: 750px;
	margin-left: auto;
	margin-right: auto;
}

#column {
	float: left;
	width: 820px;
	height: 750px;
}

#column1 {
	float: left;
	width: 217px;
	height: 750px;
	background-color: #eee;
}

#column2 {
	float: left;
	width: 595px;
	height: 750px;
	background-color: #fff;
	position: relative;
}

#column3 {
	float: right;
	width: 200px;
	height: 750px;
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
.menubox {
	border-top:1px #cccccc solid; 
	background:#f2f6fb; 
	width:498px; 
	height:22px; 
	position:absolute; 
	bottom:0;
	float:right;
}
</style>
<script language="javascript"
	type="text/javascript" 
	src="scripts/jGrowl-1.2.4/jquery.jgrowl_minimized.js"></script>
<link rel="stylesheet" type="text/css" href="css/userlayout.css" />
<link href="styles/table.css" rel="stylesheet" type="text/css">
<link href="styles/menu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="scripts/jquery_panel/panel.css" />
<link  rel="stylesheet" href="styles/SexyButtons/sexybuttons.css"  type="text/css" />
<link
	rel="stylesheet" type="text/css" media="screen"
	href="scripts/jGrowl-1.2.4/jquery.jgrowl.css" />



</head>
<body>
<div id="menu_wrapper" class="black">
			<ul id="menu">
				<li><a href="loginout.php">注销</a></li>
				<li>|</li>
				<li><a href="teacher-index.php">我的主页</a></li>
				<li>|</li>
				<li ><a href="javascript:;" onclick="window.location='teacher-question.php'">出题</a></li>
		    </ul>
</div>

<div id="header">
  
</div>
<div id="wrap">
<div id="column">
<div id="column1">
<div id="content-top">
<div style="margin-top: 30px;">
<center><span> <img src="<?php  echo $avatar;?>" alt="头像" /><br />
</div>
</div>


</div>
<div id="column2">
<div id="myinfopage"
	style="background-color: #fff; width: 100%; height: auto;">
<UL style="background-color: #Fc3; margin: auto">
	<LI><A href="teacher-firstpage.php<?php echo $postFix;?>">我的首页</A></LI>
	<LI><A href="myfriends-view.php<?php echo $postFix;?>">我的朋友</A></LI>
	<LI><A href="teacher-question-index.php<?php echo $postFix;?>">出题记录</A></LI>
    <?php if($guestView==false){?>
	<LI><A href="teacher-profile.php<?php echo $postFix;?>">我的资料</A></LI>
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
			<div class="hTxtContent"><h2>出题统计</h2></div>
		</div>
		<div class="hLeft"></div>
		<div class="hRight"></div>
	</div>
	<div class="exBody" style="background-color:#FFF">
		<div class="content" style="background-color:#FFF;font-size:15px;">
  有效出题数:<span style='color:green;font-size:15px;'> <?php echo $qtotal;?></span>
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
  
</script>
</body>
</html>
