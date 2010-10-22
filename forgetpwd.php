<?php
  if(isset($_POST['email'])){
  	require_once "included/database.php";
  	$email = $_POST['email'];
  	$sql = "select pwd from user where email='$email'";
  	$results = query($sql);
  	$pwd;
  	while($row=mysql_fetch_assoc($results)){
  		$pwd = $row['pwd'];
  	}  	
  	if(isset($pwd)){
  		$header = "From:cuiz@126.com\r\n";
  		$header.= "Reply-To:cuiz@126.com\r\n";
        $header.= "Content-Type:text/plain;\r\n charset=utf-8\r\n";
        mail($email,"找回密码","这是你的密码:$pwd");
        $url = "forgetpwd.php?msg=ok&mail=".$mail;
		header ("HTTP/1.1 303 See Other");
		header ("Location: $url");
		exit(0);
  	}else{
  		$url = "forgetpwd.php?msg=nosuchuser";
		header ("HTTP/1.1 303 See Other");
		header ("Location: $url");
		exit(0);
  	}
  }else{//end of set email;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>找回密码</title>
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
        
	</head>
	<body>
		<div id="header" style="background-image:url(images/header.png);">
          <img src="images/header.png"/>
        </div>
        <div id="content">
            <div id="alignCenter">
               <?php if(!isset($_GET['msg'])){?>
               <form action="forgetpwd.php" target="_self" method="post">
               <ul style="list-style:none; padding-top:80px; padding-left:80px; line-height:50px">
                 <li>邮件地址:                   
                    <label>
                     <input name="email" type="text" class="userinfo" id="email" />
                    
                   </label>
                 </li>   
                 <li style="text-align:center">
                     <input type="submit" value="找回密码"/>
                 </li>                              
               </ul>
               </form>
              <?php }else{
                 if($_GET['msg']=='nosuchuser'){
               ?>
                 <ul style="list-style:none; padding-top:80px; padding-left:80px; line-height:50px">
                 <li>
                    <h4>对不起,没有此用户</h4>
                 </li>
                 </ul>
               <?php      
                 }else if($_GET['msg']=='ok'){
                ?>
                <ul style="list-style:none; padding-top:80px; padding-left:80px; line-height:50px">
                 <li>密码已经发送到你的邮箱
                    <a href='mailto:<?php echo $_POST['email'];?>'>
                    <?php echo $_POST['email'];?>
                    </a>,请查收
                 </li>
                 </ul>
                
                <?php  
                 }
              }              
              ?>
            </div>
        
        </div>
	</body>
</html>


<?php 
  }//end of else
?>