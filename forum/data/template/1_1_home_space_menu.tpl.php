<? if(!defined('IN_DISCUZ')) exit('Access Denied'); if($space['uid']) { ?>
<div class="ih pbm cl">
<div class="icn avt"><a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?php echo avatar($space[uid],small); ?></a></div>
<dl>
<dt class="ptn"><?=$space['username']?></dt>
<dd>
<a href="home.php?mod=space&amp;uid=<?=$space['uid']?>"><?=$space['username']?>的个人空间</a>
<? if($_G['home_tpl_spacemenus']) { if(is_array($_G['home_tpl_spacemenus'])) foreach($_G['home_tpl_spacemenus'] as $value) { ?> <em>&rsaquo;</em> <?=$value?><? } } ?>
</dd>
</dl>
<?php if(!empty($_G['setting']['pluginhooks']['space_menu_extra'])) echo $_G['setting']['pluginhooks']['space_menu_extra']; ?>
</div>
<? } ?>