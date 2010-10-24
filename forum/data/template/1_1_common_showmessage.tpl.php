<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('showmessage');?>
<? if(!$_G['inajax']) { include template('common/header'); ?><div id="ct" class="wp cl w">
<div class="nfl">
<? } else { include template('common/header_ajax'); } if($param['msgtype'] == 1 || $param['msgtype'] == 2 && !$_G['inajax']) { ?>
<div class="f_c altw">
<div id="messagetext" class="<?=$alerttype?>">
<p><?=$show_message?></p>
<? if($url_forward) { if(!$param['redirectmsg']) { ?>
<p class="alert_btnleft"><a href="<?=$url_forward?>">如果你的浏览器没有自动跳转，请点击此链接</a></p>
<? } else { ?>
<p class="alert_btnleft"><a href="<?=$url_forward?>">如果 <?=$refreshsecond?> 秒后下载仍未开始，请点击此链接</a></p>
<? } } elseif($allowreturn) { ?>
<script type="text/javascript">
if(history.length > (BROWSER.ie ? 0 : 1)) {
document.write('<p class="alert_btnleft"><a href="javascript:history.back()">[ 点击这里返回上一页 ]</a></p>');
}
</script>
<? } ?>				
</div>
<? if($param['login']) { ?>
<div id="messagelogin"></div>
<script type="text/javascript">ajaxget('member.php?mod=logging&action=login&infloat=yes&frommessage', 'messagelogin');</script>
<? } ?>
</div>
<? } elseif($param['msgtype'] == 2) { ?>
<h3 class="flb"><em>提示信息</em><? if($_G['inajax']) { ?><span><a href="javascript:;" class="flbc" onclick="hideWindow('<?=$_G['gp_handlekey']?>');" title="关闭">关闭</a></span><? } ?></h3>
<div class="c altw">
<div class="<?=$alerttype?>"><?=$show_message?></div>
</div>
<? if($param['login']) { ?>
<p class="o pns">
<button type="button" class="pn pnc" onclick="hideWindow('<?=$_G['gp_handlekey']?>');showWindow('login', 'member.php?mod=logging&action=login');"><strong>登录</strong></button>
<? if(!$_G['setting']['bbclosed']) { ?>
<button type="button" class="pn pnc" onclick="hideWindow('<?=$_G['gp_handlekey']?>');showWindow('register', 'member.php?mod=<?=$_G['setting']['regname']?>');"><em><?=$_G['setting']['reglinkname']?></em></button>
<? } ?>
<button type="button" class="pn" onclick="hideWindow('<?=$_G['gp_handlekey']?>');"><em>取消</em></button>
</p>
<? } else { ?>
<p class="o pns"><button type="button" class="pn pnc" onclick="hideWindow('<?=$_G['gp_handlekey']?>');"><strong>关闭</strong></button></p>
<? } } else { ?><?=$show_message?><? } if(!$_G['inajax']) { ?>
</div>
</div><? include template('common/footer'); } else { include template('common/footer_ajax'); } ?>