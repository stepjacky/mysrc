function FormValidator(form, userRules, userMessages) {
    
	// alert(typeof form);
	this.formObject = null;
	if(typeof form == "object" ){
		this.formObject=form;
	}else if(typeof form == "string" ){
		this.formObject = document.getElementById(form) || document.getElementsByTagName(form)[0] || document.getElementsByName(form)[0];
	}else{
		throw new TypeError("argument['form'] ether is a string   or a object present a form");
	}
	
	
	this.userRules = userRules;
	this.userMessages = userMessages;
}
FormValidator.prototype = {
	constructor : FormValidator,
	validate : function(debug) {
	    var rules = this.userRules;
	    var vMsg = this.userMessages;
        var formData = this.serialize();
		var nextLine = '\n<br/>';
		var errorNames = [];
		var messages = [];
		var msg = '';
		var dbg = '';
		for ( var i = 0; i < formData.length; i++) {
			var node = formData[i];
			// var thisObj = $('input[name='+node.name+']');
			dbg += node.name + '<br/>';
			var r = rules[node.name];
			// 没有配置验证规则
			if (!r)
				continue;
			var vm = vMsg[node.name];
			var mms = '';
			var nameMsg = "[" + node.name + "]";
			var val = node.value;

			if (r.required && r.required == true && this.isEmptyValue(val)) {
				mms = nameMsg + '需要填写此字段';
				if (vm.required)
					mms = vm.required;
				// thisObj.css('required');

			}
			if (r.equals) {

				var targetName = r.equals;
				var edata = findFieldData(formData, targetName);
				// alert(edata.name+"["+targetName+"]=="+edata.value)
				if (val != edata.value) {
					mms = nameMsg + ' 必须等于 [' + targetName + "]";
					if (vm.equals)
						mms = vm.equals;
				}

			}

			if (r.min) {
				var lin = r.min;
				if (this.strLength(val) < lin) {
					mms = nameMsg + '此字段最小值是:' + lin;
					if (vm.min)
						mms = vm.min + lin + "位";

				}
			}
			if (r.max) {
				var max = r.max;
				if (this.strLength(val) > max) {
					mms = nameMsg + '此字段最小值是:' + max;
					if (vm.max)
						mms = vm.max + max;

				}
			}
			if (r.isNum) {
				var isNum = r.isNum;
				if (isNaN(val)) {
					mms = nameMsg + "此字段必须是数字类型";
					if (vm.isNum)
						mms = vm.isNum;
				}
			}
			if (!this.isEmptyValue(mms)) {
				msg = "<li class='error-message'>" + nameMsg + mms + nextLine
						+ " </li>";
				messages.push(msg);
			}

		}
		for (key in rules) {
			var hasIt = false;
			for ( var i = 0; i < formData.length; i++) {
				var field = formData[i];
				if (key == field.name)
					hasIt = true;

			}
			if (hasIt == false) {
				var msg = "<li class='error-message'>" + "字段:" + key + "必须输入"
						+ nextLine + "</li>";
				if (vMsg[key])
					msg = "<li class='error-message'>" + vMsg[key].required
							+ nextLine + "</li>";
				messages.push(msg);
			}

		}
		if (debug)
			messages.push(dbg);
		
		return messages.length==0?true:messages;

	},// end of main validation
	/**
	 * @author 汉图
	 * @throws TypeError
	 * 
	 */
	findFieldData : function(formData, fieldName) {
		if (fieldName == null) {
			throw new TypeError(
					"function findFieldData accept argument[1] as a string");
		}
		if (!(formData instanceof Array)) {
			throw new TypeError(
					"function findFieldData accept argument[0] as an object array");
		}
		var field = {};
		for ( var i = 0; i < formData.length; i++) {
			var d = formData[i];
			if (d.name == fieldName) {
				field.name = d.name;
				field.value = d.value;
				return field;
			}
		}
		return null;
	},// end of findfieldData method
	strLength : function(str) {
		if (!str) {
			return 0;
		}
		var a = 0; // 预期计数：中文2字节，英文1字节
		var i = 0; // 循环计数
		for (i = 0; i < str.length; i++) {
			if (str.charCodeAt(i) > 255) {
				a += 2;
			} else {
				a++;
			}
		}
		return a;
	},
	isEmptyValue : function(str) {
		// 未定义 , 空串, null值
		if (typeof str == 'undefined' || str == '' || str == null)
			return true;
		else
			return false;
	},
	
	serialize:function(){
		var form = this.formObject;
		var parts = new Array();
		var field = null;
		for(var i=0,len=form.elements.length;i<len;i++){
			field = form.elements[i];
			//如果此表单元素具有禁用属性,那么直接跳过
			if(field.disabled)continue;
			switch(field.type){
			case "select-one":
			case "select-multiple":
				for(var j=0,optLen=field.options.length;j<optLen;j++){
					var option = field.options[j];
					if(option.selected){
						var optValue = '';
						if(option.hasAttribute){
							optValue = option.hasAttribute("value")?option.value:option.text;
						}else{
							optValue = option.attributes["value"].specified?option.value:option.text;
						}
						var eleObj={};
						eleObj.name  = encodeURIComponent(field.name);
						eleObj.value = encodeURIComponent(optValue);
						parts.push(eleObj);
					}
				}//end of for loop
				break;
			case undefined:
			case "file":
			case "submit":
			case "reset":
			case "button":
				break;
			case "radio":
			case "checkbox":
				if(!field.checked){
					break;
				}
				default:
			    var eleObj={};
				eleObj.name  = encodeURIComponent(field.name);
				eleObj.value = encodeURIComponent(field.value);
				parts.push(eleObj);
			}
		}
		return parts;
	}// end of function
};