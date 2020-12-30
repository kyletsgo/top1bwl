(function (cjs, an) {

var p; // shortcut to reference prototypes
var lib={};var ss={};var img={};
lib.ssMetadata = [
		{name:"main_animate_atlas_", frames: [[871,182,146,134],[466,340,152,152],[724,0,164,180],[724,182,145,160],[0,0,464,509],[620,344,103,96],[871,318,139,90],[466,0,256,338],[890,0,106,168],[725,344,27,34]]}
];


// symbols:



(lib.body = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(0);
}).prototype = p = new cjs.Sprite();



(lib.dia1 = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(1);
}).prototype = p = new cjs.Sprite();



(lib.dia2 = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(2);
}).prototype = p = new cjs.Sprite();



(lib.dia3 = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(3);
}).prototype = p = new cjs.Sprite();



(lib.dia_bg = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(4);
}).prototype = p = new cjs.Sprite();



(lib.doll_head = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(5);
}).prototype = p = new cjs.Sprite();



(lib.hand = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(6);
}).prototype = p = new cjs.Sprite();



(lib.head = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(7);
}).prototype = p = new cjs.Sprite();



(lib.leg = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(8);
}).prototype = p = new cjs.Sprite();



(lib.n_top = function() {
	this.initialize(ss["main_animate_atlas_"]);
	this.gotoAndStop(9);
}).prototype = p = new cjs.Sprite();
// helper functions:

function mc_symbol_clone() {
	var clone = this._cloneProps(new this.constructor(this.mode, this.startPosition, this.loop));
	clone.gotoAndStop(this.currentFrame);
	clone.paused = this.paused;
	clone.framerate = this.framerate;
	return clone;
}

function getMCSymbolPrototype(symbol, nominalBounds, frameBounds) {
	var prototype = cjs.extend(symbol, cjs.MovieClip);
	prototype.clone = mc_symbol_clone;
	prototype.nominalBounds = nominalBounds;
	prototype.frameBounds = frameBounds;
	return prototype;
	}


(lib.n_top_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.n_top();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.n_top_1, new cjs.Rectangle(0,0,27,34), null);


(lib.leg_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.leg();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.leg_1, new cjs.Rectangle(0,0,106,168), null);


(lib.head_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.head();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.head_1, new cjs.Rectangle(0,0,256,338), null);


(lib.hand_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.hand();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.hand_1, new cjs.Rectangle(0,0,139,90), null);


(lib.doll_head_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.doll_head();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.doll_head_1, new cjs.Rectangle(0,0,103,96), null);


(lib.dia33 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.dia3();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.dia33, new cjs.Rectangle(0,0,145,160), null);


(lib.dia22 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.dia2();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.dia22, new cjs.Rectangle(0,0,164,180), null);


(lib.dia11 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.dia1();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.dia11, new cjs.Rectangle(0,0,152,152), null);


(lib.dia_bg_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.dia_bg();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.dia_bg_1, new cjs.Rectangle(0,0,464,509), null);


(lib.dia3_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.dia33();
	this.instance.parent = this;
	this.instance.setTransform(72.5,80,1,1,0,0,0,72.5,80);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({y:78},25,cjs.Ease.get(1)).to({y:80},24,cjs.Ease.get(1)).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,-2,145,162);


(lib.dia2_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.dia22();
	this.instance.parent = this;
	this.instance.setTransform(82,90,1,1,0,0,0,82,90);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({y:86},24,cjs.Ease.get(1)).to({y:90},25,cjs.Ease.get(1)).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,-4,164,184);


(lib.dia1_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.dia11();
	this.instance.parent = this;
	this.instance.setTransform(75,72.55,1,1,0,0,0,76,76);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({y:74.55},24,cjs.Ease.get(1)).to({y:72.55},25,cjs.Ease.get(1)).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-1,-3.4,152,154);


(lib.body_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_2
	this.instance = new lib.doll_head_1();
	this.instance.parent = this;
	this.instance.setTransform(103.8,58.6,1,1,3.2759,0,0,23.2,88.6);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(6).to({regX:23.3,regY:88.5,rotation:-2.9372,x:103.9,y:58.55},6,cjs.Ease.get(1)).to({regX:23.2,regY:88.6,rotation:3.2759,x:103.8,y:58.6},6,cjs.Ease.get(1)).wait(7));

	// 圖層_1
	this.instance_1 = new lib.body();
	this.instance_1.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(25));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,-33.9,188.6,167.9);


// stage content:
(lib.main_animate = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// dia3
	this.instance = new lib.dia3_1();
	this.instance.parent = this;
	this.instance.setTransform(100.5,374.5,1,1,0,0,0,72.5,80);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(25));

	// dia2
	this.instance_1 = new lib.dia2_1();
	this.instance_1.parent = this;
	this.instance_1.setTransform(532,265.5,1,1,0,0,0,82,90);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(25));

	// dia1
	this.instance_2 = new lib.dia1_1();
	this.instance_2.parent = this;
	this.instance_2.setTransform(35,131.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(25));

	// head
	this.instance_3 = new lib.head_1();
	this.instance_3.parent = this;
	this.instance_3.setTransform(350.5,346.3,1,1,0,0,0,188.5,327.8);

	this.timeline.addTween(cjs.Tween.get(this.instance_3).to({regX:188.6,rotation:-4.6545,x:343.55},12,cjs.Ease.cubicInOut).to({regX:188.5,rotation:0,x:350.5},12,cjs.Ease.cubicInOut).wait(1));

	// n_top
	this.instance_4 = new lib.n_top_1();
	this.instance_4.parent = this;
	this.instance_4.setTransform(331.7,357.95,1,1,0,0,0,13.5,17);

	this.timeline.addTween(cjs.Tween.get(this.instance_4).to({rotation:-7.7195,x:320.05,y:362},12,cjs.Ease.cubicInOut).to({rotation:0,x:331.7,y:357.95},12,cjs.Ease.cubicInOut).wait(1));

	// hand
	this.instance_5 = new lib.hand_1();
	this.instance_5.parent = this;
	this.instance_5.setTransform(323,366.5,1,1,0,0,0,139,45);

	this.timeline.addTween(cjs.Tween.get(this.instance_5).to({regY:45.1,rotation:9.7772,x:323.05,y:366.6},12,cjs.Ease.cubicInOut).to({regY:45,rotation:0,x:323,y:366.5},12,cjs.Ease.cubicInOut).wait(1));

	// body
	this.instance_6 = new lib.body_1();
	this.instance_6.parent = this;
	this.instance_6.setTransform(353.5,447.5,1,1,0,0,0,51.5,113);

	this.timeline.addTween(cjs.Tween.get(this.instance_6).to({regX:51.6,rotation:-7.4814,x:353.6},12,cjs.Ease.cubicInOut).to({regX:51.5,rotation:0,x:353.5},12,cjs.Ease.cubicInOut).wait(1));

	// mask_leg (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	var mask_graphics_0 = new cjs.Graphics().p("EgKdAr8QgTgwAvgKQHriJFLjTQtghopHqOQpMqTAAtzQAAvBKmqmQKmqnPBAAQPBAAKoKnQKmKmAAPBQAAIXjoHcQjhHOmPFFIgVAVQmlGfr0EJQrED5qBACIgHABQgYAAgRgtg");
	var mask_graphics_24 = new cjs.Graphics().p("EgKdAr8QgTgwAvgKQHriJFLjTQtghopHqOQpMqTAAtzQAAvBKmqmQKmqnPBAAQPBAAKoKnQKmKmAAPBQAAIXjoHcQjhHOmPFFIgVAVQmlGfr0EJQrED5qBACIgHABQgYAAgRgtg");

	this.timeline.addTween(cjs.Tween.get(mask).to({graphics:mask_graphics_0,x:278.2051,y:285.6588}).wait(24).to({graphics:mask_graphics_24,x:278.2051,y:285.6588}).wait(1));

	// leg
	this.instance_7 = new lib.leg_1();
	this.instance_7.parent = this;
	this.instance_7.setTransform(362.1,609.55,1,1.0292,0.4553,0,0,53.1,168.1);

	var maskedShapeInstanceList = [this.instance_7];

	for(var shapedInstanceItr = 0; shapedInstanceItr < maskedShapeInstanceList.length; shapedInstanceItr++) {
		maskedShapeInstanceList[shapedInstanceItr].mask = mask;
	}

	this.timeline.addTween(cjs.Tween.get(this.instance_7).to({regX:53.2,rotation:-1.271,x:362.2},12,cjs.Ease.cubicInOut).to({regX:53.1,rotation:0.4553,x:362.1},12,cjs.Ease.cubicInOut).wait(1));

	// dia_bg
	this.instance_8 = new lib.dia_bg_1();
	this.instance_8.parent = this;
	this.instance_8.setTransform(324,319,1,1,0,0,0,232,254.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_8).wait(25));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(320,300,320,836);
// library properties:
lib.properties = {
	id: 'E4BD0AC60F17F04C8FDC92EF1F8C6BED',
	width: 640,
	height: 600,
	fps: 24,
	color: "#FFFFFF",
	opacity: 1.00,
	manifest: [
		{src:"images/main_animate_atlas_.png?1574666554823", id:"main_animate_atlas_"}
	],
	preloads: []
};



// bootstrap callback support:

(lib.Stage = function(canvas) {
	createjs.Stage.call(this, canvas);
}).prototype = p = new createjs.Stage();

p.setAutoPlay = function(autoPlay) {
	this.tickEnabled = autoPlay;
}
p.play = function() { this.tickEnabled = true; this.getChildAt(0).gotoAndPlay(this.getTimelinePosition()) }
p.stop = function(ms) { if(ms) this.seek(ms); this.tickEnabled = false; }
p.seek = function(ms) { this.tickEnabled = true; this.getChildAt(0).gotoAndStop(lib.properties.fps * ms / 1000); }
p.getDuration = function() { return this.getChildAt(0).totalFrames / lib.properties.fps * 1000; }

p.getTimelinePosition = function() { return this.getChildAt(0).currentFrame / lib.properties.fps * 1000; }

an.bootcompsLoaded = an.bootcompsLoaded || [];
if(!an.bootstrapListeners) {
	an.bootstrapListeners=[];
}

an.bootstrapCallback=function(fnCallback) {
	an.bootstrapListeners.push(fnCallback);
	if(an.bootcompsLoaded.length > 0) {
		for(var i=0; i<an.bootcompsLoaded.length; ++i) {
			fnCallback(an.bootcompsLoaded[i]);
		}
	}
};

an.compositions = an.compositions || {};
an.compositions['E4BD0AC60F17F04C8FDC92EF1F8C6BED'] = {
	getStage: function() { return exportRoot.getStage(); },
	getLibrary: function() { return lib; },
	getSpriteSheet: function() { return ss; },
	getImages: function() { return img; }
};

an.compositionLoaded = function(id) {
	an.bootcompsLoaded.push(id);
	for(var j=0; j<an.bootstrapListeners.length; j++) {
		an.bootstrapListeners[j](id);
	}
}

an.getComposition = function(id) {
	return an.compositions[id];
}


an.makeResponsive = function(isResp, respDim, isScale, scaleType, domContainers) {		
	var lastW, lastH, lastS=1;		
	window.addEventListener('resize', resizeCanvas);		
	resizeCanvas();		
	function resizeCanvas() {			
		var w = lib.properties.width, h = lib.properties.height;			
		var iw = window.innerWidth, ih=window.innerHeight;			
		var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;			
		if(isResp) {                
			if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
				sRatio = lastS;                
			}				
			else if(!isScale) {					
				if(iw<w || ih<h)						
					sRatio = Math.min(xRatio, yRatio);				
			}				
			else if(scaleType==1) {					
				sRatio = Math.min(xRatio, yRatio);				
			}				
			else if(scaleType==2) {					
				sRatio = Math.max(xRatio, yRatio);				
			}			
		}			
		domContainers[0].width = w * pRatio * sRatio;			
		domContainers[0].height = h * pRatio * sRatio;			
		domContainers.forEach(function(container) {				
			container.style.width = w * sRatio + 'px';				
			container.style.height = h * sRatio + 'px';			
		});			
		stage.scaleX = pRatio*sRatio;			
		stage.scaleY = pRatio*sRatio;			
		lastW = iw; lastH = ih; lastS = sRatio;            
		stage.tickOnUpdate = false;            
		stage.update();            
		stage.tickOnUpdate = true;		
	}
}


})(createjs = createjs||{}, main_animate = main_animate||{});
var createjs, main_animate;