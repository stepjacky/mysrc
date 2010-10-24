<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="scripts/jquery/jquery-1.4.2.js" ></script>
<title>美食搜索</title>
<link href="styles/home/style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
     $(function(){

    	 $("#pageNav a").click(function(){
                switch(this.id){
                case "first":search(1);break;
                case "prev":search({$page-1});break;
                case "next":search({$page+1});break;
                case "last":search({$totalPages});break;
                default:;


               }      
                return false;

         });
         $("select[name='name']").change(function(){
               search($(this).val());


         });

    	 
         
         function search(page){
               var form = $("form");
               var hid = $("<input type='hidden' name='page' value='"+page+"'></input>");
               form.append(hid);
               form.submit();
         }


         $("#psort").change(function(){
             alert($(this).val());
              var form = $("form"); 
              var hid = $("<input type='hidden' name='page' value='{$page}'></input>");
              var sort  = $("<input type='hidden' name='psort' value='"+$(this).val()+"'></input>");
              form.append(hid);
              form.append(sort);
              form.submit();
         });

         {foreach from=$otherCdt key=cname item=cvalue}
             {if $cvalue==true} 
             $("#{$cname}").attr("checked",true);
             {else}
             $("#{$cname}").attr("checked",false);
             {/if} 
         {/foreach}

         
     });
  
  </script>


</head>

<body>
<div class="main">
	<!--头部内容开始-->
     {include file="header.tpl"}

    <!--头部内容结束-->

<div class="dqwz">您当前的位置：吃遍长沙美食网 > 美食地图 > 美食搜索</div>
	
    <div class="ssleft">
    	<div class="msq">
			<h3></h3>
			<ul class="p8">
				{section loop=$pfoods name=fsec}
				   <li>
				   <img src="styles/pic/search/list1.gif" class="mr7" />
				   <a href="search.php?word={$pfoods[fsec]['name']|urlencode}" target="_blank">{$pfoods[fsec]['name']}</a>
				   </li>
				{/section}
			</ul>
			<br /><br /><br />
		</div>
		
		<div class="blank9"></div>
		
		<div class="rmc">
			<h3></h3>
			<ul class="list p8">
			  {section loop=$hotwords name=hotwd}
				<li><a href="gsearch.php?word={$hotwords[hotwd]['word']|urlencode}">{$hotwords[hotwd]['word']}</a></li>
			  {/section}				
			</ul>
		</div>
		
    </div>
	
	<div class="sscenter">
    	<div class="gjc">
        <p>
        <a href="#"><img src="styles/pic/search/btn1.jpg" border="0" align="absmiddle" /></a> <a href="#"><img src="styles/pic/search/btn2.jpg" border="0" align="absmiddle" /></a>
        </p><br/>
			<p class="fht2">关键词"<span class="fht">{$word}</span>" 搜索结果<span class="fht">{$total}</span>条<span style="padding-left:130px"></span></p>
			<p class="pt10">搜索技巧： 一次可同时输入最多三个关键词,进行更人性化的复合搜索 </p>
		</div>
        
	   <form  action="search.php" method="post" enctype="application/x-www-form-urlencoded" target="_self">	
		<div class="jybss">
			<h3>进一步搜索</h3>
			<div class="content">
				<p>关键词 
				  <label>
				  <input name="word" type="text" id="word" 
                  style="width:200px; height:18px; font-size:14px; font-weight:bold;" value="{$word}" />
				  </label>
                  </p>
                  <br />
                  <p>
				  街道
			      <select name="street" id="street">
                    <option value="0">不限</option> 
			        {section name=street loop=$streets}
                       {assign var=sname value=$streets[street]['name']}
                       {if $street==$sname}
                       <option value="{$sname}" selected="selected">{$sname}</option>
                        {else}
                         <option value="{$sname}" >{$sname}</option>
                        {/if}
                    {/section}
                  </select>
			      标志建筑
			      <select name="build" id="build">
                      <option value="0">不限</option> 
                     {section name=building loop=$buildings}
                      {assign var=sname value=$buildings[building]['name']}
                       {if $build==$sname}
                       <option value="{$sname}" selected="selected">{$sname}</option>
                        {else}
                         <option value="{$sname}" >{$sname}</option>
                        {/if}
                    {/section}
                  </select>               
			      菜系 
			      <select name="cookstyle" id="cookstyle">
                   <option value="0">不限</option> 
                    {section name=cookstyle loop=$cookstyles}
                        {assign var=sname value=$cookstyles[cookstyle]['id']}
                        {if $cookstyleId==$sname}
                       		<option value="{$sname}" selected="selected">{$cookstyles[cookstyle]['name']}</option>
                        {else}
                         	<option value="{$sname}" >{$cookstyles[cookstyle]['name']}</option>
                        {/if}                      
                    {/section}
                  </select>
				</p>
				<p class="pt10">支　持
				            
			    人均消费：
			    <input type="text" name="pcc_min" style="width:30px" id="pcc_min" value="{$pccMin}" />     
			    到      
			    <input type="text" name="pcc_max" style="width:30px" id="pcc_max"  value="{$pccMax}"/>
			    元 ， 热门餐厅 
			    <input type="checkbox" name="hotShopper" value="checkbox" id="hotShopper" />
				</p>
				<p class="pt10">
                <label>
				能停车
				  <input type="checkbox" name="carport" value="1" id="carport" />
				  ,    
				  </label>
                  
                  <label>
                   有包厢    
				  <input type="checkbox" name="ledge" value="1" id="ledge" />
				  ,</label>
                  
                  <label> 能刷卡
				  <input type="checkbox" name="swiping_card" value="1" id="swiping_card" />    
				  ,</label>
                  <label>
                  无线上网
				  <input type="checkbox" name="wireless" value="1" id="wireless" />
				  ,     
				  </label>
                  <label>
                   有外卖    
				  <input type="checkbox" name="take_out" value="1" id="take_out" />
				  ,</label>
                  <label>
                  夜宵
				  <input type="checkbox" name="souper" value="1" id="souper" />
                  </label>
                  
</p>
				<div class="blank9"></div>
				<p class="pt10" align="center">
                <a href="javascript:;" onclick="document.forms[0].submit();"><img src="styles/pic/search/btn3.jpg" border="0" /></a>　<a href="javascript:;"  onclick="document.forms[0].reset();"><img src="styles/pic/search/btn4.jpg" border="0" /></a></p>
				<div class="blank9"></div>
		  </div>
		</div>
        <input type="hidden" name="from" value="search" />
		</form>
		<div class="blank9"></div>
		<p class="p8"><span class="right"><select name="psort" id="psort">
      		  <option value="-1">请选择排序方式...</option>
              <option value="desc">人均消费从高到低</option>
              <option value="asc">人均消费从低到高</option>
		</select></span><img src="styles/pic/search/list2.gif" />勾选商家进行对比
		<div class="clear"></div>
		</p>
		
		
		<div class="fy">
        <div id="pageNav"> 显示第{$start}-{$start+10} 条记录，共 {$total} 条记录
        <a href="javascript:;" id="first" >首页</a> 
        <span class="orange">
        <a href="javascript:;" id="prev" >前页</a>
        </span> 
        <span  class="orange">
        <a href="javascript:;"  id="next" >后页</a>
        </span> 
        <a href="javascript:;"  id="last" >尾页</a> 
        <label>到第
		  <select name="page">
		    {section loop=$totalPages name=psec}
                {assign var=currentPage value=$smarty.section.psec.index+1}
                {if  $currentPage==$page}
                <option value="{$currentPage}" selected="true">{$currentPage}</option>
                {else}
                <option value="{$currentPage}" >{$currentPage}</option>
                {/if}
            {/section}	    
	      </select>
		  </label>       
	    页，共 {$totalPages} 页
		</div>
          </div>
		
        {foreach from=$qShoppers key=skey item=shopper}
		<div class="cxlist">
			<div class="pic">
				<img src="{$shopper['shopImage']}" />
				<p align="center">
				  <input type="checkbox" name="comp" value="{$shopper['id']}" />
				</p>
			</div>
			<div class="text">
				<dl>
					<dt class="orange"><span>人均消费：{$shopper['pccmin']}～{$shopper['pccmax']}</span>
                    <a href="shopper.php?id={$shopper['id']}" target="_blank">{$shopper['name']}</a></dt>
					<dd>
                    {$shopper['instro']}
                    </dd>
					<dd><span class="orange">电话：</span>{$shopper['phone']}</dd>
					<dd><span class="orange">地址：</span>{$shopper['address']}</dd>
					
				</dl>
		  </div>
			<div class="clear"></div>	
		</div>
		{/foreach}		
		
    </div>
	
	<div class="ssright">
    	<img src="styles/pic/search/rban1.jpg" />
		<div class="blank9"></div>
		<img src="styles/pic/search/rban2.jpg" />
		<div class="blank9"></div>
		
		<div class="duib">
			<h3><input type="checkbox" name="checkbox232" value="checkbox" />对比选中的商家</h3>
			<p align="center">请从左侧选择要对比的商家 </p>
			<p align="center"><a href="#"><img src="styles/pic/search/btn5.jpg" border="0" /></a></p>
			<div class="blank9"></div>
	  </div>
	  
	  <div class="blank9"></div>
	  <div class="rdtj">
	  		<h3><span>热店推荐</span></h3>
	  		{section loop=$hotshoppers name=hots}
			<dl>
				<dt><a href="shopper.php?id={$hotshoppers[hots]['id']}">{$hotshoppers[hots]['name']}</a></dt>
				<dd class="pic"><img style="width:98px;height:75px" src="{$hotshoppers[hots]['shopImage']}" /></dd>
				<dd class="txt1 orange">人均：{$hotshoppers[hots]['pcc_min']}~{$hotshoppers[hots]['pcc_max']}</dd>
				<dd class="txt1">人气：<span class="red">{$hotshoppers[hots]['moods']}</span></dd>
			</dl>
			<div class="clear"></div>
			{/section}			
	  </div>
		
    </div>    
   {include_php file="footer.php"}
    
</div>
</body>
</html>
