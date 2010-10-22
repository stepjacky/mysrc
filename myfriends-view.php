<?php 
   $guestView = false;
   if(isset($_GET['userId'])){
   	  $guestView = true;
   }

?>

<div style="height:500px">
<?php if($guestView==false){?>
<table>
 <thead>
 <tr>
 <th>添加朋友</th>
 </tr>
 </thead>
 <tbody>
 
 <tr>
 <td>
   <label>朋友Email:<input type="text" width="200" id="fmail" name='friend' /></label> 
   
   <button  class="sexybutton" onclick="addFriend();"><span><span><span class="add">添加</span></span></span></button>
 </td>
 </tr>
 </tbody>
</table>
<?php }?>
<table width="56%">
<thead>
 <tr>
 <th colspan="3">我的好友</th>
 </tr>
 </thead>
<?php 
  if(!isset($_GET['userId'])){
  	exit(0);
  }
  require_once "included/database.php";
  $me = $_GET['userId'];
  $userId = urlencode($_GET['userId']);
  $sql = "select f.friend fmail ,
                 u.avatar favt,
                 u.localname fname,
                 u.address faddr,
                 u.sex sex
                   from myfriend f,user u
                   where f.email='$userId'
                      and u.email = f.friend
                   limit 0,9";
  $result = query($sql);
  while($row = mysql_fetch_assoc($result)){
    	$fmail = urldecode($row['fmail']);
    	$favt  = $row['favt'];
    	$fname = $row['fname'];
    	$faddr = $row['faddr'];
    	$fsex  = $row['sex']=='f'?'男':'女';
 
  

?>
  <tr>
    <th width="13%" rowspan="2" scope="col">
    <img src="<?php echo $favt;?>" width="50" height="50" />
    
    </th>
    <th width="60%" height="27" align="left" valign="top" scope="col">
<a href="findfriend.php?userId=<?php echo $fmail;?>" target="_blank">    
<?php echo strip_tags($fname);?>
</a>
</th>
    <th width="27%" align="right" scope="col"><?php echo $fsex.' '.$faddr ?> </th>
  </tr>
  <tr>
    <th height="25" align="left" valign="bottom" scope="col">
    </th>
    <th align="right" scope="col">
    <?php if($guestView==false){?>
    <a href="javascript:;" onclick="deletefriend(<?php echo "'$me' , '$fmail'";?>);">
                 删除
     </a>
     <?php }?>
    </th>
  </tr>
<?php  }?>
</table>
</div>