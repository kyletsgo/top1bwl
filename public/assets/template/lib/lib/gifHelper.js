/**
 *
 * @authors Eric Hsiao
 *
 */

var gifHelper = function () {

  //private menbers
  var gif;

  var imgList = [];
  var oImgSrc = '';

  var imgObjList = [], count = 0;

  var oImg = document.getElementById("img");
  var canvas;
  var ctx;
  var canvasWidth = 542;
  var canvasHeight = 542;


  var callback;

  //private methods
  function init() {
    console.log('templete is loaded.');

    canvas = document.createElement('canvas');
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;

    ctx = canvas.getContext('2d');

    gif = new GIF({
      workers: 4,
      quality: 5,
      workerScript: "dist/lib/gif/gif.worker.js",
      // transparent: "#fff",
      // background: '#ffffff',
    });

    gif.on("finished", function (blob) {
      console.log(URL.createObjectURL(blob));
      var file = new FileReader();
      file.readAsDataURL(blob);
      file.onload = function () {
        // document.getElementById("result").setAttribute("src", file.result)
        callback(file.result);
      }
    });
  }

  function generateGif(imgObjList) {
    for (let i = 0; i < imgObjList.length; i++) {
      ctx.save();
      ctx.drawImage(oImg, 0, 0, canvas.width, canvas.height);
      ctx.drawImage(imgObjList[i], 0, 0, canvas.width, canvas.height);
      ctx.restore();
      gif.addFrame(canvas, { copy: true, delay: 60 / 1000 })
      ctx.clearRect(0, 0, canvas.width, canvas.height)
    }
    gif.render();
  }

  function createGIF() {

    for (let i = 0; i < imgList.length; i++) {
      var tmpImg = new Image();
      imgObjList.push(tmpImg);
      tmpImg.src = imgList[i];
      tmpImg.onload = function () {
        count++;
        if (count === imgList.length) {
          generateGif(imgObjList);
        }
      }
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
    createGIF: function (_imgList, _oImgSrc, _callback) {
      console.log('start createGIF');
      imgList = _imgList;
      oImgSrc = _oImgSrc;
      callback = _callback;
      var _img = new Image();
      _img.src = oImgSrc;
      _img.addEventListener("load", function () {
        oImg = _img;
        createGIF();
      }, false);
    }
  };
};

var _gifHelper = new gifHelper();