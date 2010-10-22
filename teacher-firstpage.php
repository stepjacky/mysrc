<?php
session_start();
require_once "included/database.php";
$email='';
$guestView = false;
$localname='';
$avatar='images/fmale.png';
$signature = '';
if(isset($_GET['userId'])){
	//浏览模式
	$email = $_GET['userId'];
	$guestView = true;
}else{
	$email=$_SESSION['loginuser'];

}
$temail = urlencode($email);
$school='';
$result = query("select signature,school, avatar,localname from user where email='$temail'");
while($row=mysql_fetch_assoc($result)){
	$avatar = $row['avatar'];
	$localname = $row['localname'];
	$signature = $row['signature'];
	$school=$row['school'];
}

$servyear = '';
$aword = '';
$technical='';
$teacher_grade_id='';
$honor='';
$servyear_show='';
$aword_show='';
$technical_show='';
$honor_show='';
$teacher_grade_show='';
$sql = "select
servyear ,
aword ,
technical,
teacher_grade_id,
honor,
servyear_show,
technical_show,
aword_show,
teacher_grade_show,
honor_show
from teacher_adv where email='$temail'
";


$result = query($sql);
$teacherExists = false;
if($result){
	$teacherExists = true;
	while($row= mysql_fetch_assoc($result)){
		$servyear = $row['servyear'];
		$aword = $row['aword'];
		$technical=$row['technical'];
		$teacher_grade_id=$row['teacher_grade_id'];
		$honor=$row['honor'];
		$servyear_show=$row['servyear_show'];
		$technical_show=$row['technical_show'];
		$aword_show=$row['aword_show'];
		$teacher_grade_show=$row['teacher_grade_show'];
		$honor_show=$row['honor_show'];
	}
	if($teacher_grade_id=='')$teacher_grade_id=-1;
	$sql = "select name from teacher_type where id=$teacher_grade_id";
	loginfo($sql);
	//exit;
	$teacher_grade = getFieldValue($sql);
}
?>
<table align="center">
	<tr>
		<td colspan="2"><?php echo $email; ?>[<?php echo $localname;?>]		
		</td>
	</tr>
	<tr>
		<td width="19%" height="122"><img src="<?php  echo $avatar;?>" /></td>
		<td width="81%" align="left" valign="top" bgcolor="#FFFFDD"
			onmouseover="this.style.backgroundColor='#FFFFCC'"
			onmouseout="this.style.backgroundColor='#FFFFDD'"><?php echo strip_tags($signature,"<img/>");?>
		</td>

	</tr>
</table>
<div id="recent"
	style="width: 100%; height: 400px; background-color: #FFF">
<table>
	<thead>
		<tr>
			<th clospan='3'>
			<h3>个人情况</h3>
			</th>
		</tr>
	</thead>
	<tbody>
	 <tr>
	 <td>所在学校</td>
	 <td><?php echo $school;?></td>
	 </tr>
	<?php
	if($teacherExists==true){

		if($teacher_grade_show=='y'){
			echo "<tr style='line-height:30px;font-size:13px'>
         	<td>
         	教师类型 </td> <td>".strip_tags($teacher_grade)."</td></tr>";
		}
		if($servyear_show=='y'){
			echo "<tr style='line-height:30px;font-size:13px'>
         	<td>
         	任教年限</td><td>$servyear 年</td></tr>";
		}
		if($technical_show=='y'){
			echo "<tr style='line-height:30px;font-size:13px'>
         	<td>
         	职称</td><td>".strip_tags($technical)."</td></tr>";
		}
		if($aword_show=='y'){
			echo "<tr style='line-height:30px;font-size:13px'>
         	<td>
         	所获奖励</td><td>".strip_tags($aword)."</td></tr>";
		}
		if($honor_show=='y'){
			echo "<tr style='line-height:30px;font-size:13px'>
         	<td>
         	所获荣誉</td><td>".strip_tags($honor)."</td></tr>";
		}
	}
	?>
	</tbody>
</table>
</div>
