<?php 
   header('content-Type=text/html;charset=utf-8');
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>后台登陆页</title>
		<meta  http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">
       
		body{
			padding:0;
			margin:0;
			font-size:13px;
		}
		#header{
			margin-left:auto;
			margin-right:auto;
			width:1024px;
			background-image:url(images/header.png);
		    height:60px;
			
	    }
        #content{
	margin-left:auto;
	margin-right:auto;
	width:1024px;
	height:400px;
	background-color:#FFF;
	border:#CCC 1px outset;
	vertical-align:middle;
	padding: 100px 0px 0px 0px;
			} 
            #alignCenter{
	margin:0 auto;		/* 居中 这个是必须的，，其它的属性非必须 */
	width:400px;		/* 给个宽度 顶到浏览器的两边就看不出居中效果了 */
	height:300px;
	background-color:#FFF;
	background-image:url(images/admin-login-main.png);
	font-size: 18px;
			}
			.userinfo{
	height:20px;
	width:150px;
}
        </style>
        <script
	language="javascript" type="text/javascript"
	src="scripts/jquery-1.3.2.min.js"></script>
	</head>
	<body>
		<div id="header" style="background-image:url(images/header.png);">
          <img src="images/header.png"/>
        </div>
        <div id="content">
            <div id="alignCenter">               
               <form action="adminpanel.php" target="_self" method="post">
               <ul style="list-style:none; padding-top:40px; padding-left:80px; line-height:40px">
                  <li  style=" padding-left:80px;">管理登录</li>
                 <li>用 户:
                   
                    <label>
                     <input name="email" type="text" class="userinfo" id="username">
                   </label>
                 </li>
                 <li>
                     <label>密 码:
                       <input name="pwd" type="password" class="userinfo" id="pwd">
                     </label>
                 </li>
                 <li>
                     <label style="valign:middle">验证码:&nbsp;&nbsp;
                     <input type='text' onfocus="disPlayVcode();" name='acode' style="width:60px;"/>                                                                              
                        &nbsp;
                        <img id="vcode" style=" vertical-align:middle;" onclick='this.src="checkNum.php#"+new Date().getTime()'>
                         </label><br/>
                         <label>
                         
                        
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
                               	
                               }
                         
                         ?>
                         
                         </label>
                 </li>
                 <li style=" padding-left:80px;">
                     <input type="submit" style="width:60px" value="登陆" />                     
                 </li>
               </ul>
               </form>
            </div>
        
        </div>
        <script language="javascript">
<!--
$(function(){ 
	  //$("#vcode").attr("src",'checkNum.php#'+new Date().getTime());
	   $("#vcode").css("display","none");	  
		
	});
function disPlayVcode(){
	  $("#vcode").attr("src",'checkNum.php#'+new Date().getTime());
	  $("#vcode").css("display","inline");
	}
//-->
        </script>
	</body>
</html>
