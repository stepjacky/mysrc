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
        // $util->logInfo($entry['name']);
        // $util->logInfo($entry['remark']);
    }
}

$name = $util->getProperty($entry, "name");
$master = $util->getProperty($entry,"master");
$contains = $util->getProperty($entry,"contains");
$introduction = $util->getProperty($entry, "introduction");
$shopImage = $util->getProperty($entry, "shopImage");
$pcc_min = $util->getProperty($entry, "pcc_min");
$pcc_max = $util->getProperty($entry, "pcc_max");
$worktime = $util->getProperty($entry, "worktime");
$state = $util->getProperty($entry, "state");
$feature = $util->getProperty($entry, "feature");
$environment = $util->getProperty($entry, "environment");
$phone = $util->getProperty($entry, "phone");
$address = $util->getProperty($entry, "address");
$sectionabout = $util->getProperty($entry, "sectionabout");
$buildingabout = $util->getProperty($entry, "buildingabout");
$buslines = $util->getProperty($entry, "buslines");
$carport = $util->getProperty($entry, "carport");
$ledge = $util->getProperty($entry, "ledge");
$swiping_card = $util->getProperty($entry, "swiping_card");
$take_out = $util->getProperty($entry, "take_out");
$souper = $util->getProperty($entry, "souper");
$wireless = $util->getProperty($entry, "wireless");
$memberSupported = $util->getProperty($entry, "memberSupported");
$type = $util->getProperty($entry, "type");// type id;
$longitude =$util->getProperty($entry, "longitude");
$lantitude =$util->getProperty($entry, "lantitude");

$SQL = "select c.id,c.name from shopper_has_cookstyle shc right join cookstyle c on shc.cookstyle_id=c.id
        where shc.shopper_id=$shopperId";
$cookstyles = array();
$cresult = $dao->query($SQL);
while($crow= mysql_fetch_assoc($cresult)){
    array_push($cookstyles, $crow);
}
$cookstyleJson = jsonEncode($cookstyles);

?>
<body>
<div id="wapper">
<form>
<?php echo $idInput;?>
<table width="600" border="1" align="center">
    <tr>
        <td colspan="2">
        <div id="output2"
            style="width: 100%; height: 100%; background-color: #fc3;"></div>
        </td>
    </tr>
    <tr>
        <th colspan="2" bgcolor="#FFFFCC">添加商家</th>
    </tr>
    <tr>
        <td width="141"><span class="prelabel">店主</span></td>
        <td width="443"><input name="master" type="text"
            style="width: 350px;" value="<?php echo $master;?>" /></td>
    </tr>
    <tr>
        <td width="141"><span class="prelabel">名称</span></td>
        <td width="443"><input name="name" type="text"
            style="width: 350px;"  value="<?php echo $name;?>" /></td>
    </tr>
    <tr>
        <td width="141"><span class="prelabel">容纳人数</span></td>
        <td width="443"><input name="contains" type="text"
            style="width: 350px;"  value="<?php echo $contains;?>" /></td>
    </tr>
    <tr>
        <td width="141"><span class="prelabel">地理位置</span></td>
        <td width="443"><button id="poisition"></button> 
            <label id="pos"></label>
            </td>
    </tr>
    <tr>
        <td><span style="height: 105px;"><span class="prelabel">简介</span></span></td>
        <td><span style="height: 105px;"> <textarea name="introduction"
            id="introduction"
            style="float: left; height: 100px; width: 250px;"><?php echo $introduction;?></textarea>
        </span></td>
    </tr>
    <tr>
        <td><span style="height: 105px;"><span class="prelabel">图片</span></span></td>
        <td>
        <input type="hidden" id="shopImg" name="shopImage" value="<?php echo $shopImage;?>" />
        <label id="shopImgText"><?php echo $shopImage;?></label>
            
        <button id="selImg">上传图片</button>
        <button id="setImg">选择图片</button>
        <button id="showImg">查看图片</button>
        </td>
    </tr>
    <tr>
        <td><span class="prelabel">人均消费</span></td>
        <td><input name="pcc_min" type="text" size="10" value="<?php echo $pcc_min;?>" /> - <input
            name="pcc_max" type="text" size="10" value="<?php echo $pcc_max;?>" /></td>
    </tr>
    <tr>
        <td><span class="prelabel">营业时间</span></td>
        <td><input name="worktime" type="text" value="<?php echo $worktime;?>"/></td>
    </tr>
    <tr>
        <td><span class="prelabel">拥有菜系</span></td>
        <td><select name="cookstyle" style="width: 200px;">
        </select></td>
    </tr>
    <tr>
        <td><span class="prelabel">类型</span></td>
        <td>
        <select name="type" id="type"></select></td>
    </tr>
    <tr>
        <td><span class="prelabel">店面状态</span></td>
        <td><select name="state" id="state">
            <option value="open">正常营业</option>
            <option value="new">新开张</option>
            <option value="closed">已关闭</option>
        </select></td>
    </tr>
    <tr>
        <td><span class="prelabel">特色推荐</span></td>
        <td><textarea name="feature" id="feature"  style="float: left; height: 100px; width: 250px;" ><?php echo $feature;?></textarea></td>
    </tr>
    <tr>
        <td><span style="height: 105px;"><span class="prelabel">适合环境</span></span></td>
        <td><span style="height: 105px;"> <textarea name="environment"
            id="environment"
            style="float: left; height: 100px; width: 250px;"><?php echo $environment;?></textarea>
        </span></td>
    </tr>
    <tr>
        <td><span class="prelabel">电话</span></td>
        <td><input name="phone" type="text" id="phone" value="<?php echo $phone;?>" /></td>
    </tr>
    <tr>
        <td><span style="height: 105px;"><span class="prelabel">地址</span></span></td>
        <td><span style="height: 105px;"> <textarea name="address"
            id="address"
            style="float: left; height: 100px; width: 250px;"><?php echo $address;?></textarea>
        </span></td>
    </tr>
    <tr>
        <td><span class="prelabel">相关路段</span></td>
        <td>
        <dd>多个用半角逗号隔开</dd>
        <textarea name="sectionabout" id="sectionabout"><?php echo $sectionabout;?></textarea></td>
    </tr>
    <tr>
        <td><span class="prelabel">周边建筑</span></td>
        <td>
        <dd>多个用半角逗号隔开</dd>
        <textarea name="buildingabout" id="buildingabout"><?php echo $buildingabout;?></textarea></td>
    </tr>
    <tr>
        <td><span class="prelabel">公交线路</span></td>
        <td>
        <dd>多个用半角逗号隔开</dd>
        <textarea name="buslines" id="buslines"><?php echo $buslines;?></textarea></td>
    </tr>
    <tr>
        <td><span class="prelabel">车位</span></td>
        <td><label> <input type="radio" name="carport" value="1"
            id="carport_1" /> 有</label> <label> <input type="radio"
            name="carport" value="0" id="carport_0" /> 无</label></td>
    </tr>
    <tr>
        <td><span class="prelabel">包厢</span></td>
        <td>
        <label> <input type="radio" name="ledge" value="1"
            id="ledge_1" /> 有</label> 
           
        <label> <input type="radio"
            name="ledge" value="0" id="ledge_0" /> 无</label></td>
    </tr>
    <tr>
        <td><span class="prelabel">刷卡</span></td>
        <td><label> <input type="radio" name="swiping_card" value="1"
            id="swiping_card_1" /> 有</label> <label> <input type="radio"
            name="swiping_card" value="0" id="swiping_card_0" /> 无</label></td>
    </tr>
    <tr>
        <td><span class="prelabel">外卖</span></td>
        <td><label> <input type="radio" name="take_out" value="1"
            id="take_out_1" /> 有</label> <label> <input type="radio"
            name="take_out" value="0" id="take_out_0" /> 无</label></td>
    </tr>
    <tr>
        <td><span class="prelabel">夜宵</span></td>
        <td><label> <input type="radio" name="souper" value="1"
            id="souper_1" /> 有</label> <label> <input type="radio"
            name="souper" value="0" id="souper_0" /> 无</label></td>
    </tr>
    <tr>
        <td><span class="prelabel">无线</span></td>
        <td><label> <input type="radio" name="wireless" value="1"
            id="wireless_1" /> 有</label> <label> <input type="radio"
            name="wireless" value="0" id="wireless_0" /> 无</label></td>
    </tr>
    <tr>
        <td><span class="prelabel">可办会员</span></td>
        <td><label> <input type="radio" name="memberSupported" value="1"
            id="memberSupported_1" /> 是</label> <label> <input type="radio"
            name="memberSupported" value="0" id="memberSupported_0" /> 否</label></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <button name="saveShopper" id="saveShopper">保存店家</button>
        </td>
    </tr>
</table>
</form>
</div>
<script type="text/javascript">

var xaction = "<?php echo $action;?>";
var entryName = "<?php echo $entryName;?>";
var url = "../model/"+entryName+".php";
   jQuery.noConflict();  
   jQuery(document).ready(function($){      
   
     $("<?php echo "#carport_$carport";?>").attr("checked",true);
     $("<?php echo "#ledge_$ledge";?>").attr("checked",true);
     $("<?php echo "#swiping_card_$swiping_card"; ?>").attr("checked",true);
     $("<?php echo "#take_out_$take_out"; ?>").attr("checked",true);
     $("<?php echo "#souper_$souper"; ?>").attr("checked",true);
     $("<?php echo "#wireless_$wireless"; ?>").attr("checked",true);
     $("<?php echo "#memberSupported_$memberSupported"; ?>").attr("checked",true);
     
     $("#selImg").click(function(e){
    	 window.open('../scripts/jquery_upload_crop/upload_crop_v1.2.php','avatar');
         return false;

     }).button();
     $("#setImg").click(function(e){
         
         imageShowWindow();
         return false;

     }).button();

     $("#showImg").click(function(e){
         var imgsrc = $("#shopImg").val();
    	 shopperImageWindow(imgsrc);
    	 return false;
     }).button();

     $("#poisition").click(function(e){
         

         posWindow();

         return false;
     }).button({"label":"确定地理位置"});
     
     var state = $("select[name=state]");
     state.multiSelect({
         multiple: false,
         showHeader: false,
         selectedText: function(numChecked, numTotal, checkedItem){
             return $(checkedItem).attr("title");
         }
     });
     state.val("<?php echo $state;?>");
       
     var cooks =  $("select[name=cookstyle]");
     var options =  {
             "data":"action=list&actionparam=all",
             "onSuccess": function(json, responseXML){
   	           // MochaUI.notification(json);
                   var cookstyles = json.rows;
                   for(var i=0;i<cookstyles.length;i++){                       
                       var opt = jQuery('<option></option>');
                       opt.text(cookstyles[i].name);
                       opt.val(cookstyles[i].id);                      
                       cooks.append(opt); 
                   }
                   cooks.multiSelect({
            		   "checkAllText": '全选',
            		   "unCheckAllText": '全不选',
            		   "noneSelectedText" :'请选择菜系',
            		   "show":"blind",
            		   "hide":"blind",
            		   "selectedText":"#/# 已选择"
                       //"position":"middle"
            		                       
            		   
            	   });
             },
             "onFailure":function(xhr){
                  alert("发送错误:"+xhr.responseText);
             }
             
             
     }; 
     var myRequest = new Request.JSON(options);
     myRequest.post("../model/cookstyle.php");  


     var types = $("select[id=type]");
     

     options =  {
             "data":"action=list&actionparam=all",
             "onSuccess": function(json, responseXML){
   	           // MochaUI.notification(json);
                   var tmp = '<?php echo $type; ?>';
                   var cookstyles = json.rows;
                   for(var i=0;i<cookstyles.length;i++){                       
                       var opt = jQuery('<option></option>');
                       opt.text(cookstyles[i].name);
                       opt.val(cookstyles[i].id);  
                       if(tmp==cookstyles[i].id)
                           opt.selected = true;                    
                       types.append(opt); 
                   }
                   types.multiSelect({
                	   multiple: false, 
            		   "checkAllText": '全选',
            		   "unCheckAllText": '全不选',
            		   "noneSelectedText" :'请选择店家类型',
            		   "show":"blind",
            		   "hide":"blind",
            		   "selectedText":"#/# 已选择"
                           
                       //"position":"middle"
            		                       
            		   
            	   });
             },
             "onFailure":function(xhr){
                  alert("发送错误:"+xhr.responseText);
             }
             
             
     }; 
     var myRequest = new Request.JSON(options);
     myRequest.post("../model/shoppercatalog.php");    





     

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
             //alert(longitude+','+lantitude);
             
              if(isMapUpdated==true){
            	 isMapUpdated=false;
                 formData.push({"name":"longitude","value":longitude});
                 formData.push({"name":"lantitude","value":lantitude});
             }
             return true;
         } 
         var errs = '';
         for(var i=0;i<errorMsg.length;i++){
               errs+=errorMsg[i];
         }
         //$("#output2").html("<ol>"+errs+"</ol>");
         notify(errorMsg[0]);
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
	         "introduction":{"required":true},
	         "address":{"required":true},
	         "phone":{"required":true},
	         "contains":{"required":true,"isNum":true},
	         "shopImage":{"required":true},
	         "pcc_min":{"required":true,"isNum":true},
	         "pcc_max":{"required":true,"isNum":true},
	         "feature":{"required":true},
	         "environment":{"required":true},
	         "carport":{"required":true},
	         "ledge":{"required":true},
	         "swiping_card":{"required":true},
	         "take_out":{"required":true},
	         "souper":{"required":true},
	         "wireless":{"required":true},
	         "memberSupported":{"required":true},
	         "sectionabout":{"required":true},
	         "buildingabout":{"required":true},
	         "buslines":{"required":true},
	         "state":{"required":true},
	         "worktime":{"required":true},
   };
   var vMessages = {
		   "name":{"required":"需要商家名称","min":"商家名称长度不能小于","max":"商家名称长度不能大于"},
	         "introduction":{"required":"商家介绍不能为空"},
	         "address":{"required":"商家地址不能空"},
	         "phone":{"required":"电话不能为空"},
	         "contains":{"required":"容纳人数不能为空","isNum":"容纳人数必须是一个数字"},
	         "shopImage":{"required":"商家图片必须有"},
	         "pcc_min":{"required":"最低消费必须有","isNum":"最低消费必须是一个数字"},
	         "pcc_max":{"required":"最高消费必须有","isNum":"最高消费必须是一个数字"},
	         "type":{"required":"商家分类必须有"},
	         "feature":{"required":"商家特点必须有"},
	         "environment":{"required":"环境必须输入"},
	         "carport":{"required":"请选择是否有车位"},
	         "ledge":{"required":"请选择是否有包厢"},
	         "swiping_card":{"required":"请选择是否可以刷卡"},
	         "take_out":{"required":"请选择是否有外卖"},
	         "souper":{"required":"请选择是否有外卖"},
	         "wireless":{"required":"请选择是否可以无线上网"},
	         "memberSupported":{"required":"请选择是否可以无办理会员"},
	         "sectionabout":{"required":"请填写相关路段"},
	         "buildingabout":{"required":"请填写周围建筑物"},
	         "buslines":{"required":"请填写公交线路"},
	         "state":{"required":"请选择店家当前状态"},
	         "worktime":{"required":"请填写营业时间"},
          
   }; 

   
   var imageShowWindow = function(){
	    new MUI.Window({
	        id: 'imageShowWindow',
	        title: '查看商家图片',
	        width: 600,
	        height: 350,
	        resizeLimit: {'x': [450, 2500], 'y': [300, 2000]},
            toolbar:true,
            toolbarURL:'../view/util/imageTools.html',
            toolbarHeight:30,
	        scrollbars: false, // Could make this automatic if a 'panel' method were created
	        toolbarOnload:function(){
                $("#selectImg").click(function(){
                	//MochaUI.closeWindow($("imageShowWindow"));
                    //alert(selectImage);
                    $("#shopImg").val(selectImage);
                    $("#shopImgText").text(selectImage);
                    MochaUI.closeAll();  
                    return false;
                }).button();

                
            },
	        onContentLoaded: function(){    
	       
	            new MUI.Column({
	                container: 'imageShowWindow_contentWrapper',//'splitWindow_contentWrapper',
	                id: 'imageShowWindow_sideColumn',
	                placement: 'left',
	                width: 170,
	                resizeLimit: [100, 300]
	            });
	        
	            new MUI.Column({
	                container: 'imageShowWindow_contentWrapper',//splitWindow_contentWrapper',
	                id: 'imageShowWindow_mainColumn',
	                placement: 'main',
	                width: null,
	                resizeLimit: [100, 300]
	            });
	        
	            new MUI.Panel({
	                header: false,
	                id: 'imageShowWindow_panel1',                   
	                contentURL: '../scripts/jquery_upload_crop/upload_pic/shopperimage.php?imgsrc=http://www.google.com.hk/intl/zh-CN/images/logo_cn.png',
	                column: 'imageShowWindow_mainColumn',
	                panelBackground: '#fff'
	            });
	        
	            new MUI.Panel({
	                header: false,
	                id: 'imageShowWindow_panel2',
	                addClass: 'panelAlt',                   
	                contentURL: '../scripts/jquery_upload_crop/upload_pic/left.php',
	                column: 'imageShowWindow_sideColumn'                    
	            });
           
	        }           
	    });
	};// end of imageWindow


	var shopperImageWindow = function(imgsrc){ 
		new MUI.Window({
			id: 'shopperImageWindow',
			title: '查看商家图片',
			contentURL: '../scripts/jquery_upload_crop/upload_pic/shopperimage.php?imgsrc='+imgsrc,
			width: 400,
			height: 300
		});
	};



	   
    var x = <?php echo $longitude!=""?$longitude:112.986059; ?>;
    
    var y = <?php echo $lantitude!=""?$lantitude:28.194901; ?>;
    jQuery("#pos").text(x+','+y);
 
	var posWindow = function(){ 
 var thewin=new MUI.Window({
			id: 'posWindow',
			title: '查看商家地理位置',
			contentURL: '../poisition.php?x='+x+'&y='+y,
			width: 550,
			height: 425,
			onContentLoaded:function(){
			  jQuery("#okupdate").click(function(){
				   isMapUpdated = true;
                   jQuery("#pos").text(longitude+','+lantitude);
                   try{
                    MochaUI.closeAll();
                   }catch(e){
                     alert(e.message);
                   }
			       return false; 
			   }).button();
            }
		});
	};

  
});//end of document ready events

</script>
</body>
</html>
