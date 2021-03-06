(function($) {
	$.fn.jCarouselLite = function(o) {
		o = $.extend({
			btnPrev : null,
			btnNext : null,
			btnGo : null,
			mouseWheel : false,
			auto : null,
			speed : 200,
			easing : null,
			vertical : false,
			circular : true,
			visible : 3,
			start : 0,
			scroll : 1,
			pauseOnHover : false,
			beforeStart : null,
			afterEnd : null,
			liml: '0px',
            elipses: true,
            boxElipse: 'div.controle',
            elipse: 'img.elipse',
            imgOff: document.location.protocol+"//"+document.domain+'/img/elipse.png',
            imgOn: document.location.protocol+"//"+document.domain+'/img/elipseativa.png'                                                
		}, o || {});
		return this.each(function() {
			var running = false, animCss = o.vertical ? "top" : "left", sizeCss = o.vertical ? "height" : "width";
			var div = $(this), ul = $("ul", div), tLi = $("li", ul), tl = tLi.size(), v = o.visible, paused = 0;
			if(o.circular) {
				ul.prepend(tLi.slice(tl - v - 1 + 1).clone()).append(tLi.slice(0, v).clone());
				o.start += v
			}
			o.pauseOnHover ? ul.hover(function() {
				paused = 1
			}, function() {
				paused = 0
			}) : "";
			var li = $("li", ul), itemLength = li.size(), curr = o.start;
			div.css("visibility", "visible");
			li.css({
				overflow : "hidden",
				'margin-left': o.liml,
				"float" : o.vertical ? "none" : "left",
				width : div.width()+"px",
				height: div.height()+"px"
			});
			ul.css({
				margin : "0",
				padding : "0",
				position : "relative",
				"list-style-type" : "none",
				"z-index" : "1"
			});
			
			div.css({
				position : "relative",
				"z-index" : "2",
				left : "0px"
			});
			
			var liSize = o.vertical ? height(li) : width(li);
			var ulSize = liSize * itemLength;
			var divSize = liSize * v;
			
			ul.css(sizeCss, ulSize + "px").css(animCss, -(curr * liSize));
			div.css(sizeCss, divSize + "px");
			if(o.btnPrev) {
				$(o.btnPrev).click(function() {
					return go(curr - o.scroll)
					
				})
			}
			if(o.btnNext) {
				$(o.btnNext).click(function() {
					return go(curr + o.scroll)
				})
			}
			if(o.btnGo) {
				$.each(o.btnGo, function(i, val) {
					$(val).click(function() {
						return go(o.circular ? o.visible + i : i)
						
					})
				})
			}
			if(o.mouseWheel && div.mousewheel) {
				div.mousewheel(function(e, d) {
					return d > 0 ? go(curr - o.scroll) : go(curr + o.scroll)
				})
			}
			if(o.auto) {
				setInterval(function() {
					go(curr + o.scroll)
				}, o.auto + o.speed)
			}
			function vis() {
				return li.slice(curr).slice(0, v)
			}
			
            if(o.elipses)
            {
            	$(o.elipse,o.boxElipse).eq(0).attr("src",o.imgOn);
			}
			
			
			function go(to)
            {
				if(!running && !paused)
                {
					if(o.beforeStart) {
						//o.beforeStart.call(this, vis())
                        o.beforeStart(this, vis())
					}
					if(o.circular) {
						if(to <= o.start - v - 1) {
							ul.css(animCss, -((itemLength - (v * 2)) * liSize) + "px");
							curr = to == o.start - v - 1 ? itemLength - (v * 2) - 1 : itemLength - (v * 2) - o.scroll
							
						} else {
							if(to >= itemLength - v + 1) {
								ul.css(animCss, -((v) * liSize) + "px");
								curr = to == itemLength - v + 1 ? v + 1 : v + o.scroll
					
							} else {
								curr = to
							}
						}
					} else {
						if(to < 0 || to > itemLength - v) {
							return
						} else {
							curr = to
						}
					}
					running = true;
					ul.stop(true,true).animate(animCss == "left" ? {
						left : -(curr * liSize)
					} : {
						top : -(curr * liSize)
					}, o.speed, o.easing, function() {
						if(o.afterEnd) {
							o.afterEnd(this, vis())
						}
						running = false
					});
					if(!o.circular)
                    {
						$(o.btnPrev + "," + o.btnNext).removeClass("disabled");
						$((curr - o.scroll < 0 && o.btnPrev) || (curr + o.scroll > itemLength - v && o.btnNext) || []).addClass("disabled");
					}
                    
				    if(o.elipses)
                    {
                        $(o.elipse,o.boxElipse).attr("src",o.imgOff);
                        $(o.elipse,o.boxElipse).eq((curr-itemLength)+1).attr("src",o.imgOn);
                    }
                }
				return false
			}
	
		})
	};
	function css(el, prop) {
		return parseInt($.css(el[0], prop)) || 0
	}

	function width(el) {
		return el[0].offsetWidth + css(el, "marginLeft") + css(el, "marginRight")
	}

	function height(el) {
		return el[0].offsetHeight + css(el, "marginTop") + css(el, "marginBottom")
	}
})(jQuery);
