// JavaScript template using Windows Script Host
function message(msg) {
	$("#dialog").empty();
	$("#dialog").append(msg);
	$("#dialog").dialog("open");

}

function dumpObj(obj) {
	var msg = '';
	for (key in obj) {
		msg += "<b style='color:red'>" + key
				+ "</b><b style='color:red'>==></b>" + obj[key] + "<br/>";

	}
	return msg;
}
function dumpText(obj) {
	var msg = '';
	for (key in obj) {
		msg += key + "  ==>   " + obj[key] + "\n";

	}
	return msg;
}
// 获取fckeditor 中的内容 的html形式
function getEditorHTMLContents(EditorName) {
	var oEditor = FCKeditorAPI.GetInstance(EditorName);
	return (oEditor.GetXHTML(true));
}
// 获取编辑器中文字内容
function getEditorTextContents(EditorName) {
	var oEditor = FCKeditorAPI.GetInstance(EditorName);
	return (oEditor.EditorDocument.body.innerText);
}
// 设置编辑器中内容
function SetEditorContents(EditorName, ContentStr) {
	var oEditor = FCKeditorAPI.GetInstance(EditorName);
	oEditor.SetHTML(ContentStr);
}

// JavaScript Document

// 加入收藏夹
function addFavorite(url, title) {
	if (document.all) {
		window.external.addFavorite(url, title);
	} else if (window.sidebar) {
		window.sidebar.addPanel(title, url, "");
	}
}

// 设置首页
function setHomepage() {
	if (document.all) {
		document.body.style.behavior = 'url(#default#homepage)';
		document.body.setHomePage(url);
	} else if (window.sidebar) {
		if (window.netscape) {
			try {
				netscape.security.PrivilegeManager
						.enablePrivilege("UniversalXPConnect");
			} catch (e) {
				alert("该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项"
						+ "signed.applets.codebase_principal_support 值该为true");
			}
		}
		var prefs = Components.classes['@mozilla.org/preferences-service;1']
				.getService

				(Components.interfaces.nsIPrefBranch);
		prefs.setCharPref('browser.startup.homepage', url);
	}
}
// 获得事件函数
function getEvent() { // 同时兼容ie和ff的写法
	if (document.all)
		return window.event;
	func = getEvent.caller;
	while (func != null) {
		var arg0 = func.arguments[0];
		if (arg0) {
			if ((arg0.constructor == Event || arg0.constructor == MouseEvent)
					|| (typeof(arg0) == "object" && arg0.preventDefault && arg0.stopPropagation)) {
				return arg0;
			}
		}
		func = func.caller;
	}
	return null;
}
// 添加事件工具函数
function addEvent(el, type, handle) {
	if (el.addEventListener) {// for standard browses
		el.addEventListener(type, handle, false);
	} else if (el.attachEvent) {// for IE
		el.attachEvent("on" + event, handle);
	} else {// other
		el["on" + type] = handle;
	}

}
function fetchSelectvars(){
   var evt = getEvent();
   var element = evt.srcElement || evt.target;
   return element.options[element.selectedIndex];
}

function getEventTarget() {
	var evt = getEvent();
	var element = evt.srcElement || evt.target;
	return element;
}
function isIE() {
	return navigator.appName.indexOf("Microsoft Internet Explorer") != -1
			&& document.all;
}
function isIE6() {
	return navigator.userAgent.split(";")[1].toLowerCase().indexOf("msie 6.0") == "-1"
			? false
			: true;
}
function isIE7() {
	return navigator.userAgent.split(";")[1].toLowerCase().indexOf("msie 7.0") == "-1"
			? false
			: true;
}
function isIE8() {
	return navigator.userAgent.split(";")[1].toLowerCase().indexOf("msie 8.0") == "-1"
			? false
			: true;
}
function isNN() {
	return navigator.userAgent.indexOf("Netscape") != -1;
}
function isOpera() {
	return navigator.appName.indexOf("Opera") != -1;
}
function isFF() {
	return navigator.userAgent.indexOf("Firefox") != -1;
}
function isChrome() {
	return navigator.userAgent.indexOf("Chrome") > -1;
}
function hackAllCss() {
	/**
	 * 
	 * 头部添加
	 * 
	 * <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 * "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html
	 * xmlns="http://www.w3.org/1999/xhtml">
	 * 
	 * 
	 * 
	 * 
	 */

}
function judgeNumber(obj){

	if(isNaN(obj.value)){
	   //	alert(isNaN(obj.value));
	   obj.value = '';
	}

}
function functionValid(funcName) {
	try {
		if (typeof(eval(funcName)) == "function") {
			return true;
		} else {
			return false;
		}
	} catch (e) {
		return false;
	}
}

// @arr1 第一个数组
// @arr2 第二个数组
function insect(arr1, arr2) {
	if (!arr1 || !arr2) {
		alert("请输入正确的数组变量!");
		return false;
	}
	if (arr1.length != arr2.length)
		return false;

	var ft = true;
	$.each(arr1, function(i, n) {
				// alert(n + ' in arr2= '+arr2 + $.inArray(n,arr2));
				if ($.inArray(n, arr2) == -1) {
					ft = false;

				}
			});
	$.each(arr2, function(i, n) {
				// alert(n + ' in arr1= '+arr1 + $.inArray(n,arr1));
				if ($.inArray(n, arr1) == -1) {
					ft = false;

				}
			});
	return ft;
}

Date.prototype.format = function(format) // author: meizz
{
	var o = {
		"M+" : this.getMonth() + 1, // month
		"d+" : this.getDate(), // day
		"h+" : this.getHours(), // hour
		"m+" : this.getMinutes(), // minute
		"s+" : this.getSeconds(), // second
		"q+" : Math.floor((this.getMonth() + 3) / 3), // quarter
		"S" : this.getMilliseconds()
		// millisecond
	}
	if (/(y+)/.test(format))
		format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4
						- RegExp.$1.length));
	for (var k in o)
		if (new RegExp("(" + k + ")").test(format))
			format = format.replace(RegExp.$1, RegExp.$1.length == 1
							? o[k]
							: ("00" + o[k]).substr(("" + o[k]).length));
	return format;
}
Math.trunc=function(a,b){
	if(b==0)return 0;
    return Math.floor(a/b);
}