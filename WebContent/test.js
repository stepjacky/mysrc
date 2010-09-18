$(function(){
    $("form").submit(function(){
    	 var vad = new FormValidator("form",ruls,megs);
         var vadresult = vad.validate();
         if(vadresult==true){
         	alert("验证通过");
         	return true;
         }else if(vadresult instanceof Array) {
         	$("#errorPanel").html(vadresult.join("")).fadeIn("slow");
         }
    	
    	return false;
    });	
	
    
    var ruls = {
    		"name":{"required":true,"min":4,"max":6},
    		"password":{"required":true,"min":6},
    		"password2":{"required":true,"min":6}   
    
    };
    var megs = {
    		"name":{"required":"需要商家名称","min":"商家名称长度不能小于","max":"商家名称长度不能大于"},
    		"password":{"required":"需要密码","min":"密码长度不能小于"},
    		"password2":{"required":"需要确认密码","min":"密码长度不能小于"}
    		
    };

});