!function(t){function i(t){this.init(t)}i.prototype={value:0,size:30,startAngle:-Math.PI,thickness:"auto",fill:{gradient:["#3aeabb","#fdd250"]},emptyFill:"#e5e5e5",animation:{duration:3300,easing:"circleProgressEasing"},animationStartValue:0,reverse:!1,lineCap:"butt",constructor:i,el:null,canvas:null,ctx:null,radius:0,arcFill:null,lastFrameValue:0,init:function(i){t.extend(this,i),this.radius=this.size/2,this.initWidget(),this.initFill(),this.draw()},initWidget:function(){var i=this.canvas=this.canvas||t("<canvas>").prependTo(this.el)[0];i.width=this.size,i.height=this.size,this.ctx=i.getContext("2d")},initFill:function(){function i(){var i=t("<canvas>")[0];i.width=e.size,i.height=e.size,i.getContext("2d").drawImage(u,0,0,s,s),e.arcFill=e.ctx.createPattern(i,"no-repeat"),e.drawFrame(e.lastFrameValue)}var e=this,a=this.fill,r=this.ctx,s=this.size;if(!a)throw Error("The fill is not specified!");if(a.color&&(this.arcFill=a.color),a.gradient){var n=a.gradient;if(1==n.length)this.arcFill=n[0];else if(n.length>1){for(var c=a.gradientAngle||0,h=a.gradientDirection||[s/2*(1-Math.cos(c)),s/2*(1+Math.sin(c)),s/2*(1+Math.cos(c)),s/2*(1-Math.sin(c))],l=r.createLinearGradient.apply(r,h),o=0;o<n.length;o++){var g=n[o],d=o/(n.length-1);t.isArray(g)&&(d=g[1],g=g[0]),l.addColorStop(d,g)}this.arcFill=l}}if(a.image){var u;a.image instanceof Image?u=a.image:(u=new Image,u.src=a.image),u.complete?i():u.onload=i}},draw:function(){this.animation?this.drawAnimated(this.value):this.drawFrame(this.value)},drawFrame:function(t){this.lastFrameValue=t,this.ctx.clearRect(0,0,this.size,this.size),this.drawEmptyArc(t),this.drawArc(t)},drawArc:function(t){var i=this.ctx,e=this.radius,a=this.getThickness(),r=this.startAngle;i.save(),i.beginPath(),this.reverse?i.arc(e,e,e-a/2,r-2*Math.PI*t,r):i.arc(e,e,e-a/2,r,r+2*Math.PI*t),i.lineWidth=a,i.lineCap=this.lineCap,i.strokeStyle=this.arcFill,i.stroke(),i.restore()},drawEmptyArc:function(t){var i=this.ctx,e=this.radius,a=this.getThickness(),r=this.startAngle;1>t&&(i.save(),i.beginPath(),0>=t?i.arc(e,e,e-a/2,0,2*Math.PI):this.reverse?i.arc(e,e,e-a/2,r,r-2*Math.PI*t):i.arc(e,e,e-a/2,r+2*Math.PI*t,r),i.lineWidth=a,i.strokeStyle=this.emptyFill,i.stroke(),i.restore())},drawAnimated:function(i){var e=this,a=this.el;a.trigger("circle-animation-start"),t(this.canvas).stop(!0,!0).css({animationProgress:0}).animate({animationProgress:1},t.extend({},this.animation,{step:function(t){var r=e.animationStartValue*(1-t)+i*t;e.drawFrame(r),a.trigger("circle-animation-progress",[t,r])},complete:function(){a.trigger("circle-animation-end")}}))},getThickness:function(){return t.isNumeric(this.thickness)?this.thickness:this.size/14}},t.circleProgress={defaults:i.prototype},t.easing.circleProgressEasing=function(t,i,e,a,r){return(i/=r/2)<1?a/2*i*i*i+e:a/2*((i-=2)*i*i+2)+e},t.fn.circleProgress=function(e){var a="circle-progress";if("widget"==e){var r=this.data(a);return r&&r.canvas}return this.each(function(){var r=t(this),s=r.data(a),n=t.isPlainObject(e)?e:{};s?s.init(n):(n.el=r,s=new i(n),r.data(a,s))})}}(jQuery);