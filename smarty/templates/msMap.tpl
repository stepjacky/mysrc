<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>吃遍长沙美食网-美食地图</title>
<link href="styles/home/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="main">
	<!--头部内容开始-->
   {include file="header.tpl"}

    <!--头部内容结束-->
    
    
    <div class="dqwz">您当前的位置：吃遍长沙美食网 > 美食地图 </div>
    
    <!--美食地图左侧开始-->
  <div class="mapLeft">
    	<div class="msbd">
        	<div class="top"></div>
     <form  action="search.php" method="post" enctype="application/x-www-form-urlencoded" target="_self">        
            <div class="search1">
            	<div class="tiaoj">
                
                <span class="fht">想花</span>(人均)
           	    <input type="text" name="pcc_min" size="6" />
           	    <span class="fht pR15"> 元  到</span>
           	    <input type="text" value="哪儿" name="word" size="16" id="word" />
                <span class="fht pL15"> 吃</span>
                <input type="text"  value="什么菜" name="cookWord" size="16" />
            	<label>
            	  <input type="submit" class="mapBtn1" id="button" value="提交" />
          	  </label>
            	</div>
                <div class="zhic">支持：
                  
                    <input type="checkbox" name="carport" id="checkbox2" value="1" />能停车
                    <input type="checkbox" name="ledge" id="checkbox3"  value="1"/>
                  有包厢
                  <input type="checkbox" name="swiping_card" id="checkbox4"  value="1"/>
                  能刷卡
                  <input type="checkbox" name="wireless" id="checkbox5" value="1" />
无线上网    
<input type="checkbox" name="take_out" id="take_out" value="1" />
有外卖
<input type="checkbox" name="souper" id="souper" value="1" />
夜宵 </div> 
            </div>
            </form>
            
             <form  action="search.php" method="post" enctype="application/x-www-form-urlencoded" target="_self"> 
            <div class="kjss">
              <p>
               <span class="f666" style="margin-left:103px;">(可同时输入菜系、地点等关键字，并用空格间隔。例：西餐 东街口)</span>
              </p>
               <br />
               <p style="margin-left:104px">快捷搜索：
              <label>
                <input name="word" type="text" id="word" style="width:400px" />
              </label>
              <input type="submit" class="mapBtn1" id="button" value="提交" />
              </p> 
            </div>
            </form>
            <div class="blank9"></div>
        <table width="93%" align="center" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="13%" class="red">热门关键字：</td>
                <td width="87%" class="lh20">
                {section loop=$queryWords name=hot}
                   <a href="search.php?word={$queryWords[hot]['word']|urlencode}" target="_blank"> {$queryWords[hot]['word']}
                   </a>|
                {/section}
               </td>
              </tr>
          </table>

            
        </div>
		
		<div class="blank9"></div>
		
		
		
        <div class="msbd">
          <div class="top"></div>
          <table width="93%" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="90" class="red">吃环境：</td>
              <td><a href="search.php?word={$envs[0]['name']}" target="_blank"><img src="styles/pic/msMap/chjBan1.jpg" border="0" /></a></td>
			  <td width="20" align="center"><img src="styles/pic/msMap/chjLine.jpg" /></td>
			  <td><a href="search.php?word={$envs[1]['name']}" target="_blank"><img src="styles/pic/msMap/chjBan2.jpg" border="0" /></a></td>
			  <td width="20" align="center"><img src="styles/pic/msMap/chjLine.jpg" /></td>
			  <td><a href="search.php?word={$envs[2]['name']}" target="_blank"><img src="styles/pic/msMap/chjBan3.jpg" border="0" /></a></td>
			  <td width="20" align="center"><img src="styles/pic/msMap/chjLine.jpg" /></td>
			  <td><a href="search.php?word={$envs[3]['name']}" target="_blank"><img src="styles/pic/msMap/chjBan4.jpg" border="0" /></a></td>
			  <td width="20" align="center"><img src="styles/pic/msMap/chjLine.jpg" /></td>
			  <td><a href="search.php?word={$envs[4]['name']}" target="_blank"><img src="styles/pic/msMap/chjBan5.jpg" border="0" /></a></td>
			  <td width="20" align="center"><img src="styles/pic/msMap/chjLine.jpg" /></td>
			  <td><a href="search.php?word={$envs[5]['name']}" target="_blank"><img src="styles/pic/msMap/chjBan6.jpg" border="0" /></a></td>
			  <td width="20" align="center"><img src="styles/pic/msMap/chjLine.jpg" /></td>
            </tr>
          </table>
          <div style="height:20px"></div>
          <table width="93%" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%" class="red">热门菜：</td>
              <td width="87%" class="lh20">
               {section loop=$hotcooks name=hot}
                   <a href="search.php?word={$hotcooks[hot]['name']|urlencode}" target="_blank">                
                                    {$hotcooks[hot]['name']}
                   </a>|
                {/section}
             </td>
            </tr>
          </table>
		  <div class="blank9"></div>
        </div>
		
		
		<!--美食专题开始-->
		<div class="blank9"></div>
		<div class="mszt">
			<h3></h3>
			<ul>
				{section loop=$foodfavs name=fvsec}
				<li><a href="catalogartitle.php?id={$foodfavs[fvsec]['artitleCatalogId']}" target="_blank">
				<span class="ui-widget-content">
				<img src="{$foodfavs[fvsec]['image']}" style="width:108px;height:83px" />
				</span>
				<p class="txt">{$foodfavs[fvsec]['name']}</p>
				</a></li>
				{/section}		
				
			</ul>
			<div class="clear"></div>
		</div>
		<!--美食专题结束-->
		
		
		<!--标志路段开始-->
		<div class="blank9"></div>
		<ul class="bzldTab">
			<li class="active white">标志地段</li>
		</ul>
		<div class="clear"></div>
		<div class="bzldCon">
		  <div class="left">
		  {foreach from=$insecs name=leftsec key=sname item=sec}
             {if $smarty.foreach.leftsec.index<=5}
		    <dl>
		      <dt style="color:blue;font-weight:bold">{$sname}</dt>
		      <dd>
		      {foreach from=$sec item=csec}
		      <a href="search.php?word={$csec['name']|urlencode}" target="_blank">[{$csec['name']}]</a> 
		      {/foreach}
		      </dd>
	        </dl>
	        {/if}
		  {/foreach}
	      </div>
	      
	      
	      
			<div class="left">
			{foreach from=$insecs name=leftsec key=sname item=sec}
             {if $smarty.foreach.leftsec.index>5}
		    <dl>
		      <dt style="color:blue;font-weight:bold">{$sname}</dt>
		      <dd>
		      {foreach from=$sec item=csec}
		      <a href="search.php?word={$csec['name']|urlencode}" target="_blank">[{$csec['name']}]</a> 
		      {/foreach}
		      </dd>
	        </dl>
	        {/if}
		  {/foreach}	
				
			</div>
			<div class="right">&nbsp;</div>
			<div class="clear"></div>
		</div>
		<!--标志路段结束-->
		
		
		
    </div>
    <!--美食地图左侧结束-->
    
    
    <!--美食地图右侧开始-->
    <div class="mapRight">
	
		<!--优惠卡商家开始-->	
    	<div class="yhsj">
			{section loop=$cardShoppers name=cardshop}
            <dl>
				<dt><img src="{$cardShoppers[cardshop]['shopImage']}"  width="98"  height="75"/></dt>
				<dd><a href="shopper.php?id={$cardShoppers[cardshop]['id']}">--{$cardShoppers[cardshop]['name']}</a></dd>
			</dl>
            
            {/section}
			
		</div>
		<!--优惠卡商家结束-->	
		
		<div class="blank9"></div>
		<!--每周荐店开始-->	
		<div class="mzjd">
            {section loop=$weekShoppers name=wshopper}
			<dl>
				<dt><img src="{$weekShoppers['wshopper']['shopImage']}"  width="98"  height="75"/></dt>
				<dd><a href="shopper.php?id={$weekShoppers['wshopper']['id']}">--{$weekShoppers['wshopper']['name']}</a></dd>
			</dl>
            {/section}
			
		</div>
		<!--每周荐店结束-->
		
		<div class="blank9"></div>
		
			
    </div>
    <div class="clear"></div>
    <!--美食地图右侧结束-->
    
    
    
    
    
    
    <div class="blank9"></div>
	
	
	
	<div class="MapTit1 left mr7">
        	<h3><span><a href="#">更多>></a></span>最新加入</h3>
            <div class="content">
           	  <ul class="list">
                    {section loop=$newjoins name=sp} 
                      <li>·
                      <a href="shopper.php?id={$newjoins[sp]['id']}" target="_blank">{$newjoins[sp]['name']}</a>
                      </li>
                    {/section}
                	
              </ul>
            </div>
  </div>
        
        
        <div class="MapTit1 left">
        	<h3><span><a href="#">更多>></a></span>人气最旺</h3>
            <div class="content">
           	  <ul class="list">
                	 {section loop=$hotmoods name=sp} 
                      <li>·
                      <a href="shopper.php?id={$hotmoods[sp]['id']}" target="_blank">{$hotmoods[sp]['name']}</a>
                      </li>
                    {/section}
                </ul>
            </div>
        </div>
        
        
        <div class="MapTit1 right">
        	<h3><span><a href="#">更多>></a></span>热门评论</h3>
            <div class="content">
           	  <ul class="list">
                	 {section loop=$hotcommits name=sp} 
                      <li>·
                      <a href="shopper.php?id={$hotcommits[sp]['id']}" target="_blank">{$hotcommits[sp]['name']}</a>
                      </li>
                    {/section}
                </ul>
          </div>
        </div>
		<div class="blank9"></div>
	
	
	
	
	
    
    {include_php file="footer.php"}
    
    
</div>
</body>
</html>
