<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplay');
0
|| checktplrefresh('./template/default/forum/forumdisplay.htm', './template/default/common/header.htm', 1287323041, 'diy', './data/template/1_diy_forum_forumdisplay.tpl.php', './template/default', 'forum/forumdisplay')
|| checktplrefresh('./template/default/forum/forumdisplay.htm', './template/default/common/simplesearchform.htm', 1287323041, 'diy', './data/template/1_diy_forum_forumdisplay.tpl.php', './template/default', 'forum/forumdisplay')
|| checktplrefresh('./template/default/forum/forumdisplay.htm', './template/default/forum/recommend.htm', 1287323041, 'diy', './data/template/1_diy_forum_forumdisplay.tpl.php', './template/default', 'forum/forumdisplay')
|| checktplrefresh('./template/default/forum/forumdisplay.htm', './template/default/forum/forumdisplay_list.htm', 1287323041, 'diy', './data/template/1_diy_forum_forumdisplay.tpl.php', './template/default', 'forum/forumdisplay')
|| checktplrefresh('./template/default/forum/forumdisplay.htm', './template/default/common/footer.htm', 1287323041, 'diy', './data/template/1_diy_forum_forumdisplay.tpl.php', './template/default', 'forum/forumdisplay')
|| checktplrefresh('./template/default/forum/forumdisplay.htm', './template/default/common/header_common.htm', 1287323041, 'diy', './data/template/1_diy_forum_forumdisplay.tpl.php', './template/default', 'forum/forumdisplay')
|| checktplrefresh('./template/default/forum/forumdisplay.htm', './template/default/forum/search_sortoption.htm', 1287323041, 'diy', './data/template/1_diy_forum_forumdisplay.tpl.php', './template/default', 'forum/forumdisplay')
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
<base href="<?=$_G['siteurl']?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_forum_forumdisplay.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?><script type="text/javascript">var STYLEID = '<?=STYLEID?>', STATICURL = '<?=STATICURL?>', IMGDIR = '<?=IMGDIR?>', VERHASH = '<?=VERHASH?>', charset = '<?=CHARSET?>', discuz_uid = '<?=$_G['uid']?>', cookiepre = '<?=$_G['config']['cookie']['cookiepre']?>', cookiedomain = '<?=$_G['config']['cookie']['cookiedomain']?>', cookiepath = '<?=$_G['config']['cookie']['cookiepath']?>', showusercard = '<?=$_G['setting']['showusercard']?>', attackevasive = '<?=$_G['config']['security']['attackevasive']?>', disallowfloat = '<?=$_G['setting']['disallowfloat']?>', creditnotice = '<? if($_G['setting']['creditnotice']) { ?><?=$_G['setting']['creditnames']?><? } ?>', defaultstyle = '<?=$_G['style']['defaultextstyle']?>', REPORTURL = '<?=$_G['currenturl_encode']?>', SITEURL = '<?=$_G['siteurl']?>';</script>
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

<div id="wp" class="wp"><? if($_G['forum']['ismoderator']) { ?>
<script src="<?=$_G['setting']['jspath']?>forum_moderate.js?<?=VERHASH?>" type="text/javascript"></script>
<? } ?>

<div id="pt" class="bm cl"><? if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="搜索本版">搜索本版</label></li>
EOF;
?><? } if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?
$slist[portal] = <<<EOF
<li><input type="radio" id="mod_article" class="pr" name="mod" value="portal"
EOF;
 if(CURSCRIPT == 'portal') { 
$slist[portal] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[portal] .= <<<EOF
 /><label for="mod_article" title="搜索文章">文章</label></li>
EOF;
?><? } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?
$slist[forum] = <<<EOF
<li><input type="radio" id="mod_thread" class="pr" name="mod" value="forum"
EOF;
 if(CURSCRIPT == 'forum' && !$_G['fid']) { 
$slist[forum] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[forum] .= <<<EOF
 /><label for="mod_thread" title="搜索{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
EOF;
?><? } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?
$slist[blog] = <<<EOF
<li><input type="radio" id="mod_blog" class="pr" name="mod" value="blog"
EOF;
 if(CURSCRIPT == 'home' && $do != 'album') { 
$slist[blog] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[blog] .= <<<EOF
 /><label for="mod_blog" title="搜索日志">日志</label></li>
EOF;
?><? } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?
$slist[album] = <<<EOF
<li><input type="radio" id="mod_album" class="pr" name="mod" value="album"
EOF;
 if(CURSCRIPT == 'home' && $do == 'album') { 
$slist[album] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[album] .= <<<EOF
 /><label for="mod_album" title="搜索相册">相册</label></li>
EOF;
?><? } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?
$slist[group] = <<<EOF
<li><input type="radio" id="mod_group" class="pr" name="mod" value="group"
EOF;
 if(CURSCRIPT == 'group' || $_G['basescript']=='group') { 
$slist[group] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[group] .= <<<EOF
 /><label for="mod_group" title="搜索{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><? } ?><?
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="搜索用户">用户</label></li>
EOF;
?>
<? if($slist) { ?>
<div id="sc" class="y">
<form id="scform" method="post" autocomplete="off" onsubmit="searchFocus($('srchtxt'))" action="<?=$_G['siteurl']?>search.php?searchsubmit=yes" target="_blank">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?=$_G['fid']?>" />
<table cellspacing="0" cellpadding="0">
<tr>
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">搜索</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="请输入搜索内容" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">搜索</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><? echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<? } } ?><div class="z">
<a href="./" id="fjump"<? if($_G['setting']['forumjump'] == 1) { ?> onmouseover="showMenu({'ctrlid':this.id})"<? } ?> class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <?=$navigation?>
</div>
</div><?php echo adshow("text/wp a_t"); ?><style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
<div id="ct" class="wp cl<? if($_G['forum']['allowside']) { ?> ct2<? } ?>">
<div class="mn">
<div class="bm bml">
<? if($_G['forum']['banner'] && !$subforumonly) { ?><img src="<?=$_G['forum']['banner']?>" width="100%" alt="<?=$_G['forum']['name']?>" /><? } ?>
<div class="bm_h cl">
<? if($_G['page'] == 1 && $_G['forum']['rules']) { ?><span class="o"><img id="forum_rules_<?=$_G['fid']?>_img" src="<?=IMGDIR?>/collapsed_<?=$collapse['forum_rulesimg']?>.gif" title="收起/展开" alt="收起/展开" onclick="toggle_collapse('forum_rules_<?=$_G['fid']?>')" /></span><? } ?>
<span class="y">
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=forum&amp;id=<?=$_G['fid']?>&amp;handlekey=favoriteforum" id="a_favorite" class="fa_fav" onclick="showWindow(this.id, this.href, 'get', 0);">收藏本版</a>
<? if(rssforumperm($_G['forum']) && $_G['setting']['rssstatus'] && !$_G['gp_archiveid'] && !$subforumonly) { ?><span class="pipe">|</span><a href="forum.php?mod=rss&amp;fid=<?=$_G['fid']?>&amp;auth=<?=$rssauth?>" class="fa_rss" target="_blank" title="RSS">订阅</a><? } if(!empty($forumarchive)) { ?>
<span class="pipe">|</span><a id="forumarchive" href="javascript:;" class="fa_achv" onmouseover="showMenu(this.id)"><? if($_G['gp_archiveid']) { ?><?=$forumarchive[$_G['gp_archiveid']]['displayname']?><? } else { ?>存档<? } ?></a>
<? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_forumaction'])) echo $_G['setting']['pluginhooks']['forumdisplay_forumaction']; if($_G['forum']['ismoderator']) { if($_G['forum']['recyclebin']) { ?>
<span class="pipe">|</span><a href="<? if($_G['adminid'] == 1) { ?>admin.php?mod=forum&action=recyclebin&frames=yes<? } elseif($_G['forum']['ismoderator']) { ?>forum.php?mod=modcp&action=recyclebins&fid=<?=$_G['fid']?><? } ?>" class="fa_bin" target="_blank">回收站</a>
<? } if($_G['forum']['ismoderator'] && !$_G['gp_archiveid']) { ?>
<span class="pipe">|</span><strong>
<? if($_G['forum']['status'] != 3) { ?>
<a href="forum.php?mod=modcp&amp;fid=<?=$_G['fid']?>">管理面板</a>
<? } else { ?>
<a href="forum.php?mod=group&amp;action=manage&amp;fid=<?=$_G['fid']?>">管理面板</a>
<? } ?>
</strong>
<? } if($_G['forum']['modworks']) { if($modnum) { ?><span class="pipe">|</span><a href="forum.php?mod=modcp&amp;action=moderate&amp;op=threads&amp;fid=<?=$_G['fid']?>" target="_blank">待审核帖(<?=$modnum?>)</a><? } if($modusernum) { ?><span class="pipe">|</span><a href="forum.php?mod=modcp&amp;action=moderate&amp;op=members&amp;fid=<?=$_G['fid']?>" target="_blank">待审核用户(<?=$modusernum?>)</a><? } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_modlink'])) echo $_G['setting']['pluginhooks']['forumdisplay_modlink']; } ?>
</span>
<h1 class="xs2">
<a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>"><?=$_G['forum']['name']?></a>
<? if(!$subforumonly) { ?><span class="xs1 xw0 i">今日: <strong class="xi1"><?=$_G['forum']['todayposts']?></strong><span class="pipe">|</span>主题: <strong class="xi1"><?=$_G['forum']['threads']?></strong></span><? } ?>
</h1>
</div>
<div class="bm_c cl">
<? if(!empty($_G['forum']['domain']) && !empty($_G['setting']['domain']['root']['forum'])) { ?>
<div class="pbn">本版域名:<a href="http://<?=$_G['forum']['domain']?>.<?=$_G['setting']['domain']['root']['forum']?>" id="group_link">http://<?=$_G['forum']['domain']?>.<?=$_G['setting']['domain']['root']['forum']?></a></div>
<? } if($moderatedby) { ?><div class="pbn">版主: <span class="xi2"><?=$moderatedby?></span></div><? } if($_G['page'] == 1 && $_G['forum']['rules']) { ?>
<div id="forum_rules_<?=$_G['fid']?>" style="<?=$collapse['forum_rules']?>;">
<div class="pbm xg2"><?=$_G['forum']['rules']?></div>
</div>
<? } ?>
<div id="forumarchive_menu" class="p_pop" style="display:none">
<ul>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>">全部主题</a></li><? if(is_array($forumarchive)) foreach($forumarchive as $id => $info) { ?><li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;archiveid=<?=$id?>"><?=$info['displayname']?> (<?=$info['threads']?>)</a></li>
<? } ?>
</ul>
</div>
</div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_top'])) echo $_G['setting']['pluginhooks']['forumdisplay_top']; if($subexists && $_G['page'] == 1) { include template('forum/forumdisplay_subforum'); } ?>

<div class="drag">
<!--[diy=diy4]--><div id="diy4" class="area"></div><!--[/diy]-->
</div>

<? if(!empty($_G['forum']['recommendlist'])) { ?>
<div class="bm bmw">
<div class="bm_h cl">
<h2>推荐主题</h2>
</div>
<div class="bm_c cl"><? if($_G['forum']['recommendlist']['images'] && $_G['forum']['modrecommend']['imagenum']) { ?>
<div class="cl" style="width: <?=$_G['forum']['modrecommend']['imagewidth']?>px; margin: 0 auto; float:left;">
<script type="text/javascript">
var slideSpeed = 5000;
var slideImgsize = [<?=$_G['forum']['modrecommend']['imagewidth']?>,<?=$_G['forum']['modrecommend']['imageheight']?>];
var slideBorderColor = '<?=SPECIALBORDER?>';
var slideBgColor = '<?=COMMONBG?>';
var slideImgs = new Array();
var slideImgLinks = new Array();
var slideImgTexts = new Array();
var slideSwitchColor = '<?=TABLETEXT?>';
var slideSwitchbgColor = '<?=COMMONBG?>';
var slideSwitchHiColor = '<?=SPECIALBORDER?>';<? if(is_array($_G['forum']['recommendlist']['images'])) foreach($_G['forum']['recommendlist']['images'] as $k => $imginfo) { ?>slideImgs[<? echo $k+1; ?>] = '<?=$imginfo['filename']?>';
slideImgLinks[<? echo $k+1; ?>] = 'forum.php?mod=viewthread&tid=<?=$imginfo['tid']?>';
slideImgTexts[<? echo $k+1; ?>] = '<?=$imginfo['subject']?>';
<? } ?>
</script>
<script src="<?=$_G['setting']['jspath']?>forum_slide.js?<?=VERHASH?>" type="text/javascript"></script>
</div>
<? } ?>
<div class="cl"<? if($_G['forum']['recommendlist']['images'] && $_G['forum']['modrecommend']['imagenum']) { ?> style="margin-left: <?=$_G['forum']['modrecommend']['imagewidth']?>px; padding-left: 20px;"<? } ?>><?php unset($_G['forum']['recommendlist']['images']); ?><ul class="xl<? if(!$_G['forum']['allowside']) { ?> xl2<? } ?> cl"><? if(is_array($_G['forum']['recommendlist'])) foreach($_G['forum']['recommendlist'] as $rtid => $recommend) { ?><li>
<a href="forum.php?mod=viewthread&amp;tid=<?=$rtid?>" <?=$recommend['subjectstyles']?> target="_blank"><?=$recommend['subject']?></a>
</li>
<? } ?>
</ul>
</div></div>
</div>
<? } ?>

<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_middle'])) echo $_G['setting']['pluginhooks']['forumdisplay_middle']; if(!$subforumonly) { if($recommendgroups && !$_G['forum']['allowside']) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>推荐<?=$_G['setting']['navs']['3']['navname']?></h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><? if(is_array($recommendgroups)) foreach($recommendgroups as $key => $group) { ?><li>
<a href="forum.php?mod=group&amp;fid=<?=$group['fid']?>" title="<?=$group['name']?>" target="_blank" class="avt"><img src="<?=$group['icon']?>" alt="<?=$group['name']?>"></a>
<p><a href="forum.php?mod=group&amp;fid=<?=$group['fid']?>" target="_blank"><?=$group['name']?></a></p>
</li>
<? } ?>
</ul>
</div>
</div>
<? } if($threadmodcount) { ?><div class="bm bmn hm xi2"><strong><a href="home.php?mod=space&amp;uid=<?=$_G['uid']?>&amp;do=thread&amp;view=me&amp;type=thread&amp;from=&amp;filter=aduit">你有 <?=$threadmodcount?> 个主题正等待审核中，点击查看</a></strong></div><? } ?>

<div id="pgt" class="bm bw0 pgs cl">
<?=$multipage?>
<span class="pgb y" <? if($_G['setting']['visitedforums']) { ?>id="visitedforums" onmouseover="$('visitedforums').id = 'visitedforumstmp';this.id = 'visitedforums';showMenu({'ctrlid':this.id,'pos':'34'})"<? } ?> ><a href="forum.php">返&nbsp;回</a></span>
<? if(!$_G['gp_archiveid']) { ?><a href="javascript:;" id="newspecial" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})"<? if(!$_G['forum']['allowspecialonly']) { ?> onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=<?=$_G['fid']?>')"<? } else { ?> onclick="location.href='forum.php?mod=post&action=newthread&fid=<?=$_G['fid']?>'"<? } ?> title="发新帖"><img src="<?=IMGDIR?>/pn_post.png" alt="发新帖" /></a><? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_postbutton_top'])) echo $_G['setting']['pluginhooks']['forumdisplay_postbutton_top']; ?>
</div><? if(($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable']) || $_G['forum']['threadsorts']) { ?>
<ul id="thread_types" class="ttp bm cl">
<li <? if(!$_G['gp_typeid'] && !$_G['gp_sortid']) { ?>class="xw1 a"<? } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">全部</a></li>
<? if($_G['forum']['threadtypes']) { if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $id => $name) { ?><li<? if($_G['gp_typeid'] == $id) { ?> class="xw1 a"<? } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=typeid&amp;typeid=<?=$id?><?=$forumdisplayadd['typeid']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>"><? if($_G['forum']['threadtypes']['icons'][$id] && $_G['forum']['threadtypes']['prefix'] == 2) { ?><img class="vm" src="<?=$_G['forum']['threadtypes']['icons'][$id]?>" alt="" /> <? } ?><?=$name?></a></li>
<? } } if($_G['forum']['threadsorts']) { if($_G['forum']['threadtypes']) { ?><li><span class="pipe">|</span></li><? } if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $name) { ?><li<? if($_G['gp_sortid'] == $id) { ?> class="xw1 a"<? } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=sortid&amp;sortid=<?=$id?><?=$forumdisplayadd['sortid']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>"><?=$name?></a></li>
<? } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_filter_extra'])) echo $_G['setting']['pluginhooks']['forumdisplay_filter_extra']; ?>
</ul>
<script type="text/javascript">showTypes('thread_types');</script>
<? } ?>

<div id="threadlist" class="tl bm bmw"<? if($_G['uid']) { ?> style="position: relative;"<? } ?>>
<? if($quicksearchlist && !$_G['gp_archiveid']) { ?><div class="bbs">
<form method="post" autocomplete="off" name="searhsort" id="searhsort" class="bm_c pns mfm bbda cl" action="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=sortid&amp;sortid=<?=$_G['gp_sortid']?>">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" /><? if(is_array($quicksearchlist)) foreach($quicksearchlist as $optionid => $option) { ?><span class="mtm z">
<? if(!in_array($option['type'], array('select', 'radio', 'range'))) { ?><strong><?=$option['title']?>: </strong><? } if(in_array($option['type'], array('radio', 'checkbox', 'select', 'range'))) { if($option['type'] != 'checkbox') { ?>
<span class="ftid">
<select name="searchoption[<?=$optionid?>][value]" id="<?=$option['identifier']?>">
<option value="0"><?=$option['title']?>不限</option><? if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { ?><option value="<?=$id?>" <? if($_G['gp_searchoption'][$optionid]['value'] == $id) { ?>selected="selected"<? } ?>><?=$value?></option>
<? } ?>
</select>
</span>
<input type="hidden" name="searchoption[<?=$optionid?>][type]" value="<?=$option['type']?>">
<script type="text/javascript" reload="1">simulateSelect('<?=$option['identifier']?>'<? if($option['type'] == 'range') { ?>, 90<? } ?>);</script>
<? } else { if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { ?><input type="checkbox" class="pc" name="searchoption[<?=$optionid?>][value][<?=$id?>]" value="<?=$id?>" <? if($_G['gp_searchoption'][$optionid]['value'][$id]) { ?>checked="checked"<? } ?>> <?=$value?> 
<? } ?>
<input type="hidden" name="searchoption[<?=$optionid?>][type]" value="checkbox">
<? } } else { if($option['type'] == 'calendar') { ?>
<script src="<?=$_G['setting']['jspath']?>calendar.js?<?=VERHASH?>" type="text/javascript"></script>
<input type="text" name="searchoption[<?=$optionid?>][value]" size="15" class="px vm" value="<?=$_G['gp_searchoption'][$optionid]['value']?>" onclick="showcalendar(event, this, false)" />
<? } else { ?>
<input type="text" name="searchoption[<?=$optionid?>][value]" size="15" class="px vm" value="<?=$_G['gp_searchoption'][$optionid]['value']?>" />
<? } } ?>
</span>
<? } ?>
<span class="mtm z"><button type="submit" class="pn pnp vm" name="searchsortsubmit"><em>搜索</em></button></span>
</form>
<dl class="bm_c ptm tsm cl"><? if(is_array($quicksearchlist)) foreach($quicksearchlist as $option) { ?><dt><?=$option['title']?>:</dt>
<dd>
<ul>
<li<? if($_G['gp_'.$option['identifier']] == 'all') { ?> class="a"<? } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=sortid&amp;sortid=<?=$_G['gp_sortid']?>&amp;searchsort=1<?=$filterurladd?>&amp;<?=$option['identifier']?>=all<?=$sorturladdarray[$option['identifier']]?>" class="xi2">不限</a></li><? if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { ?><li<? if($_G['gp_'.$option['identifier']] && $id == $_G['gp_'.$option['identifier']]) { ?> class="a"<? } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=sortid&amp;sortid=<?=$_G['gp_sortid']?>&amp;searchsort=1&amp;<?=$option['identifier']?>=<?=$id?><?=$sorturladdarray[$option['identifier']]?>" class="xi2"><?=$value?></a></li>
<? } ?>
</ul>
</dd>
<? } ?>
</dl>
</div><? } ?>
<div class="th">
<table cellspacing="0" cellpadding="0" class="th">
<tr>
<th colspan="<? if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']) { ?>3<? } else { ?>2<? } ?>">
<div class="tf">
<span id="atarget" <? if(!empty($_G['cookie']['atarget'])) { ?>onclick="setatarget(0)" class="y atarget_1"<? } else { ?>onclick="setatarget(1)" class="y"<? } ?> title="在新窗口中打开帖子">新窗</span>
筛选:
<a id="filter_special" href="javascript:;" class="showmenu xi2" onclick="showMenu(this.id)">
<? if($_G['gp_specialtype'] == 'poll') { ?>投票<? } elseif($_G['gp_specialtype'] == 'trade') { ?>商品<? } elseif($_G['gp_specialtype'] == 'reward') { ?>悬赏<? } elseif($_G['gp_specialtype'] == 'activity') { ?>活动<? } elseif($_G['gp_specialtype'] == 'debate') { ?>辩论<? } else { ?>全部主题<? } ?>
</a>
<a id="filter_dateline" href="javascript:;" class="showmenu xi2" onclick="showMenu(this.id)">
<? if($_G['gp_dateline'] == 86400) { ?>一天<? } elseif($_G['gp_dateline'] == 172800) { ?>两天<? } elseif($_G['gp_dateline'] == 604800) { ?>一周<? } elseif($_G['gp_dateline'] == 2592000) { ?>一个月<? } elseif($_G['gp_dateline'] == 7948800) { ?>三个月<? } else { ?>全部时间<? } ?>
</a>
<span class="pipe">|</span>排序:
<a id="filter_orderby" href="javascript:;" class="showmenu xi2" onclick="showMenu(this.id)">
<? if($_G['gp_orderby'] == 'dateline') { ?>发帖时间<? } elseif($_G['gp_orderby'] == 'replies') { ?>回复/查看<? } elseif($_G['gp_orderby'] == 'views') { ?>查看<? } elseif($_G['gp_orderby'] == 'lastpost') { ?>最后发表<? } elseif($_G['gp_orderby'] == 'heats') { ?>热门<? } else { ?>默认排序<? } ?>
</a>
<span class="pipe">|</span><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=digest&amp;digest=1<?=$forumdisplayadd['digest']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>" class="xi2">精华</a><? if(!empty($_G['setting']['recommendthread']['status'])) { ?><span class="pipe">|</span><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=recommend&amp;recommend=1&amp;orderby=recommends<?=$forumdisplayadd['recommend']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>" class="xi2">推荐</a><? } ?>
</div>
</th>
<td class="by">作者</td>
<td class="num">回复/查看</td>
<td class="by">最后发表</td>
</tr>
</table>
</div>
<div class="bm_c">
<form method="post" autocomplete="off" name="moderate" id="moderate" action="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?=$_G['fid']?>&amp;infloat=yes&amp;nopost=yes">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<table summary="forum_<?=$_G['fid']?>" <? if(!$separatepos) { ?>id="forum_<?=$_G['fid']?>"<? } ?> cellspacing="0" cellpadding="0">
<? if((!$simplestyle || !$_G['forum']['allowside'] && $page == 1) && !empty($announcement)) { ?>
<tbody>
<tr>
<td class="icn"><img src="<?=IMGDIR?>/ann_icon.gif" alt="公告" /></td>
<? if($_G['forum']['ismoderator'] && !$_G['gp_archiveid']) { ?><td class="o">&nbsp;</td><? } ?>
<th><strong class="xst">公告: <? if(empty($announcement['type'])) { ?><a href="forum.php?mod=announcement&amp;id=<?=$announcement['id']?>#<?=$announcement['id']?>" target="_blank"><?=$announcement['subject']?></a><? } else { ?><a href="<?=$announcement['message']?>" target="_blank"><?=$announcement['subject']?></a><? } ?></strong></th>
<td class="by">
<cite><a href="home.php?mod=space&amp;uid=<?=$announcement['authorid']?>" c="1"><?=$announcement['author']?></a></cite>
<em><?=$announcement['starttime']?></em>
</td>
<td class="num">&nbsp;</td>
<td class="by">&nbsp;</td>
</tr>
</tbody>
<? } if($_G['forum_threadcount']) { if(is_array($_G['forum_threadlist'])) foreach($_G['forum_threadlist'] as $key => $thread) { if($_G['setting']['forumseparator'] == 1 && $separatepos == $key + 1) { ?>
<tbody>
<tr class="ts">
<td>&nbsp;</td>
<? if($_G['forum']['ismoderator'] && !$_G['gp_archiveid']) { ?><td>&nbsp;</td><? } ?>
<th>版块主题</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
</tbody>
<? } if($separatepos <= $key + 1) { ?><?php echo adshow("threadlist"); } ?>
<tbody id="<?=$thread['id']?>">
<tr>
<td class="icn">
<a href="forum.php?mod=viewthread&amp;tid=<? if(!$thread['moved']) { ?><?=$thread['tid']?><? } else { ?><?=$thread['closed']?><? } ?>&amp;<? if($_G['gp_archiveid']) { ?>archiveid=<?=$_G['gp_archiveid']?>&amp;<? } ?>extra=<?=$extra?>" title="<? if(in_array($thread['displayorder'], array(1, 2, 3, 4))) { if($thread['displayorder'] == 1) { ?>本版置顶主题 - <? } elseif($thread['displayorder'] == 2) { ?>分类置顶主题 - <? } elseif($thread['displayorder'] == 3) { ?>全局置顶主题 - <? } elseif($thread['displayorder'] == 4) { ?>多版置顶主题 - <? } } ?>新窗口打开" target="_blank">
<? if($thread['folder'] == 'lock') { ?>
<img src="<?=IMGDIR?>/folder_lock.gif" />
<? } elseif($thread['special'] == 1) { ?>
<img src="<?=IMGDIR?>/pollsmall.gif" alt="投票" />
<? } elseif($thread['special'] == 2) { ?>
<img src="<?=IMGDIR?>/tradesmall.gif" alt="商品" />
<? } elseif($thread['special'] == 3) { ?>
<img src="<?=IMGDIR?>/rewardsmall.gif" alt="悬赏" />
<? } elseif($thread['special'] == 4) { ?>
<img src="<?=IMGDIR?>/activitysmall.gif" alt="活动" />
<? } elseif($thread['special'] == 5) { ?>
<img src="<?=IMGDIR?>/debatesmall.gif" alt="辩论" />
<? } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<img src="<?=IMGDIR?>/pin_<?=$thread['displayorder']?>.gif" alt="<?=$_G['setting']['threadsticky'][3-$thread['displayorder']]?>" />
<? } else { ?>
<img src="<?=IMGDIR?>/folder_<?=$thread['folder']?>.gif" />
<? } ?>
</a>
</td>
<? if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']) { ?>
<td class="o">
<? if($thread['fid'] == $_G['fid']) { if($thread['displayorder'] <= 3 || $_G['adminid'] == 1) { ?>
<input onclick="tmodclick(this)" type="checkbox" name="moderate[]" value="<?=$thread['tid']?>" />
<? } else { ?>
<input type="checkbox" disabled="disabled" />
<? } } else { ?>
<input type="checkbox" disabled="disabled" />
<? } ?>
</td>
<? } ?>
<th class="<?=$thread['folder']?>">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_thread'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_thread'][$key]; ?>
<?=$thread['sorthtml']?> <?=$thread['typehtml']?>
<? if($thread['moved']) { ?>
移动:<?php $thread[tid]=$thread[closed]; } if($thread['isgroup'] == 1) { ?><?php $thread[tid]=$thread[closed]; ?>[<a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?=$groupnames[$thread['tid']]['fid']?>" target="_blank"><?=$groupnames[$thread['tid']]['name']?></a>]
<? } ?>
<a href="forum.php?mod=viewthread&amp;tid=<?=$thread['tid']?>&amp;<? if($_G['gp_archiveid']) { ?>archiveid=<?=$_G['gp_archiveid']?>&amp;<? } ?>extra=<?=$extra?>"<?=$thread['highlight']?><? if($thread['isgroup'] == 1) { ?> target="_blank"<? } ?> onclick="atarget(this)" class="xst"><?=$thread['subject']?></a>
<? if($thread['icon'] >= 0) { ?>
<img src="<?=STATICURL?>image/stamp/<?=$_G['cache']['stamps'][$thread['icon']]['url']?>" alt="<?=$_G['cache']['stamps'][$thread['icon']]['text']?>" align="absmiddle" />
<? } if($stemplate && $sortid) { ?><?=$stemplate[$sortid][$thread['tid']]?><? } if($thread['readperm']) { ?> - [阅读权限 <span class="bold"><?=$thread['readperm']?></span>]<? } if($thread['price'] > 0) { if($thread['special'] == '3') { ?>
- <span style="color: #C60">[悬赏<?=$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title']?> <span class="bold"><?=$thread['price']?></span> <?=$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit']?>]</span>
<? } else { ?>
- [售价 <?=$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title']?> <span class="bold"><?=$thread['price']?></span> <?=$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit']?>]
<? } } elseif($thread['special'] == '3' && $thread['price'] < 0) { ?>
- [已解决]
<? } if($thread['attachment'] == 2) { ?>
<img src="<?=STATICURL?>image/filetype/image_s.gif" alt="attach_img" title="图片附件" align="absmiddle" />
<? } elseif($thread['attachment'] == 1) { ?>
<img src="<?=STATICURL?>image/filetype/common.gif" alt="attachment" title="附件" align="absmiddle" />
<? } if($thread['displayorder'] == 0) { if($thread['recommendicon'] && $filter != 'recommend') { ?>
<img src="<?=IMGDIR?>/recommend_<?=$thread['recommendicon']?>.gif" align="absmiddle" alt="recommend" title="评价指数 <?=$thread['recommends']?>" />
<? } if($thread['heatlevel']) { ?>
<img src="<?=IMGDIR?>/hot_<?=$thread['heatlevel']?>.gif" align="absmiddle" alt="heatlevel" title="<?=$thread['heatlevel']?> 级热门" />
<? } if($thread['digest'] > 0 && $filter != 'digest') { ?>
<img src="<?=IMGDIR?>/digest_<?=$thread['digest']?>.gif" align="absmiddle" alt="digest" title="精华 <?=$thread['digest']?>" />
<? } if($thread['rate'] > 0) { ?>
<img src="<?=IMGDIR?>/agree.gif" align="absmiddle" alt="agree" title="帖子被加分" />
<? } elseif($thread['rate'] < 0) { ?>
<img src="<?=IMGDIR?>/disagree.gif" align="absmiddle" alt="disagree" title="帖子被减分" />
<? } } if($thread['multipage']) { ?>
<span class="tps"><?=$thread['multipage']?></span>
<? } if($thread['weeknew']) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?=$thread['tid']?>&amp;goto=lastpost#lastpost" class="xi1">New</a>
<? } ?>
</th>
<td class="by">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_author'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_author'][$key]; ?>
<cite>
<? if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?=$thread['authorid']?>" c="1"><?=$thread['author']?></a><? if(!empty($verify[$thread['authorid']])) { ?><?=$verify[$thread['authorid']]?><? } } else { if($_G['forum']['ismoderator']) { ?>
<a href="home.php?mod=space&amp;uid=<?=$thread['authorid']?>" c="1">匿名</a>
<? } else { ?>
匿名
<? } } ?>
</cite>
<em><?=$thread['dateline']?></em>
</td>
<td class="num"><a href="forum.php?mod=viewthread&amp;tid=<?=$thread['tid']?>&amp;extra=<?=$extra?>" class="xi2"><?=$thread['replies']?></a><em><?=$thread['views']?></em></td>
<td class="by">
<cite><? if($thread['lastposter']) { ?><a href="<? if($thread['digest'] != -2) { ?>home.php?mod=space&username=<?=$thread['lastposterenc']?><? } else { ?>forum.php?mod=viewthread&tid=<?=$thread['tid']?>&page=<? echo max(1, $thread['pages']);; } ?>" c="1"><?=$thread['lastposter']?></a><? } else { ?>匿名<? } ?></cite>
<em><a href="<? if($thread['digest'] != -2) { ?>forum.php?mod=redirect&tid=<?=$thread['tid']?>&goto=lastpost<?=$highlight?>#lastpost<? } else { ?>forum.php?mod=viewthread&tid=<?=$thread['tid']?>&page=<? echo max(1, $thread['pages']);; } ?>"><?=$thread['lastpost']?></a></em>
</td>
</tr>
</tbody>
<? } } else { ?>
<tbody><tr><th colspan="<? if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']) { ?>6<? } else { ?>5<? } ?>"><p class="emp">本版块或指定的范围内尚无主题。</p></th></tr></tbody>
<? } ?>
</table>
<? if($_G['forum']['ismoderator'] && $_G['forum_threadcount']) { include template('forum/topicadmin_modlayer'); } ?>
</form>
</div>
</div>

<? if(!IS_ROBOT) { ?>
<div id="filter_special_menu" class="p_pop" style="display:none" change="location.href='forum.php?mod=forumdisplay&fid=<?=$_G['fid']?>&filter='+$('filter_special').value">
<ul>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">全部主题</a></li>
<? if($showpoll) { ?><li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=specialtype&amp;specialtype=poll<?=$forumdisplayadd['specialtype']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">投票</a></li><? } if($showtrade) { ?><li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=specialtype&amp;specialtype=trade<?=$forumdisplayadd['specialtype']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">商品</a></li><? } if($showreward) { ?><li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=specialtype&amp;specialtype=reward<?=$forumdisplayadd['specialtype']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">悬赏</a></li><? } if($showactivity) { ?><li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=specialtype&amp;specialtype=activity<?=$forumdisplayadd['specialtype']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">活动</a></li><? } if($showdebate) { ?><li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=specialtype&amp;specialtype=debate<?=$forumdisplayadd['specialtype']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">辩论</a></li><? } ?>
</ul>
</div>
<div id="filter_dateline_menu" class="p_pop" style="display:none">
<ul>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;orderby=<?=$_G['gp_orderby']?>&amp;filter=dateline<?=$forumdisplayadd['dateline']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">全部时间</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;orderby=<?=$_G['gp_orderby']?>&amp;filter=dateline&amp;dateline=86400<?=$forumdisplayadd['dateline']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">一天</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;orderby=<?=$_G['gp_orderby']?>&amp;filter=dateline&amp;dateline=172800<?=$forumdisplayadd['dateline']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">两天</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;orderby=<?=$_G['gp_orderby']?>&amp;filter=dateline&amp;dateline=604800<?=$forumdisplayadd['dateline']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">一周</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;orderby=<?=$_G['gp_orderby']?>&amp;filter=dateline&amp;dateline=2592000<?=$forumdisplayadd['dateline']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">一个月</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;orderby=<?=$_G['gp_orderby']?>&amp;filter=dateline&amp;dateline=7948800<?=$forumdisplayadd['dateline']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">三个月</a></li>
</ul>
</div>
<div id="filter_orderby_menu" class="p_pop" style="display:none">
<ul>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">默认排序</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=author&amp;orderby=dateline<?=$forumdisplayadd['author']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">发帖时间</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=reply&amp;orderby=replies<?=$forumdisplayadd['reply']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">回复/查看</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=reply&amp;orderby=views<?=$forumdisplayadd['view']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">查看</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=lastpost&amp;orderby=lastpost<?=$forumdisplayadd['lastpost']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">最后发表</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;filter=heat&amp;orderby=heats<?=$forumdisplayadd['heat']?><? if($_G['gp_archiveid']) { ?>&amp;archiveid=<?=$_G['gp_archiveid']?><? } ?>">热门</a></li>
<ul>
</div>
<? } ?>

<div class="bm bw0 pgs cl">
<?=$multipage?>
<span <? if($_G['setting']['visitedforums']) { ?>id="visitedforumstmp" onmouseover="$('visitedforums').id = 'visitedforumstmp';this.id = 'visitedforums';showMenu({'ctrlid':this.id,'pos':'21'})"<? } ?> class="pgb y"><a href="forum.php">返&nbsp;回</a></span>
<? if(!$_G['gp_archiveid']) { ?><a href="javascript:;" id="newspecialtmp" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})"<? if(!$_G['forum']['allowspecialonly']) { ?> onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=<?=$_G['fid']?>')"<? } else { ?> onclick="location.href='forum.php?mod=post&action=newthread&fid=<?=$_G['fid']?>'"<? } ?> title="发新帖"><img src="<?=IMGDIR?>/pn_post.png" alt="发新帖" /></a><? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_postbutton_bottom'])) echo $_G['setting']['pluginhooks']['forumdisplay_postbutton_bottom']; ?>
</div><? } ?>
<!--[diy=diyfastposttop]--><div id="diyfastposttop" class="area"></div><!--[/diy]-->
<? if($fastpost && $_G['group']['allowpost']) { include template('forum/forumdisplay_fastpost'); } ?>

<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_bottom'])) echo $_G['setting']['pluginhooks']['forumdisplay_bottom']; ?>
<!--[diy=diyforumdisplaybottom]--><div id="diyforumdisplaybottom" class="area"></div><!--[/diy]-->
</div>

<? if($_G['forum']['allowside']) { ?>
<div class="sd">
<? if(!$subforumonly) { ?>
<div class="bm">
<div class="bm_h">
<h2>所属分类: <?php echo cutstr($_G['cache']['forums'][$_G['forum']['fup']]['name'], 22, '') ?></h2>
</div>
<div class="bm_c">
<ul class="xl xl2 cl"><? if(is_array($_G['cache']['forums'])) foreach($_G['cache']['forums'] as $bforum) { if($bforum['fup'] == $_G['forum']['fup'] && $bforum['status']) { ?>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?=$bforum['fid']?>"><?=$bforum['name']?></a></li>
<? } } ?>
</ul>
</div>
</div>

<? if($recommendgroups) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>推荐<?=$_G['setting']['navs']['3']['navname']?></h2>
</div>
<div class="bm_c cl">
<ul class="ml mls cl"><? if(is_array($recommendgroups)) foreach($recommendgroups as $key => $group) { ?><li>
<a href="forum.php?mod=group&amp;fid=<?=$group['fid']?>" title="<?=$group['name']?>" target="_blank" class="avt"><img src="<?=$group['icon']?>" alt="<?=$group['name']?>"></a>
<p><a href="forum.php?mod=group&amp;fid=<?=$group['fid']?>" target="_blank"><?=$group['name']?></a></p>
</li>
<? } ?>
</ul>
</div>
</div>
<? } if(!($_G['forum']['simple'] & 1) && $_G['setting']['whosonlinestatus']) { ?>
<div class="bm">
<? if($detailstatus) { ?>
<div class="bm_h cl">
<span class="o y"><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;page=<?=$page?>&amp;showoldetails=no#online"><img src="<?=IMGDIR?>/collapsed_no.gif" alt="" /></a></span>
<h2>正在浏览此版块的会员 (<?=$onlinenum?>)</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><? if(is_array($whosonline)) foreach($whosonline as $key => $online) { ?><li>
<a href="home.php?mod=space&amp;uid=<?=$online['uid']?>" class="avt"><?php echo avatar($online[uid],small); ?></a>
<? if($online['uid']) { ?>
<p><a href="home.php?mod=space&amp;uid=<?=$online['uid']?>"><?=$online['username']?></a></p>
<? } else { ?>
<p><?=$online['username']?></p>
<? } ?>
<span><?=$online['lastactivity']?><?="\n"?></span>
</li>
<? } ?>
</ul>
</div>
<? } else { ?>
<div class="bm_h cl">
<span class="o y"><a href="forum.php?mod=forumdisplay&amp;fid=<?=$_G['fid']?>&amp;page=<?=$page?>&amp;showoldetails=yes#online" class="nobdr"><img src="<?=IMGDIR?>/collapsed_yes.gif" alt="" /></a></span>
<h2>正在浏览此版块的会员 (<?=$onlinenum?>)</h2>
</div>
<? } ?>
</div>
<? } } ?>
<div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_side_bottom'])) echo $_G['setting']['pluginhooks']['forumdisplay_side_bottom']; ?>
</div>
<? } ?>
</div>
<? if($_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
<ul class="p_pop" id="newspecial_menu" style="display: none">
<? if(!$_G['forum']['allowspecialonly']) { ?><li><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>">发表帖子</a></li><? } if($_G['group']['allowpostpoll']) { ?><li class="poll"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=1">发起投票</a></li><? } if($_G['group']['allowpostreward']) { ?><li class="reward"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=3">发布悬赏</a></li><? } if($_G['group']['allowpostdebate']) { ?><li class="debate"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=5">发起辩论</a></li><? } if($_G['group']['allowpostactivity']) { ?><li class="activity"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=4">发起活动</a></li><? } if($_G['group']['allowposttrade']) { ?><li class="trade"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;special=2">出售商品</a></li><? } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<li class="popupmenu_option"<? if($_G['setting']['threadplugins'][$tpid]['icon']) { ?> style="background-image:url(<?=$_G['setting']['threadplugins'][$tpid]['icon']?>)"<? } ?>><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;specialextra=<?=$tpid?>"><?=$_G['setting']['threadplugins'][$tpid]['name']?></a></li>
<? } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<li class="popupmenu_option"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;extra=<?=$extra?>&amp;sortid=<?=$id?>"><?=$threadsorts?></a></li>
<? } } } ?>
</ul>
<? } if($_G['setting']['visitedforums'] || $oldthreads) { ?>
<div id="visitedforums_menu" class="<? if($oldthreads) { ?>visited_w <? } ?>p_pop blk cl" style="display: none;">
<table cellspacing="0" cellpadding="0">
<tr>
<? if($_G['setting']['visitedforums']) { ?>
<td id="v_forums">
<h3 class="mbn pbn bbda xg1">浏览过的版块</h3>
<ul>
<?=$_G['setting']['visitedforums']?>
</ul>
</td>
<? } if($oldthreads) { ?>
<td id="v_threads">
<h3 class="mbn pbn bbda xg1">浏览过的帖子</h3>
<ul class="xl"><? if(is_array($oldthreads)) foreach($oldthreads as $oldtid => $oldsubject) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?=$oldtid?>"><?=$oldsubject?></a></li>
<? } ?>
</ul>
</td>
<? } ?>
</tr>
</table>
</div>
<? } if($_G['setting']['forumjump']) { ?>
<div class="p_pop" id="fjump_menu" style="display: none">
<?=$forummenu?>
</div>
<? } if($_G['setting']['threadmaxpages'] > 1 && $page) { ?>
<script type="text/javascript">document.onkeyup = function(e){keyPageScroll(e, <? if($page > 1) { ?>1<? } else { ?>0<? } ?>, <? if($page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']) { ?>1<? } else { ?>0<? } ?>, 'forum.php?mod=forumdisplay&fid=<?=$_G['fid']?>&filter=<?=$filter?>&orderby=<?=$_G['gp_orderby']?><?=$forumdisplayadd['page']?>&<?=$multipage_archive?>', <?=$page?>);}</script>
<? } ?>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>	</div>
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