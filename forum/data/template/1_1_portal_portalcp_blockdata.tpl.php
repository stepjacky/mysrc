<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_blockdata');
0
|| checktplrefresh('./template/default/portal/portalcp_blockdata.htm', './template/default/common/simplesearchform.htm', 1286717142, '1', './data/template/1_1_portal_portalcp_blockdata.tpl.php', './template/default', 'portal/portalcp_blockdata')
|| checktplrefresh('./template/default/portal/portalcp_blockdata.htm', './template/default/portal/portalcp_nav.htm', 1286717142, '1', './data/template/1_1_portal_portalcp_blockdata.tpl.php', './template/default', 'portal/portalcp_blockdata')
;?><? include template('common/header'); ?><div id="pt" class="bm cl"><? if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?
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
推送审核
</div>
</div>

<div id="ct" class="ct2_a wp cl">	

<div class="mn">
<h1 class="mt">推送审核</h1>
<form action="portal.php?mod=portalcp&amp;ac=blockdata" method="get" class="mbm">
<input type="hidden" name="mod" value="portalcp" />
<input type="hidden" name="ac" value="blockdata" />
模块标识:
<input type="text" class="px vm" name="searchkey" id="searchkey" value="<?=$_GET['searchkey']?>" />
<button type="submit" class="pn vm"><em>查找</em></button>
</form>
<div class="bm bw0">
<div id="block_selection">
<? if($datalist) { ?>
<form method="post" action="portal.php?mod=portalcp&amp;ac=blockdata&amp;op=verify">
<table class="dt">
<tr>
<th width="24">&nbsp;</th>
<th>数据来源</th>
<th>推送页面</th>
<th>模块标识</th>
<th>推送者</th>
<th width="120">操作</th>
</tr><? if(is_array($datalist)) foreach($datalist as $value) { ?><tr>
<td><input type="checkbox" name="ids[]" value="<?=$value['dataid']?>" /></td>
<td><a href="<?=$value['url']?>" target="_blank"><?=$value['title']?></a></td>
<td><? if($blocks[$value['bid']]['diyurl']) { ?><a href="<?=$blocks[$value['bid']]['diyurl']?>" target="_blank"><?=$blocks[$value['bid']]['tplname']?></a><? } else { ?><?=$blocks[$value['bid']]['tplname']?><? } ?></td>
<td><?=$blocks[$value['bid']]['blockname']?></td>
<td><a href="home.php?uid=<?=$value['uid']?>" target="_blank"><?=$value['username']?></a></td>
<td>
<a href="portal.php?mod=portalcp&amp;ac=block&amp;op=verifydata&amp;bid=<?=$value['bid']?>&amp;dataid=<?=$value['dataid']?>" onclick="showWindow('verifydata', this.href, 'get', 0)">审核</a>
</td>
</tr>
<? } ?>
<tr>
<td colspan="6">
<input type="checkbox" id="chkall" name="chkall" onclick="checkall(this.form, 'ids')" />
<label for="chkall">全选</label>
<input id="op_delete" class="pr" value="delete" name="optype" type="radio"><label for="op_delete"> 删除</label>&nbsp;&nbsp;
<input id="op_pass" class="pr" value="pass" name="optype" type="radio"><label for="op_pass"> 通过</label>&nbsp;&nbsp;
<input type="hidden" name="batchsubmit" value="1" />
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<button type="submit" value="true" name="trashsubmit" class="pn vm"><em>提交</em></button>
</td>
</tr>
</table>
<? if($multi) { ?><div class="pgs cl"><?=$multi?></div><? } ?>
</form>
<? } else { ?>
<p class="emp">没有需要审核的推送数据</p>
<? } ?>
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
</div><? include template('common/footer'); ?>