function FormValidator(cfg) {
	// form, userRules, userMessages,ePanel
	if (!cfg.form || !cfg.rule || !cfg.message) {
		throw new Error("no enough arguments");
	}
	this.config = cfg;
	this.autoSubmit = cfg.autoSubmit;
	this.formObject = null;
	if (typeof cfg.form == "object") {
		this.formObject = cfg.form;
	} else if (typeof cfg.form == "string") {
		this.formObject = document.getElementById(cfg.form)
				|| document.getElementsByTagName(cfg.form)[0]
				|| document.getElementsByName(cfg.form)[0];
	} else {
		throw new TypeError(
				"argument['cfg.form'] ether is a string[id]  or a object present a form");
	}

	this.errorPanel = null;
	if (typeof cfg.errorContainor == "object") {
		this.errorPanel = cfg.errorContainor;
	} else if (typeof cfg.errorContainor == "string") {
		this.errorPanel = document.getElementById(cfg.errorContainor)
				|| document.getElementsByName(cfg.errorContainor)[0];
	} else {
		throw new TypeError(
				"argument['cfg.errorContainor'] ether is a string[id] or a object present the container");
	}

	this.userRules = cfg.rule;
	this.userMessages = cfg.message;
}
FormValidator.prototype = {
	constructor : FormValidator,
	validate : function() {
		var rules = this.userRules;
		var vMsg = this.userMessages;
		var formData = this.serialize();
		var nextLine = '\n<br/>';
		var errorNames = [];
		var restNames = [];
		var messages = [];
		var msg = '';
		for ( var i = 0; i < formData.length; i++) {
			var node = formData[i];
			// var thisObj = $('input[name='+node.name+']');
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

			}
			if (r.equals) {

				var targetName = r.equals;
				var edata = findFieldData(formData, targetName);
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
				errorNames.push(node.name);
			} else{
				restNames.push(node.name);
			}

		}// end of for loop

		/*
		 * for (key in rules) { var hasIt = false; for ( var i = 0; i <
		 * formData.length; i++) { var field = formData[i]; if (key ==
		 * field.name) hasIt = true;
		 *  } if (hasIt == false) { var msg = "<li class='error-message'>" +
		 * "字段:" + key + "必须输入" + nextLine + "</li>"; if (vMsg[key]) msg = "<li class='error-message'>" +
		 * vMsg[key].required + nextLine + "</li>";
		 * 
		 * messages.push(msg); }
		 *  }
		 */
		var result = messages.length == 0 ? true : false;
		if (result) {
			if (this.config.success) {
				this.config.success();
				if (this.autoSubmit)
					this.formObject.submit();
			}
		} else {
			if (this.config.failure) {
				if (this.errorPanel)
					this.errorPanel.innerHTML = messages.join(" ");
				this.config.failure(messages);
				// alert(errorNames.length);
				(function() {
					for (var idx in errorNames) {
                        var name = errorNames[idx];
						var es = document.getElementsByName(name);
						var e;
						if(es)e = es[0];
						e.className=e.className+" validate-error";
                        //alert(e.className);
					}
					for(idx in restNames){
						name = restNames[idx];
						es = document.getElementsByName(name);
						if(es)e = es[0];
						var cnames = e.className.split(/\s*/i);
						for(var i in cnames){
							if(cnames[i]=='validate-error'){
								cnames.splice(i, 1);
							}
						}
						e.className = cnames.join(" ");
					}
				})();

			}
		}

	},// end of main validation
	/**
	 * @author 汉图
	 * @throws TypeError
	 * @param formData
	 *            表单数组
	 * @param fieldName
	 *            要获取的name属性
	 * @return 返回null或者表单元素对象
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

	serialize : function() {
		var form = this.formObject;
		var parts = new Array();
		var field = null;
		for ( var i = 0, len = form.elements.length; i < len; i++) {
			field = form.elements[i];
			// 如果此表单元素具有禁用属性,那么直接跳过
			if (field.disabled)
				continue;
			switch (field.type) {
			case "select-one":
			case "select-multiple":
				for ( var j = 0, optLen = field.options.length; j < optLen; j++) {
					var option = field.options[j];
					if (option.selected) {
						var optValue = '';
						if (option.hasAttribute) {
							optValue = option.hasAttribute("value") ? option.value
									: option.text;
						} else {
							optValue = option.attributes["value"].specified ? option.value
									: option.text;
						}
						var eleObj = {};
						eleObj.name = encodeURIComponent(field.name);
						eleObj.value = encodeURIComponent(optValue);
						parts.push(eleObj);
					}
				}// end of for loop
				break;
			case undefined:
			case "file":
			case "submit":
			case "reset":
			case "button":
				break;
			case "radio":
			case "checkbox":
				if (!field.checked) {
					break;
				}
			default:
				var eleObj = {};
				eleObj.name = encodeURIComponent(field.name);
				eleObj.value = encodeURIComponent(field.value);
				parts.push(eleObj);
			}
		}
		return parts;
	}// end of function
};