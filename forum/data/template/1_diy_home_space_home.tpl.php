<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_home');
0
|| checktplrefresh('./template/default/home/space_home.htm', './template/default/common/header.htm', 1286714433, 'diy', './data/template/1_diy_home_space_home.tpl.php', './template/default', 'home/space_home')
|| checktplrefresh('./template/default/home/space_home.htm', './template/default/home/space_userabout.htm', 1286714433, 'diy', './data/template/1_diy_home_space_home.tpl.php', './template/default', 'home/space_home')
|| checktplrefresh('./template/default/home/space_home.htm', './template/default/common/footer.htm', 1286714433, 'diy', './data/template/1_diy_home_space_home.tpl.php', './template/default', 'home/space_home')
|| checktplrefresh('./template/default/home/space_home.htm', './template/default/common/header_common.htm', 1286714433, 'diy', './data/template/1_diy_home_space_home.tpl.php', './template/default', 'home/space_home')
;?>
<? if(empty($diymode)) { ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=CHARSET?>" />
<title><? if(!empty($navtitle)) { ?><?=$navtitle?> - <? } if(empty($nobbname)) { ?> <?=$_G['setting']['bbname']?> - <? } ?> Powered by Discuz!</title>
<?=$_G['setting']['seohead']?>

<meta name="keywords" content="<? if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<? if(!empty($metadescription)) { echo htmlspecialchars($metadescription); ?> <? } ?>,<?=$_G['setting']['bbname']?>" />
<meta name="generator" content="Discuz! <?=$_G['setting']['version']?>" />
<meta name="author" content="Discuz! Team and Comsenz UI Team" />
<meta name="copyright" content="2001-2010 Comsenz Inc." />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<base href="<?=$_G['siteurl']?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_home_space.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?><script type="text/javascript">var STYLEID = '<?=STYLEID?>', STATICURL = '<?=STATICURL?>', IMGDIR = '<?=IMGDIR?>', VERHASH = '<?=VERHASH?>', charset = '<?=CHARSET?>', discuz_uid = '<?=$_G['uid']?>', cookiepre = '<?=$_G['config']['cookie']['cookiepre']?>', cookiedomain = '<?=$_G['config']['cookie']['cookiedomain']?>', cookiepath = '<?=$_G['config']['cookie']['cookiepath']?>', showusercard = '<?=$_G['setting']['showusercard']?>', attackevasive = '<?=$_G['config']['security']['attackevasive']?>', disallowfloat = '<?=$_G['setting']['disallowfloat']?>', creditnotice = '<? if($_G['setting']['creditnotice']) { ?><?=$_G['setting']['creditnames']?><? } ?>', defaultstyle = '<?=$_G['style']['defaultextstyle']?>', REPORTURL = '<?=$_G['currenturl_encode']?>', SITEURL = '<?=$_G['siteurl']?>';</script>
<script src="<?=$_G['setting']['jspath']?>common.js?<?=VERHASH?>" type="text/javascript"></script><? if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?><?=$rsshead?><? } if($_G['basescript'] == 'forum') { if(!empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
<link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_<?=STYLEID?>_widthauto.css?<?=VERHASH?>" />
<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
<? } ?>
<script src="<?=$_G['setting']['jspath']?>forum.js?<?=VERHASH?>" type="text/javascript"></script>
<? } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="<?=$_G['setting']['jspath']?>home.js?<?=VERHASH?>" type="text/javascript"></script>
<? } elseif($_G['basescript'] == 'portal') { ?>
<script src="<?=$_G['setting']['jspath']?>portal.js?<?=VERHASH?>" type="text/javascript"></script>
<? } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<script src="<?=$_G['setting']['jspath']?>portal.js?<?=VERHASH?>" type="text/javascript"></script>
<? } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_css_diy.css?<?=VERHASH?>" />
<? } ?>
</head>

<body id="nv_<?=$_G['basescript']?>" class="pg_<?=CURMODULE?>" onkeydown="if(event.keyCode==27) return false;">
<? if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?=STATICURL?>image/diy/panel-toggle.png" alt="DIY" /></a>
<? } ?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<? if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><div id="hd">
<div class="wp">
<div class="hdc cl">
<h2><a href="./" title="<?=$_G['setting']['bbname']?>"><?=BOARDLOGO?></a></h2>

<? if($_G['uid']) { ?>
<div id="um">
<div class="avt y"><a href="home.php?mod=space&amp;uid=<?=$_G['uid']?>" c="34"><?php echo avatar($_G[uid],small); ?></a></div>
<p>
<strong><a href="home.php?mod=space&amp;uid=<?=$_G['uid']?>" class="vwmy" target="_blank" title="访问我的空间"><?=$_G['member']['username']?></a></strong>
<? if($_G['group']['allowinvisible']) { ?>
<span id="loginstatus" class="xg1">
<a href="member.php?mod=switchstatus" title="切换在线状态" onclick="ajaxget(this.href, 'loginstatus');doane(event);">
<? if($_G['session']['invisible']) { ?>
隐身
<? } else { ?>
在线
<? } ?>
</a>
</span>
<? } ?>
<span class="pipe">|</span><span id="usersetup" class="showmenu" onmouseover="showMenu(this.id);"><a href="home.php?mod=spacecp">设置</a></span>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1']; ?>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=notice" id="myprompt"<? if($_G['member']['newprompt']) { ?> class="new"<? } ?>>提醒<? if($_G['member']['newprompt']) { ?>(<?=$_G['member']['newprompt']?>)<? } ?></a><span id="myprompt_check"></span>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<? if($_G['member']['newpm']) { ?> class="new"<? } ?>>短消息<? if($_G['member']['newpm']) { ?>(<?=$_G['member']['newpm']?>)<? } ?></a>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=friend">好友</a> <? if($_G['setting']['regstatus'] > 1) { ?><a href="home.php?mod=spacecp&amp;ac=invite" class="xg1">邀请</a> <? } if($_G['setting']['taskon']) { ?>
<span class="pipe">|</span>
<? if(empty($_G['cookie']['taskdoing_'.$_G['uid']])) { ?>
<a href="home.php?mod=task&amp;item=new">任务</a>
<? } else { ?>
<a href="home.php?mod=task&amp;item=doing" id="task_ntc" class="new">进行中的任务</a>
<? } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2']; if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || $_G['group']['allowauthorizedblock'] || $_G['group']['allowauthorizedarticle']) { ?>
<span class="pipe">|</span><a href="portal.php?mod=portalcp">门户管理</a>
<? } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
<span class="pipe">|</span><a href="forum.php?mod=modcp&amp;fid=<?=$_G['fid']?>" target="_blank"><?=$_G['setting']['navs']['2']['navname']?>管理</a>
<? } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?>
<span class="pipe">|</span><a href="admin.php" target="_blank">管理中心</a>
<? } ?>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?=FORMHASH?>">退出</a>
</p>
<p><?php $upgradecredit = $_G['uid'] && $_G['group']['grouptype'] == 'member' && $_G['group']['groupcreditslower'] != 999999999 ? $_G['group']['groupcreditslower'] - $_G['member']['credits'] : false; ?>积分: <a href="home.php?mod=spacecp&amp;ac=credit"><?=$_G['member']['credits']?></a><? if(is_array($_G['setting']['extcredits'])) foreach($_G['setting']['extcredits'] as $extcreditid => $extcredit) { if(empty($extcredit['hiddeninheader'])) { ?> , <?=$extcredit['img']?><?=$extcredit['title']?>: <a href="home.php?mod=spacecp&amp;ac=credit" id="hcredit_<?=$extcreditid?>"><? echo getuserprofile('extcredits'.$extcreditid);; ?></a> <?=$extcredit['unit']?><? } } ?> , 用户组: <a href="home.php?mod=spacecp&amp;ac=usergroup"<? if($upgradecredit !== 'false') { ?> id="g_upmine" class="xi2" onmouseover="showMenu({'ctrlid':this.id, 'pos':'21'});"<? } ?>><?=$_G['group']['grouptitle']?></a>
</p>
</div>
<? } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<p>
<strong><a id="loginuser" class="noborder"><?=$_G['cookie']['loginuser']?></a></strong>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);hideWindow('register');">激活</a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?=FORMHASH?>">退出</a>
</p>
<? } else { include template('member/login_simple'); } ?>
</div>

<? if(!IS_ROBOT) { ?>
<div id="qmenu_menu" class="p_pop" style="display: none; zoom: 1;">
<? if($_G['uid']) { ?>
<ul><? if(is_array($_G['setting']['mynavs'])) foreach($_G['setting']['mynavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
<li><?=$nav['code']?></li>
<? } } ?>
</ul>
<? if(!empty($_G['style']['extstyle'])) { ?>
<div class="sslct cl">
<? if(!$_G['style']['defaultextstyle']) { ?><span class="sslct_btn" onclick="extstyle('')" title="默认"><i>&nbsp;</i></span><? } if(is_array($_G['style']['extstyle'])) foreach($_G['style']['extstyle'] as $extstyle) { ?><span class="sslct_btn" onclick="extstyle('<?=$extstyle['0']?>')" title="<?=$extstyle['1']?>"><i style='background:<?=$extstyle['2']?>'>&nbsp;</i></span>
<? } ?>
</div>
<? } } else { ?>
<p class="reg_tip">
<a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="showWindow('register', this.href)" class="xi2">注册新用户，开通自己的个人中心</a>
</p>
<? } if($_G['basescript'] == 'forum' && empty($_G['disabledwidthauto'])) { ?>
<ul class="wslct">
<li><a href="javascript:;" onclick="widthauto(this)"><? if(empty($_G['cookie']['widthauto'])) { ?>切换到宽版<? } else { ?>切换到窄版<? } ?></a></li>
</ul>
<? } ?>
</div>
<? } ?>

<div id="nv">
<a href="<? if($_G['uid']) { ?>home.php<? } else { ?>javascript:;<? } ?>" id="qmenu" onmouseover="showMenu(this.id)">我的中心</a>
<ul><?php $mnid = getcurrentnav(); if(is_array($_G['setting']['navs'])) foreach($_G['setting']['navs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?><li <? if($mnid == $nav['navid']) { ?>class="a" <? } ?><?=$nav['nav']?>></li><? } } ?>
</ul>
</div>
<? if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
<ul class="p_pop h_pop" id="plugin_menu" style="display: none"><? if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { ?> <? if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
 <li><?=$module['url']?></li>
 <? } } ?>
</ul>
<? } ?>
<?=$_G['setting']['menunavs']?>
<div id="mu" class="cl">
<? if($_G['setting']['subnavs']) { if(is_array($_G['setting']['subnavs'])) foreach($_G['setting']['subnavs'] as $navid => $subnav) { if($_G['setting']['navsubhover'] || $mnid == $navid) { ?>
<ul class="cl <? if($mnid == $navid) { ?>current<? } ?>" id="snav_<?=$navid?>" style="display:<? if($mnid != $navid) { ?>none<? } ?>">
<?=$subnav?>
</ul>
<? } } } ?>
</div><?php echo adshow("subnavbanner/a_mu"); ?></div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>

<div id="wp" class="wp"><?php echo adshow("text/wp a_t"); ?><style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct3_a wp cl">
<div class="appl"><? include template('common/userabout'); ?></div>
<!--/sidebar-->
<div class="sd">
<div class="drag">
<!--[diy=diysidetop]--><div id="diysidetop" class="area"></div><!--[/diy]-->
</div>
<? if($_G['setting']['taskon'] && !empty($task) && is_array($task)) { ?>
<div class="bm">
<div class="bm_c">
<p class="pbm">您好，<?=$_G['username']?>，欢迎加入我们。有新任务等着您，挺简单的，赶快来参加吧</p>
<hr class="da m0" />
<dl class="xld cl">
<dd class="m"><img src="<?=$task['icon']?>" width="64" height="64" alt="Icon" /></dd>
<dt><a href="home.php?mod=task&amp;do=view&amp;id=<?=$task['taskid']?>"><?=$task['name']?></a></dt>
<dd>
<p><?=$task['description']?></p>
</dd>
</dl>
</div>
</div>
<? } ?>
<div class="drag">
<!--[diy=diymagictop]--><div id="diymagictop" class="area"></div><!--[/diy]-->
</div>
<? if(!empty($magic) && is_array($magic)) { ?>
<div class="bm">
<div class="bm_c">
<dl class="xld cl">
<dd class="m"><img src="<?=STATICURL?>/image/magic/<?=$magic['pic']?>" alt="<?=$magic['name']?>" title="<?=$magic['description']?>" /></dd>
<dt><?=$magic['name']?></strong></dt>
<dd>
<p class="xg1" title="<?=$magic['description']?>"><?=$magic['description']?></p>
<p>售价
<? if($_G['setting']['extcredits'][$magic['credit']]['unit']) { ?>
<strong class="xi1"><?=$_G['setting']['extcredits'][$magic['credit']]['title']?> <?=$magic['price']?> <?=$_G['setting']['extcredits'][$magic['credit']]['unit']?>/张</strong>
<? } else { ?>
<strong class="xi1"><?=$magic['price']?> <?=$_G['setting']['extcredits'][$magic['credit']]['title']?>/张</strong>
<? } ?>
</p>
<p>
<? if($magic['num'] > 0) { ?>
<a href="home.php?mod=magic&amp;action=shop&amp;operation=buy&amp;mid=<?=$magic['identifier']?>" onclick="showWindow('magics', this.href);return false;" class="xi2 xw1">购买</a>
<? if($_G['group']['allowmagics'] > 1) { ?>
<em class="pipe">|</em> <a href="home.php?mod=magic&amp;action=shop&amp;operation=give&amp;mid=<?=$magic['identifier']?>" onclick="showWindow('magics', this.href);return false;" class="xi2">赠送</a>
<? } } else { ?>
<span class="xg1">此道具缺货</span>
<? } ?>
</p>
</dd>
</dl>
</div>
</div>
<? } ?>
<div class="drag">
<!--[diy=diydefaultusertop]--><div id="diydefaultusertop" class="area"></div><!--[/diy]-->
</div>
<? if($defaultusers) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>好友推荐</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><? if(is_array($defaultusers)) foreach($defaultusers as $key => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<? if($ols[$value['uid']]) { ?>在线<? } ?>" class="avt">
<? if($ols[$value['uid']]) { ?><em class="gol"></em><? } ?><?php echo avatar($value[uid],small); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>"><?=$value['username']?></a></p>
</li>
<? } ?>
</ul>
</div>
</div>
<? } ?>

<div class="drag">
<!--[diy=diynewusertop]--><div id="diynewusertop" class="area"></div><!--[/diy]-->
</div>

<? if($showusers) { ?>
<div class="bm">
<div class="bm_h cl">
<span class="y">
<a href="misc.php?mod=ranklist&amp;type=member">全部</a>
</span>
<h2>竞价排名</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><? if(is_array($showusers)) foreach($showusers as $key => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<? if($ols[$value['uid']]) { ?>在线<? } ?>" class="avt">
<? if($ols[$value['uid']]) { ?><em class="gol"></em><? } ?><?php echo avatar($value[uid],small); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>"><?=$value['username']?></a></p>
<!--span><span title="<?=$value['credit']?>"><?=$value['credit']?></span></span-->
</li>
<? } ?>
</ul>
</div>
</div>
<? } if($newusers) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>新加入会员</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><? if(is_array($newusers)) foreach($newusers as $key => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<? if($ols[$value['uid']]) { ?>在线<? } ?>" class="avt">
<? if($ols[$value['uid']]) { ?><em class="gol"></em><? } ?><?php echo avatar($value[uid],small); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>"><?=$value['username']?></a></p>
<span><span title="<?=$value['regdate']?>"><?=$value['regdate']?></span></span>
</li>
<? } ?>
</ul>
</div>
</div>
<? } ?>

<div class="drag">
<!--[diy=diyvisitorlisttop]--><div id="diyvisitorlisttop" class="area"></div><!--[/diy]-->
</div>

<? if($visitorlist) { ?>
<div class="bm">
<div class="bm_h cl">
<span class="y">
<? if($_G['setting']['magicstatus'] && $_G['setting']['magics']['visit']) { ?>
<span class="xg1"><a id="a_magic_visit" href="home.php?mod=magic&amp;mid=visit" onclick="showWindow('magics',this.href,'get', 0)" style="padding-left: 18px; background: url(<?=STATICURL?>image/magic/visit.small.gif) no-repeat 0 50%;"><?=$_G['setting']['magics']['visit']?></a></span>
<? } ?>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend&amp;view=visitor">全部</a>
</span>
<h2>最近来访</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><? if(is_array($visitorlist)) foreach($visitorlist as $key => $value) { ?><li>
<? if($value['vusername'] == '') { ?>
<div class="avt"><img src="<?=STATICURL?>image/magic/hidden.gif" alt="匿名" /></div>
<p>匿名</p>
<span><?php echo dgmdate($value[dateline], 'u', 9999, $_G[setting][dateformat]); ?></span>
<? } else { ?>
<a href="home.php?mod=space&amp;uid=<?=$value['vuid']?>" title="<? if($ols[$value['vuid']]) { ?>在线<? } ?>" class="avt" c="1">
<? if($ols[$value['vuid']]) { ?><em class="gol"></em><? } ?><?php echo avatar($value[vuid],small); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?=$value['vuid']?>" title="<?=$value['vusername']?>"><?=$value['vusername']?></a></p>
<span><?php echo dgmdate($value[dateline], 'u', 9999, $_G[setting][dateformat]); ?></span>
<? } ?>
</li>
<? } ?>
</ul>
</div>
</div>
<? } ?>

<div class="drag">
<!--[diy=diysearchtop]--><div id="diysearchtop" class="area"></div><!--[/diy]-->
</div>

           <? if($_G['uid']) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>查找会员</h2>
</div>
<div id="sc" class="bm_c">
<form id="searchfriendform" action="home.php" method="get">
<input type="hidden" name="op" value="" />
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="search" />
<input type="hidden" name="type" value="all" />
<input type="hidden" name="searchsubmit" id="searchsubmit" value="true" />
<table cellspacing="0" cellpadding="0" class="shortsc">
<tr>
<td><a id="sctype" class="showmenu sc_display" onclick="showMenu(this.id);return false;" href="home.php?mod=spacecp&amp;ac=search" title="请选择搜索模式">用户名</a></td>
<td><input type="text" id="searchword" name="username" class="px xs1" value="请输入搜索内容" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" type="button" class="xw1" value="" onclick="sendSearchfriend();"><span>查找</span></button></td>
</tr>
</table>
</form>
</div>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul>
<li onclick="$('searchword').name = 'username';"><label for="searchselect_username" title="用户名" ><input type="radio" id="searchselect_username" class="pr" checked="checked" />用户名</label></li>
<li onclick="$('searchword').name = 'uid';"><label for="searchselect_uid" title="UID" ><input type="radio" id="searchselect_uid" class="pr" />UID</label></li>
</ul>
</div>
<script type="text/javascript">
initSearchmenu();
function sendSearchfriend() {
var sw = $('searchword');
var sf = $('searchfriendform');
if(sw.value != '请输入搜索内容') {
sf.submit(true);
} else {
window.location.href = 'home.php?mod=spacecp&ac=search';
}
}
</script>
</div>
            <? } ?>

<div class="drag">
<!--[diy=diyfriendtop]--><div id="diyfriendtop" class="area"></div><!--[/diy]-->
</div>

<? if($olfriendlist) { ?>
<div class="bm">
<div class="bm_h cl">
<span class="y">
<? if($_G['setting']['magicstatus'] && $_G['setting']['magics']['detector']) { ?>
<span class="xg1"><a id="a_magic_detector" href="home.php?mod=magic&amp;mid=detector" onclick="showWindow('magics',this.href,'get', 0)" style="padding-left: 18px; background: url(<?=STATICURL?>image/magic/detector.small.gif) no-repeat 0 50%;"><?=$_G['setting']['magics']['detector']?></a></span>
<? } ?>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=friend">全部</a>
</span>
<h2>我的好友</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><? if(is_array($olfriendlist)) foreach($olfriendlist as $key => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<? if($ols[$value['uid']]) { ?>在线<? } ?>" class="avt" c="1">
<? if($ols[$value['uid']]) { ?><em class="gol"></em><? } ?><?php echo avatar($value[uid],small); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>" title="<?=$value['username']?>"><?=$value['username']?></a></p>
<span><? if($value['lastactivity']) { ?><?php echo dgmdate($value[lastactivity], 'u', 9999, $_G[setting][dateformat]); } else { ?>热度(<?=$value['num']?>)<? } ?></span>
</li>
<? } ?>
</ul>
</div>
</div>
<? } ?>

<div class="drag">
<!--[diy=diybirthtop]--><div id="diybirthtop" class="area"></div><!--[/diy]-->
</div>

<? if($birthlist) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>好友生日提醒</h2>
</div>
<div class="bm_c">
<table cellpadding="2" cellspacing="4"><? if(is_array($birthlist)) foreach($birthlist as $key => $values) { ?><tr>
<td align="right" valign="top">
<? if($values['0']['istoday']) { ?>今天<? } else { ?><?=$values['0']['birthmonth']?>-<?=$values['0']['birthday']?><? } ?>
</td>
<td style="padding-left:10px;">
<ul><? if(is_array($values)) foreach($values as $value) { ?><li><a href="home.php?mod=space&amp;uid=<?=$value['uid']?>"><?=$value['username']?></a></li>
<? } ?>
</ul>
</td>
</tr>
<? } ?>
</table>
</div>
</div>
<? } ?>

<div class="drag">
<!--[diy=diysidebottom]--><div id="diysidebottom" class="area"></div><!--[/diy]-->
</div>

<?php if(!empty($_G['setting']['pluginhooks']['space_home_side_bottom'])) echo $_G['setting']['pluginhooks']['space_home_side_bottom']; ?>
</div>
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<? if($space['uid'] && $space['self']) { ?>
<div class="bm bw0">
<table cellpadding="0" cellspacing="0" class="mi mbm">
<tr>
<th>
<div class="avatar mbn"><?php echo avatar($_G[uid],middle); ?></div>
<p><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>" target="_blank" class="o xi2">访问我的空间</a></p>
</th>
<td>
<h3 class="xs2">
<span class="y xw0 xs1">已有 <em class="xi1"><?=$space['views']?></em> 人次访问</span>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"<?php g_color($space[groupid]); ?>><?=$space['username']?></a><?php g_icon($space[groupid]); ?></h3><? include template('home/space_status'); ?></td>
</tr>
</table>
<!--[diy=diycontentmiddle]--><div id="diycontentmiddle" class="area"></div><!--[/diy]-->
<?php if(!empty($_G['setting']['pluginhooks']['space_home_top'])) echo $_G['setting']['pluginhooks']['space_home_top']; if($space['newprompt']) { ?>
<ul class="mipm cl">
<? if($space['notifications']) { ?><li><img src="<?=STATICURL?>image/feed/notice.gif" alt="notice" class="vm" /> <a href="home.php?mod=space&amp;do=notice" class="xi2"><strong class="xi1"><?=$space['notifications']?></strong> 条通知</a></li><? } if($space['pendingfriends']) { ?><li><img src="<?=STATICURL?>image/feed/friend.gif" alt="friend" class="vm" /> <a href="home.php?mod=spacecp&amp;ac=friend&amp;op=request" class="xi2"><strong class="xi1"><?=$space['pendingfriends']?></strong> 个好友请求</a></li><? } if($space['groupinvitations']) { ?><li><img src="<?=STATICURL?>image/feed/mtag.gif" alt="mtag" class="vm" /> <a href="home.php?mod=space&amp;do=notice&amp;type=group" class="xi2"><strong class="xi1"><?=$space['groupinvitations']?></strong> 个<?=$_G['setting']['navs']['3']['navname']?>邀请</a></li><? } if($space['activityinvitations']) { ?><li><img src="<?=STATICURL?>image/feed/event.gif" alt="event" class="vm" /> <a href="home.php?mod=spacecp&amp;ac=event&amp;op=eventinvite" class="xi2"><strong class="xi1"><?=$space['activityinvitations']?></strong> 个活动邀请</a></li><? } if($space['myinvitations']) { ?><li><img src="<?=STATICURL?>image/feed/userapp.gif" alt="userapp" class="vm" /> <a href="home.php?mod=space&amp;do=notice&amp;view=userapp" class="xi2"><strong class="xi1"><?=$space['myinvitations']?></strong> 个应用消息</a></li><? } if($space['pokes']) { ?><li><img src="<?=STATICURL?>image/feed/poke.gif" alt="poke" class="vm" /> <a href="home.php?mod=spacecp&amp;ac=poke" class="xi2"><strong class="xi1"><?=$space['pokes']?></strong> 个新招呼</a></li><? } if($space['newpm']) { ?><li><img src="<?=STATICURL?>image/feed/pm.gif" alt="newpm" class="vm" /> <a href="home.php?mod=space&amp;do=pm" class="xi2"><strong class="xi1"><?=$space['newpm']?></strong> 个新短消息</a></li><? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_home_promptlink'])) echo $_G['setting']['pluginhooks']['space_home_promptlink']; ?>
</ul>
<? } ?>
</div><?php echo adshow("feed/bm"); ?><div class="bm bw0">
<ul class="tb cl">
<li<?=$actives['we']?>><a href="home.php?mod=space&amp;do=home&amp;view=we">好友的动态</a></li>
<li<?=$actives['me']?>><a href="home.php?mod=space&amp;do=home&amp;view=me">我的动态</a></li>
<li<?=$actives['all']?>><a href="home.php?mod=space&amp;do=home&amp;view=all">随便看看</a></li>
<?php if(!empty($_G['setting']['pluginhooks']['space_home_navlink'])) echo $_G['setting']['pluginhooks']['space_home_navlink']; if($_G['setting']['magicstatus'] && $_G['setting']['magics']['thunder']) { ?>
<li class="y"><a id="a_magic_thunder" href="home.php?mod=magic&amp;mid=thunder" onclick="showWindow('magics', this.href, 'get', 0)" style="padding-left: 18px; background: url(<?=STATICURL?>image/magic/thunder.small.gif) no-repeat 0 50%;"><?=$_G['setting']['magics']['thunder']?></a></li>
<? } ?>
</ul>

<? } else { ?>
<div class="bm bw0"><?php $_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=home&amp;view=me\">TA的近期动态</a>"; include template('home/space_menu'); } if($_GET['view'] == 'all') { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=home&amp;view=all&amp;order=dateline"<?=$orderactives['dateline']?>>最新动态</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=home&amp;view=all&amp;order=hot"<?=$orderactives['hot']?>>热点动态</a>
</p>
<? } elseif($groups) { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=home&amp;view=we"<?=$gidactives['-1']?>>全部好友</a><? if(is_array($groups)) foreach($groups as $key => $value) { ?><span class="pipe">|</span><a href="home.php?mod=space&amp;do=home&amp;view=we&amp;gid=<?=$key?>"<?=$gidactives[$key]?>><?=$value?></a><? } ?>
</p>
<? } } else { include template('home/space_header'); ?><div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm">
<div class="bm_h cl">
<h1 class="mt">动态</h1>
</div>
<div class="bm_c">
<? } ?>

<div id="feed_div" class="e">
<? if($hotlist) { ?>
<h4 class="et"><a href="home.php?mod=space&amp;do=home&amp;view=all&amp;order=hot" class="y xw0">查看更多热点 <em>&rsaquo;</em></a>近期热点推荐</h4>
<ul class="el"><? if(is_array($hotlist)) foreach($hotlist as $value) { ?><?php $value = mkfeed($value); include template('home/space_feed_li'); } ?>
</ul>
<? } if($list) { if(is_array($list)) foreach($list as $day => $values) { if($_GET['view']!='hot') { ?>
<h4 class="et">
<? if($day=='yesterday') { ?>昨天<? } elseif($day=='today') { ?>今天<? } else { ?><?=$day?><? } ?>
</h4>
<? } ?>

<ul class="el"><? if(is_array($values)) foreach($values as $value) { include template('home/space_feed_li'); } ?>
</ul>
<? } } elseif($feed_users) { ?>
<div class="xld xlda mtm"><? if(is_array($feed_users)) foreach($feed_users as $day => $users) { ?><h4 class="et">
<? if($day=='yesterday') { ?>昨天<? } elseif($day=='today') { ?>今天<? } else { ?><?=$day?><? } ?>
</h4><? if(is_array($users)) foreach($users as $user) { ?><?php $daylist = $feed_list[$day][$user[uid]]; ?><?php $morelist = $more_list[$day][$user[uid]]; ?><dl class="bbda cl">
<dd class="m avt">
<? if($user['uid']) { ?>
<a href="home.php?mod=space&amp;uid=<?=$user['uid']?>" target="_blank" c="1"><?php echo avatar($user[uid],small); ?></a>
<? } else { ?>
<img src="<?=IMGDIR?>/systempm.gif" />
<? } ?>
</dd>
<dd class="cl">
<ul class="el"><? if(is_array($daylist)) foreach($daylist as $value) { include template('home/space_feed_li'); } ?>
</ul>

<? if($morelist) { ?>
<p class="xg1 cl"><span onclick="showmore('<?=$day?>', '<?=$user['uid']?>', this);" class="unfold">展开</span></p>
<div id="feed_more_div_<?=$day?>_<?=$user['uid']?>" style="display:none;">
<ul class="el"><? if(is_array($morelist)) foreach($morelist as $value) { include template('home/space_feed_li'); } ?>
</ul>
</div>
<? } ?>
</dd>
</dl>
<? } } ?>
</div>
<? } else { ?>
<p class="emp">还没有相关动态</p>
<? } if($filtercount) { ?>
<div class="i" id="feed_filter_notice_<?=$start?>">
根据你的<a href="home.php?mod=spacecp&amp;ac=privacy&amp;op=filter" target="_blank" class="xi2 xw1">筛选设置</a>,有 <?=$filtercount?> 条动态被屏蔽 (<a href="javascript:;" onclick="filter_more(<?=$start?>);" id="a_feed_privacy_more" class="xi2">点击查看</a>)
</div>
<div id="feed_filter_div_<?=$start?>" style="display:none;">
<h4 class="et">以下是被屏蔽的动态</h4>
<ul class="el"><? if(is_array($filter_list)) foreach($filter_list as $value) { include template('home/space_feed_li'); } ?>
<li><a href="javascript:;" onclick="filter_more(<?=$start?>);">&laquo; 收起</a></li>
</ul>
</div>
<? } ?>

</div>
<!--/id=feed_div-->

<? if(empty($diymode)) { if($multi) { ?>
<div class="pgs cl mtm"><?=$multi?></div>
<? } ?>

<?php if(!empty($_G['setting']['pluginhooks']['space_home_bottom'])) echo $_G['setting']['pluginhooks']['space_home_bottom']; ?>
<div id="ajax_wait"></div>
</div>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
</div>
<!--/content-->
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>

<? } else { if($count==$perpage) { ?>
<div class="pgs cl"><div class="pg"><a href="javascript:;" onclick="feed_more();" id="a_feed_more">查看更多动态</a></div></div>
<? } ?>
</div>
</div>
</div>
<div class="sd"><div id="pcd" class="bm cl">
<div class="hm">
<p><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?php echo avatar($space[uid],middle); ?></a></p>
<h2 class="xs2"><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?=$space['username']?></a></h2>
</div>
<ul class="xl xl2 cl ul_list">
<? if($space['self']) { ?>
<li class="ul_diy"><a href="home.php?mod=space&amp;diy=yes">装扮空间</a></li>
<li class="ul_msg"><a href="home.php?mod=space&amp;do=wall">查看留言</a></li>
<li class="ul_avt"><a href="home.php?mod=spacecp&amp;ac=avatar">编辑头像</a></li>
<li class="ul_profile"><a href="home.php?mod=spacecp&amp;ac=profile">更新资料</a></li>
<? } else { ?><?php require_once libfile('function/friend');$isfriend=friend_check($space[uid]); if(!$isfriend) { ?>
<li class="ul_add"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?=$space['uid']?>&amp;handlekey=addfriendhk_<?=$space['uid']?>" id="a_friend_li_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">加为好友</a></li>
<? } else { ?>
<li class="ul_ignore"><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?=$space['uid']?>&amp;handlekey=ignorefriendhk_<?=$space['uid']?>" id="a_ignore_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">解除好友</a></li>
<? } ?>
<li class="ul_contect"><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>&amp;do=wall">给我留言</a></li>
<li class="ul_poke"><a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?=$space['uid']?>&amp;handlekey=propokehk_<?=$space['uid']?>" id="a_poke_<?=$space['uid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">打个招呼</a></li>
<li class="ul_pm"><a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?=$space['uid']?>&amp;touid=<?=$space['uid']?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?=$space['uid']?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)">发送消息</a></li>
<? } ?>
</ul>
<? if(checkperm('allowbanuser') || checkperm('allowedituser') || $_G['adminid'] == 1) { ?>
<hr class="da mtn m0">
<ul class="ptn xl xl2 cl">
<? if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<li>
<? if(checkperm('allowbanuser')) { ?>
<a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?=$space['username']?>&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?=$space['uid']?><? } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<? } else { ?>
<a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?=$space['username']?>&submit=yes&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?=$space['uid']?><? } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<? } ?>
</li>
<? } if($_G['adminid'] == 1) { ?>
<li><a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?=$space['username']?>" id="umanageli" onmouseover="showMenu(this.id)" class="showmenu">内容管理</a></li>
<? } ?>
</ul>
<? if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<ul id="usermanageli_menu" class="p_pop" style="width: 80px; display:none;">
<? if(checkperm('allowbanuser')) { ?>
<li><a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?=$space['username']?>&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?=$space['uid']?><? } ?>" target="_blank">禁止用户</a></li>
<? } if(checkperm('allowedituser')) { ?>
<li><a href="<? if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?=$space['username']?>&submit=yes&frames=yes<? } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?=$space['uid']?><? } ?>" target="_blank">编辑用户</a></li>
<? } ?>
</ul>
<? } if($_G['adminid'] == 1) { ?>
<ul id="umanageli_menu" class="p_pop" style="width: 80px; display:none;">
<li><a href="admin.php?action=threads&amp;users=<?=$space['username']?>" target="_blank">管理帖子</a></li>
<li><a href="admin.php?action=doing&amp;searchsubmit=1&amp;users=<?=$space['username']?>" target="_blank">管理记录</a></li>
<li><a href="admin.php?action=blog&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理日志</a></li>
<li><a href="admin.php?action=feed&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理动态</a></li>
<li><a href="admin.php?action=album&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理相册</a></li>
<li><a href="admin.php?action=pic&amp;searchsubmit=1&amp;users=<?=$space['username']?>" target="_blank">管理图片</a></li>
<li><a href="admin.php?action=comment&amp;searchsubmit=1&amp;authorid=<?=$space['uid']?>" target="_blank">管理评论</a></li>
<li><a href="admin.php?action=share&amp;searchsubmit=1&amp;uid=<?=$space['uid']?>" target="_blank">管理分享</a></li>
<li><a href="admin.php?action=threads&amp;operation=group&amp;users=<?=$space['username']?>" target="_blank">群组主题</a></li>
<li><a href="admin.php?action=prune&amp;searchsubmit=1&amp;operation=group&amp;users=<?=$space['username']?>" target="_blank">群组帖子</a></li>
</ul>
<? } } ?>
</div>
</div></div>
</div>
<? } ?><?php my_checkupdate(); ?><script type="text/javascript">

function filter_more(id) {
if($('feed_filter_div_'+id).style.display == '') {
$('feed_filter_div_'+id).style.display = 'none';
$('feed_filter_notice_'+id).style.display = '';
} else {
$('feed_filter_div_'+id).style.display = '';
$('feed_filter_notice_'+id).style.display = 'none';
}
}

function close_feedbox() {
var x = new Ajax();
x.get('home.php?mod=spacecp&ac=common&op=closefeedbox', function(s){
$('feed_box').style.display = 'none';
});
}

function showmore(day, uid, e) {
var obj = 'feed_more_div_'+day+'_'+uid;
$(obj).style.display = $(obj).style.display == ''?'none':'';
if(e.className == 'unfold'){
e.innerHTML = '收起';
e.className = 'fold';
} else if(e.className == 'fold') {
e.innerHTML = '展开';
e.className = 'unfold';
}
}

var elems = selector('li[class~=magicthunder]', $('feed_div')); 
for(var i=0; i<elems.length; i++){
magicColor(elems[i]); 
}
</script>	</div>
<? if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb">
<em><? if($_G['cache']['focus']['title']) { ?><?=$_G['cache']['focus']['title']?><? } else { ?>站长推荐<? } ?></em>
<span><a href="javascript:;" onclick="setcookie('nofocus_<?=$focusid?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="关闭">关闭</a></span>
</h3>
<hr class="l" />
<div class="detail">
<h4><a href="<?=$focus['url']?>" target="_blank"><?=$focus['subject']?></a></h4>
<p>
<? if($focus['image']) { ?>
<a href="<?=$focus['url']?>" target="_blank"><img src="<?=$focus['image']?>" onload="thumbImg(this, 1)" _width="58" _height="58" /></a>
<? } ?>
<?=$focus['summary']?>
</p>
</div>
<hr class="l" />
<a href="<?=$focus['url']?>" class="moreinfo" target="_blank">查看</a>
</div>
<? } ?><?php echo adshow("footerbanner/wp a_f/1"); ?><?php echo adshow("footerbanner/wp a_f/2"); ?><?php echo adshow("footerbanner/wp a_f/3"); ?><?php echo adshow("float/a_fl/1"); ?><?php echo adshow("float/a_fr/2"); ?><?php echo adshow("couplebanner/a_fl a_cb/1"); ?><?php echo adshow("couplebanner/a_fr a_cb/2"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?>
<div id="ft" class="wp cl">
<div id="flk" class="y">
<p><?php $fnavcount=0; if(is_array($_G['setting']['footernavs'])) foreach($_G['setting']['footernavs'] as $nav) { if($nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) ||
!$nav['type'] && ($nav['id'] == 'stat' && $_G['group']['allowstatdata'] || $nav['id'] == 'report' && $_G['uid'] || $nav['id'] == 'archiver'))) { ?><?=$nav['code']?><span class="pipe">|</span><? } } ?>
<strong><a href="<?=$_G['setting']['siteurl']?>" target="_blank"><?=$_G['setting']['sitename']?></a></strong>
<? if($_G['setting']['icp']) { ?>( <a href="http://www.miitbeian.gov.cn/" target="_blank"><?=$_G['setting']['icp']?></a> )<? } if($_G['setting']['statcode']) { ?><?=$_G['setting']['statcode']?><? } ?>				
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?>
</p>
<p class="xs0">
GMT<?=$_G['timenow']['offset']?>, <?=$_G['timenow']['time']?>
<span id="debuginfo">
<? if(debuginfo()) { ?>, Processed in <?=$_G['debuginfo']['time']?> second(s), <?=$_G['debuginfo']['queries']?> queries
<? if($_G['gzipcompress']) { ?>, Gzip On<? } if($_G['memory']) { ?>, <? echo ucwords($_G['memory']); ?> On<? } ?>.
<? } ?>
</span>
</p>
</div>
<div id="frt">
<p>Powered by <strong><a href="http://www.discuz.net" target="_blank">Discuz!</a></strong> <em><?=$_G['setting']['version']?></em><? if(!empty($_G['setting']['boardlicensed'])) { ?> <a href="http://license.comsenz.com/?pid=1&amp;host=<?=$_SERVER['HTTP_HOST']?>" target="_blank">Licensed</a><? } ?></p>
<p class="xs0">&copy; 2001-2010 <a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a></p>
</div><?php updatesession(); ?></div>
<? } ?>

<ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<? if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<? if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<? } else { ?>home.php?mod=spacecp&ac=videophoto<? } ?>">认证</a></li>
<? } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<? if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li>
<? } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<? if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<? if($_G['gp_id'] == $id) { ?> class="a"<? } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?=$id?>"><?=$module['name']?></a></li><? } } } ?>
</ul>

<? if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly">
积分 <?=$_G['member']['credits']?>, 距离下一级还需 <?=$upgradecredit?> 积分
</div>
<div class="mncr"></div>
</div>
<? } if(!$_G['setting']['bbclosed']) { if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?=$_G['timestamp']?>" type="text/javascript"></script>
<? } if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="home.php?mod=misc&ac=sendmail&rand=<?=$_G['timestamp']?>" type="text/javascript"></script>
<? } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="<?=$_G['setting']['jspath']?>common_diy.js?<?=VERHASH?>" type="text/javascript"></script>
<script src="<?=$_G['setting']['jspath']?>portal_diy.js?<?=VERHASH?>" type="text/javascript"></script>
<? } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
<script src="<?=$_G['setting']['jspath']?>common_diy.js?<?=VERHASH?>" type="text/javascript"></script>
<script src="<?=$_G['setting']['jspath']?>space_diy.js?<?=VERHASH?>" type="text/javascript"></script>
<? } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_G['gp_do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<? } ?><?php output(); ?></body>
</html>