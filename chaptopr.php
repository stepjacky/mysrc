 <span>上级分类:</span><label id="cparentId" style="color:red:font-size:15px;font-weight:bold;"></label>
		<hr style="height:1px;color : #0080ff"/><br/>
<p>
	    <fieldset>
	    		<p>
     		<legend>选择操作</legend>
   　		<label>编辑<input type="radio" name="cact" value="update" /></label>
   　		<label>添加<input type="radio" name="cact" value="add" onclick="$('#cndata').val('')" /></label>
   　		<label style="color:red;font-weight:bold;">
   　		           删除<input type="radio" name="cact" value="delete" onclick="if(confirm('真的要删除吗'))return true;return false;" />
   　		</label>
   　		</p>
   	   </fieldset>	
</p>
			<br/>
<label>分类名称:<input type="text" name="nodeData" id="cndata" style="font-weight:bold;width:300px;height:20px;background-color:#87ceeb;border:1px solid #000000;font-size:15px" /></label><br/>
<br/>
<br/>
<button onclick="doOprChapterTree(event,cpttree,cptnode);return false;"> 保 存 </button>	