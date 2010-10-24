<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<?php function tpl_hide_credits_hidden($creditsrequire) {
global $_G; ?><?
$return = <<<EOF
<div class="locked">
EOF;
 if($_G['uid']) { 
$return .= <<<EOF
{$_G['username']}
EOF;
 } else { 
$return .= <<<EOF
游客
EOF;
 } 
$return .= <<<EOF
，本帖隐藏的内容需要积分高于 {$creditsrequire} 才可浏览，你当前积分为 {$_G['member']['credits']}</div>
EOF;
?><?php return $return; ?><?php }

function tpl_hide_credits($creditsrequire, $message) { ?><?
$return = <<<EOF
<div class="locked">以下内容需要积分高于 {$creditsrequire} 才可浏览</div>
{$message}<br /><br />

EOF;
?><?php return $return; ?><?php }

function tpl_codedisp($discuzcodes, $code) { ?><?
$return = <<<EOF
<div class="blockcode"><div id="code{$discuzcodes['codecount']}"><ol><li>{$code}</ol></div><em onclick="copycode($('code{$discuzcodes['codecount']}'));">复制代码</em></div>
EOF;
?><?php return $return; ?><?php }

function tpl_quote() { ?><?
$return = <<<EOF
<div class="quote"><blockquote>\\1</blockquote></div>
EOF;
?><?php return $return; ?><?php }

function tpl_free() { ?><?
$return = <<<EOF
<div class="quote"><blockquote>\\1</blockquote></div>
EOF;
?><?php return $return; ?><?php }

function tpl_hide_reply() {
global $_G; ?><?
$return = <<<EOF
<div class="showhide"><h4>本帖隐藏的内容</h4>\\1</div>

EOF;
?><?php return $return; ?><?php }

function tpl_hide_reply_hidden() {
global $_G; ?><?
$return = <<<EOF
<div class="locked">
EOF;
 if($_G['uid']) { 
$return .= <<<EOF
{$_G['username']}
EOF;
 } else { 
$return .= <<<EOF
游客
EOF;
 } 
$return .= <<<EOF
，如果你要查看本帖隐藏内容请<a href="forum.php?mod=post&amp;action=reply&amp;fid={$_G['fid']}&amp;tid={$_G['tid']}" onclick="showWindow('reply', this.href)">回复</a></div>
EOF;
?><?php return $return; ?><?php }

function attachlist($attach) {
global $_G;
$attach['refcheck'] = (!$attach['remote'] && $_G['setting']['attachrefcheck']) || ($attach['remote'] && ($_G['setting']['ftp']['hideurl'] || ($attach['isimage'] && $_G['setting']['attachimgpost'] && strtolower(substr($_G['setting']['ftp']['attachurl'], 0, 3)) == 'ftp')));
$aidencode = aidencode($attach['aid']);
$GLOBALS['aimgs'][$attach['pid']][] = $attach['aid'];
$widthcode = attachwidth($attach['width']);
$is_archive = $_G['forum_thread']['is_archived'] ? "&fid=".$_G['fid']."&archiveid=".$_G[forum_thread][archiveid] : ''; ?><?
$__STATICURL = STATICURL;$return = <<<EOF


EOF;
 if($attach['attachimg'] && $_G['setting']['showimages']) { if(!IS_ROBOT) { 
$return .= <<<EOF

<dl class="tattl attm">
<dt></dt>
<dd>
<p class="mbn">
<a href="forum.php?mod=attachment{$is_archive}&amp;aid={$aidencode}&amp;nothumb=yes" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" id="aid{$attach['aid']}" class="bold" target="_blank">{$attach['filename']}</a>
<em class="xg1">({$attach['attachsize']}, 下载次数: {$attach['downloads']})</em>
</p>
<div class="attp" id="aid{$attach['aid']}_menu" style="display: none">
<div class="crly">
<p class="y">{$attach['dateline']} 上传</p>
<p>下载次数: {$attach['downloads']}</p>
<p>
<a href="javascript:;" onclick="imageRotate('aimg_{$attach['aid']}', 1)"><img src="{$__STATICURL}image/common/rleft.gif" /></a>
<a href="javascript:;" onclick="imageRotate('aimg_{$attach['aid']}', 2)"><img src="{$__STATICURL}image/common/rright.gif" /></a>
</p>
</div>
<div class="mncr"></div>
</div>
<p class="mbn">

EOF;
 if($attach['readperm']) { 
$return .= <<<EOF
阅读权限: <strong>{$attach['readperm']}</strong>
EOF;
 } if($attach['price']) { 
$return .= <<<EOF
售价: <strong>{$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title']} {$attach['price']} {$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit']}</strong> &nbsp;[<a href="forum.php?mod=misc&amp;action=viewattachpayments&amp;aid={$attach['aid']}" onclick="showWindow('attachpay', this.href)" target="_blank">记录</a>]

EOF;
 if(!$attach['payed']) { 
$return .= <<<EOF

&nbsp;[<a href="forum.php?mod=misc&amp;action=attachpay&amp;aid={$attach['aid']}" onclick="showWindow('attachpay', this.href)" target="_blank">购买</a>]

EOF;
 } } 
$return .= <<<EOF

</p>

EOF;
 if($attach['description']) { 
$return .= <<<EOF
<p class="mbn xg2">{$attach['description']}</p>
EOF;
 } if(!$attach['price'] || $attach['payed']) { 
$return .= <<<EOF

<p class="mbn">

EOF;
 if($_G['setting']['thumbstatus'] && $attach['thumb']) { 
$return .= <<<EOF

<a href="javascript:;"><img id="aimg_{$attach['aid']}" onclick="zoom(this, '
EOF;
 if($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}&noupdate=yes&nothumb=yes
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}
EOF;
 } 
$return .= <<<EOF
')" src="
EOF;
 if($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}.thumb.jpg
EOF;
 } 
$return .= <<<EOF
" alt="{$attach['imgalt']}" title="{$attach['imgalt']}" /></a>

EOF;
 } else { 
$return .= <<<EOF

<img id="aimg_{$attach['aid']}" src="{$__STATICURL}image/common/none.gif" file="
EOF;
 if($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}&noupdate=yes
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}
EOF;
 } 
$return .= <<<EOF
" {$widthcode} id="aimg_{$attach['aid']}" alt="{$attach['imgalt']}" title="{$attach['imgalt']}" />

EOF;
 } 
$return .= <<<EOF

</p>

EOF;
 } 
$return .= <<<EOF

</dd>

EOF;
 } else { 
$return .= <<<EOF

<dl class="tattl attm">

EOF;
 if(!$attach['price'] || $attach['payed']) { 
$return .= <<<EOF

<dd>

EOF;
 if($attach['description']) { 
$return .= <<<EOF
<p>{$attach['description']}</p>
EOF;
 } 
$return .= <<<EOF

<img src="
EOF;
 if($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}&noupdate=yes
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}
EOF;
 } 
$return .= <<<EOF
" alt="{$attach['imgalt']}" title="{$attach['imgalt']}" />
</dd>

EOF;
 } } } else { 
$return .= <<<EOF

<dl class="tattl">
<dt>
{$attach['attachicon']}
</dt>
<dd>
<p class="attnm">

EOF;
 if(!$attach['price'] || $attach['payed']) { 
$return .= <<<EOF

<a href="forum.php?mod=attachment{$is_archive}&amp;aid={$aidencode}" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" id="aid{$attach['aid']}" target="_blank"
EOF;
 if(!$attach['attachimg'] && $_G['getattachcredits']) { 
$return .= <<<EOF
 onclick="return creditconfirm('{$_G['getattachcredits']}');"
EOF;
 } 
$return .= <<<EOF
>{$attach['filename']}</a>

EOF;
 } else { 
$return .= <<<EOF

<a href="forum.php?mod=misc&amp;action=attachpay&amp;aid={$attach['aid']}" onclick="showWindow('attachpay', this.href)">{$attach['filename']}</a>

EOF;
 } 
$return .= <<<EOF

<div class="attp" id="aid{$attach['aid']}_menu" style="display: none">
<div class="crly">
<p class="y">{$attach['dateline']} 上传</p>
<p>下载次数: {$attach['downloads']}</p>

EOF;
 if(!$attach['attachimg'] && $_G['getattachcredits']) { 
$return .= <<<EOF
下载积分 {$_G['getattachcredits']}<br />
EOF;
 } 
$return .= <<<EOF

</div>
<div class="mncr"></div>
</div>
</p>
<p>{$attach['attachsize']}
EOF;
 if($attach['readperm']) { 
$return .= <<<EOF
, 阅读权限: <strong>{$attach['readperm']}</strong>
EOF;
 } 
$return .= <<<EOF
, 下载次数: {$attach['downloads']}</p>
<p>

EOF;
 if($attach['price']) { 
$return .= <<<EOF

售价: <strong>{$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title']} {$attach['price']} {$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit']}</strong> &nbsp;[<a href="forum.php?mod=misc&amp;action=viewattachpayments&amp;aid={$attach['aid']}" onclick="showWindow('attachpay', this.href)" target="_blank">记录</a>]

EOF;
 if(!$attach['payed']) { 
$return .= <<<EOF

&nbsp;[<a href="forum.php?mod=misc&amp;action=attachpay&amp;aid={$attach['aid']}" onclick="showWindow('attachpay', this.href)">购买</a>]					

EOF;
 } } 
$return .= <<<EOF

</p>

EOF;
 if($attach['description']) { 
$return .= <<<EOF
<p class="xg2">{$attach['description']}</p>
EOF;
 } 
$return .= <<<EOF

</dd>

EOF;
 } 
$return .= <<<EOF

</dl>

EOF;
?><?php return $return; ?><?php }

function attachinpost($attach) {
global $_G;
$attach['refcheck'] = (!$attach['remote'] && $_G['setting']['attachrefcheck']) || ($attach['remote'] && ($_G['setting']['ftp']['hideurl'] || ($attach['isimage'] && $_G['setting']['attachimgpost'] && strtolower(substr($_G['setting']['ftp']['attachurl'], 0, 3)) == 'ftp')));
$aidencode = aidencode($attach['aid']);
$GLOBALS['aimgs'][$attach['pid']][] = $attach['aid'];
$widthcode = attachwidth($attach['width']);
$is_archive = $_G['forum_thread']['is_archived'] ? '&fid='.$_G['fid'].'&archiveid='.$_G[forum_thread][archiveid] : ''; ?><?
$__STATICURL = STATICURL;$return = <<<EOF


EOF;
 if($attach['attachimg'] && $_G['setting']['showimages'] && (!$attach['price'] || $attach['payed'])) { if(!IS_ROBOT) { if($_G['setting']['thumbstatus'] && $attach['thumb']) { 
$return .= <<<EOF

<img
EOF;
 if($attach['price'] && $_G['forum_attachmentdown'] && $_G['uid'] != $attach['uid']) { 
$return .= <<<EOF
 class="attprice"
EOF;
 } 
$return .= <<<EOF
 style="cursor:pointer" onclick="zoom(this, '
EOF;
 if($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}&noupdate=yes&nothumb=yes
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}
EOF;
 } 
$return .= <<<EOF
')" src="
EOF;
 if($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}.thumb.jpg
EOF;
 } 
$return .= <<<EOF
" border="0" id="aimg_{$attach['aid']}" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" alt="{$attach['imgalt']}" title="{$attach['imgalt']}" />

EOF;
 } else { 
$return .= <<<EOF

<img
EOF;
 if($attach['price'] && $_G['forum_attachmentdown'] && $_G['uid'] != $attach['uid']) { 
$return .= <<<EOF
 class="attprice"
EOF;
 } 
$return .= <<<EOF
 src="{$__STATICURL}image/common/none.gif" file="
EOF;
 if($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}&noupdate=yes
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}
EOF;
 } 
$return .= <<<EOF
" 
EOF;
 if($_G['gp_action'] != 'printable') { 
$return .= <<<EOF
{$widthcode}
EOF;
 } 
$return .= <<<EOF
 id="aimg_{$attach['aid']}" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" alt="{$attach['imgalt']}" title="{$attach['imgalt']}" />

EOF;
 } 
$return .= <<<EOF

<div class="tatt" id="aimg_{$attach['aid']}_menu" style="position: absolute; display: none">
<div class="crly">
<div class="y">{$attach['dateline']} 上传</div>
<a href="forum.php?mod=attachment{$is_archive}&amp;aid={$aidencode}&amp;nothumb=yes" title="{$attach['filename']} 下载次数:{$attach['downloads']}" target="_blank"><strong>下载附件</strong> <span class="xs0">({$attach['attachsize']})</span></a>

EOF;
 if($attach['description']) { 
$return .= <<<EOF
<br />{$attach['description']}
EOF;
 } } else { if($attach['description']) { 
$return .= <<<EOF
<p>{$attach['description']}</p>
EOF;
 } 
$return .= <<<EOF

<img src="
EOF;
 if($attach['refcheck']) { 
$return .= <<<EOF
forum.php?mod=attachment{$is_archive}&aid={$aidencode}&noupdate=yes
EOF;
 } else { 
$return .= <<<EOF
{$attach['url']}{$attach['attachment']}
EOF;
 } 
$return .= <<<EOF
" alt="{$attach['imgalt']}" title="{$attach['imgalt']}" />
<div style="display: none">

EOF;
 } } else { 
$return .= <<<EOF

{$attach['attachicon']}
<span style="white-space: nowrap" id="attach_{$attach['aid']}" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})">

EOF;
 if(!$attach['price'] || $attach['payed']) { 
$return .= <<<EOF

<a href="forum.php?mod=attachment{$is_archive}&amp;aid={$aidencode}" target="_blank"
EOF;
 if(!$attach['attachimg'] && $_G['getattachcredits']) { 
$return .= <<<EOF
 onclick="return creditconfirm('{$_G['getattachcredits']}');"
EOF;
 } 
$return .= <<<EOF
>{$attach['filename']}</a>

EOF;
 } else { 
$return .= <<<EOF

<a href="forum.php?mod=misc&amp;action=attachpay&amp;aid={$attach['aid']}" onclick="showWindow('attachpay', this.href)">{$attach['filename']}</a>

EOF;
 } 
$return .= <<<EOF

<em class="xg1">({$attach['attachsize']}, 下载次数: {$attach['downloads']}
EOF;
 if($attach['price']) { 
$return .= <<<EOF
, 售价: {$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title']} {$attach['price']} {$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit']}
EOF;
 } 
$return .= <<<EOF
)
</em>
</span>
<div class="tatt" id="attach_{$attach['aid']}_menu" style="position: absolute; display: none">
<div class="crly">
<div class="y">{$attach['dateline']} 上传</div>
下载次数: {$attach['downloads']}

EOF;
 if($attach['description']) { 
$return .= <<<EOF
<br />{$attach['description']}
EOF;
 } if($attach['readperm']) { 
$return .= <<<EOF
<br />阅读权限: {$attach['readperm']}
EOF;
 } } if($attach['price']) { 
$return .= <<<EOF

<br />售价: {$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title']} {$attach['price']} {$_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit']}	&nbsp;<a href="forum.php?mod=misc&amp;action=viewattachpayments&amp;aid={$attach['aid']}" onclick="showWindow('attachpay', this.href)" target="_blank">[记录]</a>

EOF;
 if(!$attach['payed']) { 
$return .= <<<EOF

&nbsp;[<a href="forum.php?mod=misc&amp;action=attachpay&amp;aid={$attach['aid']}" onclick="showWindow('attachpay', this.href)" target="_blank">购买</a>]

EOF;
 } } if(!$attach['attachimg'] && $_G['getattachcredits']) { 
$return .= <<<EOF
<br />下载积分: {$_G['getattachcredits']}
EOF;
 } 
$return .= <<<EOF

</div>
<div class="mncr"></div>
</div>

EOF;
?><?php return $return; ?><?php } ?>