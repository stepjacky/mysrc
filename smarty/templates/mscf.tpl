<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>吃遍长沙美食网-美食厨房</title>
<link href="styles/home/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="main">
	<!--头部内容开始-->
   {include file="header.tpl"}

    <!--头部内容结束-->
    <div class="dqwz">您当前的位置：吃遍长沙美食网 > 美食厨房 </div>
    
    <!--美食搜索内容开始-->
    <div class="mscfSearch">
    	<span><a href="#"><img align="absmiddle" src="styles/pic/mscfBtn1.jpg"/></a></span>
        <span><input name="textfield2" type="text" class="mscfInput1" id="textfield2" value="请输入搜索条件" /></span>
      	<span><a href="#"><img align="absmiddle" src="styles/pic/mscfBtn2.jpg"/></a></span>
        <span>搜索向导：分别按 <i class="red">菜系/原料/口味/工艺</i> 搜索菜谱</span>
    </div>
    <!--美食搜索内容结束-->
    <div class="blank9"></div>
    
    
    <!--栏目Ａ内容开始-->
    <div class="msColA">
    <div class="zxcp">
        	<h3><a href="#">更多>></a></h3>
            <div class="blank9"></div>
    	<ul class="cplist">
                <li>
                <img src="styles/pic/mscf/colAban2.jpg" />
                {$artitles['a'][0]['remark']}...
                <span class="orange">
                	<a href="artitle.php?id={$artitles['a'][0]['artid']}" target="_blank">[阅读详情]</a>
                </span>
                </li>
                
                <li class="pt10">
                <img src="styles/pic/mscf/colAban3.jpg" />
                {$artitles['a'][1]['remark']}...
                <span class="orange">
        			<a href="artitle.php?id={$artitles['a'][1]['artid']}" target="_blank">[阅读详情]</a>
                </span>
                </li>
        </ul>
      </div>
        
      <div class="cfbd">
        	<h3 class="white"><a href="#">更多>></a></h3>
            <div class="content">
            	<ul class="list2">
                    {section loop=$artitles['b'] name=badsec max=8}
                    
                    <li>·<a href="artitle.php?id={$artitles['b'][badsec]['artid']}" target="_blank">
                      {$artitles['b'][badsec]['arttitle']}
                    </a></li>
                    
                    {/section}
				</ul>    
            </div>
      </div>
        
        <div class="colZt">
            <a href="{$ad['href']}" target="_blank">
        	    <img src="{$ad['image']|default:'styles/pic/mscf/colAban1.jpg'}" style="width:206px; height:265px" />
            </a>
        </div>
        
        <div class="blank9"></div>
    </div>
    
    <!--栏目Ａ内容结束-->
    
    
     <!--栏目B内容开始-->
     <div class="msColB">
     	<div class="msColBTit1">
        	<h3><span><a href="#">更多>></a></span>{$artitles['c'][0]['cataname']|default:'该类无文章'}</h3>
            <div class="blank9"></div>
            <ul class="cplist">
            
            {section loop=$artitles['c'] name=eastart max=5}
                        
            <li>
            <img src="styles/pic/mscf/colAban2.jpg" />
            <span class="f14 orange">{$artitles['c'][eastart]['arttitle']}</span><br />
                {$artitles['c'][eastart]['remark']} ... 
                <span class="orange">
                <a href="artitle.php?id={$artitles['c'][eastart]['artid']}">[查看详情]</a></span></li>
                <div class="blank5"></div>
             {/section}   
                
        </ul>
        <div class="clear"></div>
        </div>
        
        <div class="msColBTit2">
        	<h3><span><a href="#">更多>></a></span>{$artitles['d'][0]['cataname']|default:'该类无文章'}</h3>
            <div class="blank9"></div>
            <ul class="cplist">
            {section loop=$artitles['d'] name=westart max=5}
                        
            <li>
            <img src="styles/pic/mscf/colAban2.jpg" />
            <span class="f14 orange">{$artitles['d'][westart]['arttitle']}</span><br />
                {$artitles['d'][westart]['remark']} ... 
                <span class="orange">
                <a href="artitle.php?id={$artitles['d'][westart]['artid']}">[查看详情]</a></span></li>
                <div class="blank5"></div>
             {/section}   
        </ul>
        <div class="clear"></div>
        </div>
        
     </div>
     <div class="blank9"></div>
     <!--栏目B内容结束-->
     
     
     <!--栏目C内容结束-->
		<div class="msColCTit1 left mr7">
        	<h3>{$artitles['e'][0]['cataname']}</h3>
            <div class="content">
           	  <ul class="list">
               {section loop=$artitles['e'] name=eart max=6}
                        
            <li>
                ·<a href="artitle.php?id={$artitles['e'][eart]['artid']}">{$artitles['e'][eart]['arttitle']}</a>
                </li>
                
             {/section}   
                </ul>
                <p class="img" align="center"><img src="styles/pic/mscf/colCban1.jpg" style=" padding-bottom:5px" />
                <br />
                <a href="artitle.php?id={$artitles['e'][6]['artid']}">{$artitles['e'][6]['arttitle']}</a>
               </p>
                <div class="clear"></div>
            </div>
        </div>
        
        
        <div class="msColCTit1 left">
        	<h3>{$artitles['f'][0]['cataname']}</h3>
            <div class="content">
           	  <ul class="list">
                 {section loop=$artitles['f'] name=fart max=6}
                        
            <li>
                ·<a href="artitle.php?id={$artitles['f'][fart]['artid']}">{$artitles['f'][fart]['arttitle']}</a>
                </li>
                
             {/section}   
                </ul>
                <p class="img" align="center"><img src="styles/pic/mscf/colCban1.jpg" style=" padding-bottom:5px" />
                <br />
                <a href="artitle.php?id={$artitles['f'][6]['artid']}">{$artitles['f'][6]['arttitle']}</a>
               </p>
                <div class="clear"></div>
            </div>
        </div>
        
        
        <div class="msColCTit1 right">
        	<h3>{$artitles['g'][0]['cataname']}</h3>
            <div class="content">
           	  <ul class="list">
                	 {section loop=$artitles['g'] name=gart max=6}
                        
            <li>
                ·<a href="artitle.php?id={$artitles['g'][gart]['artid']}">{$artitles['g'][gart]['arttitle']}</a>
                </li>
                
             {/section}   
                </ul>
                <p class="img" align="center"><img src="styles/pic/mscf/colCban1.jpg" style=" padding-bottom:5px" />
                <br />
                <a href="artitle.php?id={$artitles['g'][6]['artid']}">{$artitles['g'][6]['arttitle']}</a>
               </p>
                <div class="clear"></div>
            </div>
        </div>
     <!--栏目C内容结束-->
    
    
     {include_php file="footer.php"}
    
    
</div>
</body>
</html>
