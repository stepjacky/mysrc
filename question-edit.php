<?php 
    session_start();
    require_once "included/database.php" ; 
     
?>
<html>
<head>
<link  rel="stylesheet" href="styles/SexyButtons/sexybuttons.css"  type="text/css" />

<script
	src="scripts/question.js" type="text/javascript"></script>
</head>
<body>
<div style="height:auto; color: #03C;">


<?php 
 //添加新题目
if(!isset($_GET['id'])){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#99CCFF">
  <td>题目类型</td>
  <td>年级</td>
  <td>学科</td>
  <td>学期</td>
  <td>难度</td>
  <td>教材版本</td>
</tr>
<tr>
  <td width="13%"><?php echo makeSelect("qst_type_id","select id,name from qtype");?>
  </td>
  <td width="17%"><?php echo makeSelect("qst_grade_id","select id,name from grade where parent_id!=-1");?></td>
  <td width="23%"><select id="qst_subject_id">
    <option value='-1'>请选择学科..</option>
  </select></td>
  <td width="15%"><select id="semester">
      <option value='u'>上学期</option>
      <option value='d'>下学期</option>
  </select>
  </td>
  <td width="15%"><select id="diffculity">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5" selected="selected">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
  </select>
  </td>
  <td width="17%"><?php echo makeSelect("qst_bvser_id","select id,name from bookversion");?></td>
</tr>

<caption style="background:#ccccdd; font-size:24px; height:40px;">添加题目</caption>
<thead>
<tr>
<th colspan="6">

<button 
onclick="addQuestion('questionform');return false;"
 class="sexybutton"><span><span><span class="ok">添加题目</span></span></span></button>

</th>
</tr>
</thead>
</table>  
<form id="questionform">
    <?php include_once 'texteditor.php'?>
    <input type="hidden" id="qst_owner_id" name="owner" value="<?php echo $_SESSION['loginuser']; ?>"/>
</form>
<?php 
    
//编辑题目
} else{
    
    	
    	?>
   <form id="questionform">
   <button 
    onclick="editQuestion('questionform');return false;"
   class="sexybutton" type="reset"><span><span><span class="ok">提交修改</span></span></span></button>
   
      <hr/>
      <input type="hidden" id="qid" name="id" value="<?php echo $_GET['id']?>"/>
      <?php 
         $desc='';
         $remark='';
         $result = query("select description,remark from question where id=".$_GET['id']);
         while($row = mysql_fetch_assoc($result)){
           $desc   =$row['description'];
           $remark =$row['remark'];
           break;
         }
         
         createFckeditor("qtext",$desc);
         $result = query("select * from answer where question_id=".$_GET['id']);
         $answer = array();
         $answertext = array();
         while($row = mysql_fetch_assoc($result)){
             $answer[$row['tip']] = $row['iscorrect']; 
             $answertext[$row['tip']] = $row['name'];       	
         }
      ?>
     
      答案
      <hr/> 
      <table >
   <tr align="center" bgcolor="#99CCFF" height="35" style="font-size:24px; font-weight:bold">
    <td  colspan="2">
    <label>A 
    <input type="checkbox"
		name="a" id="answer_A" no="A"
		<?php echo $answer['A']=='y'?'checked=true':'';?>
		
		/></label>
   </td>
    <td>
    <label>B
    <input type="checkbox"
		name="b" id="answer_B" no="B"
		<?php echo $answer['B']=='y'?'checked=true':'';?>
		/>
    </label>
    </td>
    <td>
    <label>C
    <input type="checkbox"
		name="c" id="answer_C" no="C"
		<?php echo $answer['C']=='y'?'checked=true':'';?>
		/>
    </label>    
    </td>
    <td  colspan="2">
    <label>D
    <input type="checkbox"
		name="d" id="answer_D" no="D"
		<?php echo $answer['D']=='y'?'checked=true':'';?>
		/>
    </label>
    </td>
  </tr>
  <tr align="center">
    <td colspan="2"><textarea style="width:100%; height:100px" id="answer_A_text"><?php echo $answertext['A'];?></textarea></td>
    <td><textarea style="width:100%; height:100px" id="answer_B_text"><?php echo $answertext['B'];?></textarea></td>
    <td><textarea style="width:100%; height:100px" id="answer_C_text"><?php echo $answertext['C'];?></textarea></td>
    <td colspan="2"><textarea style="width:100%; height:100px" id="answer_D_text"><?php echo $answertext['D'];?></textarea></td>
  </tr>
  <tr bgcolor="#99CCCC">
    <td height="35"
     colspan="6" align="center" bgcolor="#99CCFF"
       style="font-size:24px;text-align:center;  font-weight:bold">答案解释</td>
  </tr>  
</table>
      
      
      
      
      答案解释:
      <hr/>
      <textarea id="remark" name="remark" style="width:100%;height:60px"><?php echo $remark;?></textarea> 
   </form>

<?php }?>
</div>
</body>
</html>