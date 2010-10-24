<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>吃遍长沙美食网-精彩食尚</title>
<link href="styles/home/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="main">
	<!--头部内容开始-->
    {include file="header.tpl"}

    <!--头部内容结束-->
    
    <div class="dqwz">您当前的位置：吃遍长沙美食网 > 精彩食尚 </div>
    <div><img src="styles/pic/jcmsBanner.jpg"/></div>
    <div class="blank9"></div>
	
    <div>
    	<div class="flashPic">
              <SCRIPT language=javascript src="scripts/home/portal_flash.php" type=text/javascript></SCRIPT>
        </div>
        <div class="jcssTip">
        	<dl class="sshot">
				<dt class="orange"><a href="artitle.php?id={$artitles['z'][0]['artid']}" target="_blank">{$artitles['z'][0]['arttitle']}</a></dt>
				<dd>{$artitles['z'][0]['remark']}...  <span class="orange"><a href="artitle.php?id={$artitles['z'][0]['artid']}" target="_blank">[阅读详情]</a></span></dd>
			</dl>
			<div class="blank9"></div>
			<ul class="sslist left">
            {section loop=$artitles['a'] name=asec max=5}
				<li>·<a href="artitle.php?id={$artitles['a'][asec]['artid']}" target="_blank">
                {$artitles['a'][asec]['arttitle']}</a></li>
			{/section}
			</ul>
			<ul class="sslist right">
				 {section loop=$artitles['b'] name=bsec max=5}
				<li>·<a href="artitle.php?id={$artitles['b'][bsec]['artid']}" target="_blank">
                {$artitles['b'][bsec]['arttitle']}</a></li>
			{/section}
			</ul>
            <div class="clear"></div>
        </div>
        <div class="msHot">
			<ul class="sslist">
				 {section loop=$artitles['c'] name=csec max=5}
				<li>·<a href="artitle.php?id={$artitles['c'][csec]['artid']}" target="_blank">
                {$artitles['c'][csec]['arttitle']}</a></li>
			{/section}
			</ul>
		</div>
		<div class="clear"></div>
    </div>
    
    <div class="blank9"></div>
	
	<div class="yyms">
		<h3>{$artitles['d'][0]['cataname']}</h3>
		<ul>
			 {section loop=$artitles['d'] name=dsec max=6}
            <li>
            <a href="artitle.php?id={$artitles['d'][dsec]['artid']}" target="_blank">
            <img src="{$artitles['d']['artimage']|default:'styles/pic/yymsPic1.jpg'}" style=" width:120px; height:90px"/>
            <p class="txt">{$artitles['d'][dsec]['arttitle']}</p>
            </a>
            </li>
            {/section}			
		</ul>
	</div>
    
    <div class="blank9"></div>
    
<div class="ssmsTab left mr7">
    	<h3><span><a href="catalogartitle.php?id={$artitles['e'][0]['cataid']}" target="_blank">更多>></a></span>{$artitles['e'][0]['cataname']}</h3>
        <dl>
            	<dd class="img"><img src="{$artitles['e'][0]['artimage']|default:'styles/pic/ssmsPic1.jpg'}" /></dd>
           	  	<dt><b><a href="artitle.php?id={$artitles['e'][0]['artid']}" target="_blank">{$artitles['e'][0]['arttitle']}</a></b><br/>{$artitles['e'][0]['remark']}...</dt>                
        </dl>
        <ul class="list2 f14 pL15">
          {section loop=$artitles['e'] start=1 name=esec max=7}
            <li>·
            <a href="artitle.php?id={$artitles['e'][esec]['artid']}" target="_blank">
                     {$artitles['e'][esec]['arttitle']}
            </a>
            </li>
          {/section}	
        
			
		</ul>            
    </div>
    
<div class="ssmsTab left">
    	<h3><span><a href="catalogartitle.php?id={$artitles['f'][0]['cataid']}" target="_blank">更多>></a></span>{$artitles['f'][0]['cataname']}</h3>
        <dl>
            	<dd class="img"><img src="{$artitles['f'][0]['artimage']|default:'styles/pic/ssmsPic1.jpg'}" /></dd>
           	  	<dt><b><a href="artitle.php?id={$artitles['f'][0]['artid']}" target="_blank">{$artitles['f'][0]['arttitle']}</a></b><br/>{$artitles['f'][0]['remark']}...</dt>                
        </dl>
        <ul class="list2 f14 pL15">
          {section loop=$artitles['f'] start=1 name=fsec max=7}
            <li>·
            <a href="artitle.php?id={$artitles['f'][fsec]['artid']}" target="_blank">
                     {$artitles['f'][fsec]['arttitle']}
            </a>
            </li>
          {/section}         
    </div>
    
    
<div class="ssmsTab right">
    	<h3><span><a href="catalogartitle.php?id={$artitles['g'][0]['cataid']}" target="_blank">更多>></a></span>{$artitles['g'][0]['cataname']}</h3>
        <dl>
            	<dd class="img"><img src="{$artitles['g'][0]['artimage']|default:'styles/pic/ssmsPic1.jpg'}" /></dd>
           	  	<dt><b><a href="artitle.php?id={$artitles['g'][0]['artid']}" target="_blank">{$artitles['g'][0]['arttitle']}</a></b><br/>{$artitles['g'][0]['remark']}...</dt>                
        </dl>
        <ul class="list2 f14 pL15">
          {section loop=$artitles['g'] start=1 name=gsec max=7}
            <li>·
            <a href="artitle.php?id={$artitles['g'][gsec]['artid']}" target="_blank">
                     {$artitles['g'][gsec]['arttitle']}
            </a>
            </li>
          {/section}      
    </div>
    
    <div class="blank9"></div>
    
    
    
     
    
    <div class="ssmsTab left mr7">
    	<h3><span><a href="catalogartitle.php?id={$artitles['h'][0]['cataid']}" target="_blank">更多>></a></span>{$artitles['h'][0]['cataname']}</h3>
        <dl>
            	<dd class="img"><img src="{$artitles['h'][0]['artimage']|default:'styles/pic/ssmsPic1.jpg'}" /></dd>
           	  	<dt><b><a href="artitle.php?id={$artitles['h'][0]['artid']}" target="_blank">{$artitles['h'][0]['arttitle']}</a></b><br/>{$artitles['h'][0]['remark']}...</dt>                
        </dl>
        <ul class="list2 f14 pL15">
          {section loop=$artitles['h'] start=1 name=hsec max=7}
            <li>·
            <a href="artitle.php?id={$artitles['h'][hsec]['artid']}" target="_blank">
                     {$artitles['h'][hsec]['arttitle']}
            </a>
            </li>
          {/section}      
    </div>
    
    <div class="ssmsTab left">
    	<h3><span><a href="catalogartitle.php?id={$artitles['i'][0]['cataid']}" target="_blank">更多>></a></span>{$artitles['i'][0]['cataname']}</h3>
        <dl>
            	<dd class="img"><img src="{$artitles['i'][0]['artimage']|default:'styles/pic/ssmsPic1.jpg'}" /></dd>
           	  	<dt><b><a href="artitle.php?id={$artitles['i'][0]['artid']}" target="_blank">{$artitles['i'][0]['arttitle']}</a></b><br/>{$artitles['i'][0]['remark']}...</dt>                
        </dl>
        <ul class="list2 f14 pL15">
          {section loop=$artitles['i'] start=1 name=isec max=7}
            <li>·
            <a href="artitle.php?id={$artitles['i'][isec]['artid']}" target="_blank">
                     {$artitles['i'][isec]['arttitle']}
            </a>
            </li>
          {/section}    
    </div>
    
    
    <div class="ssmsTab right">
    	<h3><span><a href="catalogartitle.php?id={$artitles['j'][0]['cataid']}" target="_blank">更多>></a></span>{$artitles['j'][0]['cataname']}</h3>
        <dl>
            	<dd class="img"><img src="{$artitles['j'][0]['artimage']|default:'styles/pic/ssmsPic1.jpg'}" /></dd>
           	  	<dt><b><a href="artitle.php?id={$artitles['j'][0]['artid']}" target="_blank">{$artitles['j'][0]['arttitle']}</a></b><br/>{$artitles['j'][0]['remark']}...</dt>                
        </dl>
        <ul class="list2 f14 pL15">
          {section loop=$artitles['j'] start=1 name=jsec max=7}
            <li>·
            <a href="artitle.php?id={$artitles['j'][jsec]['artid']}" target="_blank">
                     {$artitles['j'][jsec]['arttitle']}
            </a>
            </li>
          {/section}        
    </div>
    
    {include_php file="footer.php"}
    
    
    
</div>
</body>
</html>
