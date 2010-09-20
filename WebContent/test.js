$(function() {
	$("form").submit(function() {
		try {
			var vad = new FormValidator({
				"form" : "form",
				"rule" : ruls,
				"message" : megs,
				"errorContainor" : "errorPanel",
				"autoSubmit":true,
				"success" : function() {
					alert("验证通过");
				},
				"failure" : function() {
					alert("表单验证失败");
				}

			}).validate();
		} catch (e) {
			alert(e.message);
		}

		return false;
	});

	var ruls = {
		"name" : {
			"required" : true,
			"min" : 4,
			"max" : 6
		},
		"password" : {
			"required" : true,
			"min" : 6
		},
		"password2" : {
			"required" : true,
			"min" : 6
		}

	};
	var megs = {
		"name" : {
			"required" : "需要商家名称",
			"min" : "商家名称长度不能小于",
			"max" : "商家名称长度不能大于"
		},
		"password" : {
			"required" : "需要密码",
			"min" : "密码长度不能小于"
		},
		"password2" : {
			"required" : "需要确认密码",
			"min" : "密码长度不能小于"
		}

	};

});