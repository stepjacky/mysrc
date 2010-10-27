<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>美食文章-{$artitle['title']}</title>
<link href="styles/home/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="main">
	<!--头部内容开始-->
     {include file='header.tpl'}
   


    <!--头部内容结束-->
    <div class="dqwz">您当前的位置：吃遍长沙美食网 &gt; 文章页面</div>
    
<!--美食地图左侧开始-->
    <!--美食地图左侧结束-->
    <!--美食地图右侧开始-->
    <div class="clear"></div>
    <!--美食地图右侧结束-->
    
    
    
    
    
    
    <div class="blank9"></div>
    
  <div class="openLeft">
    <h2>{$artitle['title']}</h2>
        <div class="link">
        	发布时间：{$artitle['publishDate']|date_format:$config['date']}   人气：{$artitle['moods']}
<div class="ljtxt">
                <span><a href="#">打印</a></span>
                <span><a href="#">转发</a></span>
                <span><a href="#">收藏</a></span>
                转载自: <span class="red"><a href="{$artitle['from_link']}" target="_blank">{$artitle['from_title']}</a></span>
            </div>
            <div class="clear"></div>
        </div>
       <div style="width:100%;margin-left:5px;text-align: justify;word-break:break-all;">
       {$artitle['content']}
       </div>
    <div class="blank9"></div>
  </div>
  <div class="sjright">
	     
<div class="blank2"></div>
		
		<div >
	  		<h3><span class="fht">热店推荐</span></h3>
			{foreach from=$hotShoppers key=nindex item=nshopper name=nfshopper}
<dl>
    <dt><a href="shopper.php?id={$nshopper['id']}" target="_blank">{$nshopper['name']}<br/>&nbsp;</a></dt>
    <dd class="pic"><img src="{$nshopper['shopImage']|default:'styles/pic/search/rdtj01.jpg'}" style="width:98px;height:75px;" /></dd>
    <dd class="txt1 orange">人均：{$nshopper['pccmin']}~{$nshopper['pccmax']}</dd>
    <dd class="txt1">人气：<span class="red">{$shopper['moods']}</span></dd>
</dl>
<div class="clear"></div>
{/foreach}
	  </div>
      
      <div class="blank9"></div>
   	     
    <div class="msHot2">
        <h3><span class="fht">美食热点</span></h3>
         <div class="blank9"></div>
<ul>
				{section loop=$hotArtitles name=harts}
                <li style="line-height:20px ">
                <a href="artitle.php?id={$hotArtitles[harts]['id']}" target="_blank">
                 {$hotArtitles[harts]['title']}
                </a>            
                </li>                
                {/section}      
			
			</ul>
		</div>
		
	</div>
<div class="clear"></div>
	<div style="clear:both; height:16px">
    <div class="xglj">
        	<div class="syt">
            <span class="bold">上一条</span>：
             {if $sblingartitles['prev']!=null}
        
        <a href="artitle.php?id={$sblingartitles['prev']['id']}" target="_self" class="blue">
         {$sblingartitles['prev']['title']}
        </a>
       
        {else}
                           没有了
        {/if}
            
            
            </div>
            <div class="xyt">
            <span class="bold">下一条</span>：
            
             {if $sblingartitles['next']!=null}
        
        <a href="artitle.php?id={$sblingartitles['next']['id']}" target="_self" class="blue">
        {$sblingartitles['next']['title']}</a>
        
        {else}
                           没有了
        {/if}
            
            
            </div>
            <div class="clear"></div>
      </div>
    </div>
    <div class="blank9"></div>
	
    {include file='footer.tpl'}
    
    
</div>
</body>
</html>
