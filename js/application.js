// Wait till the browser is ready to render the game (avoids glitches)
window.requestAnimationFrame(function () {
  new GameManager(4, KeyboardInputManager, HTMLActuator, LocalScoreManager);
});


    var imageList = [
        "http://oispavapee.tk/img/2.png",
        "http://oispavapee.tk/img/4.png",
        "http://oispavapee.tk/img/8.png",
        "http://oispavapee.tk/img/16.png",
        "http://oispavapee.tk/img/32.png",
        "http://oispavapee.tk/img/64.png",
        "http://oispavapee.tk/img/128.png",
        "http://oispavapee.tk/img/256.png",
        "http://oispavapee.tk/img/512.png",
        "http://oispavapee.tk/img/1024.png",
        "http://oispavapee.tk/img/2048.png",
	"http://oispavapee.tk/img/katko.png"

    ];
    for(var i = 0; i < imageList.length; i++ ) 
    {
        var imageObject = new Image();
        imageObject.src = imageList[i];
    }
