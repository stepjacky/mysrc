<?php
  session_start();
  require_once "included/database.php";
  if(isset($_SESSION['loginuser']) && isset($_SESSION['usertype'])){
	  if($_SESSION['usertype']!='T'){
	     $url = "login.php";
		 header ("HTTP/1.1 303 See Other");
		 header ("Location: $url");
		 exit(0);
	  }
   }else{
   	     $url = "login.php";
		 header ("HTTP/1.1 303 See Other");
		 header ("Location: $url");
		 exit(0);
   }
   $email = urlencode($_SESSION['loginuser']);
   $sex= getFieldValue("select sex from user where email='$email'");
  
?>
<style type="text/css">
<!--
button{
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
}
div.jGrowl div.manilla {
				background-color: 		#FFF1C2;
				color: 					navy;
			}
			
			div.jGrowl div.smoke {
				background: url(images/smoke.png) no-repeat;
				-moz-border-radius: 	0px;
				-webkit-border-radius:	0px;
				width: 					280px;
				height: 				55px;
				overflow: 				hidden;
				color:                  yellow;
				font-size:              15px;
				font-weight:            bold
			}
 
			div.jGrowl div.flora {
				background: 			#E6F7D4 url(images/flora-notification.png) no-repeat;
				-moz-border-radius: 	0px;
				-webkit-border-radius:	0px;
				opacity: 				1;
				filter: 				alpha(opacity = 100);
				width: 					270px;
				height: 				90px;
				padding: 				0px;
				overflow: 				hidden;
				border-color: 			#5ab500;
			}
 
			div.jGrowl div.flora div.message {
				padding: 				5px;
				color: 					#000;
			}
			
			div.jGrowl div.flora div.header {
				background: 			url(images/flora-header.png) no-repeat;
				padding: 				5px;
			}
 
			div.jGrowl div.flora div.close {
				background: 			url(images/flora-close.png) no-repeat;
				padding: 				5px;
				color: 					transparent;
				padding: 				0px;
				margin: 				5px;
				width:					17px;
			}
			
			div.jGrowl div.iphone {
				font-family: 			"Helvetica Neue", "Helvetica";
				font-size: 				12px;
				background: 			url(images/iphone.png) no-repeat;
				-moz-border-radius: 	0px;
				-webkit-border-radius:	0px;
				opacity: 				.90;
				filter: 				alpha(opacity = 90);
				width: 					245px;
				height: 				137px;
				padding: 				0px;
				overflow: 				hidden;
				border-color: 			#5ab500;
				color: 					#fff;
			}
 
			div.jGrowl div.iphone div.message {
				padding-top: 			0px;
				padding-bottom: 		7px;
				padding-left: 			15px;
				padding-right: 			15px;
			}
			
			div.jGrowl div.iphone div.header {
				padding: 				7px;
				padding-left: 			15px;
				padding-right: 			15px;
				font-size: 				17px;
			}
 
			div.jGrowl div.iphone div.close {
				display: 				none;
			}
			
			div#random {
				width: 					1000px;
				background-color: 		red;
				line-height: 			60px;
			}  
-->

</style>
<link
	rel="stylesheet" type="text/css" media="screen"
	href="scripts/jGrowl-1.2.4/jquery.jgrowl.css" />

<script language="javascript"
	type="text/javascript" 
	src="scripts/myutils.js"></script>

<script language="javascript"
	type="text/javascript" 
	src="scripts/jGrowl-1.2.4/jquery.jgrowl_minimized.js"></script>
<form id="profileForm" onSubmit="return false;">
<input type="hidden" name='email' value="<?php echo $email;?>" />
<table border="0" cellpadding="1" cellspacing="0">
  <thead>
   <tr>
     <td colspan="4" align="left" class="column1" scope="col">
     <ul style="list-style:none; list-style-type:">
     <li style="display:inline">■ <a href="javascript:;" 
     onclick="loadBasicDetail('basic');">基本资料</a></li>
     <li style="display:inline">■ <a href="javascript:;" 
     onclick="loadBasicDetail('adv');">教育资历</a></li>
     <li style="display:inline">■
     <a 
      onclick="window.open('scripts/jquery_upload_crop/upload_crop_v1.2.php','avatar');"
    href="javascript:;">修改头像</a>
     </li>
     </ul>
      
     </td>
   </tr>
  </thead>
  <tbody id="dtbody">  
   
  </tbody>
  <tfoot>
  <tr>
    <td height="78" colspan="4" valign="middle">
    <center>
    <button id="saveprofile" onclick="saveProfile();return false;">保存修改</button>
    </center></td>
  </tr>
  </tfoot>  
</table>
</form>
<script language="javascript">
<!--
   var mdetail = $("#dtbody");
   $(function(){    
      loadBasicDetail("basic");   
      
   });
var tbasic = true;
function inilizeBasic(){
	   
    var sex  = '<?php echo $sex;?>';
    $("#sex_"+sex).attr("checked",true);   

    $("#birthday").datepicker(
			  {
			changeMonth: true,
			changeDate:true,
			changeYear: true,
			yearRange: '1965:2012'
			
			
		}
	 );
}



function loadBasicDetail(type){
	var url = "teacher-profile-basic.php";
	if(type=='adv'){
      url = "teacher-profile-adv.php";
      tbasic = false;
	}else{
		tbasic = true;
	}
	mdetail.html("稍后...<img src='images/ajax-loader.gif'/>");
	$.ajax({
        type:"GET",
        url:url,
        success:function(data){
		   mdetail.html(data);
           if(type=='basic'){
        	   inilizeBasic();
           }else if(type=='adv'){
        	   inilizeAdv();
           }
		      
        },
        error:function(data){
           alert(data);
           }
        

       });
	
}
   
var form = $("#profileForm");
function saveProfile(){
	 var e = getEvent();
 	 if(e.preventDefault) e.preventDefault();
 	 if(e.returnValue) e.returnValue=false;
 	 var t = $(getEventTarget());
 	 t.attr("disabled",true);
 	 var oper = "editPro";
     var data = form.serialize() ;
     $.jGrowl("正在保存用户资料!",{ life: 1000,
         position:"center",
         theme:  'smoke'
     });

     if(tbasic==true){//保存基本资料
    	 if($("#pwd").val()!=$("#pwd2").val())
    		{

    			$.jGrowl("两次密码不一致!", { life: 1000,
    				                     position:"center",
    				                     theme:  'smoke',
    				                     beforeOpen: function(e,m,o) {
    				         				o.position='center';
    				         			 }
    				                      });
    			
    			return false;
    		}
    	 oper = "editPro";
     }else{
    	 oper = "editAdv";
     }

     $.ajax({
         type:"POST",
         url:"member-controller.php",
         data:data+"&oper="+oper,
         success:function(data){
    	 $.jGrowl("用户资料保存完毕!",{ life: 1000,
             position:"center",
             theme:  'smoke'
              });
    	 t.attr("disabled",false);
         },
         error:function(data){
              alert("更新个人出错:\n"+data);
              t.attr("disabled",false);
         }
     });
     
     return false;

 }; 
//-->
</script>