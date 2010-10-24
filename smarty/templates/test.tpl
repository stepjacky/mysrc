<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="scripts/jquery/jquery-1.4.2.js"></script>
<title>无标题文档</title>
<script type="text/javascript">
$(function(){

	var EARTH_RADIUS = 6378.137;
	function rad(d){
	    return d * Math.PI / 180.0;
	}

	function getDistance(lng1,lat1,lng2,lat2){
	    var radLat1 = rad(lat1);
	    var radLat2 = rad(lat2);
	    var a = radLat1 - radLat2;
	    var b = rad(lng1) - rad(lng2);
	    var s = 2 * Math.asin(Math.sqrt(Math.pow(Math.sin(a/2),2) +
	     Math.cos(radLat1)*Math.cos(radLat2)*Math.pow(Math.sin(b/2),2)));
	    s = s * EARTH_RADIUS;
	    s = Math.round(s * 10000) / 10000;
	    return s;
	}
	
	alert(getDistance(100,200,100.10,200));

	    
});


</script>

</head>

<body>


</body>
</html>
