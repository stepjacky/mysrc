<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('login');
0
|| checktplrefresh('./template/default/member/login.htm', './template/default/common/seccheck.htm', 1286714479, '1', './data/template/1_1_member_login.tpl.php', './template/default', 'member/login')
;?><? include template('common/header'); if(!empty($message)) { ?>
<?=$ucsynlogin?>
<script type="text/javascript" reload="1">
<? if($message == 2) { ?>
hideWindow('login');
showWindow('register', '<?=$location?>');
<? } elseif($message == 1) { ?>
display('main_messaqge_<?=$_G['gp_loginhash']?>');
display('layer_login_<?=$_G['gp_loginhash']?>');
display('layer_message_<?=$_G['gp_loginhash']?>');
<? if(isset($_G['gp_frommessage'])) { ?>
display('messagetext');
display('layer_header_<?=$_G['gp_loginhash']?>');
<? } if($_G['groupid'] == 8) { ?>
$('messageleft_<?=$_G['gp_loginhash']?>').innerHTML = '<p>欢迎你回来 <?=$usergroups?> <? echo addslashes($_G['username']); ?></p><p>你的帐号处于非激活状态</p>';
<? } else { ?>
$('messageleft_<?=$_G['gp_loginhash']?>').innerHTML = '<p>欢迎你回来 <?=$usergroups?> <? echo addslashes($_G['username']); ?></p>';
<? } if(!empty($_G['gp_floatlogin'])) { ?>
$('messageright_<?=$_G['gp_loginhash']?>').innerHTML = '<a href="javascript:;" onclick="location.reload()">如果页面没有响应，请点这里刷新</a>';
setTimeout('location.href = location.href', <?=$mrefreshtime?>);
<? } else { ?><?php $dreferer = str_replace('&amp;', '&', dreferer()); ?>$('messageright_<?=$_G['gp_loginhash']?>').innerHTML = '<a href="<?=$dreferer?>">现在将转入登录前页面</a>';
setTimeout("window.location.href='<?=$dreferer?>'", <?=$mrefreshtime?>);
<? } } if(!empty($_G['gp_handlekey'])) { ?>
setMenuPosition('fwin_<?=$_G['gp_handlekey']?>', 'fwin_<?=$_G['gp_handlekey']?>', '00');
<? } else { ?>
setMenuPosition('fwin_login', 'fwin_login', '00');
<? } ?>
</script>
<? } else { ?><?php $loginhash = 'L'.random(4); if(empty($_G['gp_infloat'])) { ?>
<div id="ct" class="wp w cl">
<div class="mn mw">
<? } ?>

<div class="blr" id="main_messaqge_<?=$loginhash?>">
<div id="layer_login_<?=$loginhash?>">
<h3 class="flb">
<em id="returnmessage_<?=$loginhash?>"><? if(!empty($_G['gp_infloat'])) { if(!empty($_G['gp_guestmessage'])) { ?>你需要先登录才能继续本操作<? } else { ?>用户登录<? } } ?></em>
<span><? if(!empty($_G['gp_infloat']) && !isset($_G['gp_frommessage'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('<?=$_G['gp_handlekey']?>', 0, 1);" title="关闭">关闭</a><? } ?></span>
</h3>
<?php if(!empty($_G['setting']['pluginhooks']['logging_top'])) echo $_G['setting']['pluginhooks']['logging_top']; ?>
<form method="post" autocomplete="off" name="login" id="loginform_<?=$loginhash?>" class="cl" onsubmit="<? if($_G['setting']['pwdsafety']) { ?>pwmd5('password3_<?=$loginhash?>');<? } ?>pwdclear = 1;ajaxpost('loginform_<?=$loginhash?>', 'returnmessage_<?=$loginhash?>', 'returnmessage_<?=$loginhash?>', 'onerror');return false;" action="member.php?mod=logging&amp;action=login&amp;loginsubmit=yes<? if(!empty($_G['gp_handlekey'])) { ?>&amp;handlekey=<?=$_G['gp_handlekey']?><? } if(!empty($_G['gp_infloat'])) { ?>&amp;floatlogin=yes<? } if(isset($_G['gp_frommessage'])) { ?>&amp;frommessage<? } ?>&amp;loginhash=<?=$loginhash?>">
<div class="c cl">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="referer" value="<?=$_G['referer']?>" />
<div class="lgfm nlf">
<? if($invite) { ?>
<span>
<label><em>推荐人:</em><a href="home.php?mod=space&amp;uid=<?=$invite['uid']?>" target="_blank"><?=$invite['username']?></a></label>
</span>
<? } if($_G['setting']['autoidselect']) { ?>
<div class="ftid sipt lpsw" id="account_<?=$loginhash?>">
<label for="username">帐　号　：</label>
<input type="text" name="username" id="username_<?=$loginhash?>" autocomplete="off" size="36" class="txt" tabindex="1" value="<?=$username?>" />
</div>
<? } else { ?>
<div class="ftid sipt" id="account_<?=$loginhash?>">
<select name="loginfield" style="float: left;" width="45" id="loginfield_<?=$loginhash?>">
<option value="username">用户名</option>
<option value="uid">UID</option>
<option value="email">Email</option>
</select>
<input type="text" name="username" id="username_<?=$loginhash?>" autocomplete="off" size="36" class="txt" tabindex="1" value="<?=$username?>" />
</div>
<? } ?>
<p class="sipt lpsw">
<label for="password3_<?=$loginhash?>">密　码　：</label>
<input type="password" id="password3_<?=$loginhash?>" name="password" onfocus="clearpwd()" onkeypress="detectCapsLock(event, this)" size="36" class="txt" tabindex="1" />
</p>

<div class="ftid sltp">
<select id="loginquestionid_<?=$loginhash?>" width="213" name="questionid" change="if($('loginquestionid_<?=$loginhash?>').value > 0) {$('loginanswer_<?=$loginhash?>').style.display='';} else {$('loginanswer_<?=$loginhash?>').style.display='none';}">
<option value="0">安全提问(未设置请忽略)</option>
<option value="1">母亲的名字</option>
<option value="2">爷爷的名字</option>
<option value="3">父亲出生的城市</option>
<option value="4">你其中一位老师的名字</option>
<option value="5">你个人计算机的型号</option>
<option value="6">你最喜欢的餐馆名称</option>
<option value="7">驾驶执照最后四位数字</option>
</select>
</div>
<p><input type="text" name="answer" id="loginanswer_<?=$loginhash?>" style="display:none" autocomplete="off" size="36" class="sipt" tabindex="1" /></p>

<div id="seccodelayer_<?=$loginhash?>">
<? if($secqaacheck || $seccodecheck) { ?><?
$sectpl = <<<EOF
<label><em><sec></em><sec></label><label><em style="height:30px">&nbsp;</em><sec></label>
EOF;
?><?php $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');
$sectpldefault = $sectpl;
$sectplqaa = str_replace('<hash>', 'qaa'.$sechash, $sectpldefault);
$sectplcode = str_replace('<hash>', 'code'.$sechash, $sectpldefault);
$secshow = !isset($secshow) ? 1 : $secshow;
$sectabindex = !isset($sectabindex) ? 1 : $sectabindex; ?><?
$__STATICURL = STATICURL;$seccheckhtml = <<<EOF

<input name="sechash" type="hidden" value="{$sechash}" />

EOF;
 if($sectpl) { if($secqaacheck) { 
$seccheckhtml .= <<<EOF

{$sectplqaa['0']}验证问答{$sectplqaa['1']}<input name="secanswer" id="secqaaverify_{$sechash}" type="text" autocomplete="off" style="width:100px" class="txt px vm" onblur="checksec('qaa', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updatesecqaa('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checksecqaaverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplqaa['2']}<span id="secqaa_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updatesecqaa('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplqaa['3']}

EOF;
 } if($seccodecheck) { 
$seccheckhtml .= <<<EOF

{$sectplcode['0']}验证码{$sectplcode['1']}<input name="seccodeverify" id="seccodeverify_{$sechash}" type="text" autocomplete="off" style="width:100px" class="txt px vm" onblur="checksec('code', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updateseccode('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checkseccodeverify_{$sechash}"><img src="{$__STATICURL}image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplcode['2']}<span id="seccode_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updateseccode('{$sechash}');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplcode['3']}

EOF;
 } } 
$seccheckhtml .= <<<EOF


EOF;
?><?php unset($secshow); if(empty($secreturn)) { ?><?=$seccheckhtml?><? } } ?>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['logging_input'])) echo $_G['setting']['pluginhooks']['logging_input']; ?>
</div>
<div class="lgf minf">
<h4>没有帐号？<a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="注册帐号"><?=$_G['setting']['reglinkname']?></a></h4>
<p><a href="javascript:;" onclick="display('layer_login_<?=$loginhash?>');display('layer_lostpw_<?=$loginhash?>');" title="找回密码">找回密码</a></p>
<? if(!$_G['setting']['bbclosed']) { ?><p><a href="javascript:;" onclick="ajaxget('member.php?mod=clearcookies&formhash=<?=FORMHASH?>', 'returnmessage_<?=$loginhash?>', 'returnmessage_<?=$loginhash?>');return false;" title="清除痕迹">清除痕迹</a></p><? } ?>
<?php if(!empty($_G['setting']['pluginhooks']['logging_side'])) echo $_G['setting']['pluginhooks']['logging_side']; ?>
</div>
</div>
<p class="fsb pns cl">
<? if($_G['setting']['sitemessage']['login']) { ?><a href="javascript:;" id="custominfo_login_<?=$loginhash?>" class="y"><img src="<?=IMGDIR?>/info_small.gif" alt="帮助" /></a><? } ?>
<button class="pn pnc" type="submit" name="loginsubmit" value="true" tabindex="1"><span>登录</span></button>
<label for="cookietime_<?=$loginhash?>"><input type="checkbox" class="pc" name="cookietime" id="cookietime_<?=$loginhash?>" tabindex="1" value="2592000" <?=$cookietimecheck?> /> 记住我的登录状态</label>
</p>
</form>
</div>
<div id="layer_lostpw_<?=$loginhash?>" style="display: none;">
<h3 class="flb">
<em id="returnmessage3_<?=$loginhash?>">找回密码</em>
<span><? if(!empty($_G['gp_infloat']) && !isset($_G['gp_frommessage'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('login')" title="关闭">关闭</a><? } ?></span>
</h3>
<form method="post" autocomplete="off" id="lostpwform_<?=$loginhash?>" class="cl" onsubmit="ajaxpost('lostpwform_<?=$loginhash?>', 'returnmessage3_<?=$loginhash?>', 'returnmessage3_<?=$loginhash?>', 'onerror');return false;" action="member.php?mod=lostpasswd&amp;lostpwsubmit=yes&amp;infloat=yes">
<div class="c cl">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="hidden" name="handlekey" value="lostpwform" />
<div class="lgfm">
<label><em>用户名:</em><input type="text" name="username" size="25" value=""  tabindex="1" class="txt" /></label>
<label><em>Email:</em><input type="text" name="email" size="25" value=""  tabindex="1" class="txt" /></label>
</div>
<div class="lgf minf">
<h4>没有帐号？<a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="注册帐号"><?=$_G['setting']['reglinkname']?></a></h4>
<p><a href="javascript:;" onclick="display('layer_login_<?=$loginhash?>');display('layer_lostpw_<?=$loginhash?>');">返回登录</a></p>
</div>
</div>
<p class="fsb pns cl">
<em>&nbsp;</em>
<button class="pn pnc" type="submit" name="lostpwsubmit" value="true" tabindex="100"><span>提交</span></button>
</p>
</form>
</div>
</div>

<div id="layer_message_<?=$loginhash?>"<? if(empty($_G['gp_infloat'])) { ?> class="f_c blr nfl"<? } ?> style="display: none;">
<h3 class="flb" id="layer_header_<?=$loginhash?>">
<? if(!empty($_G['gp_infloat']) && !isset($_G['gp_frommessage'])) { ?>
<em>用户登录</em>
<span><a href="javascript:;" class="flbc" onclick="hideWindow('login')" title="关闭">关闭</a></span>
<? } ?>
</h3>
<div class="c"><div class="alert_right">
<div id="messageleft_<?=$loginhash?>"></div>
<p class="alert_btnleft" id="messageright_<?=$loginhash?>"></p>
</div>
</div>

<script src="<?=$_G['setting']['jspath']?>md5.js?<?=VERHASH?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">
hideWindow('register');
var pwdclear = 0;
function initinput_login() {
document.body.focus();
if($('loginform_<?=$loginhash?>')) {
$('loginform_<?=$loginhash?>').username.focus();
}
<? if(!$_G['setting']['autoidselect']) { ?>
simulateSelect('loginfield_<?=$loginhash?>');
<? } ?>
simulateSelect('loginquestionid_<?=$loginhash?>');
}
if(BROWSER.ie && BROWSER.ie < 7) {
setTimeout('initinput_login()', 500);
} else {
initinput_login();
}
<? if($_G['setting']['sitemessage']['login']) { ?>
showPrompt('custominfo_login_<?=$loginhash?>', 'mouseover', '<? echo trim($_G['setting']['sitemessage']['login'][array_rand($_G['setting']['sitemessage']['login'])]); ?>', <?=$_G['setting']['sitemessage']['time']?>);
<? } if($_G['setting']['pwdsafety']) { ?>
var pwmd5log = new Array();
function pwmd5() {
numargs = pwmd5.arguments.length;
for(var i = 0; i < numargs; i++) {
if(!pwmd5log[pwmd5.arguments[i]] || $(pwmd5.arguments[i]).value.length != 32) {
pwmd5log[pwmd5.arguments[i]] = $(pwmd5.arguments[i]).value = hex_md5($(pwmd5.arguments[i]).value);
}
}
}
<? } ?>

function clearpwd() {
if(pwdclear) {
$('password3_<?=$loginhash?>').value = '';
}
pwdclear = 0;
}

function succeedhandle_lostpwform(url, msg) {
showDialog(msg, 'notice');
hideWindow('login');
}
<? if(isset($_G['gp_viewlostpw'])) { ?>
display('layer_login_<?=$loginhash?>');
display('layer_lostpw_<?=$loginhash?>');
<? } ?>
</script>
<? } ?><?php updatesession(); if(empty($_G['gp_infloat'])) { ?>
</div></div>
</div>
<? } include template('common/footer'); ?>