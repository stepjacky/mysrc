<? if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./template/default/common/header.htm', './template/default/common/header_common.htm', 1286717085, '1', './data/template/1_1_common_header_member_logging.tpl.php', './template/default', 'common/header_member_logging')
;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<base href="<?=$_G['siteurl']?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_member_logging.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?><script type="text/javascript">var STYLEID = '<?=STYLEID?>', STATICURL = '<?=STATICURL?>', IMGDIR = '<?=IMGDIR?>', VERHASH = '<?=VERHASH?>', charset = '<?=CHARSET?>', discuz_uid = '<?=$_G['uid']?>', cookiepre = '<?=$_G['config']['cookie']['cookiepre']?>', cookiedomain = '<?=$_G['config']['cookie']['cookiedomain']?>', cookiepath = '<?=$_G['config']['cookie']['cookiepath']?>', showusercard = '<?=$_G['setting']['showusercard']?>', attackevasive = '<?=$_G['config']['security']['attackevasive']?>', disallowfloat = '<?=$_G['setting']['disallowfloat']?>', creditnotice = '<? if($_G['setting']['creditnotice']) { ?><?=$_G['setting']['creditnames']?><? } ?>', defaultstyle = '<?=$_G['style']['defaultextstyle']?>', REPORTURL = '<?=$_G['currenturl_encode']?>', SITEURL = '<?=$_G['siteurl']?>';</script>
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

<div id="wp" class="wp">