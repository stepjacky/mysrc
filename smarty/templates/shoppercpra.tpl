<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>吃遍长沙美食网-商家比较</title>
<link href="styles/home/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="main">
	<!--头部内容开始-->
{include file="header.tpl"}

<div class="dqwz">您当前的位置：吃遍长沙美食网 > 美食地图 > 商家对比</div>
    <!--头部内容结束-->
	<div class="thbox">
    {foreach from=$shoppers key=sindex item=shopper}
	  <div class="dblist">
			<h3>{$shopper['name']}</h3>
			<div class="content">
				<ul>
					<li><span class="bold">电话</span>：{$shopper['phone']}</li>
					<li><span class="bold">拥有菜系</span>：
                    {foreach from=$cookstyles[$shopper.id] key=ckinx item=cook}
                    <span class="blue">{$cook['name']}</span>
                    {/foreach}
					<li><span class="bold">特色推荐</span>：{$shopper['feature']}</li>
					<li><span class="bold">人均消费</span>：{$shopper['pcc_min']}~{$shopper['pcc_max']}元</li>
					<li><span class="bold">营业时间</span>：{$shopper['worktime']}</li>
				</ul>
			</div>
			
	        <div class="pj">
              {$shopper['introduction']}
            </div>
			<div style="height:23px"></div>
			<table width="90%" align="center" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="30%">
           <img src="styles/pic/index/ico3.gif" width="16" height="16" align="absmiddle" />
                     平均得分
            </td>
			
			<td width="70%"  colspan="2">
             {section loop=$avgvalues[$shopper.id][0]['avgvalue'] name=aname}
                 <img src="styles/pic/ico5.gif" />
             {/section} 
            
            </td>
		  </tr>
		</table>
		<div class="blank9"></div>
			
	  </div>
      {/foreach}
	  <div class="blank9"></div>
		
	</div>
	
    <div class="ssright">
	  <div class="rdtj">
	  		<h3><span>热店推荐</span></h3>
			{foreach from=$hotshoppers key=hk item=hot}
            
            <dl>
				<dt><a href="shopper.php?id={$hot['id']}" target="_blank">{$hot['name']}</a></dt>
				<dd class="pic"><img src="{$hot['shopImage']}" style="width: 98px; height: 75px;" /></dd>
				<dd class="txt1 orange">人均：{$hot['pcc_min']}~{$hot['pcc_max']}</dd>
				<dd class="txt1">人气：<span class="red">{$hot['moods']}</span></dd>
			</dl>
			<div class="clear"></div>
			{/foreach}
			
	  </div>
		
    </div>    
   
	
    
    
    
    
   {include_php file="footer.php"}
    
    
    
</div>
</body>
</html>
