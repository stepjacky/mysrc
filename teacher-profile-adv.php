<?php
session_start();
require_once "included/database.php";
$email = urlencode($_SESSION['loginuser']);
/**
 * `servyear` INT NULL ,
 `aword` TEXT NULL ,
 `technical` TEXT NULL ,
 `teacher_grade_id` INT NULL ,
 `honor` TEXT NULL ,
 `servyear_show` SET('y','n') NULL DEFAULT 'y' ,
 `aword_show` SET('y','n') NULL DEFAULT 'y' ,
 `technical_show` SET('y','n') NULL DEFAULT 'y' ,
 `teacher_grade_show` SET('y','n') NULL DEFAULT 'y' ,
 `honor_show` SET('y','n') NULL DEFAULT 'y' ,
 *
 * */
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
$result = query("select 
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
from teacher_adv where email='$email'");
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
?>

<tr>

	<td colspan="2">执教年限</td>
	<td><select name="servyear" id="servyear">
    
     </select>
    </td>
	<td><select name="servyear_show" id="servyear_show" >
		<option value="y">显示</option>
		<option value="n">隐藏</option>
	</select></td>
</tr>
<tr>

	<td colspan="2">教师级别</td>
	<td><?php echo makeSelect("teacher_grade_id","select id,name from teacher_type");?>
	</td>
	<td><select name="teacher_grade_show" id="teacher_grade_show">
		<option value="y">显示</option>
		<option value="n">隐藏</option>
	</select></td>
</tr>
<tr>

	<td colspan="2">职称</td>
	<td><textarea name="technical" id="technical" cols="40" rows="5"><?php echo strip_tags($technical);?></textarea></td>
	<td><select name="technical_show" id="technical_show">
		<option value="y">显示</option>
		<option value="n">隐藏</option>
	</select></td>
</tr>
<tr>

	<td colspan="2">所获奖励</td>
	<td><textarea name="aword" id="aword" cols="40" rows="5"><?php echo strip_tags($aword);?></textarea></td>
	<td><select name="aword_show" id="aword_show">
		<option value="y">显示</option>
		<option value="n">隐藏</option>
	</select></td>
</tr>
<tr>

	<td colspan="2">所获荣誉</td>
	<td><textarea name="honor" id="honor" cols="40" rows="5"><?php echo strip_tags($honor);?></textarea></td>
	<td><select name="honor_show" id="honor_show">
		<option value="y">显示</option>
		<option value="n">隐藏</option>
	</select></td>
</tr>

<script language="javascript">
<!--
function inilizeAdv(){
	
	var servy = "<?php echo $servyear;?>";
	for(var i=1;i<30;i++){
		var opt = $("<option></option>");
        opt.val(i);
        opt.text(i+"年");
		if(i==servy)opt.attr("selected",true);
		$("#servyear").append(opt);		
	
	}
	
	$("#teacher_grade_id").attr("value","<?php echo $teacher_grade_id;?>");
	 
	
	
	$("#servyear_show").attr("value","<?php echo $servyear_show;?>");
    
    $("#technical_show").attr("value","<?php echo $technical_show;?>");

    $("#aword_show").attr("value","<?php echo $aword_show;?>");

    $("#honor_show").attr("value","<?php echo $honor_show;?>");

    $("#teacher_grade_show").attr("value","<?php echo $teacher_grade_show;?>");
    
}
//-->

</script>
