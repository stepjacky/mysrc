<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_index');
0
|| checktplrefresh('./template/default/portal/portalcp_index.htm', './template/default/common/simplesearchform.htm', 1286717125, '1', './data/template/1_1_portal_portalcp_index.tpl.php', './template/default', 'portal/portalcp_index')
|| checktplrefresh('./template/default/portal/portalcp_index.htm', './template/default/portal/portalcp_nav.htm', 1286717125, '1', './data/template/1_1_portal_portalcp_index.tpl.php', './template/default', 'portal/portalcp_index')
;?><? include template('common/header'); ?><style type="text/css">
.parentcat {}
.cat { margin-left: 20px; }
.lastchildcat, .childcat { margin-left: 40px; }
</style>
<? if($op == 'push') { ?>
<h3 class="flb">
<em>生成文章</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>

<div class="c" style="width:260px; height: 300px; overflow: hidden; overflow-y: scroll;">
<p>选择一个频道分类：</p>
<? if($categorytree) { ?>
<table class="mtw dt">
<?=$categorytree?>
</table>
<? } else { ?>
<p>!portalcp_index_message1!</p>
<? } ?>
</div>
<script language="javascript">
function toggle_group(oid, obj, conf) {
obj = obj ? obj : $('a_'+oid);
if(!conf) {
var conf = {'show':'[-]','hide':'[+]'};
}
var obody = $(oid);
if(obody.style.display == 'none') {
obody.style.display = '';
obj.innerHTML = conf.show;
} else {
obody.style.display = 'none';
obj.innerHTML = conf.hide;
}
}
</script>

<? } else { ?>
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
<a href="./" class="nvhm" title="首页"><?=$_G['setting']['bbname']?></a> <em>&rsaquo;</em> 
<a href="portal.php"><?=$_G['setting']['navs']['1']['navname']?></a> <em>&rsaquo;</em>
<a href="portal.php?mod=portalcp">门户管理</a> <em>&rsaquo;</em>
频道栏目
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<h1 class="mt">频道栏目</h1>
<div class="bm bw0">
<? if($categorytree) { ?>
<table class="dt">
<tr>
<th>分类名称</th>
<th width="80">文章数</th>
<th width="120">操作</th>
</tr>
<?=$categorytree?>
</table>
<? } elseif(empty($_G['cache']['portalcategory'])) { ?>
<p>您还没有创建任何频道栏目</p>
<? } else { ?>
<p>您还未被授权管理任何频道栏目</p>
<? } ?>
</div>
</div>
<div class="appl"><div class="tbn">
<ul>
<? if($_G['group']['allowauthorizedarticle'] || $_G['group']['allowmanagearticle']) { ?><li<? if($ac == 'index' || $ac == 'category') { ?> class="a"<? } ?>><a href="portal.php?mod=portalcp&amp;ac=index">频道栏目</a></li><? } if($_G['group']['allowauthorizedblock'] || $_G['group']['allowdiy']) { ?>
<li<? if($ac == 'portalblock' || $ac=='block') { ?> class="a"<? } ?>><a href="portal.php?mod=portalcp&amp;ac=portalblock">模块管理</a></li>
<li<? if($ac == 'blockdata') { ?> class="a"<? } ?>><a href="portal.php?mod=portalcp&amp;ac=blockdata&amp;op=manage">推送审核</a></li>
<? } if(!$_G['inajax'] && !empty($_G['setting']['plugins']['portalcp'])) { if(is_array($_G['setting']['plugins']['portalcp'])) foreach($_G['setting']['plugins']['portalcp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<? if($_G['gp_id'] == $id) { ?> class="a"<? } ?>><a href="portal.php?mod=portalcp&amp;ac=plugin&amp;id=<?=$id?>"><?=$module['name']?></a></li><? } } } if(!empty($modsession->islogin)) { ?>
<li><a href="portal.php?mod=portalcp&amp;ac=logout">退出</a></li>
<? } ?>
</ul>
</div></div>
</div>
<? } include template('common/footer'); ?>