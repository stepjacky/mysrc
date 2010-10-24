<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_portalblock');
0
|| checktplrefresh('./template/default/portal/portalcp_portalblock.htm', './template/default/common/simplesearchform.htm', 1286717129, '1', './data/template/1_1_portal_portalcp_portalblock.tpl.php', './template/default', 'portal/portalcp_portalblock')
|| checktplrefresh('./template/default/portal/portalcp_portalblock.htm', './template/default/portal/portalcp_pageblock.htm', 1286717129, '1', './data/template/1_1_portal_portalcp_portalblock.tpl.php', './template/default', 'portal/portalcp_portalblock')
|| checktplrefresh('./template/default/portal/portalcp_portalblock.htm', './template/default/portal/portalcp_nav.htm', 1286717129, '1', './data/template/1_1_portal_portalcp_portalblock.tpl.php', './template/default', 'portal/portalcp_portalblock')
;?><? include template('common/header'); if(!$_G['inajax']) { ?>
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
<a href="<?=$_G['setting']['navs']['1']['filename']?>"><?=$_G['setting']['navs']['1']['navname']?></a> <em>&rsaquo;</em>
<a href="portal.php?mod=portalcp">门户管理</a> <em>&rsaquo;</em>
模块管理
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<h1 class="mt">模块管理</h1>
<div class="bm bw0">
<div id="block_selection">
<? } if($op=='recommend') { ?>
<h3 class="flb">
<em id="return_<?=$_G['gp_handlekey']?>">推送</em>
<? if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" class="flbc" title="关闭">关闭</a></span><? } ?>
</h3>
<script src="<?=$_G['setting']['jspath']?>portal.js?<?=VERHASH?>" type="text/javascript"></script>
<form id="recommendform" method="post" enctype="multipart/form-data" action="portal.php?mod=portalcp&amp;ac=block&amp;op=recommend&amp;id=<?=$_GET['id']?>&amp;idtype=<?=$_GET['idtype']?>" onsubmit="if(recommenditem_check()) { ajaxpost('recommendform','return_<?=$_G['gp_handlekey']?>','return_<?=$_G['gp_handlekey']?>','onerror');} return false;">
<div class="c">
<table class="tfm"<? if($_G['inajax']) { ?> width="400"<? } ?>>
<tr>
<th width="80">选择模块</th>
<td><select onchange="listblock_bypage(this.value)" class="ps">
<option value="">选择页面</option><? if(is_array($diytemplate)) foreach($diytemplate as $targettplname => $tplname) { ?><option value="<?=$targettplname?>"<? if($_GET['page']==$targettplname) { ?> selected<? } ?>><?=$tplname?></option>
<? } ?>
</select>
<select name="bid" id="recommend_bid"<? if($op=='recommend') { ?> onchange="recommenditem_byblock(this.value, '<?=$_GET['id']?>', '<?=$_GET['idtype']?>')"<? } ?> class="ps">
<option value="">选择模块</option>
</select><? if(is_array($pageblocks)) foreach($pageblocks as $key => $value) { ?><select id="recommend_pageblock_<?=$key?>" class="ps" style="display:none;"><? if(is_array($value)) foreach($value as $bid) { if($blocks[$bid]) { ?>
<option value="<?=$bid?>"><?=$blocks[$bid]?></option>
<? } } ?>
</select>
<? } ?></td>
</tr>
<tbody id="itemeditarea"></tbody>
</table>
</div>
<p class="o pns">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="recommendsubmit" value="1" />
<input type="hidden" name="handlekey" value="<?=$_G['gp_handlekey']?>" />
<input type="hidden" name="referer" value="<?=$_G['referer']?>">
<button type="submit" class="pn pnc" value="true"><strong>提交</strong></button>
</p>
</form>
<script type="text/javascript" reload="1">
function errorhandle_recommenditem(message) {
var editarea = $('itemeditarea');
ajaxinnerhtml(editarea, '<tr><td>&nbsp;</td><td>' + message + '</td></tr>');
}
</script>

<? } elseif($op=='search') { ?>
<p>
仅显示搜索条件下的模块。 <a href="portal.php?mod=portalcp&amp;ac=portalblock" class="xi2">点击返回列表页</a>
</p>
<? if($blocks) { ?>
<table class="dt mtm">
<tr>
<th>模块标识</th>
<th>模块分类</th>
<th>数据来源</th>
<th>所在页面</th>
<th width="120">操作</th>
</tr><? if(is_array($blocks)) foreach($blocks as $block) { ?><tr>
<td><label for="push_bid_<?=$block['bid']?>"><?=$block['name']?></label></td>
<td><?=$block['blockclassname']?></td>
<td><?=$block['datasrc']?></td>
<td><? if($block['diyurl']) { ?><a href="<?=$block['diyurl']?>" target="_blank"><?=$block['tplname']?></a><? } else { ?><?=$block['tplname']?><? } ?></td>
<td>
<? if($block['perm']['allowproperty']) { ?>
<a href="portal.php?mod=portalcp&amp;ac=block&amp;op=block&amp;bid=<?=$block['bid']?>" target="_blank">属性</a>
<? } if($block['perm']['allowdata']) { ?>
<a href="portal.php?mod=portalcp&amp;ac=block&amp;op=data&amp;bid=<?=$block['bid']?>" target="_blank">数据</a>
<? } if($block['isrecommendable']) { ?>
<a href="portal.php?mod=portalcp&amp;ac=blockdata&amp;op=manage&amp;searchkey=%23<?=$block['bid']?>" target="_blank">审核</a>
<a href="portal.php?mod=portalcp&amp;ac=block&amp;op=itemdata&amp;bid=<?=$block['bid']?>" target="_blank">推送库</a>
<? } ?>
</td>
</tr>
<? } ?>
</table>
<? if($multi) { ?><div class="pgs cl"><?=$multi?></div><? } } else { ?>
<p class="emp">没有可管理的模块</p>
<? } } else { ?>
<form action="portal.php?mod=portalcp&amp;ac=portalblock&amp;op=search" method="get" class="mbm">
<input type="hidden" name="mod" value="portalcp" />
<input type="hidden" name="ac" value="portalblock" />
<input type="hidden" name="op" value="search" />
模块标识:
<input type="text" class="px vm" name="searchkey" id="searchkey" value="<?=$_GET['searchkey']?>" />
<button type="submit" class="pn vm"><em>查找</em></button>
</form>
<? if($pageblocks) { if(is_array($pageblocks)) foreach($pageblocks as $key => $value) { ?><div class="bm">
<div class="bm_h"><h3><? if($diyurls[$key]) { ?><a href="<?=$diyurls[$key]?>" target="_blank"><?=$diytemplate[$key]?></a><? } else { ?><?=$diytemplate[$key]?><? } ?></h3></div>
<div class="bm_c">
<ul class="xl xl2 ptblk cl"><? if(is_array($value)) foreach($value as $bid) { ?><li>
<em>

<? if($blocks[$bid]['perm']['allowproperty']) { ?>
<a href="portal.php?mod=portalcp&amp;ac=block&amp;op=block&amp;bid=<?=$bid?>" target="_blank">属性</a>
<span class="pipe">|</span>
<? } if($blocks[$bid]['perm']['allowdata']) { ?>
<a href="portal.php?mod=portalcp&amp;ac=block&amp;op=data&amp;bid=<?=$bid?>" target="_blank">数据</a>
<? } if($blocks[$bid]['isrecommendable']) { ?>
<span class="pipe">|</span>
<a href="portal.php?mod=portalcp&amp;ac=blockdata&amp;op=manage&amp;searchkey=%23<?=$bid?>" target="_blank">审核</a>
<span class="pipe">|</span>
<a href="portal.php?mod=portalcp&amp;ac=block&amp;op=itemdata&amp;bid=<?=$bid?>" target="_blank">推送库</a>
<? } ?>
</em>
<?=$blocks[$bid]['name']?>
</li>
<? } ?>
</ul>
</div>
</div>
<? } if($multi) { ?><div class="pgs cl"><?=$multi?></div><? } } else { ?>
<p>没有可管理的模块</p>
<? } } if(!$_G['inajax']) { ?>
</div>
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