$(function() {

	$("#sbtn").click(function() {
		try {
			$("form").formProceed( {
				"rules" : ruls,
				"messages" : megs,
				"errorContainor" : "errorPanel",
				"autoSubmit" : true,
				"url" : "test.php",
				"type" : "post",
				"success" : function() {
					alert("验证通过");
				},
				"failure" : function() {
					alert("表单验证失败");
				},
				"beforeSubimt" : function() {
					alert("准备发送");
				},
				"submitSuccess" : function(data) {
					alert(data.message);
				},
				"submitFailure" : function(data) {
					alert("处理错误");
				}

			});

		} catch (ex) {
			alert(ex.message);
		}

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