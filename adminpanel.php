<?php

session_start();

$rcode  = strtolower($_POST['acode']);
$scode  = strtolower($_SESSION['code']);
$loginpage='admin_l___go.php';
$email='';

if($rcode!=$scode){
	$url = "$loginpage?msg=codeerror";
	header ("HTTP/1.1 303 See Other");
	header ("Location: $url");
	exit(0);
}
if(isset($_POST['email']) && isset($_POST['pwd'])){
	require_once "included/database.php";
	if(emailValidate($_POST['email'])){
		$email  = urlencode($_POST['email']);
		$pwd    = urlencode($_POST['pwd']);
		$count = getCountByWhere("user", "email='$email' and pwd='$pwd' and usertype='A'");
		if($count==0){
			$url = "$loginpage?msg=nouser";
			header ("HTTP/1.1 303 See Other");
			header ("Location: $url");
			exit(0);
		}else{
		    $results = query("select localname from user where email='$email'");
		    $nick='';
		    while($row = mysql_fetch_assoc($results)){
		    	$nick = $row['localname'];
		    }
			$_SESSION['loginuser']=($_POST['email']);
			$_SESSION['localname']=($nick); 
		}
	}else{
		$url = "$loginpage?msg=mailerror";
		header ("HTTP/1.1 303 See Other");
		header ("Location: $url");
		exit(0);
	}

}else{
	$url = "$loginpage?msg=noinput";
	header ("HTTP/1.1 303 See Other");
	header ("Location: $url");
	exit(0);

}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"　"http://www.w3.org/TR/html4/loose.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>后台管理面板</title>
<?php
include_once "included/static-resource.php";
?>
<!-- DEMO styles - specific to this page -->
<link rel="stylesheet" type="text/css"
	href="scripts/jquery_layout/complex.css" />

<link rel="stylesheet" type="text/css"
	href="styles/table.css" />

<script type="text/javascript"
	src="scripts/jquery_layout/jquery.layout.min.js"></script>
<script type="text/javascript" src="scripts/jquery_layout/complex.js"></script>

<script language="javascript" type="text/javascript"
	src="scripts/index.js"></script>

<script type="text/javascript">
/*
 * complex.html
 *
 * This is a demonstration page for the jQuery layout widget
 *
 *	NOTE: For best code readability, view this with a fixed-space font and tabs equal to 4-chars
 */

	var outerLayout, innerLayout;

	/*
	*#######################
	*     ON PAGE LOAD
	*#######################
	*/
	$(document).ready( function() {
		// create the OUTER LAYOUT
		outerLayout = $("body").layout( layoutSettings_Outer );

		/*******************************
		 ***  CUSTOM LAYOUT BUTTONS  ***
		 *******************************
		 *
		 * Add SPANs to the east/west panes for customer "close" and "pin" buttons
		 *
		 * COULD have hard-coded span, div, button, image, or any element to use as a 'button'...
		 * ... but instead am adding SPANs via script - THEN attaching the layout-events to them
		 *
		 * CSS will size and position the spans, as well as set the background-images
		 */

		// BIND events to hard-coded buttons in the NORTH toolbar
		outerLayout.addToggleBtn( "#tbarToggleNorth", "north" );
		outerLayout.addOpenBtn( "#tbarOpenSouth", "south" );
		outerLayout.addCloseBtn( "#tbarCloseSouth", "south" );
		outerLayout.addPinBtn( "#tbarPinWest", "west" );
		outerLayout.addPinBtn( "#tbarPinEast", "east" );

		// save selector strings to vars so we don't have to repeat it
		// must prefix paneClass with "body > " to target ONLY the outerLayout panes
		var westSelector = "body > .ui-layout-west"; // outer-west pane
		var eastSelector = "body > .ui-layout-east"; // outer-east pane

		 // CREATE SPANs for pin-buttons - using a generic class as identifiers
		$("<span></span>").addClass("pin-button").prependTo( westSelector );
		$("<span></span>").addClass("pin-button").prependTo( eastSelector );
		// BIND events to pin-buttons to make them functional
		outerLayout.addPinBtn( westSelector +" .pin-button", "west");
		outerLayout.addPinBtn( eastSelector +" .pin-button", "east" );

		 // CREATE SPANs for close-buttons - using unique IDs as identifiers
		$("<span></span>").attr("id", "west-closer" ).prependTo( westSelector );
		$("<span></span>").attr("id", "east-closer").prependTo( eastSelector );
		// BIND layout events to close-buttons to make them functional
		outerLayout.addCloseBtn("#west-closer", "west");
		outerLayout.addCloseBtn("#east-closer", "east");



		/* Create the INNER LAYOUT - nested inside the 'center pane' of the outer layout
		 * Inner Layout is create by createInnerLayout() function - on demand
		 *
			innerLayout = $("div.pane-center").layout( layoutSettings_Inner );
		 *
		 */


		// DEMO HELPER: prevent hyperlinks from reloading page when a 'base.href' is set
		$("a").each(function () {
			var path = document.location.href;
			if (path.substr(path.length-1)=="#") path = path.substr(0,path.length-1);
			if (this.href.substr(this.href.length-1) == "#") this.href = path +"#";
		});

	});


	/*
	*#######################
	* INNER LAYOUT SETTINGS
	*#######################
	*
	* These settings are set in 'list format' - no nested data-structures
	* Default settings are specified with just their name, like: fxName:"slide"
	* Pane-specific settings are prefixed with the pane name + 2-underscores: north__fxName:"none"
	*/
	layoutSettings_Inner = {
		applyDefaultStyles:				true // basic styling for testing & demo purposes
	,	minSize:						20 // TESTING ONLY
	,	spacing_closed:					14
	,	north__spacing_closed:			8
	,	south__spacing_closed:			8
	,	north__togglerLength_closed:	-1 // = 100% - so cannot 'slide open'
	,	south__togglerLength_closed:	-1
	,	fxName:							"slide" // do not confuse with "slidable" option!
	,	fxSpeed_open:					1000
	,	fxSpeed_close:					2500
	,	fxSettings_open:				{ easing: "easeInQuint" }
	,	fxSettings_close:				{ easing: "easeOutQuint" }
	,	north__fxName:					"none"
	,	south__fxName:					"drop"
	,	south__fxSpeed_open:			500
	,	south__fxSpeed_close:			1000
	//,	initClosed:						true
	,	center__minWidth:				200
	,	center__minHeight:				200
	};


	/*
	*#######################
	* OUTER LAYOUT SETTINGS
	*#######################
	*
	* This configuration illustrates how extensively the layout can be customized
	* ALL SETTINGS ARE OPTIONAL - and there are more available than shown below
	*
	* These settings are set in 'sub-key format' - ALL data must be in a nested data-structures
	* All default settings (applied to all panes) go inside the defaults:{} key
	* Pane-specific settings go inside their keys: north:{}, south:{}, center:{}, etc
	*/
	var layoutSettings_Outer = {
		name: "outerLayout" // NO FUNCTIONAL USE, but could be used by custom code to 'identify' a layout
		// options.defaults apply to ALL PANES - but overridden by pane-specific settings
	,	defaults: {
			size:					"auto"
		,	minSize:				50
		,	paneClass:				"pane" 		// default = 'ui-layout-pane'
		,	resizerClass:			"resizer"	// default = 'ui-layout-resizer'
		,	togglerClass:			"toggler"	// default = 'ui-layout-toggler'
		,	buttonClass:			"button"	// default = 'ui-layout-button'
		,	contentSelector:		".content"	// inner div to auto-size so only it scrolls, not the entire pane!
		,	contentIgnoreSelector:	"span"		// 'paneSelector' for content to 'ignore' when measuring room for content
		,	togglerLength_open:		35			// WIDTH of toggler on north/south edges - HEIGHT on east/west edges
		,	togglerLength_closed:	35			// "100%" OR -1 = full height
		,	hideTogglerOnSlide:		true		// hide the toggler when pane is 'slid open'
		,	togglerTip_open:		"关闭此面板"
		,	togglerTip_closed:		"显示此面板"
		,	resizerTip:				"改变此面板大小"
		//	effect defaults - overridden on some panes
		,	fxName:					"slide"		// none, slide, drop, scale
		,	fxSpeed_open:			750
		,	fxSpeed_close:			1500
		,	fxSettings_open:		{ easing: "easeInQuint" }
		,	fxSettings_close:		{ easing: "easeOutQuint" }
	}
	,	north: {
			spacing_open:			1			// cosmetic spacing
		,	togglerLength_open:		0			// HIDE the toggler button
		,	togglerLength_closed:	-1			// "100%" OR -1 = full width of pane
		,	resizable: 				false
		,	slidable:				false
		//	override default effect
		,	fxName:					"none"
		,	initClosed:				false	
		}
	,	south: {
			maxSize:				200
		,	spacing_closed:			0			// HIDE resizer & toggler when 'closed'
		,	slidable:				false		// REFERENCE - cannot slide if spacing_closed = 0
		,	initClosed:				true
		//	CALLBACK TESTING...
		,	onhide_start:			function () {}
		,	onhide_end:				function () {}
		,	onshow_start:			function () {}
		,	onshow_end:				function () {}
		,	onopen_start:			function () {}
		,	onopen_end:				function () {}
		,	onclose_start:			function () {}
		,	onclose_end:			function () {}
		,	onresize_start:			function () {}
		,	onresize_end:			function () {}
		}
	,	west: {
			size:					250
		,	spacing_closed:			21			// wider space when closed
		,	togglerLength_closed:	21			// make toggler 'square' - 21x21
		,	togglerAlign_closed:	"top"		// align to top of resizer
		,	togglerLength_open:		0			// NONE - using custom togglers INSIDE west-pane
		,	togglerTip_open:		"隐藏功能窗口"
		,	togglerTip_closed:		"显示功能窗口"
		,	resizerTip_open:		"改变功能窗口大小"
		,	slideTrigger_open:		"click" 	// default
		,	initClosed:				false
		//	add 'bounce' option to default 'slide' effect
		,	fxSettings_open:		{ easing: "easeOutBounce" }
		}
	,	east: {
			size:					250
		,	spacing_closed:			21			// wider space when closed
		,	togglerLength_closed:	21			// make toggler 'square' - 21x21
		,	togglerAlign_closed:	"top"		// align to top of resizer
		,	togglerLength_open:		0 			// NONE - using custom togglers INSIDE east-pane
		,	togglerTip_open:		"关闭属性面板"
		,	togglerTip_closed:		"打开属性面板"
		,	resizerTip_open:		"改变属性面板大小"
		,	slideTrigger_open:		"mouseover"
		,	initClosed:				true
		//	override default effect, speed, and settings
		,	fxName:					"drop"
		,	fxSpeed:				"normal"
		,	fxSettings:				{ easing: "" } // nullify default easing
		}
	,	center: {
			paneSelector:			"#mainContent" 			// sample: use an ID to select pane instead of a class
		,	onresize:				"innerLayout.resizeAll"	// resize INNER LAYOUT when center pane resizes
		,	minWidth:				200
		,	minHeight:				200
		}
	};

</script>

</head>
<body>

<div class="ui-layout-west" style="padding: 0px; margin: 0;">

<div class="header" style="height: 28px; font-size: 15px">管理功能</div>

<div class="content" style="padding: 0px; margin: 0;">
<?php
include_once 'leftaccordion.php';
?></div>

<div class="footer"></div>

</div>

<div class="ui-layout-east">

<div class="header">我的功能</div>

<div class="subhead">属性时间</div>

<div class="content"></div>

<div class="footer">属性</div>
<div class="footer">事件</div>
<div class="footer">版权</div>

</div>


<div class="ui-layout-north"
	style="background-image: url(images/admin-header.png); background-repeat: repeat-x">
<div class="content"
	style="height: 50px; text-align: left; color: yellow; font-size: 18px">
<span style="font-size: 24px; font-weight: bold; font-size: yellow;">
后台管理系统 </span>
<label>
<?php echo $_SESSION['localname'];?>
[
<span style="font-size:12px">
<?php echo $_SESSION['loginuser'];?>
</span>
]</label>
</div>
<ul class="toolbar">
	<li id="tbarToggleNorth"><span></span>顶部开关</li>
	<li id="tbarOpenSouth"><span></span>显示下面版</li>
	<li id="tbarCloseSouth"><span></span>关闭下面版</li>
	<li id="tbarPinWest"><span></span>推/拉功能面板</li>
	<li id="tbarPinEast" class="last"><span></span>推/拉属性面板</li>
</ul>
</div>


<div class="ui-layout-south">
<div class="header">最近操作列表</div>
<div id="southDebug" class="content">
<p>最近没有操作</p>
</div>
</div>

<div id="mainContent" style="padding: 0px; margin: 0;"><!-- DIVs for the INNER LAYOUT -->
<div class="ui-layout-center" style="padding: 0px; margin: 0">
<h3 class="header" style="height: 25px"></h3>
<div id="primaryContent" class="ui-layout-content"></div>

</div>

<div id="dialog" title="<h4 style='color:red;'>系统消息</h4>" />
</body>
</html>
