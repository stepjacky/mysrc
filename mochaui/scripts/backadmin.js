jQuery.noConflict();
//商家图片
var selectImage='';
//商家经度
var longitude=116.404;
//商家纬度
var lantitude=39.915;
//是否更新了百度地图位置
var isMapUpdated = false;


var MyImageShowWindow = function(){

 
      
	    new MUI.Window({
	        id: 'MyImageShowWindow',
	        title: '选择图片',
	        width: 600,
	        height: 350,
	        resizeLimit: {'x': [450, 2500], 'y': [300, 2000]},
	        onContentLoaded: function(){    
	       
	            new MUI.Column({
	                container: 'MyImageShowWindow_contentWrapper',//'splitWindow_contentWrapper',
	                id: 'MyImageShowWindow_sideColumn',
	                placement: 'left',
	                width: 170,
	                resizeLimit: [100, 300]
	            });
	        
	            new MUI.Column({
	                container: 'MyImageShowWindow_contentWrapper',//splitWindow_contentWrapper',
	                id: 'MyImageShowWindow_mainColumn',
	                placement: 'main',
	                width: null,
	                resizeLimit: [100, 300]
	            });
	        
	            new MUI.Panel({
	                header: false,
	                id: 'MyImageShowWindow_panel1',                   
	                contentURL: '../view/config/jquery_upload_crop/upload_pic/shopperimage.php?imgsrc=http://www.google.com.hk/intl/zh-CN/images/logo_cn.png',
	                column: 'MyImageShowWindow_mainColumn',
	                panelBackground: '#fff'
	            });
	        
	            new MUI.Panel({
	                header: false,
	                id: 'MyImageShowWindow_panel2',
	                addClass: 'panelAlt',                   
	                contentURL: '../view/config/jquery_upload_crop/upload_pic/left.php?panel=MyImageShowWindow_panel1',
	                column: 'MyImageShowWindow_sideColumn'                    
	            });
         
	        }           
	    });
};// end of imageWindow
