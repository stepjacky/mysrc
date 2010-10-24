<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
body {
    font: 12px Helvetical, Arial, sans-serif;
    padding-bottom: 200px
}

#wapper {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    font-style: normal;
    line-height: normal;
    font-weight: normal;
    font-variant: normal;
    color: #000;
    width: 1024px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 0px;
}

.peflabel {
    height: 20px;
    width: 50px;
    line-height: 18px;
    background-color: #CCC;
    text-align: right;
}

.text-field {
    height: 20px;
    font-size: 18px;
    width: 350px;
    float: left;
    margin-top: 10px;
}
</style>
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
if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action=='update'){
        if(!isset($_GET['id'])){
            echo '{"message":"没有收到主键为Id"}';
            exit(0);
        }
        $idInput = "<input type=\"hidden\" name=\"id\" value=\"".$_GET['id']."\"/>";
        $entry = $dao->getBean($_GET['id']);
        // $util->logInfo($entry['name']);
        //  $util->logInfo($entry['remark']);
    }
}

$name = $util->getProperty($entry, "name");
$remark = $util->getProperty($entry,'remark');
$util->logInfo($name);
$util->logInfo($remark);

?>
<body>
<div id="wapper">
<form><?php echo $idInput;?>
<table width="600" border="1" align="center">
    <tr>
        <td colspan="2" bgcolor="#fc3">
        <div id="output2" style="width: 100%; height: 100%"></div>
        </td>
    </tr>
    <tr>
        <th colspan="2" bgcolor="#FFFFCC">添加菜系</th>
    </tr>
    <tr>
        <td width="141"><span class="prelabel">名称</span></td>
        <td width="443"><input name="name" type="text"
            style="width: 350px;" value="<?php echo $name; ?>" /></td>
    </tr>
    <tr>
        <td><span style="height: 105px;"><span class="prelabel">简介</span></span></td>
        <td><span style="height: 105px;"> <textarea name="remark"
            id="remark"
            style="float: left; height: 100px; width: 250px;"><?php echo $remark;?></textarea>
        </span></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <button name="saveShopper" id="saveShopper">保存菜系</button>
        </td>
    </tr>
</table>
</form>
</div>

<script type="text/javascript">
var xaction = "<?php echo $action;?>";
var entryName = "<?php echo $entryName;?>";
var url = "../model/"+entryName+".php";
jQuery(document).ready(function($){ 
    
    var options = { 
                "target":        '#output2',   // target element(s) to be updated with server response 
                "url": url, // override for form's 'action' attribute 
                "type":      "post" ,       // 'get' or 'post', override for form's 'method' attribute 
                // "data":{"name":"action","value":"create"},
                "dataType":  "json" ,       // 'xml', 'script', or 'json' (expected server response type) 
                "clearForm": true  ,      // clear all form fields after successful submit 
                "resetForm": true  ,        // reset the form after successful submit 
                "beforeSubmit":  showRequest,  // pre-submit callback 
                "success":       showResponse,  // post-submit callback
                
                
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
          "name":{"required":true,"min":4,"max":20},
          "remark":{"required":false}
    };
    var vMessages = {
          "name":{
               "required":"名称不能为空",
               "min":"长度不能小于",
               "max":"长度不能大于"
           }
    } 
    
});

</script>
</body>
</html>
