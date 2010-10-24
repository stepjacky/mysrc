<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forum');
0
|| checktplrefresh('./template/default/search/forum.htm', './template/default/search/header.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
|| checktplrefresh('./template/default/search/forum.htm', './template/default/search/pubsearch.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
|| checktplrefresh('./template/default/search/forum.htm', './template/default/search/thread_list.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
|| checktplrefresh('./template/default/search/forum.htm', './template/default/search/sort_list.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
|| checktplrefresh('./template/default/search/forum.htm', './template/default/search/footer.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
|| checktplrefresh('./template/default/search/forum.htm', './template/default/common/header_common.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
|| checktplrefresh('./template/default/search/forum.htm', './template/default/common/header.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
|| checktplrefresh('./template/default/search/forum.htm', './template/default/common/simplesearchform.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
|| checktplrefresh('./template/default/search/forum.htm', './template/default/common/footer.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
|| checktplrefresh('./template/default/search/forum.htm', './template/default/common/header_common.htm', 1286718480, '1', './data/template/1_1_search_forum.tpl.php', './template/default', 'search/forum')
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
<base href="<?=$_G['siteurl']?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_search_forum.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?><script type="text/javascript">var STYLEID = '<?=STYLEID?>', STATICURL = '<?=STATICURL?>', IMGDIR = '<?=IMGDIR?>', VERHASH = '<?=VERHASH?>', charset = '<?=CHARSET?>', discuz_uid = '<?=$_G['uid']?>', cookiepre = '<?=$_G['config']['cookie']['cookiepre']?>', cookiedomain = '<?=$_G['config']['cookie']['cookiedomain']?>', cookiepath = '<?=$_G['config']['cookie']['cookiepath']?>', showusercard = '<?=$_G['setting']['showusercard']?>', attackevasive = '<?=$_G['config']['security']['attackevasive']?>', disallowfloat = '<?=$_G['setting']['disallowfloat']?>', creditnotice = '<? if($_G['setting']['creditnotice']) { ?><?=$_G['setting']['creditnames']?><? } ?>', defaultstyle = '<?=$_G['style']['defaultextstyle']?>', REPORTURL = '<?=$_G['currenturl_encode']?>', SITEURL = '<?=$_G['siteurl']?>';</script>
<script src="<?=$_G['setting']['jspath']?>common.js?<?=VERHASH?>" type="text/javascript"></script></head>

<body id="nv_search" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<div id="hd">
<div class="bbs cl">
<div class="z">
<span id="navs" class="xg1 showmenu" onmouseover="showMenu(this.id);"><a href="home.php?mod=space&amp;do=home">返回首页</a></span>
</div>
<div class="sch y">
<p>
<? if($_G['uid']) { ?>
<strong><a href="home.php?mod=space" class="vwmy" target="_blank" title="访问我的空间"><?=$_G['member']['username']?></a></strong>
<? if($_G['group']['allowinvisible']) { ?><span id="loginstatus" class="xg1"><a href="member.php?mod=switchstatus" title="切换在线状态" onclick="ajaxget(this.href, 'loginstatus');doane(event);"><? if($_G['session']['invisible']) { ?>隐身<? } else { ?>在线<? } ?></a></span><? } ?>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=home">我的中心</a>
<span class="xg1"><a href="home.php?mod=spacecp">设置</a></span>

<span class="pipe">|</span><a href="home.php?mod=space&amp;do=notice" id="myprompt"<? if($_G['member']['newprompt']) { ?> class="new"<? } ?>>提醒<? if($_G['member']['newprompt']) { ?>(<?=$_G['member']['newprompt']?>)<? } ?></a><span id="myprompt_check"></span>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<? if($_G['member']['newpm']) { ?> class="new"<? } ?>>短消息<? if($_G['member']['newpm']) { ?>(<?=$_G['member']['newpm']?>)<? } ?></a>

<? if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?><span class="pipe">|</span><a href="portal.php?mod=portalcp">门户管理</a><? } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?><span class="pipe">|</span><a href="forum.php?mod=modcp&amp;fid=<?=$_G['fid']?>" target="_blank"><?=$_G['setting']['navs']['2']['navname']?>管理</a><? } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?><span class="pipe">|</span><a href="admin.php" target="_blank">管理中心</a><? } ?>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?=FORMHASH?>">退出</a>
<? } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<strong><a id="loginuser" class="noborder"><?=$_G['cookie']['loginuser']?></a></strong>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);hideWindow('register');">激活</a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?=FORMHASH?>">退出</a>
<? } else { ?>
<a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="showWindow('register', this.href);hideWindow('login');" class="noborder"><?=$_G['setting']['reglinkname']?></a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);hideWindow('register');">登录</a>
<? } ?>
</p>
</div>
</div>
</div>
<? if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
<ul class="p_pop h_pop" id="plugin_menu" style="display: none"><? if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { ?>     <? if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
     <li><?=$module['url']?></li>
     <? } } ?>
</ul>
<? } ?>
<?=$_G['setting']['menunavs']?>

<? if($_G['setting']['navs']) { ?>
<ul class="p_pop h_pop" id="navs_menu" style="display: none"><? if(is_array($_G['setting']['navs'])) foreach($_G['setting']['navs'] as $nav) { ?><?php $nav_showmenu = strpos($nav['nav'], 'onmouseover="showMenu('); ?>    <?php $nav_navshow = strpos($nav['nav'], 'onmouseover="navShow(') ?>    <? if($nav_hidden !== false || $nav_navshow !== false) { ?><?php $nav['nav'] = preg_replace("/onmouseover\=\"(.*?)\"/i", '',$nav['nav']) ?>    <? } if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?><li <?=$nav['nav']?>></li><? } } ?>
</ul>
<? } ?><div id="ct" class="cl w">
<div class="mw">
<form class="searchform" method="post" autocomplete="off" action="search.php?mod=forum">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" /><? if($searchid || ($_G['gp_adv'] && $checkarray['posts'] && CURMODULE == 'forum')) { ?>
<table id="tpsch" class="mbm" cellspacing="0" cellpadding="0">
<tr>
<td><h1><a href="./" title="<?=$_G['setting']['bbname']?>"><?=BOARDLOGO?></a></h1></td>
<td>
<ul class="tb cl">
<? if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?
$slist[portal] = <<<EOF
<li
EOF;
 if(CURMODULE == 'portal') { 
$slist[portal] .= <<<EOF
 class="a"
EOF;
 } 
$slist[portal] .= <<<EOF
><a href="search.php?mod=portal
EOF;
 if($keyword) { 
$slist[portal] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[portal] .= <<<EOF
">文章</a></li>
EOF;
?><? } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?
$slist[forum] = <<<EOF
<li
EOF;
 if(CURMODULE == 'forum') { 
$slist[forum] .= <<<EOF
 class="a"
EOF;
 } 
$slist[forum] .= <<<EOF
><a href="search.php?mod=forum
EOF;
 if($keyword) { 
$slist[forum] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[forum] .= <<<EOF
">{$_G['setting']['navs']['2']['navname']}</a></li>
EOF;
?><? } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?
$slist[blog] = <<<EOF
<li
EOF;
 if(CURMODULE == 'blog') { 
$slist[blog] .= <<<EOF
 class="a"
EOF;
 } 
$slist[blog] .= <<<EOF
><a href="search.php?mod=blog
EOF;
 if($keyword) { 
$slist[blog] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[blog] .= <<<EOF
">日志</a></li>
EOF;
?><? } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?
$slist[album] = <<<EOF
<li
EOF;
 if(CURMODULE == 'album') { 
$slist[album] .= <<<EOF
 class="a"
EOF;
 } 
$slist[album] .= <<<EOF
><a href="search.php?mod=album
EOF;
 if($keyword) { 
$slist[album] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[album] .= <<<EOF
">相册</a></li>
EOF;
?><? } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?
$slist[group] = <<<EOF
<li
EOF;
 if(CURMODULE == 'group') { 
$slist[group] .= <<<EOF
 class="a"
EOF;
 } 
$slist[group] .= <<<EOF
><a href="search.php?mod=group
EOF;
 if($keyword) { 
$slist[group] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[group] .= <<<EOF
">{$_G['setting']['navs']['3']['navname']}</a></li>
EOF;
?><? } ?><?
$slist[user] = <<<EOF
<li
EOF;
 if(CURMODULE == 'user') { 
$slist[user] .= <<<EOF
 class="a"
EOF;
 } 
$slist[user] .= <<<EOF
><a href="search.php?mod=user
EOF;
 if($keyword) { 
$slist[user] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[user] .= <<<EOF
">用户</a></li>
EOF;
?><? echo implode("", $slist);; ?></ul>
<table id="tps_form" cellspacing="0" cellpadding="0">
<tr>
<td>
<input type="text" id="srchtxt" name="srchtxt" class="schtxt" size="45" maxlength="40" value="<?=$keyword?>" tabindex="1" />
<script type="text/javascript">$('srchtxt').focus();</script>
</td>
<td>
<input type="hidden" name="searchsubmit" value="yes" />
<button type="submit" id="tps_btn" class="schbtn"><strong>搜索</strong></button>
</td>
<? if(CURMODULE == 'forum') { ?>
<td style="padding-left: 10px; background: #FFF;">
<? if(($_G['group']['allowsearch'] & 32)) { ?><label><input type="checkbox" name="srchtype" class="pc" value="fulltext" <?=$fulltextchecked?>/> 全文</label><br /><? } if($checkarray['posts']) { if(!$_G['gp_adv']) { ?>
<a href="search.php?mod=forum&amp;adv=yes">高级</a>
<? } else { ?>
<a href="search.php?mod=forum">返回普通搜索</a>
<? } } ?>
</td>
<? } ?>
</tr>
</table>
</td>
</tr>
</table>
<? if($_G['gp_adv']) { ?>
<div id="search_option">
<h2 class="mt">搜索选项</h2>
<table summary="搜索" cellspacing="0" cellpadding="0" class="tfm">
<? if($srchtype == 'threadsort') { ?>
<tr>
<th><label for="typeid">分类信息</label></th>
<td>
<select name="sortid" onchange="ajaxget('forum.php?mod=post&action=threadsorts&sortid='+this.options[this.selectedIndex].value+'&operate=1', 'threadsorts', 'threadsortswait')">
<option value="0">无</option><?=$threadsorts?>
</select>
<span id="threadsortswait"></span>
</td>
</tr>
<tbody id="threadsorts"></tbody>
<? } if($checkarray['posts'] || $srchtype == 'trade') { ?>
<tr>
<th>作者</th>
<td><input type="text" id="srchname" name="srchuname" size="25" maxlength="40" class="px" value="<?=$srchuname?>" /></td>
</tr>

<tr>
<th>主题范围</th>
<td>
<label><input type="radio" class="pr" name="srchfilter" value="all" checked="checked" /> 全部主题</label>
<label><input type="radio" class="pr" name="srchfilter" value="digest" /> 精华主题</label>
<label><input type="radio" class="pr" name="srchfilter" value="top" /> 置顶主题</label>
</td>
</tr>
<? } if($checkarray['posts']) { ?>
<tr>
<th>特殊主题</th>
<td>
<label><input type="checkbox" class="pc" name="special[]" value="1" /> 投票主题</label>
<label><input type="checkbox" class="pc" name="special[]" value="2" /> 商品主题</label>
<label><input type="checkbox" class="pc" name="special[]" value="3" /> 悬赏主题</label>
<label><input type="checkbox" class="pc" name="special[]" value="4" /> 活动主题</label>
<label><input type="checkbox" class="pc" name="special[]" value="5" /> 辩论主题</label>
</td>
</tr>
<? } if($checkarray['posts'] || $srchtype == 'trade') { ?>
<tr>
<th><label for="srchfrom">搜索时间</label></th>
<td>
<select id="srchfrom" name="srchfrom">
<option value="0">全部时间</option>
<option value="86400">1 天</option>
<option value="172800">2 天</option>
<option value="604800">1 周</option>
<option value="2592000">1 个月</option>
<option value="7776000">3 个月</option>
<option value="15552000">6 个月</option>
<option value="31536000">1 年</option>
</select>
<label><input type="radio" class="pr" name="before" value="" checked="checked" /> 以内</label>
<label><input type="radio" class="pr" name="before" value="1" /> 以前</label>
</td>
</tr>

<tr>
<th><label for="orderby">排序类型</label></th>
<td>
<select id="orderby1" name="orderby">
<option value="lastpost" selected="selected">回复时间</option>
<option value="dateline">发布时间</option>
<option value="replies">回复数量</option>
<option value="views">浏览次数</option>
</select>
<select id="orderby2" name="orderby" style="position: absolute; display: none" disabled>
<option value="dateline" selected="selected">发布时间</option>
<option value="price">商品价格</option>
<option value="expiration">剩余时间</option>
</select>
<label><input type="radio" class="pr" name="ascdesc" value="asc" /> 按升序排列</label>
<label><input type="radio" class="pr" name="ascdesc" value="desc" checked="checked" /> 按降序排列</label>
</td>
</tr>
<? } ?>

<tr>
<th valign="top"><label for="srchfid">搜索范围</label></th>
<td>
<select id="srchfid" name="srchfid[]" multiple="multiple" size="10" style="width: 26em;">
<option value="all"<? if(!$srchfid) { ?> selected="selected"<? } ?>>全部版块</option>
<?=$forumselect?>
</select>
</td>
</tr>

<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="yes" />
<button type="submit" class="pn pnc"><strong>搜索</strong></button>
</td>
</tr>
</table>
<? if(empty($srchtype) && empty($keyword)) { ?>
<div class="bm bw0">
<h3>便捷搜索</h3>
<table cellspacing="4" cellpadding="0" width="100%">
<tr>
<td><a href="search.php?mod=forum&amp;srchfrom=3600&amp;searchsubmit=yes">1 小时以内的新帖</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=14400&amp;searchsubmit=yes">4 小时以内的新帖</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=28800&amp;searchsubmit=yes">8 小时以内的新帖</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=86400&amp;searchsubmit=yes">24 小时以内的新帖</a></td>
</tr>
<tr>
<td><a href="search.php?mod=forum&amp;srchfrom=604800&amp;searchsubmit=yes">1 周内帖子</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=2592000&amp;searchsubmit=yes">1 月内帖子</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=15552000&amp;searchsubmit=yes">6 月内帖子</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=31536000&amp;searchsubmit=yes">1 年内帖子</a></td>
</tr>
</table>
</div>
<? } ?>
</div>
<? } } else { if(!empty($srchtype)) { ?><input type="hidden" name="srchtype" value="<?=$srchtype?>" /><? } if($srchtype != 'threadsort') { ?>
<div>
<table id="tpsch" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
<tr>
<td class="hm mtw ptw pbw"><h1 class="mtw ptw"><a href="./" title="<?=$_G['setting']['bbname']?>"><?=BOARDLOGO?></a></h1></td>
<td></td>
</tr>
<tr>
<td class="hm xs2 pbm" width="400">
<? if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?
$slist[portal] = <<<EOF

EOF;
 if(CURMODULE == 'portal') { 
$slist[portal] .= <<<EOF
<strong>文章</strong>
EOF;
 } else { 
$slist[portal] .= <<<EOF
<a href="search.php?mod=portal
EOF;
 if($keyword) { 
$slist[portal] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[portal] .= <<<EOF
">文章</a>
EOF;
 } 
$slist[portal] .= <<<EOF

EOF;
?><? } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?
$slist[forum] = <<<EOF

EOF;
 if(CURMODULE == 'forum') { 
$slist[forum] .= <<<EOF
<strong>{$_G['setting']['navs']['2']['navname']}</strong>
EOF;
 } else { 
$slist[forum] .= <<<EOF
<a href="search.php?mod=forum
EOF;
 if($keyword) { 
$slist[forum] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[forum] .= <<<EOF
">{$_G['setting']['navs']['2']['navname']}</a>
EOF;
 } 
$slist[forum] .= <<<EOF

EOF;
?><? } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?
$slist[blog] = <<<EOF

EOF;
 if(CURMODULE == 'blog') { 
$slist[blog] .= <<<EOF
<strong>日志</strong>
EOF;
 } else { 
$slist[blog] .= <<<EOF
<a href="search.php?mod=blog
EOF;
 if($keyword) { 
$slist[blog] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[blog] .= <<<EOF
">日志</a>
EOF;
 } 
$slist[blog] .= <<<EOF

EOF;
?><? } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?
$slist[album] = <<<EOF

EOF;
 if(CURMODULE == 'album') { 
$slist[album] .= <<<EOF
<strong>相册</strong>
EOF;
 } else { 
$slist[album] .= <<<EOF
<a href="search.php?mod=album
EOF;
 if($keyword) { 
$slist[album] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[album] .= <<<EOF
">相册</a>
EOF;
 } 
$slist[album] .= <<<EOF

EOF;
?><? } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?
$slist[group] = <<<EOF

EOF;
 if(CURMODULE == 'group') { 
$slist[group] .= <<<EOF
<strong>{$_G['setting']['navs']['3']['navname']}</strong>
EOF;
 } else { 
$slist[group] .= <<<EOF
<a href="search.php?mod=group
EOF;
 if($keyword) { 
$slist[group] .= <<<EOF
&amp;srchtxt={$keyword}&amp;searchsubmit=yes
EOF;
 } 
$slist[group] .= <<<EOF
">{$_G['setting']['navs']['3']['navname']}</a>
EOF;
 } 
$slist[group] .= <<<EOF

EOF;
?><? } echo implode("<span class=\"pipe\">|</span>", $slist);; ?><span class="pipe">|</span>
<? if(CURMODULE == 'user') { ?><strong>用户</strong><? } else { ?><a href="search.php?mod=user<? if($keyword) { ?>&amp;srchtxt=<?=$keyword?>&amp;searchsubmit=yes<? } ?>">用户</a><? } ?>
</td>
<td></td>
</tr>
<tr id="tps_form">
<td>
<input type="text" id="srchtxt" name="srchtxt" size="65" maxlength="40" value="<?=$keyword?>" class="schtxt" tabindex="1" />
<script type="text/javascript">$('srchtxt').focus();</script>
</td>
<td>
<input type="hidden" name="searchsubmit" value="yes" />
<button type="submit" id="tps_btn" value="true" class="schbtn"><strong>搜索</strong></button>
</td>

<td style="padding-left: 10px; width: 50px; background: #FFF; text-align: left;">
<? if(CURMODULE == 'forum') { if(($_G['group']['allowsearch'] & 32)) { ?><label><input type="checkbox" name="srchtype" class="pc" value="fulltext" <?=$fulltextchecked?>/> 全文</label><br /><? } if($checkarray['posts']) { ?>
<a href="search.php?mod=forum&amp;adv=yes">高级</a>
<? } } ?>
</td>
</tr>
</table>
</div>
<? } } ?><?php if(!empty($_G['setting']['pluginhooks']['forum_top'])) echo $_G['setting']['pluginhooks']['forum_top']; ?><?php $policymsgs = $p = ''; if(is_array($_G['setting']['creditspolicy']['search'])) foreach($_G['setting']['creditspolicy']['search'] as $id => $policy) { ?><?
$policymsg = <<<EOF

EOF;
 if($_G['setting']['extcredits'][$id]['img']) { 
$policymsg .= <<<EOF
{$_G['setting']['extcredits'][$id]['img']} 
EOF;
 } 
$policymsg .= <<<EOF
{$_G['setting']['extcredits'][$id]['title']} {$policy} {$_G['setting']['extcredits'][$id]['unit']}
EOF;
?><?php $policymsgs .= $p.$policymsg;$p = ', '; } if($policymsgs) { ?><p>每进行一次搜索将扣除 <?=$policymsgs?></p><? } ?>	
</form>

<? if(!empty($searchid) && submitcheck('searchsubmit', 1)) { if($checkarray['posts']) { ?><div class="tl">
<div class="sttl mbn">
<h2><? if($keyword) { ?>结果: <em>找到 “<span class="emfont"><?=$keyword?></span>” 相关内容 <?=$index['num']?> 个</em><? } else { ?>结果: <em>找到相关主题 <?=$index['num']?> 个</em><? } ?></h2>
</div>
<? if(empty($threadlist)) { ?>
<p class="emp xs2 xg2">对不起，没有找到匹配结果。</p>
<? } else { ?>
<div class="slst mtw">
<ul><? if(is_array($threadlist)) foreach($threadlist as $thread) { ?><li class="pbw">
<h3 class="xs3"><a href="forum.php?mod=viewthread&amp;tid=<?=$thread['tid']?>&amp;highlight=<?=$index['keywords']?>" target="_blank" <?=$thread['highlight']?>><?=$thread['subject']?></a></h3>
<p class="xg1"><?=$thread['replies']?> 个评论 - <?=$thread['views']?> 次查看</p>
<p><? if(!$thread['price'] && !$thread['readperm']) { ?><?=$thread['message']?><? } else { ?>内容隐藏需要，请点击进去查看<? } ?></p>
<p>
<span><?=$thread['dateline']?></span>
 - 
<span>
<? if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?=$thread['authorid']?>" target="_blank"><?=$thread['author']?></a>
<? } else { if($_G['forum']['ismoderator']) { ?><a href="home.php?mod=space&amp;uid=<?=$thread['authorid']?>" target="_blank">匿名</a><? } else { ?>匿名<? } } ?>
</span>
 - 
<span><a href="forum.php?mod=forumdisplay&amp;fid=<?=$thread['fid']?>" target="_blank" class="xi1"><?=$thread['forumname']?></a></span>
</p>
</li>
<? } ?>
</ul>
</div>
<? } if(!empty($multipage)) { ?><div class="pgs cl mbm"><?=$multipage?></div><? } ?>
</div><? } elseif($checkarray['threadsort']) { ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<base href="<?=$_G['siteurl']?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_common.css?<?=VERHASH?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?=STYLEID?>_search_forum.css?<?=VERHASH?>" /><? if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['cookie']['extstyle']?>/style.css" /><? } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?=$_G['style']['defaultextstyle']?>/style.css" /><? } ?><script type="text/javascript">var STYLEID = '<?=STYLEID?>', STATICURL = '<?=STATICURL?>', IMGDIR = '<?=IMGDIR?>', VERHASH = '<?=VERHASH?>', charset = '<?=CHARSET?>', discuz_uid = '<?=$_G['uid']?>', cookiepre = '<?=$_G['config']['cookie']['cookiepre']?>', cookiedomain = '<?=$_G['config']['cookie']['cookiedomain']?>', cookiepath = '<?=$_G['config']['cookie']['cookiepath']?>', showusercard = '<?=$_G['setting']['showusercard']?>', attackevasive = '<?=$_G['config']['security']['attackevasive']?>', disallowfloat = '<?=$_G['setting']['disallowfloat']?>', creditnotice = '<? if($_G['setting']['creditnotice']) { ?><?=$_G['setting']['creditnames']?><? } ?>', defaultstyle = '<?=$_G['style']['defaultextstyle']?>', REPORTURL = '<?=$_G['currenturl_encode']?>', SITEURL = '<?=$_G['siteurl']?>';</script>
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

<div id="wp" class="wp"><div id="pt" class="bm cl"><? if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?
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
<a href="forum.php"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em> 分类信息
</div>
</div>

<div id="ct" class="wp cl">
<div class="mn">
<div class="content">
<div class="searchlist threadlist datalist">
<div class="itemtitle s_clear">
<h1>结果: <em>找到相关主题 <?=$index['num']?> 个</em></h1>
<? if(!empty($multipage)) { ?><?=$multipage?><? } ?>
</div>
<table summary="搜索" cellspacing="0" cellpadding="0" width="100%" class="datatable">
<thead>
<tr class="alt">
<td class="icon">&nbsp;</td>
<td>标题</td><? if(is_array($_G['forum_optionlist'])) foreach($_G['forum_optionlist'] as $var) { ?><td style="width: 10%"><?=$var?></td>
<? } ?>
<td style="width: 15%">发布时间</td>
</tr>
</thead>
<? if($resultlist) { if(is_array($resultlist)) foreach($resultlist as $tid => $value) { ?><tbody>
<tr>
<td class="icon"><?=$value['icon']?></td>
<th><a href="forum.php?mod=viewthread&amp;tid=<?=$tid?>" target="_blank"><?=$value['subject']?></a></th><? if(is_array($_G['forum_optionlist'])) foreach($_G['forum_optionlist'] as $identifier => $var) { ?><td style="width: 10%"><? if($value['option'][$identifier]) { ?><?=$value['option'][$identifier]?><? } else { ?>&nbsp;<? } ?></td>
<? } ?>
<td style="width: 15%"><?=$value['dateline']?></td>
</tr>
</tbody>
<? } } else { ?>
<tr><td colspan="<?=$colspan?>">对不起，没有找到匹配结果。</td></tr>
<? } ?>
</table>
<? if(!empty($multipage)) { ?><div class="pages_btns s_clear"><?=$multipage?></div><? } ?>
</div>
</div>
</div>
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
</html><? } } ?>

</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['forum_bottom'])) echo $_G['setting']['pluginhooks']['forum_bottom']; ?>

<script type="text/javascript">
<? if($sortid) { ?>
ajaxget('forum.php?mod=post&action=threadsorts&sortid=<?=$sortid?>&operate=1&inajax=1', 'threadsorts', 'threadsortswait');
<? } ?>
</script><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="focus">
<h3 class="flb">
<em><? if($_G['cache']['focus']['title']) { ?><?=$_G['cache']['focus']['title']?><? } else { ?>站长推荐<? } ?></em>
<span><a href="javascript:;" onclick="setcookie('nofocus_<?=$focusid?>', 1, 86400);$('focus').style.display='none'" class="flbc" title="关闭">关闭</a></span>
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
<? } ?><?php echo adshow("footerbanner/wp a_f hm/1"); ?><?php echo adshow("footerbanner/wp a_f hm/2"); ?><?php echo adshow("footerbanner/wp a_f hm/3"); ?><?php echo adshow("float/a_fl/1"); ?><?php echo adshow("float/a_fr/2"); ?><?php echo adshow("couplebanner/a_fl a_cb/1"); ?><?php echo adshow("couplebanner/a_fr a_cb/2"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?>

<div id="ft" class="w cl">
<strong><a href="<?=$_G['setting']['siteurl']?>" target="_blank"><?=$_G['setting']['sitename']?></a></strong>
<? if($_G['setting']['icp']) { ?>( <a href="http://www.miibeian.gov.cn/" target="_blank"><?=$_G['setting']['icp']?></a>)<? } if($_G['setting']['adminemail']) { ?><span class="pipe">|</span><a href="mailto:<?=$_G['setting']['adminemail']?>">联系我们</a><? } if($_G['setting']['statcode']) { ?><span class="pipe">| <?=$_G['setting']['statcode']?></span><? } ?>
<span class="pipe">|</span>

<em>Powered by <strong><a href="http://www.discuz.net" target="_blank">Discuz!</a></strong> <em><?=$_G['setting']['version']?></em><? if(!empty($_G['setting']['boardlicensed'])) { ?> <a href="http://license.comsenz.com/?pid=1&amp;host=<?=$_SERVER['HTTP_HOST']?>" target="_blank">Licensed</a><? } ?></em> &nbsp; 
<em class="xs0">&copy; 2001-2010 <a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a></em><?php updatesession(); ?></div>
<? if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?=$_G['timestamp']?>" type="text/javascript"></script>
<? } ?><?php output(); ?></body>
</html>