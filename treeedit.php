<span>上级分类:</span>
<label id="parentId"></label>
<br />
<hr
	style="height: 1px; color: #0080ff" />
<br />
<fieldset><legend>选择操作</legend> <label>编辑<input type="radio" name="act"
	value="update" /></label> <label>添加<input type="radio" name="act"
	value="add" onclick="$('#ndata').val('')" /></label> <label
	style="color: red; font-weight: bold;">删除<input type="radio" name="act"
	value="delete" onclick="if(confirm('真的要删除吗'))return true;return false;" /></label>
</fieldset>
<br />
<label>分类名称:<input type="text" style="width: 100px" name="nodeData"
	id="ndata" /></label>
<br />
<button id="btnNode"
	onclick="doOprTree(event,catetree,catenode);return false;">保 存</button>
