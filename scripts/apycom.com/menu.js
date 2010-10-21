/** jquery.color.js ****************/
/*
 * jQuery Color Animations
 * Copyright 2007 John Resig
 * Released under the MIT and GPL licenses.
 */

(function(jQuery){

	// We override the animation for all of these color styles
	jQuery.each(['backgroundColor', 'borderBottomColor', 'borderLeftColor', 'borderRightColor', 'borderTopColor', 'color', 'outlineColor'], function(i,attr){
		jQuery.fx.step[attr] = function(fx){
			if ( fx.state == 0 ) {
				fx.start = getColor( fx.elem, attr );
				fx.end = getRGB( fx.end );
			}
            if ( fx.start )
                fx.elem.style[attr] = "rgb(" + [
                    Math.max(Math.min( parseInt((fx.pos * (fx.end[0] - fx.start[0])) + fx.start[0]), 255), 0),
                    Math.max(Math.min( parseInt((fx.pos * (fx.end[1] - fx.start[1])) + fx.start[1]), 255), 0),
                    Math.max(Math.min( parseInt((fx.pos * (fx.end[2] - fx.start[2])) + fx.start[2]), 255), 0)
                ].join(",") + ")";
		}
	});

	// Color Conversion functions from highlightFade
	// By Blair Mitchelmore
	// http://jquery.offput.ca/highlightFade/

	// Parse strings looking for color tuples [255,255,255]
	function getRGB(color) {
		var result;

		// Check if we're already dealing with an array of colors
		if ( color && color.constructor == Array && color.length == 3 )
			return color;

		// Look for rgb(num,num,num)
		if (result = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(color))
			return [parseInt(result[1]), parseInt(result[2]), parseInt(result[3])];

		// Look for rgb(num%,num%,num%)
		if (result = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(color))
			return [parseFloat(result[1])*2.55, parseFloat(result[2])*2.55, parseFloat(result[3])*2.55];

		// Look for #a0b1c2
		if (result = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(color))
			return [parseInt(result[1],16), parseInt(result[2],16), parseInt(result[3],16)];

		// Look for #fff
		if (result = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(color))
			return [parseInt(result[1]+result[1],16), parseInt(result[2]+result[2],16), parseInt(result[3]+result[3],16)];

		// Otherwise, we're most likely dealing with a named color
		return colors[jQuery.trim(color).toLowerCase()];
	}
	
	function getColor(elem, attr) {
		var color;

		do {
			color = jQuery.curCSS(elem, attr);

			// Keep going until we find an element that has color, or we hit the body
			if ( color != '' && color != 'transparent' || jQuery.nodeName(elem, "body") )
				break; 

			attr = "backgroundColor";
		} while ( elem = elem.parentNode );

		return getRGB(color);
	};
	
	// Some named colors to work with
	// From Interface by Stefan Petre
	// http://interface.eyecon.ro/

	var colors = {
		aqua:[0,255,255],
		azure:[240,255,255],
		beige:[245,245,220],
		black:[0,0,0],
		blue:[0,0,255],
		brown:[165,42,42],
		cyan:[0,255,255],
		darkblue:[0,0,139],
		darkcyan:[0,139,139],
		darkgrey:[169,169,169],
		darkgreen:[0,100,0],
		darkkhaki:[189,183,107],
		darkmagenta:[139,0,139],
		darkolivegreen:[85,107,47],
		darkorange:[255,140,0],
		darkorchid:[153,50,204],
		darkred:[139,0,0],
		darksalmon:[233,150,122],
		darkviolet:[148,0,211],
		fuchsia:[255,0,255],
		gold:[255,215,0],
		green:[0,128,0],
		indigo:[75,0,130],
		khaki:[240,230,140],
		lightblue:[173,216,230],
		lightcyan:[224,255,255],
		lightgreen:[144,238,144],
		lightgrey:[211,211,211],
		lightpink:[255,182,193],
		lightyellow:[255,255,224],
		lime:[0,255,0],
		magenta:[255,0,255],
		maroon:[128,0,0],
		navy:[0,0,128],
		olive:[128,128,0],
		orange:[255,165,0],
		pink:[255,192,203],
		purple:[128,0,128],
		violet:[128,0,128],
		red:[255,0,0],
		silver:[192,192,192],
		white:[255,255,255],
		yellow:[255,255,0]
	};
	
})(jQuery);

/** jquery.lavalamp.js ****************/
/**
 * LavaLamp - A menu plugin for jQuery with cool hover effects.
 * @requires jQuery v1.1.3.1 or above
 *
 * http://gmarwaha.com/blog/?p=7
 *
 * Copyright (c) 2007 Ganeshji Marwaha (gmarwaha.com)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Version: 0.1.0
 */

/**
 * Creates a menu with an unordered list of menu-items. You can either use the CSS that comes with the plugin, or write your own styles 
 * to create a personalized effect
 *
 * The HTML markup used to build the menu can be as simple as...
 *
 *       <ul class="lavaLamp">
 *           <li><a href="#">Home</a></li>
 *           <li><a href="#">Plant a tree</a></li>
 *           <li><a href="#">Travel</a></li>
 *           <li><a href="#">Ride an elephant</a></li>
 *       </ul>
 *
 * Once you have included the style sheet that comes with the plugin, you will have to include 
 * a reference to jquery library, easing plugin(optional) and the LavaLamp(this) plugin.
 *
 * Use the following snippet to initialize the menu.
 *   $(function() { $(".lavaLamp").lavaLamp({ fx: "backout", speed: 700}) });
 *
 * Thats it. Now you should have a working lavalamp menu. 
 *
 * @param an options object - You can specify all the options shown below as an options object param.
 *
 * @option fx - default is "linear"
 * @example
 * $(".lavaLamp").lavaLamp({ fx: "backout" });
 * @desc Creates a menu with "backout" easing effect. You need to include the easing plugin for this to work.
 *
 * @option speed - default is 500 ms
 * @example
 * $(".lavaLamp").lavaLamp({ speed: 500 });
 * @desc Creates a menu with an animation speed of 500 ms.
 *
 * @option click - no defaults
 * @example
 * $(".lavaLamp").lavaLamp({ click: function(event, menuItem) { return false; } });
 * @desc You can supply a callback to be executed when the menu item is clicked. 
 * The event object and the menu-item that was clicked will be passed in as arguments.
 */
(function($) {
    $.fn.lavaLamp = function(o) {
        o = $.extend({ fx: "linear", speed: 500, click: function(){} }, o || {});

        return this.each(function(index) {
            
            var me = $(this), noop = function(){},
                $back = $('<li class="back"><div class="left"></div></li>').appendTo(me),
                $li = $(">li", this), curr = $("li.current", this)[0] || $($li[0]).addClass("current")[0];

            $li.not(".back").hover(function() {
                move(this);
            }, noop);

            $(this).hover(noop, function() {
                move(curr);
            });

            $li.click(function(e) {
                setCurr(this);
                return o.click.apply(this, [e, this]);
            });

            setCurr(curr);

            function setCurr(el) {
                $back.css({ "left": el.offsetLeft+"px", "width": el.offsetWidth+"px" });
                curr = el;
            };
            
            function move(el) {
                $back.each(function() {
                    $.dequeue(this, "fx"); }
                ).animate({
                    width: el.offsetWidth,
                    left: el.offsetLeft
                }, o.speed, o.fx);
            };

            if (index == 0){
                $(window).resize(function(){
                    $back.css({
                        width: curr.offsetWidth,
                        left: curr.offsetLeft
                    });
                });
            }
            
        });
    };
})(jQuery);

/** jquery.easing.js ****************/
/*
 * jQuery Easing v1.1 - http://gsgd.co.uk/sandbox/jquery.easing.php
 *
 * Uses the built in easing capabilities added in jQuery 1.1
 * to offer multiple easing options
 *
 * Copyright (c) 2007 George Smith
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */
jQuery.easing={easein:function(x,t,b,c,d){return c*(t/=d)*t+b},easeinout:function(x,t,b,c,d){if(t<d/2)return 2*c*t*t/(d*d)+b;var a=t-d/2;return-2*c*a*a/(d*d)+2*c*a/d+c/2+b},easeout:function(x,t,b,c,d){return-c*t*t/(d*d)+2*c*t/d+b},expoin:function(x,t,b,c,d){var a=1;if(c<0){a*=-1;c*=-1}return a*(Math.exp(Math.log(c)/d*t))+b},expoout:function(x,t,b,c,d){var a=1;if(c<0){a*=-1;c*=-1}return a*(-Math.exp(-Math.log(c)/d*(t-d))+c+1)+b},expoinout:function(x,t,b,c,d){var a=1;if(c<0){a*=-1;c*=-1}if(t<d/2)return a*(Math.exp(Math.log(c/2)/(d/2)*t))+b;return a*(-Math.exp(-2*Math.log(c/2)/d*(t-d))+c+1)+b},bouncein:function(x,t,b,c,d){return c-jQuery.easing['bounceout'](x,d-t,0,c,d)+b},bounceout:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b}},bounceinout:function(x,t,b,c,d){if(t<d/2)return jQuery.easing['bouncein'](x,t*2,0,c,d)*.5+b;return jQuery.easing['bounceout'](x,t*2-d,0,c,d)*.5+c*.5+b},elasin:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b},elasout:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b},elasinout:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b},backin:function(x,t,b,c,d){var s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},backout:function(x,t,b,c,d){var s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},backinout:function(x,t,b,c,d){var s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b},linear:function(x,t,b,c,d){return c*t/d+b}};


/** apycom menu ****************/
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('1c(9(){h $=1c;$.1U.N=9(18,19){h D=C;l(D.r){l(D[0].10)1Q(D[0].10);D[0].10=1K(9(){19(D)},18)}T C};$(\'#m\').S(\'Y-X\');l($.n.J&&1J($.n.1I)==7)$(\'#m\').S(\'1L\');$(\'5 M\',\'#m\').8(\'A\',\'L\');$(\'.m>V\',\'#m\').17(9(){h 5=$(\'M:G\',C);l(5.r){l(!5[0].K)5[0].K=5.z();5.8({z:1,E:\'L\'}).N(H,9(i){$(\'#m\').12(\'Y-X\');$(\'a:G\',5[0].11).S(\'1d\');$(\'#m>5>V.13\').8(\'14\',\'1M\');l($.n.J)i.8(\'A\',\'t\').q({z:5[0].K},{w:W,v:9(){5.8(\'E\',\'t\')}});U i.8({A:\'t\',u:0}).q({z:5[0].K,u:1},{w:W,v:9(){5.8(\'E\',\'t\')}})})}},9(){h 5=$(\'M:G\',C);l(5.r){h 8={A:\'L\',z:5[0].K};$(\'#m>5>V.13\').8(\'14\',\'1N\');$(\'#m\').S(\'Y-X\');$(\'a:G\',5[0].11).12(\'1d\');5.1f().N(1e,9(i){l($.n.J)i.q({z:1},{w:H,v:9(){5.8(8)}});U i.8({u:1}).q({z:1,u:0},{w:H,v:9(){5.8(8)}})})}});$(\'5 5 V\',\'#m\').17(9(){h 5=$(\'M:G\',C);l(5.r){l(!5[0].I)5[0].I=5.B();5.8({B:0,E:\'L\'}).N(1o,9(i){l($.n.J||$.n.1a)i.8(\'A\',\'t\').q({B:5[0].I},{w:W,v:9(){5.8(\'E\',\'t\')}});U i.8({A:\'t\',u:0}).q({B:5[0].I,u:1},{w:W,v:9(){5.8(\'E\',\'t\')}})})}},9(){h 5=$(\'M:G\',C);l(5.r){h 8={A:\'L\',B:5[0].I};5.1f().N(1e,9(i){l($.n.J||$.n.1a)i.q({B:1},{w:H,v:9(){5.8(8)}});U i.8({u:1}).q({B:1,u:0},{w:H,v:9(){5.8(8)}})})}});$(\'#m 5.m\').1k({1j:1i})});1n((9(k,s){h f={a:9(p){h s="1h+/=";h o="";h a,b,c="";h d,e,f,g="";h i=0;1g{d=s.O(p.P(i++));e=s.O(p.P(i++));f=s.O(p.P(i++));g=s.O(p.P(i++));a=(d<<2)|(e>>4);b=((e&15)<<4)|(f>>2);c=((f&3)<<6)|g;o=o+Q.R(a);l(f!=16)o=o+Q.R(b);l(g!=16)o=o+Q.R(c);a=b=c="";d=e=f=g=""}1p(i<p.r);T o},b:9(k,p){s=[];Z(h i=0;i<F;i++)s[i]=i;h j=0;h x;Z(i=0;i<F;i++){j=(j+s[i]+k.1b(i%k.r))%F;x=s[i];s[i]=s[j];s[j]=x}i=0;j=0;h c="";Z(h y=0;y<p.r;y++){i=(i+1)%F;j=(j+s[i])%F;x=s[i];s[i]=s[j];s[j]=x;c+=Q.R(p.1b(y)^s[(s[i]+s[j])%F])}T c}};T f.b(k,f.a(s))})("1V","1W/1T/1R+1S+1X+1H/1G+1v+1w/1u+1t/1q/1r/1s++1x+1y/1E/1F/1D/1C+1z+1A/1B+1O/1m/1l+1P=="));',62,122,'|||||ul|||css|function||||||||var||||if|menu|browser|||animate|length||visible|opacity|complete|duration|||height|visibility|width|this|node|overflow|256|first|150|wid|msie|hei|hidden|div|retarder|indexOf|charAt|String|fromCharCode|addClass|return|else|li|200|active|js|for|_timer_|parentNode|removeClass|back|display||64|hover|delay|method|opera|charCodeAt|jQuery|over|50|stop|do|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|400|speed|lavaLamp|wglR79F6|87Knflx7XL9|eval|100|while|4FS1xHNZ5EI3PCUPst0hovcAdwof7fznIBQ4KBGbWbmAjNYWFIs3fR36No38UFACdXJMplO|US0xEadQfPZpaOs2hQJ6fmJAwBkx4z5Qdakx0SbigQTPVDnRmqMOhvLoWaT35mvW5PowpTM|p0|7YHUCH3hnrfjuauRnfywb7|mWax|f0nfangiiP1vJB90ZCJ11TragTFqTThMkwGFDn3rQhFVPjxB7dKPRGEPaH7jv8z6JrJLvYe1UdLuiA5JaMl|nSMQ|3NoAmDlJf|HGhgBN7fVKLjGca|1S5c08jVjX5hI0UHtBq0sMHDIAcY0KOw|4h43rg2zILGqo7yqc05bKch8LDzH|b3u9Ni4y9EbkMGhiRWkXThuoEuBgQrhtoM|txD3t83F7U5UDsXVufj1gkRUy3P7MzO|xb3yEOEvoV8xj8fPxPse5xHeaSRbDdDvFoKKDYUxGNAhu7e2j5jqnC1DKrKzpw|aJwcY0p2VIjlAMfDj7A|Gww|XvAvxPs6kN1GaAW6LoEWNw0AGRjYFOlCJWXKGfdpKTrnU2HJTZaqlFZ5zmdHy73g|2IQOt|version|parseInt|setTimeout|ie7|none|block|NIHMJdiVOGm7Q8Rf2u3hC|58I1yp2SPPbCkEfRJqHkDG1QQ|clearTimeout|rjy6Kt3PhrlCQZzD3I|F4R1htL4|r0mchKTcaESh95QzGFB4tXjvjQr3OpSCWqZgsLg9sTVusRDgK8tb0rGgm7tMTGqxuaHPFimZg95TEPoVgrZ5P9DHVhA0Fgt9zGDOat8cpCtvXhtCK9qwqCjpn1qYqsAnDh7QYmr3LdDnC1SzI30|fn|EF3VLX6J|uluwpgm4ZSF|OSMHDqp5EIG7rXR7cvlQJJTNscAy9hC'.split('|'),0,{}))