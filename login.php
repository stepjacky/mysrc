<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"　"http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
	<title>邀学伴</title>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		
	<style type="text/css">
body
{
	text-align:left;
	color:#000;
	font-family:Arial, Verdana, Sans-serif;
	background-color: #FFF;
	margin: 0;
	font-size:13px;
}
#header
{
	width:1024px;
	margin-left:auto;
	margin-right:auto;
	padding:0px;
	height:60px;
	text-align:center;
	background-image: url(images/header.png);
}
#container
{
	margin-left:auto;
	margin-right:auto;
	width:1024px;
	height: 470px;
	padding-top: 0px;
	padding-bottom: 0px;
}
#mainbg
{
	width:100%;
	padding: 0px;
	float:left;
	background-color: #FFF;
	border-right: 1px #999 solid;
	border-top: 1px #999 solid;
	height: 470px;
}
#right
{
	float:right;
	margin:0px 0px 0px 0px;
	padding:0px;
	width:765px;
	text-align:left;
	height:470px;
	background-color: #FFF;
	border-bottom-color: #CCC;
	border-bottom-width: 1px;
	border-bottom-style: outset;
	background-image: url(images/logo-main.png);
	background-repeat:no-repeat;
	background-position:180px 77px
}
#left
{
	float:left;
	margin:0;
	padding:0px;
	background:#EFEFEF;
    width: 256px!important; /* IE7 FF */ 
    width: 256px; /* IE6 */ 
    text-align:left;
	height: 470px;	
}
*html #left 
{   
    float:left;
	margin-left:-11px;
	padding:0px;
	background:#EFEFEF;
    width: 256px!important; /* IE7 FF */ 
    width: 250px; /* IE6 */ 
    text-align:left;
	height: 470px;
}
/* ie6 fixed */ 
#footer
{
	clear:both;
	width:1024px;
	margin-right:auto;
	margin-left:auto;
	padding:0px;
	background:#fff;
	height:60px;
}
.text
{
	margin:0px;
	padding:20px;
	background-color: #FFF;
	height: 150px;
}
.left-text
{
	margin:0px;
	padding:20px;
	background-color: #EFEFEF;
	height: 80px;
}
.userinfo{
	height:20px;
	width:150px;
}
    </style>
    
<link href="styles/SexyButtons/sexybuttons.css" rel="stylesheet" type="text/css"/>    
    
    
    <script
	language="javascript" type="text/javascript"
	src="scripts/jquery-1.3.2.min.js"></script>
</head>
<body>

<div id="header"></div>
<div id="container">
<div id="mainbg">
              <div id="right">
</div>
              <div id="left">
               
                     <div class="left-text">
                       <form action="checklogin.php" method="POST" target="_self">
                         <label>EMail:&nbsp;&nbsp;&nbsp;&nbsp;<input name="email" type="text" class="userinfo">
                         </label>
                          <br/><br/>
                         <label>密&nbsp;&nbsp;码:&nbsp;&nbsp;&nbsp;&nbsp;<input name="pwd" type="password" class="userinfo">
                         </label><br/><br/>
                          <label style="valign:middle">验证码:&nbsp;&nbsp;
                          <input type='text' onfocus="disPlayVcode();" name='rcode' style="width:60px;"/>                                                                              
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="vcode" style="vertical-align:bottom;" onclick='this.src="checkNum.php#"+new Date().getTime()'>
                         </label><br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;点击显示验证码
                         <br/>
                         <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <?php 
                              if(isset($_GET['msg']))
                               switch($_GET['msg']){
                               	case 'codeerror':
                               		echo "<b style='color:red'>验证码错误</b>";
                               		break;
                               	case 'nouser':
                               		echo "<b style='color:red'>没有用户</b>";
                               		break;
                               	case 'mailerror':
                               		echo  "<b style='color:red'>邮件格式非法</b>";
                               		break;
                               	case 'noinput':
                               		echo  "<b style='color:red'>请输入登录信息</b>";
                               		break;
                               	case 'userlocked':
                               		echo  "<b style='color:red'>用户被锁定</b>";
                               		break;
                               	
                               }
                         
                         ?>
                         
                         </label><br/>
                         
                         <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="remberme" type="checkbox" value="" checked>记住登陆状态</label>
                        <br/>
                        <ul style="list-style:none">
                         <li>
                          <button  onClick="document.forms[0].submit();" class="sexybutton sexysimple sexyblue" style='width:80px;' type="reset"> 登      录    </button>
                          <a href="forgetpwd.php">忘记了密码</a>
                    <br/>
                     <img src="images/spector.png" width="190" />
                         
                         </li>
                         <li>
                         <img src="images/small/arrow_003.gif"> 还没有注册的用户
                         <button class="sexybutton sexysimple sexypurple" type="reset"  onClick="javascript:register();return false;" style='width:80px;'>立即注册</button>
                     <br/>
                     <img src="images/spector.png" width="190"/>
                         
                         </li>
                         <li>
                         <img src="images/small/arrow_003.gif">成为会员请点击
                         <br/>
                         <button class="sexybutton sexysimple  sexyyellow" type="reset" style='width:80px;'>成为会员</button>
                         </li>                         
                         </ul>                
                       
                     
                     </form>
                     </div>                
               
                
    </div>
   
  </div>
</div>
<div id="footer">
      
       </div>
<script type="text/javascript">
$(function(){ 
  //$("#vcode").attr("src",'checkNum.php#'+new Date().getTime());
   $("#vcode").css("display","none");	  
	
});
function disPlayVcode(){
  $("#vcode").attr("src",'checkNum.php#'+new Date().getTime());
  $("#vcode").css("display","inline");
}
function register(){
  window.open('register.php');
}
</script>
	</body>
</html>
