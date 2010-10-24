<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
$desc = $util->getProperty($entry,'description');
?>
<body>
<div id="wapper">
<form><?php echo $idInput;?>
<table width="600" border="1" align="center">
    <thead>
        <tr>
            <td colspan="2" bgcolor="#fc3">
            <div id="output2" style="width: 100%; height: 100%"></div>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="2" bgcolor="#FFFFCC">添加文章/公告分类</th>
        </tr>
        <tr>
            <td width="141"><span class="prelabel">名称</span></td>
            <td width="443"><input name="name" type="text"
                style="width: 350px;" value="<?php echo $name;?>" /></td>
        </tr>
        <tr>
            <td><span style="height: 105px;"><span class="prelabel">简介</span></span></td>
            <td><span style="height: 105px;"> <textarea
                name="description" id="description"
                style="float: left; height: 100px; width: 250px;"><?php echo $desc;?></textarea>
            </span></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" align="center">
            <button name="saveShopper" id="saveShopper">保存分类</button>
            </td>
        </tr>
    </tfoot>
</table>
</form>
</div>
<script type="text/javascript">
var xaction = "<?php echo $action;?>";
jQuery(document).ready(function($){ 
    
    var options = { 
                "target":        '#output2',   // target element(s) to be updated with server response 
                "url": "../model/artitlecatalog.php", // override for form's 'action' attribute 
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
          "description":{"required":false}
    };
    var vMessages = {
          "name":{
               "required":"名称不能为空",
               "min":"名称长度不能小于",
               "max":"名称长度不能大于"
           }
    } 
    
});


</script>
</body>
</html>
