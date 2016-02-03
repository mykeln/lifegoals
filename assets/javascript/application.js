    var ratio = window.devicePixelRatio || 1;
    // FIXME: not quite getting the correct size to fit as a background
    var w = screen.width * ratio;
    var h = screen.height * ratio;

    // shrinking the size of the image for display, but still able to press and hold
    var trunc_w = w / 4;
    var trunc_h = h / 4;

    window.onload = function () {
      document.getElementById("img_height").value = h;
      document.getElementById("img_width").value = w;
    }