<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<?php
require_once '../tools/utils.php';
require_once '../tools/jsonutil.php';
use utils\HtmlUtils;
use data\BaseDao;
$util = new HtmlUtils();
$entry = array();
$idInput = "";
$fileName = basename(__FILE__);
$entryName = $util->getEntryName($fileName);
$dao  =new BaseDao($entryName);
$action = "create";
$shopperId=-1;
if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action=='update'){
        if(!isset($_GET['id'])){
            echo '{"message":"没有收到主键为Id"}';
            exit(0);
        }
        $shopperId = $_GET['id'];
        $idInput = "<input type=\"hidden\" name=\"id\" value=\"".$_GET['id']."\"/>";
        $entry = $dao->getBean($_GET['id']);
        //print_r($entry);
        //$util->logInfo($entry['aboutsellers']);
        // $util->logInfo($entry['remark']);
    }
}
$title   = $util->getProperty($entry, "title");
$entities = get_html_translation_table(HTML_ENTITIES);
$trans = array_flip($entities);
$xcontent = strtr($util->getProperty($entry, "content"),$trans);
$from_title = $util->getProperty($entry, "from_title");
$from_link = $util->getProperty($entry, "from_link");
$sellers = $util->getProperty($entry, "aboutSellers");
?>
<body>
<div id="wapper">
<form><?php echo $idInput;?>

<table width="100%" border="1" align="center">
    <tr>
        <td colspan="2">
        <div id="output2"  style="width: 100%; height: 100%; background-color: #fc3;">
        </div>
        </td>
    </tr>
    <tr>
        <th colspan="2" bgcolor="#FFFFCC">添加主页文章</th>
    </tr>
    <tr>
        <td width="200">标题</td>
        <td><input name="title" type="text" style="width: 500px;"
            id="title" value="<?php echo $title;?>" /></td>
    </tr>
    <tr>
        <td><span style="height: 105px;"><span class="prelabel">相关商家</span></span></td>
        <td>
        <dd>多个商家名称用半角逗号隔开</dd>
        <textarea name="aboutSellers" id="aboutsellers" style="width:400px;height:150px;"
           ><?php echo $sellers;?></textarea></td>
    </tr>
    <tr>
        <td>来源</td>
        <td>[标题]<input type="text" name="from_title" id="from_title"
            style="width: 200px" value="<?php echo $from_title;?>" />
        -[链接URL] <input type="text" name="from_link" id="from_link"
            style="width: 300px" value="<?php echo $from_link;?>" /></td>
    </tr>
    <tr>
        <td>文章类型</td>
        <td><select name="artitleCatalog_id" id="artitleCatalog_id">
        </select></td>
    </tr>
    <tr>
        <td>内容</td>
        <td><?php
        $sBasePath = "../fckeditor/";
        $oFCKeditor = new FCKeditor("content") ;
        $oFCKeditor->BasePath	= $sBasePath ;
        $oFCKeditor->Height = 500;
        //$oFCKeditor->Width = 400;
        $oFCKeditor->Value	= $xcontent;
        $oFCKeditor->Create() ;
        ?></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <button id="saveShopper">保存文章</button>
         <button id="preView">预览文章</button>
        </td>
    </tr>
</table>
</form>
</div>
<script type="text/javascript">
   jQuery.noConflict();  
   jQuery(document).ready(function($){  
	   var xaction = "<?php echo $action;?>" ;
	   var entryName = "<?php echo $entryName;?>";
	   var url = "../model/"+entryName+".php";
       var artilecatalogs = $("select[id=artitleCatalog_id]");
       var options =  {
	              "data":"action=list&actionparam=all",
	              "onSuccess": function(json, responseXML){
	    	           // MochaUI.notification(json);
	                    var shoppers = json.rows;
	                    for(var i=0;i<shoppers.length;i++){                       
	                        var opt = jQuery('<option></option>');
	                        opt.text(shoppers[i].name);
	                        opt.val(shoppers[i].id);                      
	                        artilecatalogs.append(opt); 
	                    }
	                    artilecatalogs.multiSelect({
	                       "multiple": false,
	             		   "checkAllText": '全选',
	             		   "unCheckAllText": '全不选',
	             		   "noneSelectedText" :'请选择文章分类',
	             		   "show":"blind",
	             		   "hide":"blind",
	             		   "selectedText":"#/# 已选择"
                        
	                       // "position":"middle"
	             		                       
	             		   
	             	   });
	              },
	              "onFailure":function(xhr){
	                   alert("发送错误:"+xhr.responseText);
	              }
	              
	              
	      }; 
          var myRequest = new Request.JSON(options);
	      myRequest.post("../model/artitlecatalog.php");   
         options = { 
                   "target":        '#output2',   // target element(s) to be updated with server response 
                   "url": url, // override for form's 'action' attribute 
                   "type":      "post" ,       // 'get' or 'post', override for form's 'method' attribute 
                   // "data":{"name":"action","value":"create"},
                   "dataType":  "json" ,       // 'xml', 'script', or 'json' (expected server response type) 
                   //"clearForm": true  ,      // clear all form fields after successful submit 
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

            var cnt = getEditorHTMLContents("content");
            var xcont = {"name":"content","value":cnt};
          
            var errorMsg  = validateForm(formData,rules,vMessages,false);
             if(errorMsg.length==0){
                 $("#output2").empty();
                 formData.push({"name":"action","value":xaction});
                 formData.push(xcont);
                 $("#saveShopper").button( "option", "disabled", true);
                 $("#saveShopper").button( "option", "label", "正在保存.....");
                 return true;
             } 
             var errs = '';
             for(var i=0;i<errorMsg.length;i++){
                   errs+=errorMsg[i];
             }
             notify(errorMsg[0]);
             $("#output2").html(errs);
             return false;
        } 
            
           // post-submit callback 
        function showResponse(data, statusText, xhr, $form)  { 
            if(data){
            	notify(data.message);
            	$("#saveShopper").button( "option", "disabled", false);
            	$("#saveShopper").button( "option", "label", "保存文章");
                $("#output2").html(data.message);
            }
        } 
        /**验证规则和消息定义*/
        var rules = {
     		   "title":{"required":true,"min":5,"max":200},
     	     
        };
        var vMessages = {
     		   "title":{"required":"需要文章名称","min":"文章名称长度不能小于","max":"文章名称长度不能大于"},
        }; 

          
       $("#saveShopper").button();  


       jQuery("#preView").click(function(){
    	   var cnt = getEditorHTMLContents("content");
           preViewWindow(cnt);
           return false;
       }).button();

       var preViewWindow = function(cont){
    	    new MochaUI.Window({
    	        id: 'preViewWindow',
    	        title: '内容预览',
    	        // loadMethod: 'xhr',
    	        content: cont,
    	        width: 800,
    	        height: 500
    	    });
    	}  
   });

</script>
</body>
</html>
