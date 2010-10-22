<?
$base = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/ppedu/";
?>
<base href="<?echo $base?>" />
<meta
	http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link type="text/css"
	href="styles/uicustom.css" rel="stylesheet" />

<link
	rel="stylesheet" type="text/css" media="screen"
	href="scripts/jquery_ui/css/smoothness/jquery-ui-1.7.2.custom.css" />

<link
	rel="stylesheet" type="text/css" media="screen"
	href="scripts/jqgrid-3.6.4/css/ui.jqgrid.css" />


<script
	language="javascript" type="text/javascript"
	src="scripts/jquery-1.3.2.min.js"></script>

<script 
    type="text/javascript"
    src="scripts/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>
   
<script type="text/javascript"
    src="scripts/jquery_ui/js/i18n/jquery-ui-i18n.js"></script>


<script	
	type="text/javascript"
	src="scripts/jqgrid-3.6.4/js/i18n/grid.locale-cn.js"
	></script>
<script
	type="text/javascript"
	src="scripts/jqgrid-3.6.4/js/jquery.jqGrid.min.js"
	></script>

<script language="javascript"
	type="text/javascript" 
	src="scripts/jstree/jquery.tree.js"></script>
<script language="javascript"
	type="text/javascript" 
	src="scripts/myutils.js"></script>


<script type="text/javascript"
	src="fckeditor/fckeditor.js"></script>
<?
header('content-Type=text/html;charset=utf-8');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>