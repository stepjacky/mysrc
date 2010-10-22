<?echo <<<ACC
<div id="accordion" style="margin: 0; padding: 0;">
	<h3  onclick="fireaccordion('catelog')"><a href="#">题目管理</a></h3>
	<div class="ui-widget-content" style="height:360px;margin: 0; padding: 0;">
		<div id="catelog">
	     </div>
	</div>
	<h3  onclick="fireaccordion('qbank')"><a href="#">我的题库</a></h3>
	<div class="ui-widget-content" style="margin: 0; padding: 0;">
		<div id="qst_chapter"></div>
	</div>
	<h3 onclick="fireaccordion('member')"><a href="#">人员管理</a></h3>
	<div class="ui-widget-content" style="margin: 0; padding: 0;">
		
	</div>
	<h3 onclick="fireaccordion('sys')"><a href="#">系统管理</a></h3>
	<div class="ui-widget-content" style="margin: 0; padding: 0;">
		
	</div>
</div>
ACC;
?>