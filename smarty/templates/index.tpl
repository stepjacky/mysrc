<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>吃遍长沙美食网-美食主页</title>
<link href="styles/home/style.css" rel="stylesheet" type="text/css" />
<!-- 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
 -->
<script type="text/javascript" src="scripts/jquery/jquery-1.4.2.js"></script>
<script src="scripts/home/index.js" type="text/javascript"></script>
</head>

<body>
<div class="main">
	<!--头部内容开始-->
     {include file="header.tpl"}
    <!--头部内容结束-->
    
<div class="dqwz">您当前的位置：吃遍长沙美食网 >主页</div>
	<div class="indtab1">
		<ul>
        <!--
			<li><a href="javascript:void(0)"><img align="absmiddle" src="styles/pic/index/ico1.gif" />加入收藏</a></li>
			<li><a href="javascript:void(0)"><img align="absmiddle" src="styles/pic/index/ico2.gif" />美食每日快报</a></li>
			<li><a href="javascript:void(0)"><img align="absmiddle" src="styles/pic/index/ico3.gif" />每月荐店专题</a></li>
		 -->
        </ul>
	</div>  
    <div class="blank9"></div>
	
	<div class="left mr5 w200">
		<div class="indSear">
	  <table width="182" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="22" colspan="2">
          <dd>
            <input name="word2" class="f666" onfocus="this.select();" type="text" style="font-size:12px;font-weight:normal;width:180px;" value="输入关键字" id="word" />
          </td>
        </tr>
        <form action="search.php" name="sform" target="_blank" method="post" enctype="application/x-www-form-urlencoded">
        <tr>
          <td height="19" colspan="2">
          <input type="hidden" name="from" value="home" /></td>
        </tr>
        <tr>
          <td height="28"><label>
            <input type="checkbox" name="memberSupported" value="true" />
          折扣</label></td>
          <td align="right">
          <a href="javascript:;" onclick="document.forms['sform'].submit();"><img src="styles/pic/index/btnSear.jpg" width="60" height="19" border="0" /></a></td>
        </tr>
        </form>
        <tr>
          <td height="26" colspan="2"><span class="blue"><a href="msMap.php" target="_blank" class="red">更多优惠</a></span>　<span class="blue"><a href="msMap.php" target="_blank" class="red">更多餐馆</a></span></td>
        </tr>
      </table>
	  </div>
	  <div class="blank9"></div>
	  
	  <div class="zxjr">
	  		<h3>最新加盟商家</h3>
			<ul class="list4">
				{foreach from=$newjoins key=nindex item=shopper}
                <li>
                   <a href="shopper.php?id={$shopper['id']}" target="_blank">
                            {$shopper['name']|default:'未设置名字'}
                   </a>        
          </li>
				{/foreach}
	   </ul>
	  </div>
	  <p>&nbsp;</p>
	  
	  
	</div>
	
	<div class="w523 left">
		<div class="indMsdt">
			<h3>美食动态</h3>
			<p><SCRIPT language=javascript src="scripts/home/portal_flash2.php" type=text/javascript></SCRIPT></p>
		</div>
		
		<div class="blank9"></div>
		
		<div class="newbg">
			<div class="indTit1">
			本月最受欢迎商家
			</div>
		<ul class="list">
				{foreach from=$monthShoppers key=mindex item=shopper}
                <li><span class="red">·</span>
                
                 <a href="shopper.php?id={$shopper['id']}" target="_blank">
                      {$shopper['name']|default:'未指定名称'}
                 </a>
                    
                 </li>
				{/foreach}
	  </ul>
		</div>
		
		<div class="newbg2">
			<div class="p10">
				<div class="w100 left">
					<div class="indTit1 white">最新推荐</div>
					<div class="blank5"></div>
					<ul class="tabs1">
						{foreach from=$newRecommends key=nindex item=shopper name=newrmd}
                          
                          {if $smarty.foreach.newrmd.index==0}
                             <li class="active white">
                          {else}  
                             <li class="orange">
                          {/if}
                             <a href="shopper.php?id={$shopper['id']}" target="_blank">
                               {$shopper['name']|default:'未指定店家名称'}
                             </a>
                             
                           </li>
						  
                        {/foreach}
					</ul>
					
				</div>
				
				<div class="w183 right">
					<p><img src="styles/pic/index/a01.jpg" /></p>
					<div class="blank9"></div>
					<p class="f14 red">中秋之夜</p>
					<p class="white" style="padding:10px 20px 0 0px">9月22日就是中秋节了，赏月、吃月饼是必不可少的。那么，年年都吃月饼，今年</p>
				</div>
				
				<div class="clear"></div>
				
			</div>
		</div>
		
		<div class="clear"></div>
		
	</div>
	
	<div class="w253 right">
		<div class="indTit1">
			最新优惠信息
		</div>
		<ul class="list">
                {foreach from=$newsasa key=nindex item=artitle}
				<li><span class="red">·[NEW]</span>
                   <a href="artitle.php?id={$artitle['id']}" target="_blank"> 
                     {$artitle['title']}
                   </a></li>
				{/foreach}
                
                
	  </ul>
	  
	  <div class="blank9"></div>
	  
	  <div class="indTit1">
			最新美食排名
      </div>
			<ul class="phb">
                  {foreach from=$newfoods key=nindex item=artitle}
					<li><span>{$artitle['moods']}</span>
                    <a href="artitle.php?id={$artitle['id']}" target="_blank">
                        {$artitle['title']}
                    </a>
                    </li>
			    {/foreach}
				</ul>
			

	</div>
	
	<div class="blank9"></div>
 
    <table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="674">
         <a href="{$ad['a'][0]['href']|default:'javascript:;'}">
         <img src="{$ad['a'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" style="width:580px;height:59px" border="0" /></a></td>
        <td width="198"> 
        <a href="{$ad['b'][0]['href']|default:'javascript:;'}"><img  src="{$ad['b'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px" /></a></td>
        <td width="202">
         <a href="{$ad['c'][0]['href']|default:'javascript:;'}"><img src="{$ad['c'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
        </td>
      </tr>
      <tr>
        <td>
        <a href="{$ad['d'][0]['href']|default:'javascript:;'}"><img  src="{$ad['d'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:580px;height:59px" /></a></td>
        <td>
        <a href="{$ad['e'][0]['href']|default:'javascript:;'}"><img  src="{$ad['e'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px" /></a>
        </td>
        <td>
        <a href="{$ad['f'][0]['href']|default:'javascript:;'}"><img src="{$ad['f'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
        </td>
      </tr>
    </table>   
    <div class="blank2"></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
        	<div class="leftTit1">
			<h3><span><a href="#">更多>></a></span>本周推荐</h3>
            <ul class="picList">
				{section loop=$weekshoppers name=ft start=0 max=3}
                {assign var=shopper  value=$weekshoppers[ft]}   
                <li>              
                <a href="shopper.php?id={$shopper['id']}" target="_blank">
                   <img src="{$shopper['shopImage']}" style="width:128px; height:98px" />
				   <p class="tit">{$shopper['name']}</p>
				</a>
                </li>             
                {/section}
			</ul>
			<div class="blank9"></div>
            <ul class="picList">
				{section loop=$weekshoppers name=mt start=3 max=3}   
                 {assign var=shopper  value=$weekshoppers[mt]}   
                <li>              
                <a href="shopper.php?id={$shopper['id']}" target="_blank">
                   <img src="{$shopper['shopImage']}" style="width:128px; height:98px" />
				   <p class="tit">{$shopper['name']}</p>
				</a>
                </li>             
                {/section}
			</ul>
			<div class="blank9"></div>
            <ul class="picList">
				{section loop=$weekshoppers name=lt start=6 max=3}   
                 {assign var=shopper  value=$weekshoppers[lt]}   
                <li>              
                <a href="shopper.php?id={$shopper['id']}" target="_blank">
                   <img src="{$shopper['shopImage']}" style="width:128px; height:98px" />
				   <p class="tit">{$shopper['name']}</p>
				</a>
                </li>             
                {/section}
			</ul>
			<div class="blank9"></div>
         
		</div>
        </td>
        <td width="10">&nbsp;</td>
        <td width="406" valign="top">
        	<table width="100%" border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td>
                
               <a href="{$ad['g'][0]['href']|default:'javascript:;'}"><img src="{$ad['g'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                
                </td>
                <td>
                
                <a href="{$ad['h'][0]['href']|default:'javascript:;'}"><img src="{$ad['h'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                
                </td>
              </tr>
              <tr>
                <td>
                
                <a href="{$ad['i'][0]['href']|default:'javascript:;'}"><img src="{$ad['i'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                
                
                </td>
                <td>
                  <a href="{$ad['j'][0]['href']|default:'javascript:;'}"><img src="{$ad['j'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                
                </td>
              </tr>
              <tr>
                <td>
                  <a href="{$ad['k'][0]['href']|default:'javascript:;'}"><img src="{$ad['k'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                
                </td>
                <td>
                <a href="{$ad['l'][0]['href']|default:'javascript:;'}"><img src="{$ad['l'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                
                </td>
              </tr>
              <tr>
                <td>
                <a href="{$ad['m'][0]['href']|default:'javascript:;'}"><img src="{$ad['m'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                </td>
                <td>
                <a href="{$ad['n'][0]['href']|default:'javascript:;'}"><img src="{$ad['n'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                </td>
              </tr>
              <tr>
                <td>
                <a href="{$ad['o'][0]['href']|default:'javascript:;'}"><img src="{$ad['o'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                
                </td>
                <td>
                <a href="{$ad['p'][0]['href']|default:'javascript:;'}"><img src="{$ad['p'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                
                </td>
              </tr>
             <tr>
                <td>
                <a href="{$ad['q'][0]['href']|default:'javascript:;'}"><img src="{$ad['q'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                </td>
                <td>
                <a href="{$ad['r'][0]['href']|default:'javascript:;'}"><img src="{$ad['r'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                
                </td>
              </tr>
              <tr>
                <td><a href="{$ad['s'][0]['href']|default:'javascript:;'}"><img src="{$ad['s'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a></td>
                <td><a href="{$ad['t'][0]['href']|default:'javascript:;'}"><img src="{$ad['t'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" alt="" border="0" style="width:202px;height:59px"/></a></td>
              </tr>
              <tr>
                <td>
                  <a href="{$ad['u'][0]['href']|default:'javascript:;'}"><img src="{$ad['u'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
                </td>
                <td>
                <a href="{$ad['v'][0]['href']|default:'javascript:;'}"><img src="{$ad['v'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>                
                </td>
              </tr>
              
            </table>

        </td>
      </tr>
    </table>    
  	<div class="blank2"></div>
	<table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="674"><a href="{$ad['w'][0]['href']|default:'javascript:;'}">
       <img  src="{$ad['w'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0"  style="width:580px;height:59px" /></a></td>
        <td width="198">
          <a href="{$ad['x'][0]['href']|default:'javascript:;'}"><img src="{$ad['x'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a>
        </td>
        <td width="202"><a href="{$ad['y'][0]['href']|default:'javascript:;'}"><img src="{$ad['y'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a></td>
      </tr>
      <tr>
        <td><a href="{$ad['z'][0]['href']|default:'javascript:;'}">
       <img  src="{$ad['z'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0"  style="width:580px;height:59px" /></a></td>
        <td> <a href="{$ad['aa'][0]['href']|default:'javascript:;'}">
        <img  src="{$ad['aa'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a></td>
        <td> <a href="{$ad['ab'][0]['href']|default:'javascript:;'}">
      <img src="{$ad['ab'][0]['image']|default:'styles/pic/index/tjban02.jpg'}" border="0" style="width:202px;height:59px"/></a></td>
      </tr>
    </table>
    
    <div class="blank9"></div>
    
    <div class="cgcx">
    	<div class="cxtit">
        	<span><input name="textfield2" type="text" class="mscfInput1" id="textfield2" value="请输入搜索条件" /></span>
      		<span><a href="#"><img align="absmiddle" src="styles/pic/mscfBtn2.jpg"/></a></span>
        	<span class="white">搜索向导：分别按 <i style="color:#F90">菜系/原料/口味/工艺</i> 搜索菜谱</span>
        </div>
        <ul class="cgxz">
        	<li class="active" id="taglist1" onmouseover="SwitchNews('list', 1, 3,'active','white')"><a href="#">热门菜谱</a></li>
            <li class="white" id="taglist2" onmouseover="SwitchNews('list', 2, 3,'active','white')"><a href="#">中餐菜谱</a></li>
            <li class="white" id="taglist3" onmouseover="SwitchNews('list', 3, 3,'active','white')"><a href="#">西餐菜谱</a></li>
        </ul>
        <div class="tplist">
        	<div id="list1">
                 <ul class="picList2">
                     {section loop=$hotCook name=hsec start=0 max=5}
                     {assign var=hot value=$hotCook[hsec]}
                    <li><a href="artitle.php?id={$hot['id']}"><img src="{$hot['titleImage']}" style="width:128px;height:98px" />
                    <p class="tit">{$hot['title']}</p>
                    </a></li>
                    </a></li>
                    {/section}
                   
                </ul>
                <div class="blank9"></div>
                <ul class="picList2">
                    {section loop=$hotCook name=isec start=5 max=5}
                     {assign var=hot value=$hotCook[isec]}
                    <li><a href="artitle.php?id={$hot['id']}"><img src="{$hot['titleImage']}" style="width:128px;height:98px" />
                    <p class="tit">{$hot['title']}</p>
                    </a></li>
                    </a></li>
                    {/section}
                </ul>                   
               
            </div>
            
            
            
            
            <div id="list2" style="display:none">
                 <ul class="picList2">
                     {section loop=$eastCook name=ehsec start=0 max=5}
                     {assign var=hot value=$hotCook[ehsec]}
                    <li><a href="artitle.php?id={$hot['id']}"><img src="{$hot['titleImage']}" style="width:128px;height:98px" />
                    <p class="tit">{$hot['title']}</p>
                    </a></li>
                    </a></li>
                    {/section}
                   
                </ul>
                <div class="blank9"></div>
                <ul class="picList2">
                    {section loop=$eastCook name=isec start=5 max=5}
                     {assign var=hot value=$hotCook[eisec]}
                    <li><a href="artitle.php?id={$hot['id']}"><img src="{$hot['titleImage']}" style="width:128px;height:98px" />
                    <p class="tit">{$hot['title']}</p>
                    </a></li>
                    </a></li>
                    {/section}
                </ul>   
                         
            </div>
            
            
            
            <div id="list3" style="display:none">
                 <ul class="picList2">
                     {section loop=$westCook name=whsec start=0 max=5}
                     {assign var=hot value=$hotCook[whsec]}
                    <li><a href="artitle.php?id={$hot['id']}"><img src="{$hot['titleImage']}" style="width:128px;height:98px" />
                    <p class="tit">{$hot['title']}</p>
                    </a></li>
                    </a></li>
                    {/section}
                   
                </ul>
                <div class="blank9"></div>
                <ul class="picList2">
                    {section loop=$westCook name=wisec start=5 max=5}
                     {assign var=hot value=$hotCook[wisec]}
                    <li><a href="artitle.php?id={$hot['id']}"><img src="{$hot['titleImage']}" style="width:128px;height:98px" />
                    <p class="tit">{$hot['title']}</p>
                    </a></li>
                    </a></li>
                    {/section}
                </ul>   
            </div>
        </div>
    </div>
	
	
	<div class="blank5"></div>
	
     <a href="{$ad['ac'][0]['href']|default:'javascript:;'}">
       <img src="{$ad['ac'][0]['image']|default:'styles/pic/index/banner1.jpg'}" border="0" style="width:1000px;height:93px"/></a>
       <div class="blank2"></div>
   <a href="{$ad['ab'][0]['href']|default:'javascript:;'}">
       <img src="{$ad['ab'][0]['image']|default:'styles/pic/index/banner1.jpg'}" border="0"  style="width:1000px;height:93px"/></a>
	<div class="blank2"></div>
	<a href="{$ad['ad'][0]['href']|default:'javascript:;'}">
       <img src="{$ad['ad'][0]['image']|default:'styles/pic/index/banner1.jpg'}" border="0"  style="width:1000px;height:93px"/></a>
	<div class="blank9"></div>
	
	 <form action="search.php" name="tform" target="_blank" method="post" enctype="application/x-www-form-urlencoded">
	<div class="sscg">
		<span><a href="#">提供餐厅资料</a> | <a href="#">更多餐馆推荐</a></span>
		<span style="padding-left:130px">您可以在此输入店名、菜系、路段等关键词</span>
	    
        <input type="text" name="word" />
	    <img src="styles/pic/index/btn_sscg.jpg" onclick="document.forms['tform'].submit();"  align="absmiddle" border="0"/>
    
        </div>
		</form>
	<div class="blank9"></div>
	
    
   {*****************************************************
       推荐商家开始 
       
    ******************************************************}

   
	{foreach from=$catalogShoppers  key=pos item=catashopper  name=shopperloop}
 
	<div class="cgtj">
		<h3><span><a href="#"><img src="styles/pic/index/more.gif" border="0" /></a></span>
        {$catashopper['head'][0]['cataname']}</h3>
		<div class="content">
		 <div class="left">
		  <img src="{$catashopper['head'][0]['image']|default:'styles/pic/index/cgtj01.jpg'}" style="width:128px;height:98px"/>
          <p class="pictxt">
          <a href="shopper.php?id={$catashopper['head'][0]['id']}" target="_blank">
		     {$catashopper['head'][0]['name']}
          </a>
          </p>
           <img src="{$catashopper['head'][1]['image']|default:'styles/pic/index/cgtj01.jpg'}" style="width:128px;height:98px"/>
          <p class="pictxt">
          <a href="shopper.php?id={$catashopper['head'][1]['id']}" target="_blank">
		     {$catashopper['head'][1]['name']}
          </a>
          </p>     
                
            
            </div>
			<div class="right">
				<ul class="wyhd2">
				{foreach from=$catalogShoppers[$pos]['list'] key=rindex item=listItem}
                <li>
                ·<a href="shopper.php?id={$listItem['id']}" target="_blank">   
                  {$listItem['name']}
                 </a>
                 </li>
				{/foreach}
			</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>
    
    {if ($smarty.foreach.shopperloop.index+1) % 3 == 0}
           <div class="blank9"></div>
    {/if}    
	{/foreach}

   {*****  推荐商家结束  **************}
    <div class="blank9"></div>
   <img src="styles/pic/index/banner1.jpg" border="0" style="height:93px;width:100%" />
 <div class="blank9"></div>
   {*****  餐饮新闻推荐开始  ***********}

  
	<div class="cyxx">
     {foreach from=$cookRecommend['head'] key=pos item=cookrmd}
		<div class="cytit rline">
			<h3><span><a href="#"><img src="styles/pic/index/more.gif" border="0" /></a></span>
            <i>{$cookrmd[0]['cataname']}</i></h3>
			<ul class="wyhd2 p8">
				{foreach from=$cookrmd key=ckey item=cartitle}
                  <li>·
                     
                     <a href="artitle.php?id={$cartitle['id']}" target="_blank">
                             {$cartitle['title']}                     
                     </a>
                     
                     
                  </li>
				{/foreach}
			</ul>
		</div>
      {/foreach}  		
	</div>
	
	<div class="blank9"></div>
    {***********  餐饮新闻推荐结束  ***************}
    
    {***********  餐饮常规开始  ***************}
      {foreach from=$cookRecommend['list'] key=pos item=cookrmd name=cookshow}
     
       {assign var='tc' value=''}
       {if ($smarty.foreach.cookshow.index+1)%3!=0}
           {assign var=tc value=mr9}
       {/if}
	<div class="jkys {$tc}">
		<h3><span><img src="styles/pic/index/more2.gif" /></span>
        <i>{$cookrmd[0]['cataname']}</i>
        </h3>
		<div class="content">
			<dl class="gileList">
				<dt><a href="artitle.php?id={$cookrmd[0]['id']}">{$cookrmd[0]['title']}</a><br /><br /></dt>
				<dd class="img"><img src="{$cookrmd[0]['titleImage']|default:'styles/pic/index/jkms01.jpg'}" style="width:120px;height:100px" /></dd>
				<dd class="txt">{$cookrmd[0]['titleImage']|default:'暂无简介...'}</dd>
			</dl>
			<div class="blank9"></div>
			<ul class="list">
				{foreach from=$cookrmd key=ckey item=cartitle}
                  <li>·
                     
                     <a href="artitle.php?id={$cartitle['id']}" target="_blank">
                             {$cartitle['title']}                     
                     </a>
                     
                     
                  </li>
				{/foreach}
			</ul>
		</div>
	</div>
    
    {if ($smarty.foreach.cookshow.index+1)%3==0}
      <div class="clear"></div>
	  <div class="blank9"></div>
    {/if}
    {/foreach}
    {***********  餐饮常规结束  ***************}
    
    
    {include_php file="footer.php"}
    
</div>
</body>
</html>
