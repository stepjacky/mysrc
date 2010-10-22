<?php
session_start();
require_once "included/database.php";
header('content-Type=text/html;charset=utf-8');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>注册新帐户</title>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" type="text/css" media="screen"
	href="scripts/jquery_ui/css/smoothness/jquery-ui-1.7.2.custom.css" />


<link rel="stylesheet" type="text/css" media="screen"
	href="scripts/jquery-validate/css/jquery-validation.css" />
	
<link href="styles/table.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript"
	src="scripts/jquery-1.3.2.min.js"></script>

<script language="javascript" type="text/javascript"
	src="scripts/myutils.js"></script>
<script type="text/javascript"
	src="scripts/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>

<script type="text/javascript"
	src="scripts/jquery_ui/js/i18n/jquery-ui-i18n.js"></script>

<script src="scripts/jquery-validate/jquery.validate.js"
	type="text/javascript"></script>

<script src="scripts/jquery-validate/cmxforms.js" type="text/javascript"></script>

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
}

#wrap {
	width: 1024px;
	height: 650px;
	margin-left: auto;
	margin-right: auto;
	background-color: #FFF;
}

#column {
	float: left;
	width: 820px;
	height: 650px;
}

#column1 {
	float: left;
	width: 220px;
	height: 650px;
	background-color: #FFF;
}

#column2 {
	float: right;
	width: 595px;
	height: 650px;
	background-color: #FFF;
}

#column3 {
	float: right;
	width: 200px;
	height: 650px;
	background-color: #FFF
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

.fitem {
	width: 200px;
	height: 20px;
}
.button{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bolder;
	color: #CC0;
	background-color: #FFF;
	text-align: center;
	display: block;
	border: 1px solid #CF9;
	cursor: default;
	filter: Chroma(Color=blue);
	width:80px;
}
</style>
</head>
<body>
<div id="header"></div>
<div id="wrap">
<div id="column">
<div id="column1"></div>
<div id="column2">
<?php
$tableName="user";
if(isset($_POST['act'])){
	if($_POST['act']=='regfinal'){
		$rcode  = strtolower($_POST['vcode']);
		$scode = strtolower($_SESSION['code']);
		if($rcode!=$scode){
			$url = "register.php?msg=codeerror";
			header ("HTTP/1.1 303 See Other");
			header ("Location: $url");
			exit(0);
		}

		//注册代码,跳转页面
		$email = urlencode($_POST['email']);
		$pwd   = urlencode($_POST['pwd']);
		$values = array();
		$values['email']=$email;
		$values['pwd']=$pwd;
		$values['localname']=$_POST['localname'];
		$values['birthday']=$_POST['birthday'];
		$values['address']=$_POST['address'];
		$values['school']=$_POST['school'];
		$values['phone']=$_POST['phone'];
		$values['sex']=$_POST['sex'];
		$values['usertype']=$_POST['usertype'];
		$values['qq']=$_POST['qq'];
		$values['msn']=$_POST['msn'];
		//
		//
		create($tableName,$values);
		$url = "regok.php";
		header ("HTTP/1.1 303 See Other");
		header ("Location: $url");
		exit(0);
	}
}else{
	//初次进入注册界面
	?>
<form action="register.php" method="post" id="regForm"
 onsubmit="return checkform();"
><input
	type="hidden" name="act" value="regfinal" />
	<input type="hidden" name="address" id="address"/>
<table  border="0" cellpadding="1" cellspacing="0">
<caption><h2>用户注册</h2></caption>
	<tr>
		<td width="28%"><span style="height: 30px;">常用邮箱</span></td>
		<td width="72%"><span style="height: 30px;"> <input name="email"
			type="text" class="fitem" onBlur="checkmail(this);"> <label
			id="mailmsg"></label> </span></td>
	</tr>
	<tr>
		<td><span style="height: 30px;">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</span></td>
		<td><span style="height: 30px;"> <input name="pwd" type="password"
			id="pwd" class="fitem"> </span></td>
	</tr>
	<tr>
		<td><span style="height: 30px;">重复密码</span></td>
		<td><span style="height: 30px;"> <input name="pwd2" type="password"
			class="fitem"> </span></td>
	</tr>
	<tr>
		<td><span style="height: 30px;">真实姓名</span></td>
		<td><span style="height: 30px;"> <input name="localname" type="text"
			class="fitem"> </span></td>
	</tr>
	<tr>
		<td><span style="height: 30px;">出生日期</span></td>
		<td><span style="height: 30px;"> <input name="birthday" type="text"
			id="bday" readonly="true" class="fitem">			
			 </span></td>
	</tr>
	<tr>
		<td><span style="height: 30px;">居住城市</span></td>
		<td><span style="height: 30px;"> 
        <label>省/直辖市<select id="province" onChange="updateCity();"></select></label>
        <label>市<select id="city" onChange="makeAddress();" ></select></label></span>
        
        </td>
	</tr>
	<tr>
		<td><span style="height: 30px;">所属学校</span></td>
		<td><span style="height: 30px;"> 
        <input type="text" name="school" id="school"	class="fitem" /> </span></td>
	</tr>
	<tr>
		<td><span style="height: 30px;">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</span></td>
		<td><span style="height: 30px;"> <select name="sex">
			<option value="m">男</option>
			<option value="f">女</option>
		</select> </span></td>
	</tr>
	<tr>
	  <td><span style="height: 30px;">账户类型</span></td>
	  <td><span style="height: 30px;"> <select name="usertype">
	    <option value="U">学生</option>
	    <option value="T">教师</option>
	    </select> </span></td>
	  </tr>
	<tr>
	  <td><span style="height: 30px;">联系电话</span></td>
	  <td><span style="height: 30px;"> <input name="phone" type="text"
			class="fitem"> </span></td>
	  </tr>
	<tr>
		<td><span style="height: 30px;">QQ&nbsp;</span></td>
		<td><span style="height: 30px;"> <input name="qq" type="text"
			class="fitem"> </span></td>
	</tr>
	<tr>
		<td><span style="height: 30px;">M&nbsp;S&nbsp;N</span></td>
		<td><span style="height: 30px;"> <input name="msn" type="text"
			class="fitem"> </span></td>
	</tr>
	<tr>
		<td><span style="height: 30px;">服务条款</span></td>
		<td><span style="height: 30px;"> <input type="checkbox" name="agree"
			id="agree" checked="true" /> 同意<a href="javascript:;">点击查看</a></span></td>
	</tr>
	<tr>
		<td><span style="height: 30px;">输入验证</span></td>
		<td><span style="height: 30px;"> <input style="width: 50px"
			name="vcode" type="text"> <img src='checkNum.php' alt="点击刷新"
			style="vertical-align: bottom;" title="点击刷新"
			onClick='this.src="checkNum.php#"+new Date().getTime()'> <?php 
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

			?> </span></td>
	</tr>
	<tr>
		<td height="65" colspan="2" align="center">
        <center>
        <input type="submit" class="button" value="注册">
            </center>
            </td>
	</tr>
</table>
</form>
<script language="javascript">
<!--
  $.validator.setDefaults({
	  submitHandler: function() {
	    
	    document.forms[0].submit();

	  }
  });

  $(function(){
      $("#bday").datepicker(
			  {
			changeMonth: true,
			changeYear: true,
  			yearRange: '1965:2012'
  			
  			
			  }
			  );	
	  $("#regForm").validate({
			rules: {				
				pwd: {
					required: true,
					minlength: 6
				},
				pwd2: {
					required: true,
					minlength: 6,
					equalTo: "#pwd"
				},
				email: {
					required: true,
					email: true
				},
				localname: {
					required: true,
					minlength: 2
				},
				birthday:{
					required: true
					},
			    school:{
					required:true
			    },
			    phone:{
                    required:true
				    },
				
			    phone:{required:true},
			    sex:{required:true},
			    usertype:{required:true},
			    vcode:{required:true},
				agree: {required:true}
			},
			messages: {
				localname: {
					required: "请输入您的姓名",
					minlength: "用户名至少得两个字符"
				},
				pwd: {
					required: "请输入一个密码",
					minlength: "密码长度至少得6个字符"
				},
				pwd2: {
					required: "请输入一个密码",
					minlength: "密码长度至少得6个字符",
					equalTo: "两次输入的密码必须相同"
				},
				school:{
					required: "请填写您的学校"
				},				
				birthday:{required: "请输入出生日期"},
				sex:{required: "请选择性别"},
				usertype:{required: "请选择你要注册的账户类型"},
				phone:{required:"请输入您的电话"},
				vcode:{required:"需要输入验证码"},
				email: {required:"请输入您的电子邮件",email:"邮件格式不正确"},
				agree: "接受协议才可以注册"
			}
		});
		
      var pobj = {action:"getprov"};
      $.ajax({
          type: "GET",
          url:"city-controller.php",
          data: $.param(pobj),
          dataType:"json",
          success:function(data){
    	  $("#province").empty();
             for(var i=0;i<data.length;i++){
                 var row = data[i];
                 var opt  = $("<option></option>");
                opt.attr("value",row.id);
                opt.attr("text",row.name);
                $("#province").append(opt);           
             }
          },
          error:function(data){
             alert(data);
          }
          
          }
      );		
  });

  function checkmail(mobj){
	  var mail = $(mobj).val();	
	  if(mail=='')  {
		  $("#mailmsg").html('请填写email');
		  return;
		  }
      $.ajax({
    	  type: "GET",
          url:"checkmail.php",
          data:"email="+mail,
          dataType:"text",
          success:function(data){         
             if(data=='yes'){
            	 $("#mailmsg").html('此emai已经被注册');
            	 $(mobj).val('');
             }else if(data=='no'){
                
            	 $("#mailmsg").html('可以注册');
             }
          },
          error:function(data){
            alert("错误\n"+data);
            $(mobj).val('');
          }
      });
  }

 function updateCity(){
    var city = $(getEventTarget());
    var pobj = {action:"getcity",pid:city.val()};
    $.ajax({
        type: "GET",
        url:"city-controller.php",
        data: $.param(pobj),
        dataType:"json",
        success:function(data){
    	    $("#city").empty();
           for(var i=0;i<data.length;i++){
               var row = data[i];
               var opt  = $("<option></option>");
              opt.attr("value",row.name);
              opt.attr("text",row.name);
              $("#city").append(opt);           
           }
        },
        error:function(data){
           alert(data);
        }
        
        }
    );

 }

function makeAddress(){
   var copt = fetchSelectvars();
   

}
function checkform(){
	 //alert($("select[id='province'] option:selected").text());
     $("#address").val($("select[id='province'] option:selected").text()+$("#city").val());
    // alert($("#address").val());
     return true;
}
//-->
</script> <?php 
}
?>
</div>
<div class="clear"></div>
</div>
<div id="column3"></div>
<div class="clear"></div>
</div>
<div id="footer"><br />

</div>

</body>
</html>
