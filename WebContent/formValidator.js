function FormValidator(formData, userRules, userMessages) {
	this.formData = formData;
	this.userRules = userRules;
	this.userMessages = userMessages;
}
FormValidator.prototype = {
	constructor : FormValidator,
	validate : function() {
		var nextLine = '\n<br/>';
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

			if (r.required && r.required == true && isEmptyValue(val)) {
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
				if (strLength(val) < lin) {
					mms = nameMsg + '此字段最小值是:' + lin;
					if (vm.min)
						mms = vm.min + lin + "位";

				}
			}
			if (r.max) {
				var max = r.max;
				if (strLength(val) > max) {
					mms = nameMsg + '此字段最小值是:' + max;
					if (vm.max)
						mms = vm.max + max;

				}
			}
			if (r.isNum) {
				var isNum = r.isNum;
				if (!judgeNumber(val)) {
					mms = nameMsg + "此字段必须是数字类型";
					if (vm.isNum)
						mms = vm.isNum;
				}
			}
			if (!isEmptyValue(mms)) {
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
		return messages;

	}
};