<? if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./template/default/member/login_simple.htm', './template/default/common/seccheck.htm', 1286714412, '1', './data/template/1_1_member_login_simple.tpl.php', './template/default', 'member/login_simple')
;?>
<? if(CURSCRIPT != 'member') { ?>
<form method="post" autocomplete="off" id="lsform" action="member.php?mod=logging&amp;action=login&amp;loginsubmit=yes&amp;infloat=yes" onsubmit="return lsSubmit()">
<div class="fastlg cl">
<span id="return_ls" style="display:none"></span>
<div class="y">
<p><a href="member.php?mod=<?=$_G['setting']['regname']?>" onclick="showWindow('register', this.href)" class="xi2"><?=$_G['setting']['reglinkname']?></a></p>
<p><a href="member.php?mod=logging&amp;action=login&amp;viewlostpw" onclick="showWindow('login', this.href)" class="xi2">找回密码</a></p>
</div>
<div class="fastlg_fm y pns">
<p>
<? if(!$_G['setting']['autoidselect']) { ?>
<span class="ftid">
<select name="fastloginfield" id="ls_fastloginfield" width="45" tabindex="900">
<option value="username">用户名</option>
<option value="uid">UID</option>
<option value="email">Email</option>
</select>
</span>
<script type="text/javascript">simulateSelect('ls_fastloginfield')</script>
<input type="text" name="username" id="ls_username" autocomplete="off" class="px vm" tabindex="901" />
<? } else { ?>
<label for="ls_username">帐号</label> <input type="text" name="username" id="ls_username" class="px vm" <? if($_G['setting']['autoidselect']) { ?> value="UID/用户名/Email" onfocus="if(this.value == 'UID/用户名/Email') this.value = '';" onblur="if(this.value == '') this.value = 'UID/用户名/Email';"<? } ?> tabindex="901" />
<? } ?>
&nbsp;<input type="checkbox" name="cookietime" id="ls_cookietime" class="pc" value="2592000" tabindex="903" /> <label for="ls_cookietime">记住密码</label>
</p>
<p>
<label for="ls_password"<? if(!$_G['setting']['autoidselect']) { ?> class="z psw_w"<? } ?>>密码</label> <input type="password" name="password" id="ls_password" class="px vm" autocomplete="off" tabindex="902" onfocus="lsShowmore()" />
&nbsp;<button type="submit" class="pn vm"><em>登录</em></button>
</p>
<input type="hidden" name="quickforward" value="yes" />
<input type="hidden" name="handlekey" value="ls" />
</div>
</div>
<div id="ls_more" style="display:none">
<h3>
<em class="y"><a title="关闭" onclick="display('ls_more')" class="flbc" href="javascript:;">关闭</a></em>
安全验证
</h3>
<span class="z"><script type="text/javascript">var ls_sechash = '';</script></span>
<? if($_G['setting']['seccodestatus'] & 2) { ?><?php $seccodechecktmp = !empty($seccodecheck) ? $seccodecheck : false;
$secqaachecktmp = !empty($secqaacheck) ? $secqaacheck : false;
$seccodecheck = $_G['setting']['seccodestatus'] & 2;
$secqaacheck = false;
$secshow = 0;
$sectabindex = 904; if($seccodecheck) { ?><?
$sectpl = <<<EOF
<div class="mtm mbn c"><em style="display:none"><sec></em><sec></div><div class="pbm bbda xg1 d"><sec></div>
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
?><?php unset($secshow); if(empty($secreturn)) { ?><?=$seccheckhtml?><? } ?><script type="text/javascript">ls_sechash = '<?=$sechash?>';</script>
<? } ?><?php $seccodecheck = $seccodechecktmp;$secqaacheck = $secqaachecktmp; } ?>
<div class="ftid mtm mbn">
<select id="ls_questionid" width="131" name="questionid" autocomplete="off" tabindex="905" change="if($('ls_questionid').value > 0) {$('ls_answer').style.display='';$('ls_answer').focus();} else {$('ls_answer').style.display='none';}">
<option value="0">安全提问(未设置请忽略)</option>
<option value="1">母亲的名字</option>
<option value="2">爷爷的名字</option>
<option value="3">父亲出生的城市</option>
<option value="4">你其中一位老师的名字</option>
<option value="5">你个人计算机的型号</option>
<option value="6">你最喜欢的餐馆名称</option>
<option value="7">驾驶执照最后四位数字</option>
</select>
<input type="text" name="answer" id="ls_answer" style="display:none" autocomplete="off" size="36" class="px mtn" tabindex="906" />
</div>
<script type="text/javascript">simulateSelect('ls_questionid')</script>
</div>
</form>
<? } ?>