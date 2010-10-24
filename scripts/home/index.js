var $ = function(id) {
	return document.getElementById(id);
}
function SwitchNews(obj, num, sum, class1, class2) {
	ClearNews(obj, sum, class1, class2);
	$("tag" + obj + num).className = class1;
	$(obj + num).style.display = "";
}

function ClearNews(name, num, class1, class2) {
	for (i = 1; i <= num; i++) {
		var tag = $("tag" + name + i).className;
		if (tag == class1) {
			$("tag" + name + i).className = class2;
			$(name + i).style.display = "none";
		}
	}
}