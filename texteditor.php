<table >
  <tr>
    <td colspan="6"><?php
 createFckeditor('qtext','输入你的问题内容....');
?></td>
  </tr>
  <tr align="center" bgcolor="#99CCFF" height="35" style="font-size:24px; font-weight:bold">
    <td  colspan="2">
    <label>A 
    <input type="checkbox"
		name="a" id="answer_a" no="a"/></label>
   </td>
    <td>
    <label>B
    <input type="checkbox"
		name="b" id="answer_b" no="b"/>
    </label>
    </td>
    <td>
    <label>C
    <input type="checkbox"
		name="c" id="answer_c" no="c"/>
    </label>    
    </td>
    <td  colspan="2">
    <label>D
    <input type="checkbox"
		name="d" id="answer_d" no="d"/>
    </label>
    </td>
  </tr>
  <tr align="center">
    <td colspan="2"><textarea style="width:100%; height:100px" id="answer_a_text"></textarea></td>
    <td><textarea style="width:100%; height:100px" id="answer_b_text"></textarea></td>
    <td><textarea style="width:100%; height:100px" id="answer_c_text"></textarea></td>
    <td colspan="2"><textarea style="width:100%; height:100px" id="answer_d_text"></textarea></td>
   </tr>
  <tr bgcolor="#99CCCC">
    <td height="35"
     colspan="6" align="center" bgcolor="#99CCFF"
       style="font-size:24px;text-align:center;  font-weight:bold">答案解释</td>
  </tr>
  <tr height="60">
    <td colspan="6">
    <textarea 
    id="remark" 
    name="remark" 
    
    style="width:100%;height:80px;"></textarea></td>
  </tr>
  <caption style=" text-align:center;font-weight:bold;background-color:#99CCFF;height:30px;font-size:24px;">输入题目内容</caption>
</table>