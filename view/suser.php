<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>your title</title>
</head>
<?php
require_once '../tools/utils.php';
use utils\HtmlUtils;
use data\BaseDao;
$util = new HtmlUtils();
$entry = array();
$idInput = "";
$fileName = basename(__FILE__);
$entryName = $util->getEntryName($fileName);
$dao  =new BaseDao($entryName);
$action = "create";
$id="";
if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action=='update'){
        if(!isset($_GET['id'])){
            echo '{"message":"没有收到主键为Id"}';
            exit(0);
        }
        $id = $_GET['id'];
        $idInput = "<input type=\"hidden\" name=\"username\" value=\"$id\"/>";
        $entry = $dao->getBean($id,"username");
        // $util->logInfo($entry['name']);
        //  $util->logInfo($entry['remark']);
    }
}
$localname = $util->getProperty($entry, "localName");
$password = $util->getProperty($entry,'password');
?>
<body>
<div id="wapper">
<form><?php echo $idInput;?>
<table width="62%" border="1" align="center">
 <thead>
        <tr>
            <td colspan="2" bgcolor="#fc3">
            <div id="output2" style="width: 100%; height: 100%"></div>
            </td>
        </tr>
    </thead>
    <tr bgcolor="#FFFFCC">
        <th colspan="2" scope="col">添加/修改用户</th>
    </tr>
    <tr>
        <td width="43%">用户名</td>
        <td width="57%"><input type="text" name="username" id="username"
            value="<?php echo $id;?>" /></td>
    </tr>
    <tr>
        <td>密码</td>
        <td><input type="password" name="password" id="password"
            value="<?php echo $password;?>" /></td>
    </tr>
    <tr>
        <td>密码确认</td>
        <td><input type="password" name="password2" id="password2" /></td>
    </tr>
    <tr>
        <td>昵称</td>
        <td><input type="text" name="localname" id="localname"
            value="<?php echo $localname;?>" /></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <button id="saveShopper">保存用户</button>
        </td>
    </tr>
</table>
</form>
</div>
<div id="wapper"></div>
<script type="text/javascript">
   jQuery(document).ready(function($){  
	   var xaction = "<?php echo $action;?>";
	   var options = { 
               "target":        '#output2',   // target element(s) to be updated with server response 
               "url": "../model/<?php echo $entryName?>.php", // override for form's 'action' attribute 
               "type":      "post" ,       // 'get' or 'post', override for form's 'method' attribute 
               // "data":{"name":"action","value":"create"},
               "dataType":  "json" ,       // 'xml', 'script', or 'json' (expected server response type) 
               "clearForm": true  ,      // clear all form fields after successful submit 
               "resetForm": true  ,        // reset the form after successful submit 
               "beforeSubmit":  showRequest,  // pre-submit callback 
               "success":       showResponse  // post-submit callback
               
               
    };

    $("form").submit(function(){
        $(this).ajaxSubmit(options); 
        
         // !!! Important !!! 
         // always return false to prevent standard browser submit and page navigation 
         return false; 
              

    });

    function showRequest(formData, jqForm, options) { 
         var errorMsg  = validateForm(formData,rules,vMessages,false);
         if(errorMsg.length==0){
             $("#output2").empty();
             formData.push({"name":"action","value":xaction});
             return true;
         } 
         var errs = '';
         for(var i=0;i<errorMsg.length;i++){
               errs+=errorMsg[i];
         }
         $("#output2").html(errs);
         return false;
    } 
        
       // post-submit callback 
    function showResponse(data, statusText, xhr, $form)  { 
        if(data){
        MochaUI.notification(data.message);
        $("#output2").html(data.message);
        }
    } 

   $("#saveShopper").button();

   var rules = {
         "username":{"required":true,"min":4,"max":20},
         "localname":{"required":true},
         "password":{"required":true,"equals":"password2","min":6},
         "password2":{"required":true,"min":6},
   };
   var vMessages = {
         "username":{
              "required":"名称不能为空",
              "min":"名称长度不能小于",
              "max":"名称长度不能大于"
          },
          "localname":{"required":"需要输入本地用户名"},
          "password":{"required":"需要输入密码","equals":"两次密码输入必须相等","min":"密码至少需要"},
          "password2":{"required":"需要重复密码","min":"密码至少需要"}
   }; 
       
   });
   //other library  like, mootools put here
   
</script>
</body>
</html>
