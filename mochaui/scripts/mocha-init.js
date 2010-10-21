initializeWindows = function(){
	

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
	MUI.myChain.callChain();
};

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
			$('addproduct').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/product.php',
					title: '添加产品',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('addcatalog').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),
					url: '../view/catalog.php',
					title: '添加产品分类',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('addnews').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),
					url: '../view/news.php',
					title: '添加新闻',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('productlist').addEvent('click', function(e){
				MUI.updateContent({
					element: $('mainPanel'),
					//loadMethod: 'iframe',
					url: '../view/list/product.php',
					title: '产品列表',
					padding: { top: 0, right: 0, bottom: 0, left: 0 }
				});
			});	
			
			$('cataloglist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/catalog.php',
					title: '产品分类列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('newslist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/news.php',
					title: '公司新闻列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
			$('leavewordlist').addEvent('click',function(e){
				MUI.updateContent({
					element: $('mainPanel'),					
					url: '../view/list/leaveword.php',
					title: '评论列表',
					padding: { top: 8, right: 8, bottom: 8, left: 8 }
				});
			});
	
		}// end of onContentLoaded function
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
