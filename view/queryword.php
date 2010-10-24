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
$word = $util->getProperty($entry, "word");
?>
<body><div id="wapper">
<form><?php echo $idInput;?>
<table width="532" border="1" align="center">
 <thead>
        <tr>
            <td colspan="2" bgcolor="#fc3">
            <div id="output2" style="width: 100%; height: 100%"></div>
            </td>
        </tr>
    </thead>
  <tr>
    <th colspan="2" bgcolor="#FFFFCC">添加关键字</th>
    </tr>
  <tr>
    <td width="141"><span style="height:105px;"><span class="prelabel">关键词</span></span></td>
    <td width="324">
  <dd>多个关键字,用半角逗号分隔.</dd>
    <textarea name="word" id="word" style="float:left; height:150px; width:350px;"><?php echo $word;?></textarea>
   </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><button name="saveShopper" id="saveShopper">保存关键词</button></td>
  </tr>
  </table>
  </form>
  </div>
  
<script type="text/javascript">
var xaction = "<?php echo $action;?>";
jQuery(document).ready(function($){ 
    
    var options = { 
                "target":        '#output2',   // target element(s) to be updated with server response 
                "url": "../model/<?php echo $entryName;?>.php", // override for form's 'action' attribute 
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

   

    var rules = {
          "word":{"required":true},
    };
    var vMessages = {
          "word":{
               "required":"需要填写关键字",
           }
    }; 
    $("#saveShopper").button();
});


</script>
</body>
</html>