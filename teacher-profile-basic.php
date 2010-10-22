<?php 
session_start();
require_once "included/database.php";
$email = urlencode($_SESSION['loginuser']);
   $localname='';   
   $sex='';
   $pwd='';
   $birthday='';
   $qq='';
   $msn='';
   $address='';
   $school='';   
   $phone='';
   $signature='';
   $avatar='';
   $sql="select avatar,localname,pwd,sex,birthday,qq,msn,
         address,school,
         phone,signature     
         
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
   	   $phone = $row['phone'];
   	   $signature = $row['signature'];
   }
   ?>
  <tr>
    <td width="26%" rowspan="6" align="left" valign="top">
    <img  src="<?php  echo $avatar;?>" name="avatar" id="avatar" style="vertical-align:top" />
     </td>
    <td colspan="2">邮件</td>
    <td width="48%"><?php echo urldecode($email);?>
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
    <td colspan="2">昵称</td>
    <td><input type="text" name="localname" 
    id="localname" value="<?php echo $localname;?>" /></td>
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
    <td>&nbsp;</td>
    <td colspan="2">QQ</td>
    <td><input type="text" name="qq" id="qq" 
        value="<?php echo $qq;?>"
    /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
    <td>  
     <input name="school" type="text"  
        value='<?php echo $school;?>'
        />
   
   
   </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">电话号码</td>
    <td><input type="text" name="phone" id="phone"    value="<?php echo $phone;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">个人签名</td>
    <td><textarea name="signature" id="signature" cols="40" rows="5"><?php echo $signature;?></textarea></td>
  </tr>