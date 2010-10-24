<!DOCTYPE link PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
当前经纬度: <label id="info" style="font-size:14px;font-weight:bold;color:red"></label>
<div style="width: 520px; height: 340px; border: 1px solid gray"  id="container"></div>    
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
   var x = <?php echo $_GET['x'];?>;
   var y = <?php echo $_GET['y'];?>;
   var map = new BMap.Map("container");
   map.centerAndZoom(new BMap.Point(x,y), 12);
   map.addControl(new BMap.NavigationControl());
   map.addControl(new BMap.ScaleControl());
   map.addControl(new BMap.OverviewMapControl());
   
   map.enableScrollWheelZoom();
   map.addEventListener("click", function(evt){   
       //alert(evt.point.lng+','+evt.point.lat);
	   longitude = evt.point.lng;
	   lantitude = evt.point.lat;
       
       jQuery("#info").text(longitude+','+lantitude);     
   }); 
   var local = new BMap.LocalSearch("长沙市", {   
       renderOptions: {   
         map: map,   
         pageCapacity: 8,   
         autoViewport: true,   
         selectFirstResult: true ,
         //panel: "results" 
       }   
     }); 

   jQuery("#search").click(function(){
       local.search($("#name").val());
       //return false;  
   }).button();   
  
});
</script>
<input type="text" id="name" />
<button id="search">搜索</button><button id="okupdate">确定</button>
</body>
</html>