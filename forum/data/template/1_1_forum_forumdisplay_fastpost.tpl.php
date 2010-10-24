<? if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./template/default/forum/forumdisplay_fastpost.htm', './template/default/common/seditor.htm', 1286714469, '1', './data/template/1_1_forum_forumdisplay_fastpost.tpl.php', './template/default', 'forum/forumdisplay_fastpost')
;?>
<script type="text/javascript">
var postminchars = parseInt('<?=$_G['setting']['minpostsize']?>');
var postmaxchars = parseInt('<?=$_G['setting']['maxpostsize']?>');
var disablepostctrl = parseInt('<?=$_G['group']['disablepostctrl']?>');
</script>
<div id="f_pst" class="bm">
<div class="bm_h">
<h2>快速发帖</h2>
</div>
<div class="bm_c">
<form method="post" autocomplete="off" id="fastpostform" action="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>&amp;topicsubmit=yes&amp;infloat=yes&amp;handlekey=fastnewpost" onSubmit="return fastpostvalidate(this)">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_fastpost_content'])) echo $_G['setting']['pluginhooks']['forumdisplay_fastpost_content']; ?>

<div id="fastpostreturn" style="margin:-5px 0 5px"></div>

<div class="pbt cl">
<? if($_G['forum']['threadtypes']['types']) { ?>
<div class="ftid">
<select name="typeid" id="typeid" width="80">
<option value="0">选择主题分类</option><? if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $typeid => $name) { ?><option value="<?=$typeid?>"><? echo strip_tags($name);; ?></option>
<? } ?>
</select>
</div>
<script type="text/javascript" reload="1">simulateSelect('typeid');</script>
<? } ?>
<input type="text" id="subject" name="subject" class="px" value="" onkeyup="strLenCalc(this, 'checklen', 80);" tabindex="11" style="width: 25em" />
<span>还可输入 <strong id="checklen">80</strong> 个字符</span>
</div>

<div class="cl">
<? if($_G['setting']['fastsmilies']) { ?><div id="fastsmiliesdiv" class="y"><div id="fastsmiliesdiv_data"><div id="fastsmilies"></div></div></div><? } ?>
<div<? if($_G['setting']['fastsmilies']) { ?> class="hasfsl"<? } ?>>
<div class="tedt">
<div class="bar">
<span class="y">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_fastpost_func_extra'])) echo $_G['setting']['pluginhooks']['forumdisplay_fastpost_func_extra']; if($_G['setting']['magicstatus'] && !empty($_G['setting']['magics']['doodle'])) { ?>
<a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=fastpostmessage&amp;from=fastpost" onclick="showWindow(this.id, this.href, 'get', 0)"><?=$_G['setting']['magics']['doodle']?></a>
<span class="pipe">|</span>
<? } ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?=$_G['fid']?>" onclick="switchAdvanceMode(this.href);doane(event);">高级模式</a>
</span><?php $seditor = array('fastpost', array('bold', 'color', 'img', 'link', 'quote', 'code', 'smilies'), $guestpost ? 1 : 0); ?><?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_fastpost_ctrl_extra'])) echo $_G['setting']['pluginhooks']['forumdisplay_fastpost_ctrl_extra']; ?><div class="fpd">
<? if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="fbld"<? if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?=$seditor['0']?>', '[b]', '[/b]')"<? } ?>>B</a>
<? } if(in_array('color', $seditor['1'])) { ?>
<a href="javascript:;" title="设置文字颜色" class="fclr" id="<?=$seditor['0']?>forecolor"<? if(empty($seditor['2'])) { ?> onclick="showColorBox(this.id, 2, '<?=$seditor['0']?>');doane(event)"<? } ?>>Color</a>
<? } if(in_array('img', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>img" href="javascript:;" title="图片" class="fmg"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'img')"<? } ?>>Image</a>
<? } if(in_array('link', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>url" href="javascript:;" title="添加链接" class="flnk"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'url')"<? } ?>>Link</a>
<? } if(in_array('quote', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>quote" href="javascript:;" title="引用" class="fqt"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'quote')"<? } ?>>Quote</a>
<? } if(in_array('code', $seditor['1'])) { ?>
<a id="<?=$seditor['0']?>code" href="javascript:;" title="代码" class="fcd"<? if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?=$seditor['0']?>', 'code')"<? } ?>>Code</a>
<? } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?=$seditor['0']?>sml"<? if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<? } ?>>Smilies</a>
<? if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?=VERHASH?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?=$seditor['0']?>smiliesdiv', <?=$_G['setting']['smcols']?>, '<?=$seditor['0']?>');</script>
<? } } ?>
</div></div>
<div class="area">
<? if(!$guestpost) { ?>
<textarea rows="5" cols="80" name="message" id="fastpostmessage" onKeyDown="seditor_ctlent(event, '$(\'fastpostform\').submit()');" tabindex="12" class="pt"></textarea>
<? } else { ?>
<div class="pt hm">你需要登录后才可以发帖 <a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">登录</a> | <a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="showWindow('register', this.href)" class="xi2"><?=$_G['setting']['reglinkname']?></a></div>
<? } ?>
</div>
</div>
<? if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id)"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm sec"><? include template('common/seccheck'); ?></div>
<? } ?>
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="usesig" value="<?=$usesigcheck?>" />
<p class="ptm">
<button <? if(!$guestpost) { ?>type="submit" <? } else { ?>type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')" <? } ?>name="topicsubmit" id="fastpostsubmit" value="topicsubmit" tabindex="13" class="pn"><strong>发表帖子</strong></button>
</p>
</div>
</div>
</form>
</div>
</div>