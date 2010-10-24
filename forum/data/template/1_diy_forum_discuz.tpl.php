<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('discuz');
0
|| checktplrefresh('./template/default/forum/discuz.htm', './template/default/common/header.htm', 1286717743, 'diy', './data/template/1_diy_forum_discuz.tpl.php', './template/default', 'forum/discuz')
|| checktplrefresh('./template/default/forum/discuz.htm', './template/default/common/pubsearchform.htm', 1286717743, 'diy', './data/template/1_diy_forum_discuz.tpl.php', './template/default', 'forum/discuz')
|| checktplrefresh('./template/default/forum/discuz.htm', './template/default/common/footer.htm', 1286717743, 'diy', './data/template/1_diy_forum_discuz.tpl.php', './template/default', 'forum/discuz')
|| checktplrefresh('./template/default/forum/discuz.htm', './template/default/common/header_common.htm', 1286717743, 'diy', './data/template/1_diy_forum_discuz.tpl.php', './template/default', 'forum/discuz')
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
<base href="<?=$_G['siteurl']?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_forum_index.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?><script type="text/javascript">var STYLEID = '<?=STYLEID?>', STATICURL = '<?=STATICURL?>', IMGDIR = '<?=IMGDIR?>', VERHASH = '<?=VERHASH?>', charset = '<?=CHARSET?>', discuz_uid = '<?=$_G['uid']?>', cookiepre = '<?=$_G['config']['cookie']['cookiepre']?>', cookiedomain = '<?=$_G['config']['cookie']['cookiedomain']?>', cookiepath = '<?=$_G['config']['cookie']['cookiepath']?>', showusercard = '<?=$_G['setting']['showusercard']?>', attackevasive = '<?=$_G['config']['security']['attackevasive']?>', disallowfloat = '<?=$_G['setting']['disallowfloat']?>', creditnotice = '<? if($_G['setting']['creditnotice']) { ?><?=$_G['setting']['creditnames']?><? } ?>', defaultstyle = '<?=$_G['style']['defaultextstyle']?>', REPORTURL = '<?=$_G['currenturl_encode']?>', SITEURL = '<?=$_G['siteurl']?>';</script>
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

<div id="wp" class="wp"><? if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?
$slist[portal] = <<<EOF
<label for="mod_article" title="搜索文章"><input type="radio" id="mod_article" class="pr" name="mod" value="portal"
EOF;
 if(CURSCRIPT == 'portal') { 
$slist[portal] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[portal] .= <<<EOF
 /> 文章</label>
EOF;
?><? } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?
$slist[forum] = <<<EOF
<label for="mod_thread" title="搜索{$_G['setting']['navs']['2']['navname']}"><input type="radio" id="mod_thread" class="pr" name="mod" value="forum"
EOF;
 if(CURSCRIPT == 'forum') { 
$slist[forum] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[forum] .= <<<EOF
 /> {$_G['setting']['navs']['2']['navname']}</label>
EOF;
?><? } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?
$slist[blog] = <<<EOF
<label for="mod_blog" title="搜索日志"><input type="radio" id="mod_blog" class="pr" name="mod" value="blog"
EOF;
 if(CURSCRIPT == 'home' && $do != 'album') { 
$slist[blog] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[blog] .= <<<EOF
 /> 日志</label>
EOF;
?><? } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?
$slist[album] = <<<EOF
<label for="mod_album" title="搜索相册"><input type="radio" id="mod_album" class="pr" name="mod" value="album"
EOF;
 if(CURSCRIPT == 'home' && $do == 'album') { 
$slist[album] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[album] .= <<<EOF
 /> 相册</label>
EOF;
?><? } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?
$slist[group] = <<<EOF
<label for="mod_group" title="搜索{$_G['setting']['navs']['3']['navname']}"><input type="radio" id="mod_group" class="pr" name="mod" value="group"
EOF;
 if(CURSCRIPT == 'group') { 
$slist[group] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[group] .= <<<EOF
 /> {$_G['setting']['navs']['3']['navname']}</label>
EOF;
?><? } ?><?
$slist[user] = <<<EOF
<label for="mod_user" title="搜索好友"><input type="radio" id="mod_user" name="mod" value="user" class="pr" /> 用户</label>
EOF;
?>
<? } if($_G['setting']['search'] && $slist) { ?>
<div id="scbar" class="bm cl">
<form id="scform" class="z" method="post" autocomplete="off" onsubmit="searchFocus($('srchtxt'))" action="search.php?searchsubmit=yes" target="_blank">
<input type="hidden" name="mod" value="search" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="srchtype" value="title" />
<table cellspacing="0" cellpadding="0">
<tr>
<td><input type="text" name="srchtxt" id="srchtxt" value="请输入搜索内容" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td>&nbsp;<? echo implode('', $slist);; ?></td>
<td><button type="submit" id="search_submit" name="searchsubmit" class="xw1" value="true">搜索</button></td>
<td><a href="search.php?mod=search&amp;adv=yes" target="_blank" class="xi2">高级搜索</a></td>
<td>
<div class="hot">
<? if($_G['setting']['srchhotkeywords']) { ?>
<strong class="xw1 xi1">热搜: </strong><? if(is_array($_G['setting']['srchhotkeywords'])) foreach($_G['setting']['srchhotkeywords'] as $val) { if($val = trim($val)) { ?><a href="search.php?mod=search&amp;srchtxt=<? echo rawurlencode($val); ?>&amp;formhash=f1c7ceaa&amp;searchsubmit=true" target="_blank" class="xi2"><?=$val?></a><span class="pipe">|</span><? } } } ?>
</div>
</td>
</tr>
</table>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<? } ?><?php echo adshow("text/wp a_t"); ?><style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="wp cl<? if($_G['setting']['forumallowside']) { ?> ct2<? } ?>">
<div id="chart" class="bm bw0 cl">
<? if($_G['uid']) { ?><p class="y"><a href="home.php?mod=space&amp;uid=<?=$_G['uid']?>&amp;do=thread&amp;view=me" title="我的帖子" class="xi2">我的帖子</a><span class="pipe">|</span><a href="search.php?mod=forum&amp;srchfrom=<?=$newthreads?>&amp;searchsubmit=yes" title="查看新帖" class="xi2">查看新帖</a></p><? } ?>
<p class="chart">今日: <em><?=$todayposts?></em><span class="pipe">|</span>昨日: <?=$postdata['0']?><span class="pipe">|</span>帖子: <em><?=$posts?></em><span class="pipe">|</span>会员: <em><?=$_G['cache']['userstats']['totalmembers']?></em><? if($_G['setting']['lastmember']) { ?><span class="pipe">|</span>欢迎新会员: <em><a href="home.php?mod=space&amp;username=<? echo rawurlencode($_G['setting']['lastmember']); ?>" target="_blank" class="xi2"><?=$_G['setting']['lastmember']?></a></em><? } ?></p>
</div>
<? if(empty($gid) && $announcements) { ?>
<div id="an" class="bm bw0">
<dl class="cl">
<dt class="z xw1">公告:&nbsp;</dt>
<dd>
<div id="anc" class="xi2"><ul id="ancl"><?=$announcements?></ul></div>
</dd>
</dl>
</div>
<script type="text/javascript">announcement();</script>
<? } ?>

<div class="mn">
<?php if(!empty($_G['setting']['pluginhooks']['index_top'])) echo $_G['setting']['pluginhooks']['index_top']; if(!empty($_G['cache']['heats']['message'])) { ?>
<div class="bm">
<div class="bm_h cl">
<h2><?=$_G['setting']['navs']['2']['navname']?>热点</h2>
</div>
<div class="bm_c cl">
<div class="heat z"><? if(is_array($_G['cache']['heats']['message'])) foreach($_G['cache']['heats']['message'] as $data) { ?><dl class="xld">
<dt><? if($_G['adminid'] == 1) { ?><a class="d" href="forum.php?mod=misc&amp;action=removeindexheats&amp;tid=<?=$data['tid']?>" onclick="return removeindexheats()">delete</a><? } ?>
<a href="forum.php?mod=viewthread&amp;tid=<?=$data['tid']?>" target="_blank" class="xi2"><?=$data['subject']?></a></dt>
<dd><?=$data['message']?></dd>
</dl>
<? } ?>
</div>
<ul class="xl heatl"><? if(is_array($_G['cache']['heats']['subject'])) foreach($_G['cache']['heats']['subject'] as $data) { ?><li><? if($_G['adminid'] == 1) { ?><a class="d" href="forum.php?mod=misc&amp;action=removeindexheats&amp;tid=<?=$data['tid']?>" onclick="return removeindexheats()">delete</a><? } ?><a href="forum.php?mod=viewthread&amp;tid=<?=$data['tid']?>" target="_blank" class="xi2"><?=$data['subject']?></a></li>
<? } ?>
</ul>
</div>
</div>
<? } ?>

<div class="fl bm"><? if(is_array($catlist)) foreach($catlist as $key => $cat) { ?><div class="bm bmw <? if($cat['forumcolumns']) { ?> flg<? } ?> cl">
<div class="bm_h cl">
<span class="o">
<img id="category_<?=$cat['fid']?>_img" src="<?=IMGDIR?>/<?=$cat['collapseimg']?>" title="收起/展开" alt="收起/展开" onclick="toggle_collapse('category_<?=$cat['fid']?>');" />
</span>
<? if($cat['moderators']) { ?><span class="y">分区版主: <?=$cat['moderators']?></span><? } ?><?php $caturl = !empty($cat['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$cat['domain'].'.'.$_G['setting']['domain']['root']['forum'] : ''; ?><h2><a href="<? if(!empty($caturl)) { ?><?=$caturl?><? } else { ?>forum.php?gid=<?=$cat['fid']?><? } ?>" style="<? if($cat['extra']['namecolor']) { ?>color: <?=$cat['extra']['namecolor']?>;<? } ?>"><?=$cat['name']?></a></h2>
</div>
<div id="category_<?=$cat['fid']?>" class="bm_c" style="<?=$collapse['category_'.$cat['fid']]?>">
<table cellspacing="0" cellpadding="0" class="fl_tb">
<tr><? if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { ?><?php $forum=$forumlist[$forumid]; ?><?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid']; if($cat['forumcolumns']) { if($forum['orderid'] && ($forum['orderid'] % $cat['forumcolumns'] == 0)) { ?>
</tr>
<? if($forum['orderid'] < $cat['forumscount']) { ?>
<tr class="fl_row">
<? } } ?>
<td class="fl_g" width="<?=$cat['forumcolwidth']?>">
<div class="fl_icn_g"<? if(!empty($forum['extra']['iconwidth']) && !empty($forum['icon'])) { ?> style="width: <?=$forum['extra']['iconwidth']?>px;"<? } ?>>
<? if($forum['icon']) { ?>
<?=$forum['icon']?>
<? } else { ?>
<a href="<?=$forumurl?>"<? if($forum['redirect']) { ?> target="_blank"<? } ?>><img src="<?=IMGDIR?>/forum<? if($forum['folder']) { ?>_new<? } ?>.gif" alt="<?=$forum['name']?>" /></a>
<? } ?>
</div>
<dl<? if(!empty($forum['extra']['iconwidth']) && !empty($forum['icon'])) { ?> style="margin-left: <?=$forum['extra']['iconwidth']?>px;"<? } ?>>
<dt><a href="<?=$forumurl?>"<? if($forum['redirect']) { ?> target="_blank"<? } if($forum['extra']['namecolor']) { ?> style="color: <?=$forum['extra']['namecolor']?>;"<? } ?>><?=$forum['name']?></a><? if($forum['todayposts'] && !$forum['redirect']) { ?><em class="xw0 xi1" title="今日"> (<?=$forum['todayposts']?>)</em><? } ?></dt>
<? if(empty($forum['redirect'])) { ?><dd><em>主题: <?=$forum['threads']?></em>, <em>帖数: <?=$forum['posts']?></em></dd><? } ?>
<dd>
<? if($forum['permission'] == 1) { ?>
私密版块
<? } else { if($forum['redirect']) { ?>
<a href="<?=$forumurl?>" class="xi2">链接到外部地址</a>
<? } elseif(is_array($forum['lastpost'])) { if($cat['forumcolumns'] < 3) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?=$forum['lastpost']['tid']?>&amp;goto=lastpost#lastpost" class="xi2"><? echo cutstr($forum['lastpost']['subject'], 30); ?></a> <cite><?=$forum['lastpost']['dateline']?> <? if($forum['lastpost']['author']) { ?><?=$forum['lastpost']['author']?><? } else { ?>匿名<? } ?></cite>
<? } else { ?>
<a href="forum.php?mod=redirect&amp;tid=<?=$forum['lastpost']['tid']?>&amp;goto=lastpost#lastpost">最后发表: <?=$forum['lastpost']['dateline']?></a>
<? } } else { ?>
从未
<? } } ?>
</dd>
</dl>
</td>
<? } else { ?>
<td class="fl_icn" <? if(!empty($forum['extra']['iconwidth']) && !empty($forum['icon'])) { ?> style="width: <?=$forum['extra']['iconwidth']?>px;"<? } ?>>
<? if($forum['icon']) { ?>
<?=$forum['icon']?>
<? } else { ?>
<a href="<?=$forumurl?>"<? if($forum['redirect']) { ?> target="_blank"<? } ?>><img src="<?=IMGDIR?>/forum<? if($forum['folder']) { ?>_new<? } ?>.gif" alt="<?=$forum['name']?>" /></a>
<? } ?>
</td>
<td>
<h2><a href="<?=$forumurl?>"<? if($forum['redirect']) { ?> target="_blank"<? } if($forum['extra']['namecolor']) { ?> style="color: <?=$forum['extra']['namecolor']?>;"<? } ?>><?=$forum['name']?></a><? if($forum['todayposts'] && !$forum['redirect']) { ?><em class="xw0 xi1" title="今日"> (<?=$forum['todayposts']?>)</em><? } ?></h2>
<? if($forum['description']) { ?><p class="xg2"><?=$forum['description']?></p><? } if($forum['subforums']) { ?><p>子版块: <?=$forum['subforums']?></p><? } if($forum['moderators']) { ?><p>版主: <span class="xi2"><?=$forum['moderators']?></span></p><? } ?>
</td>
<td class="fl_i">
<? if(empty($forum['redirect'])) { ?><span class="xi2"><?=$forum['threads']?></span><span class="xg1"> / <?=$forum['posts']?></span><? } ?>
</td>
<td class="fl_by">
<div>
<? if($forum['permission'] == 1) { ?>
私密版块
<? } else { if($forum['redirect']) { ?>
<a href="<?=$forumurl?>" class="xi2">链接到外部地址</a>
<? } elseif(is_array($forum['lastpost'])) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?=$forum['lastpost']['tid']?>&amp;goto=lastpost#lastpost" class="xi2"><? echo cutstr($forum['lastpost']['subject'], 30); ?></a> <cite><?=$forum['lastpost']['dateline']?> <? if($forum['lastpost']['author']) { ?><?=$forum['lastpost']['author']?><? } else { ?>匿名<? } ?></cite>
<? } else { ?>
从未
<? } } ?>
</div>
</td>
</tr>
<tr class="fl_row">
<? } } ?>
<?=$cat['endrows']?>
</tr>
</table>
</div>
</div><?php echo adshow("intercat/bm a_c/$cat[fid]"); } ?>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['index_middle'])) echo $_G['setting']['pluginhooks']['index_middle']; if(empty($gid) && $_G['setting']['whosonlinestatus']) { ?>
<div id="online" class="bm oll">
<div class="bm_h">
<? if($detailstatus) { ?>
<span class="o"><a href="forum.php?showoldetails=no#online" title="收起/展开"><img src="<?=IMGDIR?>/collapsed_no.gif" alt="收起/展开" /></a></span>
<h3>
<strong><a href="home.php?mod=space&amp;do=friend&amp;view=online&amp;type=member">在线会员</a></strong>
<span class="xs1">- <strong><?=$onlinenum?></strong> 人在线
- <strong><?=$membercount?></strong> 会员(<strong><?=$invisiblecount?></strong> 隐身),
<strong><?=$guestcount?></strong> 位游客
- 最高记录是 <strong><?=$onlineinfo['0']?></strong> 于 <strong><?=$onlineinfo['1']?></strong>.</span>
</h3>
<? } else { ?>
<span class="o"><a href="forum.php?showoldetails=yes#online" title="收起/展开"><img src="<?=IMGDIR?>/collapsed_yes.gif" alt="收起/展开" /></a></span>
<h3>
<strong><a href="home.php?mod=space&amp;do=friend&amp;view=online&amp;type=member">在线会员</a></strong>
<span class="xs1">- 总计 <strong><?=$onlinenum?></strong> 人在线
- 最高记录是 <strong><?=$onlineinfo['0']?></strong> 于 <strong><?=$onlineinfo['1']?></strong>.</span>
</h3>
<? } ?>
</div>
<? if($_G['setting']['whosonlinestatus'] && $detailstatus) { ?>
<dl id="onlinelist" class="bm_c">
<dt class="ptm pbm bbda"><?=$_G['cache']['onlinelist']['legend']?></dt>
<? if($detailstatus) { ?>
<dd class="ptm pbm">
<ul class="cl">
<? if($whosonline) { if(is_array($whosonline)) foreach($whosonline as $key => $online) { ?><li title="时间: <?=$online['lastactivity']?>">
<img src="<?=STATICURL?>image/common/<?=$online['icon']?>" alt="icon" />
<? if($online['uid']) { ?>
<a href="home.php?mod=space&amp;uid=<?=$online['uid']?>"><?=$online['username']?></a>
<? } else { ?>
<?=$online['username']?>
<? } ?>
</li>
<? } } else { ?>
<li style="width: auto">当前只有游客或隐身会员在线</li>
<? } ?>
</ul>
</dd>
<? } ?>
</dl>
<? } ?>
</div>
<? } if(empty($gid) && ($_G['cache']['forumlinks']['0'] || $_G['cache']['forumlinks']['1'] || $_G['cache']['forumlinks']['2'])) { ?>
<div class="bm lk">
<div id="category_lk" class="bm_c ptm">
<? if($_G['cache']['forumlinks']['0']) { ?>
<ul class="m mbn cl"><?=$_G['cache']['forumlinks']['0']?></ul>
<? } if($_G['cache']['forumlinks']['1']) { ?>
<div class="mbn cl">
<?=$_G['cache']['forumlinks']['1']?>
</div>
<? } if($_G['cache']['forumlinks']['2']) { ?>
<ul class="x mbm cl">
<?=$_G['cache']['forumlinks']['2']?>
</ul>
<? } ?>
</div>
</div>
<? } ?>

<?php if(!empty($_G['setting']['pluginhooks']['index_bottom'])) echo $_G['setting']['pluginhooks']['index_bottom']; ?>
</div>

<? if($_G['setting']['forumallowside']) { ?>
<div id="sd" class="sd">
<?php if(!empty($_G['setting']['pluginhooks']['index_side_top'])) echo $_G['setting']['pluginhooks']['index_side_top']; ?>
<div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>
<?php if(!empty($_G['setting']['pluginhooks']['index_side_bottom'])) echo $_G['setting']['pluginhooks']['index_side_bottom']; ?>
</div>
<? } ?>
</div>

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