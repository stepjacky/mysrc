<?php require_once "included/database.php";?>
<link rel="stylesheet"
	type="text/css" media="screen" href="styles/chapter.css" />
<script
	src="scripts/chapter.js" type="text/javascript"></script>
<div class="main" style="padding: 0px; margin: 0">
<div class="col-1">
<div
	style="position: absoulute; top: 1px;height: 50px; width: 100%">

<table align="align" border="0">
	<tr>
		<td><select id="grade_subjects">
			<option value="-1">请选择学科</option>
		</select></td>
		
		<td>
		<?php 
		  echo makeSelect("bversion","select id,name from bookversion");
		?>
		</td>
		<td>
		<select id="semester">
			<option value="u">上学期</option>
			<option value="d">下学期</option>
		</select>
		</td>
	</tr>
	<tr>
	<td>
		<button id="sortchapt" onclick="sortedChapter()">排序</button>
	</td>
	</tr>
</table>
</div>
<div id='chapters' style="margin-top:20px;"></div>
</div>
<div id="chapterPanel" class="col-2"></div>
<div class="clear-float-chapt"></div>
</div>