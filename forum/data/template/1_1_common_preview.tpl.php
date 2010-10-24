<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="data/cache/style_<?=$_GET['styleid']?>_common.css?<?=VERHASH?>" />
<style type="text/css">
body { padding: 10px; }
.premsg { padding: 5px; background-color: <?=$_G['style']['commonbg']?>; }
.xst { font-family: <?=$_G['style']['threadtitlefont']?>; font-size: <?=$_G['style']['threadtitlefontsize']?>; }
#ft { padding: 10px; text-align: center; }
</style>
</head>
<body>

<div id="hd" class="mbm">
<div class="hdc cl">
<h2><?=$_G['style']['boardlogo']?></h2>
<div id="um">
<div class="avt y"><?php echo avatar($_G['member'],small); ?></div>
<p><strong><a href="#"><?=$_G['member']['username']?></a></strong><span class="xg1"> <a href="#">设置</a></span><span class="pipe">|</span><a href="#">短消息</a></p>
<p>积分<span class="pipe">|</span>用户组</p>
</div>
</div>
<div id="nv">
<ul>
<li><a href="#"><?=$_G['setting']['navs']['1']['navname']?><span>Home</span></a></li>
<li><a href="#"><?=$_G['setting']['navs']['2']['navname']?><span>BBS</span></a></li>
<li><a href="#"><?=$_G['setting']['navs']['3']['navname']?><span>Group</span></a></li>
<li><a href="#"><?=$_G['setting']['navs']['4']['navname']?><span>Space</span></a></li>
</ul>
</div>
</div>

<div class="bm">
<div class="bm_h cl">
<h2>表头</h2>
</div>
<div class="bm_c">
<div class="premsg"><a href="javascript:;" class="xi2">Crossday Discuz! Board</a> 社区系统(简称 <stong class="xw1 xi1">Discuz!</stong>)是一个采用 PHP 和 MySQL 等其他多种数据库构建的高效建站解决方案。</div>
<table class="dt">
<tr>
<td class="xs0">SMALL FONT</td>
<td><a href="javascript:;">链接文字</a></td>
<td><a href="javascript:;" class="xi2">高亮链接</a></td>
</tr>
<tr>
<td>普通文本</td>
<td class="xg2">中等文本</td>
<td class="xg1">浅色文字</td>
</tr>
<tr class="bw0_all">
<td colspan="3" class="xst">主题列表字体</td>
</tr>
</table>
</div>
</div>

<div id="ft">
版权及页脚信息
</div>

</body>
</html>