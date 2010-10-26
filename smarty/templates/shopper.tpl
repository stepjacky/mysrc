<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>吃遍长沙美食网-查看商家信息-{$shopper['name']}</title>
<link href="styles/home/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript"
         src="http://api.map.baidu.com/api?key=cb23666e43d046134efe51b974d17764&v=1.0&services=true"></script>
<script type="text/javascript" src="scripts/jquery/jquery-1.4.2.js"></script>
<link href="scripts/jgrowl/jquery.jgrowl.css" rel="stylesheet"
    type="text/css" />

<link type="text/css" href="scripts/jquery.marquee//css/jquery.marquee.css" rel="stylesheet" title="default" media="all" />
<script type="text/javascript" src="scripts/jgrowl/jquery.jgrowl.js"></script>
<script type="text/javascript" src="scripts/jquery.marquee/lib/jquery.marquee.js"></script>

<script type="text/javascript" src="scripts/myutils.js"></script>


<script type="text/javascript">
//jQuery.noConflict();
$(function(){    
	$.jGrowl.defaults.position="center";
	$.jGrowl.defaults.speed="fast";
	 $("#vote_taste,#vote_env,#vote_serve").change(function(){
	       var postData = {};
	       postData.action = "updateVote";
	       postData.fieldName = this.id;
	       postData.fieldValue = $(this).val();
	       postData.shopperId = "{$shopper['id']}"; 
	       $.ajax({
	        	   "type": "POST",
	        	   "url": "model/shopper.php",
	        	   "data": $.param(postData),
                   "dataType":"json",
	               "success":function(msg){
	    	              ajaxSuccess(msg);
	               },
	               "error":function(msg){
	                  
                       ajaxError(msg)
	               }
	        	              


	       });//end of ajax


	       
	   });
	   $("#vcode").css("display","none");	

       $("#acode").focus(function(){
    	   disPlayVcode();

       });

       $("#commit").click(function(){
              var postData={};
              postData.content=$("#content").val();
              postData.usernick=$("#usernick").val();
              postData.action="create";
              postData.acode=$("#acode").val();
              postData['shopper_id']="{$shopper['id']}";
              $.ajax({
                   "type":"post",
                   "url":"model/commonCommit.php",
                   "data":$.param(postData),
                   "dataType":"json",
                   "success":function(msg){
            	           ajaxSuccess(msg);
            	           loadCommit(1);
                   },
                   "error":function(msg){
                            ajaxError(msg);

                   }
                       
                  });     


        });
         
	   function disPlayVcode(){
	  		$("#vcode").attr("src",'checkNum.php#'+new Date().getTime());
	  		$("#vcode").css("display","inline");
	   }

       function ajaxSuccess(msg){

    	   var jopt = {};
           jopt.life=2000;
           $.jGrowl(msg.message,jopt);

       }

       function ajaxError(msg){

    	   alert("投票出现错误,请联系管理员!\n"+msg);
       }

       //加载对店家的评论
       var first=1;
       var last =1;
       var page=1;
       var next = page+1;
       var prev = (page-1)==0?1:(page-1);
       var records = 0;
       var totalpage = 0;
       var commitContainer = $("#commitContainer");
       var commitShow = $("#commitShow");
       var loadCommitFirst = true;
       function loadCommit(p){
           var postData = {};
           postData.action="list";
           postData.page = p;
           postData.rows = 5;    
           postData.sidx = "publishdate";
           postData.sord = "desc";
           $.ajax({
        	   "type":"post",
               "url":"model/commonCommit.php",
               "data":$.param(postData),
               "dataType":"json",
               "success":function(data){
                   last = data.total;
                   page = data.page;
                   next = next>last?last:next;
                   records = data.records;
                   totalpage = data.total;
                   var rows = data.rows;
                   if(loadCommitFirst){
                       if(rows.length>=1){
                           fillCommit(commitShow,rows[0],0);
                           for(var i=1;i<rows.length;i++){
                                  var cnx = commitShow.clone();
                                  var d = rows[i];
                                  fillCommit(cnx,d,i);
                           }
                       }
                       loadCommitFirst = false;
                       

                   }else{
                       if(rows.length>=1){
                    	   commitContainer.empty();
                           for(var i=0;i<rows.length;i++){
                                  var cnx = commitShow.clone();
                                  var d = rows[i];
                                  fillCommit(cnx,d,i);
                           }
                       }

                       
                   }
                   var jcnar = $(".jumpCommit"); 
                   jcnar.empty();
                   for(var r=0;r<totalpage;r++){
                	   var opt = $("<option></option>");
                       if(page==(r+1)){
                          opt.attr("selected",true);
                       }
                       opt.val(r+1);
                       opt.text(r+1);
                       jcnar.append(opt);
                   }

                   
                  
               },
               "erro":function(msg){
                   alert(msg);
               }

            });//end of ajax 

           
       }

       function fillCommit(container,data,i){
           var user   = $(".usernick",container);
           var pdate  = $(".publishdate",container);
           var cnt    = $(".content",container);
           var floor  = $(".floor",container);  
           user.text(data.usernick);
           pdate.text(data.publishdate);
           cnt.text(data.content);
           var fnum = (page-1)*5+i+1;
           fnum = (records - fnum + 1);
           floor.text("# " + fnum +" 楼");
           commitContainer.append(container);  
       }
       loadCommit(1);


       $("#commitNav a").click(function(){
            switch(this.className){
                case "commitfirst":loadCommit(1);break;
                case "commitlast":loadCommit(last);break;
                case "commitnext":loadCommit(next);break;
                case "commitprev":loadCommit(prev);break;
                default:alert("加载错误的评论参数!");

            } 

       });

       
       $(".jumpCommit").change(function(){
           loadCommit($(this).val());
           
       });

       
       //初始化地图插件
       function inilizePos(){
		    var x = {$shopper['longitude']};
   			var y = {$shopper['lantitude']};
   			var map = new BMap.Map("container");
   			var cpoint = new BMap.Point(x,y);
  			map.centerAndZoom(cpoint, 12);
   			var marker = new BMap.Marker(cpoint);        // 创建标注   
   			map.addOverlay(marker);	
   			marker.addEventListener("click", function(){
   	   			this.openInfoWindow(infoWindow);

   	   	    });
            
   			var info = "<div style='text-align:left;margin-top:10px;font-weight:bold;color:#1A6DAF'>电话:{$shopper['phone']}</div>"
   			var opts = {   
   				  width : 100,     // 信息窗口宽度   
   				  height: 50,     // 信息窗口高度   
   				  title : "<b style='font-size:15px;color:#00f'>{$shopper['name']}</b>"  // 信息窗口标题   
   			};

   		    var infoWindow = new BMap.InfoWindow(info, opts);  // 创建信息窗口对象   
   			map.openInfoWindow(infoWindow, map.getCenter());      // 打开信息窗口  
   			map.addControl(new BMap.NavigationControl());
   			map.addControl(new BMap.ScaleControl());
   			map.addControl(new BMap.OverviewMapControl());
   			map.enableScrollWheelZoom();
   				   			   
	   }
       inilizePos();
       
       $("#marquee").marquee();
      
       
});//end of document ready event process function 
</script>

</head>

<body>
<div class="main">
<!--头部内容开始-->
{include file="header.tpl"}

<!--头部内容结束--> 

<div class="dqwz">您当前的位置：吃遍长沙美食网 >商家页面</div>
<!--美食地图左侧开始--> <!--美食地图左侧结束--> <!--美食地图右侧开始-->
<div class="clear"></div>
<!--美食地图右侧结束-->



<div class="blank9"></div>
<div class="sjInfo">
<div class="sjname">{$shopper['name']|default:'未指定名称'}</div>
<div class="sjxj">人气：{$shopper['moods']} 网络星级：
{php} 
$random = rand(3,6); for($i=0;$i<$random;$i++){ echo " <img
    src='styles/pic/sjym/list04.gif' align='absmiddle' /> " ; } {/php}
</div>
<div class="dazhe">
 <ul id="marquee" class="marquee">
   <li>
     {$shopper['discount']|default:"该商家没有打折信息"}
   </li>  
 </ul>
 
</div>
<ul class="sjlj">
    <li><a href="javascript:addFavorite(document.location.href,'{$shopper['name']}');">收藏本店</a></li>
    
</ul>
<div class="clear"></div>
</div>



<div class="blank9"></div>

<div class="sjflash"><img
    src="{$shopper['shopImage']|default:'styles/pic/sjym/flash.jpg'}"
    style="width: 387px; height: 308px" />
<div class="blank9"></div>

<div class="sjdz">
<ul>
    <li>【地址】：{$shopper['address']}</li>
    <li>【相关路段】：{$shopper['sectionabout']}</li>
    <li>【周边建筑】：{$shopper['buildingabout']}</li>
</ul>
</div>
<div class="blank9"></div>
<div style="width: 100%; height: 300px; border: 1px solid gray"  id="container"></div></div>

<div class="sjtxt">
<dl class="sjlist1">
    <dt>{$shopper['name']|default:'该店'} 的简介</dt>
    <dd>{$shopper['introduction']|default:'暂无简介'}</dd>
    <dd>容纳人数：{$shopper['contains']}</dd>
</dl>

<dl class="sjlist2">
    <dt>详细信息</dt>
    <dd>人均消费： <span class="orange pr15">
    {$shopper['pcc_min']}元～{$shopper['pcc_max']}元</span> &nbsp;&nbsp;营业时间：<span
        class="orange">{$shopper['worktime']}</span></dd>
    <dd>拥有菜系： {foreach $cookstyles as $cooks} <a
        href="cookshoppers.php?cookid={$cooks['id']}" target="_blank"> <span
        style="color: blue; font-weight: 800"> {$cooks['name']} </span>
    </a> &nbsp; {/foreach}</dd>
    <dd>类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型： <a href="catalogshoppers.php?cataId={$type['id']}"
        target="_blank"> <span style="color: #F60"> {$type['name']} </span>
    </a></dd>
    <dd>特色推荐：{$shopper['feature']}</dd>
    <dd>适合环境：{$shopper['environment']}</dd>
</dl>

<dl class="sjlist2">
    <dt class="bold">电话: {$shopper['phone']}</dt>
</dl>

<div class="blank9"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
    class="sjtab1">
    <tr>
        <td>停车位： <img src="images/{$shopper['carport']}.png" align="absmiddle"/></td>
        <td>有包厢： <img src="images/{$shopper['ledge']}.png" align="absmiddle"/></td>
        <td>能刷卡： <img src="images/{$shopper['swiping_card']}.png" align="absmiddle"/></td>
    </tr>
    <tr>
        <td>有外卖： <img src="images/{$shopper['take_out']}.png" align="absmiddle"/></td>
        <td>有夜宵： <img src="images/{$shopper['souper']}.png" align="absmiddle"/></td>
        <td>无线网： <img src="images/{$shopper['Wireless']}.png" align="absmiddle"/></td>
    </tr>
</table>
<div class="blank9"></div>

<div class="tpbox">
<h3><img src="styles/pic/sjym/list05.gif" style="margin-right: 4px" />投票<span
    class="f666">(投票每人每天只有一次机会)</span></h3>
<div class="content">
<ul>
    <li>口味： {section loop=10 name=ts} {if
    $smarty.section.ts.index>$vote_taste_avg-1} <img
        src="styles/pic/sjym/list07.gif" /> {else} <img
        src="styles/pic/sjym/list06.gif"
        title="口味平均得分 {$vote_taste_avg|string_format:"%d"}" /> {/if} {/section} <label> <select
        id='vote_taste'>
        <option value="-1" selected="selected">请选择...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select> </label></li>
    <li>环境： {section loop=10 name=vn} {if
    $smarty.section.vn.index>$vote_env_avg-1} <img
        src="styles/pic/sjym/list07.gif" /> {else} <img
        src="styles/pic/sjym/list06.gif" title="环境平均得分 {$vote_env_avg|string_format:"%d"}" />
    {/if} {/section} <label> <select id="vote_env">
        <option value="-1">请选择...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select> </label></li>
    <li>服务： {section loop=10 name=gn} {if
    $smarty.section.gn.index>$vote_serve_avg-1} <img
        src="styles/pic/sjym/list07.gif" /> {else} <img
        src="styles/pic/sjym/list06.gif"
        title="服务平均得分 {$vote_serve_avg|string_format:"%d"}" /> {/if} {/section} <label> <select
        id="vote_serve">
        <option value="-1">请选择...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select> </label></li>
    <li>已有 {$voteCount} 人参与投票，平均得分 {$voteAvg|string_format:"%d"} 分</li>
</ul>
</div>
</div>

</div>
<div class="sjright"><img src="styles/pic/sjym/tck.jpg" />
<div class="blank9"></div>

<div class="fjsj">
<h3><span></span></h3>
{foreach from=$nearShoppers key=nindex item=nshopper name=nfshopper}
<dl>
    <dt><a href="shopper.php?id={$nshopper['id']}" target="_blank">{$nshopper['name']}</a></dt>
    <dd class="pic"><img src="{$nshopper['shopImage']}" style="width:98px;height:75px;" /></dd>
    <dd class="txt1 orange">人均：{$nshopper['pccmin']}~{$nshopper['pccmax']}</dd>
    <dd class="txt1">人气：<span class="red">{$shopper['moods']}</span></dd>
</dl>
<div class="clear"></div>
{/foreach}
</div>

</div>


<div class="blank9"></div>


<div class="ssleft"><a href="#"><img src="styles/pic/sjym/ban1.jpg"
    border="0" /></a>
<div class="blank9"></div>
<div class="rmc">
<h3 class="rqb"></h3>
<ul class="list p8">
    {foreach from=$queryWords key=qk item=qword}
    <li><a href="search.php?word={$qword['word']|urlencode}" target="_blank">{$qword['word']}</a></li>
    {/foreach}
</ul>
</div>
</div>

<div class="sscenter">
<div class="liuyan">
<p class="tit"><b>网友评论</b>(<i
    class="blue">请遵守网络道德，</i><i class="orange">严禁</i><i class="blue">恶意攻击，漫骂)</i></p>
<div class="content">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="14%" align="center">昵称</td>
        <td width="86%"><label> <input type="text" style="width: 450px"
            name="usernick" id="usernick" /> </label></td>
    </tr>
    <tr>
        <td align="center">&nbsp;</td>
        <td>最多120个汉字</td>
    </tr>
    <tr>
        <td align="center"><img src="styles/pic/sjym/list09.gif" />
        <p>心情(<span class="blue">可选</span>)</p>
        </td>
        <td><label> <textarea name="content" rows="5"
            style="width: 450px" id="content"></textarea> </label></td>
    </tr>
    <tr>
        <td align="center">&nbsp;</td>
        <td style="padding-right: 30px" align="right">提交前请输入验证码： <input
            type="text" id="acode" size="4" /> <img id="vcode"
            align="absmiddle" /> <label>
        <button id="commit" class="btn_sj01">发布留言</button>
        </label></td>
    </tr>
</table>
<div id="commitContainer">

<table id="commitShow" width="100%" border="1" bordercolor="#FFFFFF"
    style="border-collapse: collapse" class="lh22" cellspacing="0"
    cellpadding="0" bgcolor="#f5f5f5">

    <tr>
        <td width="14%" align="center" height="28"><span
            class="usernick"></span></td>
        <td width="86%"><span class="right" style="padding-right: 30px">
        <span class="floor"></span> </span> <span class="publishdate"> </span>

        </td>
    </tr>
    <tr>
        <td align="center"><img src="styles/pic/sjym/list09.gif" />
        <td class="content"></td>
    
    </tr>
</table>

</div>
<p align="right" id="commitNav">
    <a href="javascript:;" class="commitfirst">首页</a>
    <a href="javascript:;" class="commitprev">上页</a> 
    <a href="javascript:;" class="commitnext">下页</a> 
    <a href="javascript:;" class="commitlast">尾页</a>
    <select class="jumpCommit"></select>
</p>
</div>
</div>
</div>
<div class="ssright"><a href="#"><img src="styles/pic/sjym/mscf.jpg"
    width="205" height="29" border="0" /></a>
<div class="blank9"></div>

<div class="rmc">
<h3 class="rqb" style="background: url(styles/pic/sjym/tndj.jpg)"></h3>
<ul class="list p8">
   {foreach from=$samecatalog key=sk item=sshopper}
      <li>
      <a href="shopper.php?id={$sshopper['id']}" target="_blank">
               {$sshopper['name']}                       
      </a>
      </li>
   {/foreach} 
</ul>
</div>

</div>
<div class="clear"></div>
<div class="blank9"></div>

<div class="dbbox">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" valign="middle">
        {if $sblingShoppers['prev']!=null}
        
        <a href="shopper.php?id={$sblingShoppers['prev']['id']}" target="_self">
        <img src="styles/pic/sjym/btn01.jpg" border="0" align="baseline" /></a>
        {$sblingShoppers['prev']['name']}
        {else}
                           没有了
        {/if}
        
        
        </td>
        <td width="100">&nbsp;</td>
        
        <td align="center">
        
         {if $sblingShoppers['next']!=null}
        
        <a href="shopper.php?id={$sblingShoppers['next']['id']}" target="_self">
        <img
            src="styles/pic/sjym/btn02.jpg" border="0" align="baseline" /></a>
        {$sblingShoppers['next']['name']}
        {else}
                           没有了
        {/if}    
            
            
            </td>
    </tr>
</table>
<div class="blank9"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="6%" align="center">同类餐馆比较</td>
        <td width="81%" class="xux">
          <form action="shoppercpra.php" target="_blank" name="sameform_0" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
         
           {foreach from=$samecatalog key=sk item=sshopper name=ssname}
                 {if $smarty.foreach.ssname.index%2==0}
                     {assign var=bg value=ffc}
                 {else}
                     {assign var=bg value=fff}
                 {/if} 
                 {if $smarty.foreach.ssname.index%4==0}
                    <tr>
                 {/if}
                 <td style="width:25%; background-color:#{$bg}">
                 
                        <label>
                            <input type="checkbox" name="sameid[]" value="{$sshopper['id']}" />
                				{$sshopper['name']}                       
                        </label>
                 </td>
                 {if ($smarty.foreach.ssname.index+1)%4==0}
                 </tr> 
                 {/if}
           {/foreach}
        
        </table>
        </form>
        </td>
        <td width="13%" align="center"><a href="javascript:;" onclick="document.forms['sameform_0'].submit();return false;"><img
            src="styles/pic/sjym/btn03.jpg" width="102" height="44"
            border="0" /></a></td>
    </tr>
</table>
<div class="blank9"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="6%" align="center" class="orange">附近餐馆比较</td>
        <td width="81%" class="xux">
          <form action="shoppercpra.php" target="_blank" name="sameform_1" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            {foreach from=$nearShoppers key=nindex item=nshopper name=nfshopper}
                  {if $smarty.foreach.nfshopper.index%2==0}
                     {assign var=bg value=ffc}
                 {else}
                     {assign var=bg value=fff}
                 {/if} 
                
                {if $smarty.foreach.nfshopper.index%4==0}
                  <tr>
                {/if}
                
                 <td style="width:25%; background-color:#{$bg}">
                  <label> 
                   <input type="checkbox" name="sameid[]"
                    value="{$nshopper['id']}" />{$nshopper['name']}</label>
                    
                 </td>
                
                {if ($smarty.foreach.nfshopper.index+1)%4==0}
                  </tr>
                {/if}
                
            {/foreach}
            
         
        </table>
        </form>
        </td>
        <td width="13%" align="center"><a href="javascript:;" onclick="document.forms['sameform_1'].submit();return false;"><img
            src="styles/pic/sjym/btn03.jpg" width="102" height="44"
            border="0" /></a></td>
    </tr>
</table>
</div>


  {include_php file="footer.php"}


</div>
</body>
</html>
