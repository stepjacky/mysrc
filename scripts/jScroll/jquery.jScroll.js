/*
 * jScroll 1.0
 * Copyright (C) 2009 wo_is神仙 All Rights Reserved.
 * Licensed: http://www.gnu.org/licenses/gpl.html
*/
;(function($){
	$.fn.extend({
		"jScroll":function(o){
			o = $.extend({
				auto: 3000, //延迟时间（毫秒）
				speed: 800, //单次滚动时长（毫秒）
				vertical: false, //是否向上滚动(默认向左)
				scroll: 1 //每次滚动的元素数量
			},o);
			var running = false, sizeCss = o.vertical ? "height" : "width", ulSize = 0;
			var scrollTimer, scrollLen, itemSize, animCss, i;
			var div = $(this), ul = div.find("ul"), li = ul.children("li");
			
			div.css({overflow: "hidden"});
			ul.css({margin: "0", padding: "0", display: "inline-block"});
			li.css({"list-style-type": "none", float: o.vertical ? "none" : "left"});
			
			//获取LI元素总宽(高)
			for(i=0; i<=li.size()-1; i++){
				itemSize = o.vertical ? li.eq(i).outerHeight() : li.eq(i).outerWidth();
				ulSize+=itemSize;
			}
			var divSize = o.vertical ? div.height() : div.width(); //容器宽(高)
			ul.css(sizeCss, (ulSize*2)+"px");
			if(ulSize > divSize) running = true; //UL的宽(高)大于容的器宽(高)时才滚动
		
			div.hover(function(){
				clearInterval(scrollTimer);
			},function(){
				if(running){
					scrollTimer = setInterval(function(){
						scrollLen = 0;
						itemSize = 0;
						li = ul.children("li");
						for(i=0; i<=o.scroll-1; i++){
							itemSize = o.vertical ? li.eq(i).outerHeight() : li.eq(i).outerWidth();
							scrollLen+=itemSize;
						}
						animCss = o.vertical ? {marginTop:-scrollLen +"px"} : {marginLeft:-scrollLen +"px"};
						ul.animate(animCss, o.speed, function(){
							ul.css(o.vertical ? "margin-top" : "margin-left", "0");
							li.slice(0,o.scroll).appendTo(ul); //将前面的元素移至末尾
						})
					}, parseInt(o.auto+o.speed));
				}
			}).trigger("mouseleave"); //DOM加载完毕后自动执行hover(fn1, fn2)的fn2
		}
	});
})(jQuery);