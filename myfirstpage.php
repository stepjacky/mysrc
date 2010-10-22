<?php
session_start();
require_once "included/database.php";
$subjects = array();
$email='';
$guestView = false;
$signature='';
$experience='';
$localname='';
if(isset($_GET['userId'])){
	$email = $_GET['userId'];	
}else{
	$email = $_SESSION['loginuser'];
}

$temail = urlencode($email);
$cemail = isset($_SESSION['loginuser'])?$_SESSION['loginuser']:'noset';
$avatar ='';
$result =query("select avatar,experience,localname,signature from user where email='$temail'");
$localname = '';
while($row = mysql_fetch_assoc($result)){
	$localname=$row['localname'];
	$experience = $row['experience'];
	$signature = $row['signature'];
	$avatar = $row['avatar'];
}
if($guestView==false){
	$sql = "select id,name,image from subject limit 0,9";
	$result = query($sql);
	while($row = mysql_fetch_assoc($result)){
		array_push($subjects,array('id'=>$row['id'],'name'=>$row['name'],'image'=>$row['image']));
	}
}

?>
<div id="mheader"
	style="background-color: #FFF; height: 180px; border: #CCC outset 1px;">
<table border="0" cellspacing="0" cellpadding="0">
	 	<tr>
        
        <td colspan="2"><?php echo $email; ?>[<?php echo $localname;?>]
		
           能力值:<?php echo $experience;?>          
           
      </td>
		</tr>

    <tr>
		<th width="18%" height="78" scope="col">
           <img src="<?php echo $avatar;?>"/>
        </th>
		<th width="82%" align="left" bgcolor="#FFFFDD"
			onmouseover="this.style.backgroundColor='#FFFFCC'"
			onmouseout="this.style.backgroundColor='#FFFFDD'" valign="top"
			scope="col"><?php echo strip_tags($signature);?></th>
	</tr>
</table>


</div>
<div id="mcontent" style="width: 545px; height: auto">
<table style="width: 100%" align="center" border="0" cellspacing="0"
	cellpadding="0">
 <thead>
 <tr><th colspan="3">
  请选择科目进入答题
 </th></tr>
 </thead>
	<?php

	

		for($i=0;$i<3;$i++){
			echo "<tr>";
			for($j=0;$j<3;$j++){
				$idx = $i*3+$j;
				$sub = $subjects[$idx];
				?>
	<td align="center" valign="middle" style="padding-left: 15px; text-indent:inherit"
      onmouseover="this.style.backgroundColor='#FFC'"
      onmouseout="this.style.backgroundColor='#FFF'"
    
    >
    <ul style="list-style-type:none;">
      <li  style="float:left;">
       <a
		style="text-decoration: none"
		<?php 
		  if(urlencode($cemail) != $temail){
		     echo "onClick='return false;'";
		  }else{
		     echo "href='pickquestion.php?email=$cemail&sid=".$sub['id']."'";
		  }		
		?>
		> <img width="73" height="73" border="0"
		src="<?php echo $sub['image'];?>" style="vertical-align:middle;" /> </a> 
      </li>
       <li  style="float:left;">&nbsp;</li>
        <li  style="float:left;">&nbsp;</li>
      <li  style="float:left; margin-top:45px;">
       <?php echo $sub['name'];?><br/>
       <a href="mysubject-detail.php?email=<?php echo $email;?>&sid=<?php echo $sub['id']; ?>" target="_blank">详细统计</a>
      </li>
    </ul>
    
    
    
          
        
         
        </td>
	<?php
			}

			?>
	</tr>
	<tr>
		<td height="27" style="padding-left: 15px">&nbsp;</td>
		<td style="padding-left: 15px">&nbsp;</td>
		<td style="padding-left: 15px">&nbsp;</td>
	</tr>
	<?php


		}

	?>
</table>
</div>
