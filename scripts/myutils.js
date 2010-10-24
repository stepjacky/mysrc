// JavaScript template using Windows Script Host
function message(msg) {
	$("#dialog").empty();
	$("#dialog").append(msg);
	$("#dialog").dialog("open");

}
function notify(msg){
	MochaUI.notification(msg);
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
function setEditorContents(EditorName, ContentStr) {
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

function browserType(){
	 var Sys = {};
     var ua = navigator.userAgent.toLowerCase();
     var s;
     (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
     (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
     (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
     (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
     (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;

     /**
     if (Sys.ie) document.write('IE: ' + Sys.ie);
     if (Sys.firefox) document.write('Firefox: ' + Sys.firefox);
     if (Sys.chrome) document.write('Chrome: ' + Sys.chrome);
     if (Sys.opera) document.write('Opera: ' + Sys.opera);
     if (Sys.safari) document.write('Safari: ' + Sys.safari);
	*/
     return Sys;
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



function judgeNumber(s){
     if (s!=null && s!="")
	    {
	      return !isNaN(s);
	    }
	    return false;

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
/**
 * 表单验证
 * @param formData 表单数据数组
 * @param rules 验证规则
 * @param 验证消息
 * */
function validateForm(formData,rules,vMsg,debug){
	var nextLine = '\n<br/>';
	var messages = [];
	var msg='';
	var dbg = '';
	for(var i=0;i<formData.length;i++){
		 var node = formData[i];
		 //var thisObj = $('input[name='+node.name+']');
		 dbg+=node.name+'<br/>';
		 var r  = rules[node.name];
		 //没有配置验证规则
		 if(!r)continue;
		 var vm = vMsg[node.name];
		 var mms ='';
		 var nameMsg = "["+node.name+"]";
		 var val = node.value;
		 
			if(r.required && r.required==true && isEmptyValue(val)){
			    mms = nameMsg+'需要填写此字段';
			    if(vm.required)mms = vm.required;
			    //thisObj.css('required');
				
			}
			if(r.equals){
				
				var targetName     = r.equals;
				var edata = findFieldData(formData,targetName);
				//alert(edata.name+"["+targetName+"]=="+edata.value)
				if(val!=edata.value){
					mms = nameMsg +' 必须等于 ['+targetName+"]";
					if(vm.equals)mms = vm.equals;
				}
				
			}
			
			
			if(r.min){
				var lin = r.min;
				if(strLength(val)<lin){
					mms = nameMsg+'此字段最小值是:'+lin;
				    if(vm.min)mms = vm.min+lin+"位";
					  
				}
			}
			if(r.max){
			    var max = r.max;
			    if(strLength(val)>max){
			    	mms = nameMsg+'此字段最小值是:'+max;
				    if(vm.max)mms = vm.max+max;
					  
				}
			}
			if(r.isNum){
				var isNum = r.isNum;
				if(!judgeNumber(val)){
					mms = nameMsg+"此字段必须是数字类型";
					if(vm.isNum)mms = vm.isNum;
				}
			}
			if(!isEmptyValue(mms)){
				msg = "<li class='error-message'>"+ nameMsg+ mms +nextLine+" </li>";
				messages.push(msg);	
	        }
		
	}
	for(key in rules){
		var hasIt = false;
		for(var i=0;i<formData.length;i++){
		    var field = formData[i];
		    if(key==field.name)hasIt=true;
		
		}
		if(hasIt==false){
			var msg = "<li class='error-message'>"+"字段:"+key+"必须输入"+nextLine+"</li>";
			if(vMsg[key])msg ="<li class='error-message'>"+ vMsg[key].required+nextLine+"</li>";
			messages.push(msg);
		}
		
	}
	if(debug)messages.push(dbg);
	return messages;
}

function findFieldData(formData,fieldName){
	var field= {}; 
	for(var i=0;i<formData.length;i++){
		 var d = formData[i];
		 if(d.name==fieldName){
			field.name=d.name;
			field.value=d.value;
			return field;
		 }
	}
	
	return null;
	
}


function isEmptyValue(v){
	if(typeof v=='undefined' || v=='' || v==null)
		return true;
	else 
		return false;
}

function strLength(str){
    if(!str) { return 0; }
    var a = 0; //预期计数：中文2字节，英文1字节
    var i = 0; //循环计数
    for (i=0;i<str.length;i++){
       if (str.charCodeAt(i)>255){
           a+=2;
        }
        else{
           a++;
        }
    }
    return a; 
    
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
function showGrowl(msg){
	jQuery.jGrowl.defaults.position="center";
	jQuery.jGrowl.defaults.speed="fast";
    var jopt = {};
    jopt.life=2000;
    jQuery.jGrowl(msg,jopt);
	
}
function block(je,msg){
    je.block({ 
	   css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff'
       
       },
       message:msg || "正在加载 , 请等待..." 
   }); 

}
function unblock(je){
   je.unblock(); 

}