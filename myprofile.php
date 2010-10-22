<?php
  session_start();
  require_once "included/database.php";
  if(isset($_SESSION['loginuser']) && isset($_SESSION['usertype'])){
	  if($_SESSION['usertype']!='U'){
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
   $localname='';   
   $sex='';
   $pwd='';
   $birthday='';
   $qq='';
   $msn='';
   $address='';
   $school='';
   $msn='';
   $parent='';
   $phone='';
   $signature='';
   $avatar='';
   $experience='';
   $sql="select avatar,localname,pwd,sex,birthday,qq,msn,
         address,school,grade_id,
         parent,phone,signature,experience
         from user 
         where email='$email'
         ";
   $result = query($sql);   
   while($row=mysql_fetch_assoc($result)){
   	   $avatar=$row['avatar'];
   	   $localname = $row['localname'];
   	   $pwd = $row['pwd'];
   	   $sex = $row['sex'];
   	   $birthday = $row['birthday'];
   	   $qq= $row['qq'];
   	   $msn = $row['msn'];
   	   $address = $row['address'];
   	   $school = $row['school'];
   	   $parent = $row['parent'];
   	   $grade_id = $row['grade_id'];
   	   $phone = $row['phone'];
   	   $signature = $row['signature'];
   	   $experience = $row['experience'];
   }
$medal = getFieldValue("select sum(medal) from userexp where email='$email'");

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

-->

</style>
<link
	rel="stylesheet" type="text/css" media="screen"
	href="scripts/jGrowl-1.2.4/jquery.jgrowl.css" />

<script language="javascript"
	type="text/javascript" 
	src="scripts/jGrowl-1.2.4/jquery.jgrowl_minimized.js"></script>

<script language="javascript"
	type="text/javascript" 
	src="scripts/myutils.js"></script>


<form id="profileForm" onSubmit="return false;">
<input type="hidden" name='email' value="<?php echo $email;?>" />
<table width="71%" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <th colspan="4" align="left" class="column1" scope="col">个人资料
    <a 
      onclick="window.open('scripts/jquery_upload_crop/upload_crop_v1.2.php','avatar');"
    href="javascript:;">修改头像</a></th>
  </tr>
  <tr>
    <td width="26%" rowspan="6" align="left" valign="top">
    <img src="<?php  echo $avatar;?>" name="avatar" id="avatar" style="vertical-align:top" />
     </td>
    <td colspan="2">邮件</td>
    <td width="44%"><?php echo urldecode($email);?>
      <input name="email2" type="hidden" id="email" 
    value="<?php echo ($email);?>" /></td>
  </tr>
  <tr>
    <td colspan="2">性别</td>
    <td>
      <label>
        <input type="radio" name="sex" value="f" id="sex_f" />
        男</label>   
      <label>
        <input type="radio" name="sex" value="m" id="sex_m" />
        女</label>
      
    </td>
  </tr>
  <tr>
    <td colspan="2">真实姓名</td>
    <td><input type="text" name="localname" 
    id="localname" value="<?php echo strip_tags($localname);?>" /></td>
  </tr>
  <tr>
    <td colspan="2">密码</td>
    <td><input name="pwd" type="password" id="pwd" 
	value="<?php echo $pwd;?>" /></td>
  </tr>
  <tr>
    <td colspan="2">确认密码</td>
    <td><input type="password" name="pwd2" id="pwd2" value="<?php echo $pwd;?>" /></td>
  </tr>
  <tr>
    <td colspan="2">出生日期</td>
    <td><input name="birthday" type="text" id="birthday"
      value="<?php echo strftime("%Y-%m-%d",strtotime($birthday));?>" readonly="readonly"
      /></td>
  </tr>
  <tr>
    <td>能力值:<?php echo $experience;?></td>
    <td colspan="2">QQ</td>
    <td><input type="text" name="qq" id="qq" 
        value="<?php echo $qq;?>"
    /></td>
  </tr>
  <tr>
    <td>勋章数:
    <img src='images/level/level-<?php echo trunc($medal,10);?>.png' style="vertical-align:middle;" />
    </td>
    <td colspan="2">MSN</td>
    <td><input type="text" name="msn" id="msn"   value="<?php echo $msn;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">所在城市</td>
    <td>
      <input name="address" type="text"
        value='<?php echo $address;?>'/>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">所在学校</td>
    <td> <input name="school" type="text"  
        value='<?php echo $school;?>'
        /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">所在年级</td>
    <td>  <?php echo makeSelect('grade_id',"select id,name from grade where parent_id!=-1");?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">父母姓名</td>
    <td><input type="text" name="parent" id="parent"   value="<?php echo $parent;?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">电话号码</td>
    <td><input type="text" name="phone" id="phone"    value="<?php echo $phone;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">个人签名</td>
    <td><textarea name="signature" id="signature" cols="35" rows="5"><?php echo $signature;?></textarea></td>
  </tr>
  <tr>
    <td colspan="4"  style="text-align:center">
    <center>
    <button id="saveprofile" onclick="saveProfile();return false;">保存修改</button>
    </center>
    </td>
  </tr>
</table>
<input name="oper" value="editPro" type="hidden"/>
</form>
<script language="javascript">
<!--
   $(function(){
     
      var grade   = '<?php echo $grade_id;?>';
      var sex  = '<?php echo $sex;?>';

      $("#sex_"+sex).attr("checked",true);
      $("#grade_id").attr("value",grade);

      $("#birthday").datepicker(
			  {
			changeMonth: true,
			changeDate:true,
  			changeYear: true,
  			yearRange: '1965:2000'
  			
  			
		}
	 );
 	
      
   });
var form = $("#profileForm");
function saveProfile(){
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
     var e = getEvent();
 	  if(e.preventDefault) e.preventDefault();
 	  if(e.returnValue) e.returnValue=false;
 	 var t = $(getEventTarget());
 	 t.attr("disabled",true);
     var data = form.serialize() ;
     $.jGrowl("正在保存用户资料!",{ life: 1000,
         position:"center",
         theme:  'smoke'
          });
     $.ajax({
         type:"POST",
         url:"member-controller.php",
         data:data,
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