/**
 *
 * @authors Eric Hsiao
 *
 */

createAnimate = function () {

  //private menbers
  var exportRoot;

  //private methods
  function init() {
    console.log('main is loaded.');
  }

  function load($container, _namespace, _callback) {
    loadAnimate($container, _namespace, 
      function (_exportRoot) {
        exportRoot = _exportRoot;

        if (_callback != null) {
          _callback(exportRoot);
        }
    });
  }


  function loadAnimate($container ,_namespace,  _callback) {
    var $canvas, stage, _exportRoot, anim_container, dom_overlay_container, fnStartAnimation;

    console.log(this[_namespace]);

    var key = Object.keys(this[_namespace].compositions)[0];
    var comp = this[_namespace].getComposition(key);
    var lib = comp.getLibrary();

    $canvas = $('<canvas></canvas>').attr({
      width: lib.properties.width,
      height: lib.properties.height
    }).appendTo($container);

    var loader = new createjs.LoadQueue(false);
    loader.addEventListener("fileload", function (evt) { handleFileLoad(evt, comp) });
    loader.addEventListener("complete", function (evt) { handleComplete(evt, comp) });
    loader.loadManifest(lib.properties.manifest);

    function handleFileLoad(evt, comp) {
      var images = comp.getImages();
      if (evt && (evt.item.type == "image")) { images[evt.item.id] = evt.result; }
    }
    function handleComplete(evt, comp) {
      var lib = comp.getLibrary();
      var ss = comp.getSpriteSheet();
      var queue = evt.target;
      var ssMetadata = lib.ssMetadata;
      for (i = 0; i < ssMetadata.length; i++) {
        ss[ssMetadata[i].name] = new createjs.SpriteSheet({ "images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames })
      }
      _exportRoot = new lib[_namespace]();
      stage = new lib.Stage($canvas[0]);
      fnStartAnimation = function () {
        stage.addChild(_exportRoot);
        createjs.Ticker.setFPS(lib.properties.fps);
        createjs.Ticker.addEventListener("tick", stage);
        _exportRoot.stop();
        if (_callback != null) {
          _callback(_exportRoot);
        }
      }

      this[_namespace].compositionLoaded(lib.properties.id);
      fnStartAnimation();
    }
  }

  //constructor

  {
    $(document).ready(function () {
      init();
    });
  }

  //public

  return {
    load: function ($container, _namespace,  _callback) {
      load( $container, _namespace, _callback);
    }
  }
}