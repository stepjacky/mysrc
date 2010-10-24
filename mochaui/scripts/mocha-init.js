/* 

	In this file we setup our Windows, Columns and Panels,
	and then inititialize MochaUI.
	
	At the bottom of Core.js you can setup lazy loading for your
	own plugins.

*/

/*
  
INITIALIZE WINDOWS

	1. Define windows
	
		var myWindow = function(){ 
			new MUI.Window({
				id: 'mywindow',
				title: 'My Window',
				contentURL: 'pages/lipsum.html',
				width: 340,
				height: 150
			});
		}

	2. Build windows on onDomReady
	
		myWindow();
	
	3. Add link events to build future windows
	
		if ($('myWindowLink')){
			$('myWindowLink').addEvent('click', function(e) {
				new Event(e).stop();
				jsonWindows();
			});
		}

		Note: If your link is in the top menu, it opens only a single window, and you would
		like a check mark next to it when it's window is open, format the link name as follows:

		window.id + LinkCheck, e.g., mywindowLinkCheck

		Otherwise it is suggested you just use mywindowLink

	Associated HTML for link event above:

		<a id="myWindowLink" href="pages/lipsum.html">My Window</a>	


	Notes:
		If you need to add link events to links within windows you are creating, do
		it in the onContentLoaded function of the new window. 
 
-------------------------------------------------------------------- */

initializeWindows = function(){

		
	
	MUI.ajaxpageWindow = function(){
		new MUI.Window({
			id: 'ajaxpage',
			contentURL: '../view/indexmessage.php',
			title:"添加主页文章",
			width: 340,
			height: 150
		});
	};
	if ($('ajaxpageLinkCheck')){ 
		$('ajaxpageLinkCheck').addEvent('click', function(e){
			new Event(e).stop();
			MUI.ajaxpageWindow();
		});
	}	
	
	
	
	MUI.clockWindow = function(){
		new MUI.Window({
			id: 'clock',
			title: '精品时钟',
			addClass: 'transparent',
			contentURL: MUI.path.plugins + 'coolclock/index.html',
			shape: 'gauge',
			headerHeight: 30,
			width: 160,
			height: 160,
			x: 570,
			y: 140,
			padding: { top: 0, right: 0, bottom: 0, left: 0 },
			require: {			
				js: [MUI.path.plugins + 'coolclock/scripts/coolclock.js'],
				onload: function(){
					if (CoolClock) new CoolClock();
				}	
			}				
		});	
	};
	if ($('clockLinkCheck')){
		$('clockLinkCheck').addEvent('click', function(e){	
			new Event(e).stop();
			MUI.clockWindow();
		});
	}	
	
	MUI.parametricsWindow = function(){	
		new MUI.Window({
			id: 'parametrics',
			title: '窗口参数调整',			
			contentURL: MUI.path.plugins + 'parametrics/index.html',
			width: 305,
			height: 110,
			x: 570,
			y: 160,
			padding: { top: 12, right: 12, bottom: 10, left: 12 },
			resizable: false,
			maximizable: false,
			require: {
				css: [MUI.path.plugins + 'parametrics/css/style.css'],
				js: [MUI.path.plugins + 'parametrics/scripts/parametrics.js'],
				onload: function(){	
					if (MUI.addRadiusSlider) MUI.addRadiusSlider();
					if (MUI.addShadowSlider) MUI.addShadowSlider();
				}		
			}				
		});
	};
	if ($('parametricsLinkCheck')){
		$('parametricsLinkCheck').addEvent('click', function(e){	
			new Event(e).stop();
			MUI.parametricsWindow();
		});
	}
	

	
	

	// Examples > Tests
		
	
	MUI.accordiantestWindow = function() {
		var id = 'accordiantest';
		new MUI.Window({
			id: id,
			title: 'Accordian',			
			contentURL: 'pages/accordian-demo.html',
			width: 300,
			height: 200,
			scrollbars: false,
			resizable: false,
			maximizable: false,				
			padding: { top: 0, right: 0, bottom: 0, left: 0 },
			require: {
				css: [MUI.path.plugins + 'accordian/css/style.css'],
				onload: function(){
					this.windowEl = $(id);				
					new Accordion('#' + id + ' h3.accordianToggler', "#" + id + ' div.accordianElement',{
						opacity: false,
						alwaysHide: true,
						onActive: function(toggler, element){
							toggler.addClass('open');
						},
						onBackground: function(toggler, element){
							toggler.removeClass('open');
						},							
						onStart: function(toggler, element){
							this.windowEl.accordianResize = function(){
								MUI.dynamicResize($(id));
							}
							this.windowEl.accordianTimer = this.windowEl.accordianResize.periodical(10);
						}.bind(this),
						onComplete: function(){
							this.windowEl.accordianTimer = $clear(this.windowEl.accordianTimer);
							MUI.dynamicResize($(id)) // once more for good measure
						}.bind(this)
					}, $(id));
				}	
			}					
		});
	};
	
	// Workspaces
	
	MUI.aboutWindow = function() {
		new MUI.Modal({
			id: 'about',
			title: 'MUI',			
			contentURL: 'pages/about.html',
			type: 'modal2',
			width: 350,
			height: 195,
			padding: { top: 43, right: 12, bottom: 10, left: 12 },
			scrollbars: false
		});
	};
	if ($('aboutLink')) {
		$('aboutLink').addEvent('click', function(e){
			new Event(e).stop();
			MUI.aboutWindow();
		});
	}
	
	MUI.loadingWindow = function(msg){
		new MUI.Modal({
			id: 'about',
			title: '系统提示',			
			content:msg,
			type: 'modal2',
			width: 350,
			height: 195,
			padding: { top: 43, right: 12, bottom: 10, left: 12 },
			scrollbars: false
		});	
	}
	
	
	MUI.myChain.callChain();
};

/*
  
INITIALIZE COLUMNS AND PANELS  

	Creating a Column and Panel Layout:
	 
	 - If you are not using panels then these columns are not required.
	 - If you do use panels, the main column is required. The side columns are optional.
	 
	 Columns
	 - Create your columns from left to right.
	 - One column should not have it's width set. This column will have a fluid width.
	 
	 Panels
	 - After creating Columns, create your panels from top to bottom, left to right.
	 - One panel in each column should not have it's height set. This panel will have a fluid height.	 
	 - New Panels are inserted at the bottom of their column. 
 
-------------------------------------------------------------------- */


initializeColumns = function() {

	new MUI.Column({
		id: 'sideColumn1',
		placement: 'left',
		width: 200,
		resizeLimit: [100, 300]
	});
	
	new MUI.Column({
		id: 'mainColumn',
		placement: 'main',
		resizeLimit: [100, 300]
	});
	
	new MUI.Column({
		id: 'sideColumn2',
		placement: 'right',
		width: 220,
		resizeLimit: [200, 300]
	});
	
	// 左边第一个树菜单面板
	new MUI.Panel({
		id: 'files-panel',
		title: '功能菜单',		
		contentURL: 'pages/file-view.html',
		column: 'sideColumn1',
		require: {
			css: [MUI.path.plugins + 'tree/css/style.css'],			
			js: [MUI.path.plugins + 'tree/scripts/tree.js'],
			onload: function(){
				if (buildTree) buildTree('tree1');
			}	
		},
		onContentLoaded: function(){		
			$('notesLink').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/shopper.php',
					title: '添加店家',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('xhrLink').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),
					url: '../view/cookstyle.php',
					title: '添加菜系',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('building').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),
					url: '../view/building.php',
					title: '添加建筑',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('youtube4Link').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),
					//loadMethod: 'iframe',
					url: '../view/shoppercatalog.php',
					title: '添加店家分类',
					padding: { top: 0, right: 0, bottom: 0, left: 0 }
				});
			});	
			
			$('shoplist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/shopper.php',
					title: '店家列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('cooklist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/cookstyle.php',
					title: '菜系列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('buildinglist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/building.php',
					title: '建筑物列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('shopcataloglist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/shoppercatalog.php',
					title: '店家分类列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			
			
			
			$('splitWindowLink').addEvent('click', function(e){
				//MUI.splitWindow();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/queryword.php',
					title: '添加查询关键字',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});		
			$('ajaxpageLink').addEvent('click', function(e){
				//MUI.ajaxpageWindow();这是显示一个ajax窗口
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/indexmessage.php',
					title: '添加主页公告',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});	
			$('jsonLink').addEvent('click', function(e){
				//MUI.jsonWindows();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/artitle.php',
					title: '添加主页文章',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});	
			$('youtubeLink').addEvent('click', function(e){
				//MUI.youtubeWindow();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/artitlecatalog.php',
					title: '添加文章/公告分类',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});	
			$('indexmessagelist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/indexmessage.php',
					title: '公告列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('artitlelist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/artitle.php',
					title: '文章列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
		
			$('keywordlist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/queryword.php',
					title: '关键字列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('artitlecataloglist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/artitlecatalog.php',
					title: '添加文章/公告分类',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			
			$('clockLink').addEvent('click', function(e){
				MUI.clockWindow();
			});
								
			$('fxmorpherLink').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),
					url: '../view/suser.php',
					title: '添加用户',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
				//MUI.fxmorpherWindow();
			});			
			$('listuser').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),
					url: '../view/list/suser.php',
					title: '用户列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
				//MUI.fxmorpherWindow();
			});	
			$('commitlist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),
					url: '../view/list/commonCommit.php',
					title: '评论列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});  
			});
			
			$("homepage").addEvent("click",function(e){
				new Event(e).stop();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/config/home.php',
					title: '配置主页内容',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
				
			});
			$("cookroom").addEvent("click",function(e){
				new Event(e).stop();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/config/cookroom.php',
					title: '配置美食厨房',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
				
			});
			$("foodfash").addEvent("click",function(e){
				new Event(e).stop();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/config/foodfash.php',
					title: '配置精彩食尚',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
				
			});
			$("foodmap").addEvent("click",function(e){
				new Event(e).stop();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/config/foodmap.php',
					title: '配置美食地图',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
				
			});
			$("friendlinklist").addEvent("click",function(e){
				new Event(e).stop();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/config/friendlink.php',
					title: '配置友情链接',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
				
			});
			$("friendlink").addEvent("click",function(e){
				new Event(e).stop();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/friendlink.php',
					title: '配置友情链接',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
				
			});
			$("clearallcache").addEvent("click",function(e){
				new Event(e).stop();
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/config/cache.php',
					title: '管理缓存内容',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
				
			});
			
			
			$('sysparam').addEvent('click', function(e){
				MUI.parametricsWindow();
			});			
		}
	});
	
	
	// Add panels to main column	
	new MUI.Panel({
		id: 'mainPanel',
		title: '内容主区',
		contentURL: 'pages/lipsum.html',
		column: 'mainColumn',
		headerToolbox: false,
		headerToolboxURL: 'pages/toolbox-demo2.html',
		headerToolboxOnload: function(){
			if ($('demoSearch')) {
				$('demoSearch').addEvent('submit', function(e){
					e.stop();
					$('spinner').setStyle('visibility', 'visible');
					if ($('postContent') && MUI.options.standardEffects == true) {
						$('postContent').setStyle('opacity', 0);
					}
					else {
						$('mainPanel_pad').empty();
					}
					this.set('send', {
						onComplete: function(response){
							MUI.updateContent({
								'element': $('mainPanel'),
								'content': response,
								'title': 'Ajax Response',
								'padding': {
									top: 8,
									right: 8,
									bottom: 8,
									left: 8
								}
							});
						},
						onSuccess: function(){
							if ($('postContent') && MUI.options.standardEffects == true) {								
								$('postContent').setStyle('opacity', 0).get('morph').start({'opacity': 1});
							}
						}
					});
					this.send();
				});
			}
		}		
	});
	
	new MUI.Panel({
		id: 'panel3',
		title: '属性面板',
		contentURL: 'pages/tips.html',
		column: 'sideColumn2',
		height: 120
	});	
	
	new MUI.Panel({
		id: 'tips-panel',
		title: '提示属性',
		contentURL: 'pages/tips.html',
		column: 'sideColumn2',
		height: 140,
		footer: true
	});
	
	
	
	MUI.myChain.callChain();
};

// Initialize MochaUI when the DOM is ready
window.addEvent('load', function(){ //using load instead of domready for IE8

	MUI.myChain = new Chain();
	MUI.myChain.chain(
		function(){MUI.Desktop.initialize();},
		function(){MUI.Dock.initialize();},
		function(){initializeColumns();},		
		function(){initializeWindows();}		
	).callChain();	

});
