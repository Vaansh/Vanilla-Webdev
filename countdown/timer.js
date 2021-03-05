window.onload = function () {
  let min = 1; //1 for instance
  let sec = 35; //35 for instance
  let fiveMinutes = min * sec,
    display = document.querySelector("#timer");
  timer(fiveMinutes, display, 1);
};

function timer(duration, element, extend) {
  let time = duration;
  let min, sec;
  let customTimer = setInterval(function () {
    min = Math.floor(time / 60);
    if (min < 10) {
      min = "0" + min;
    }
    sec = Math.floor(time % 60);
    if (sec < 10) {
      sec = "0" + sec;
    }

    element.innerHTML = `${min}:${sec}`;

    if (min === "00" && sec === 30) {
      element.innerHTML = `${min}:${sec + 1}`;
      if (
        confirm(
          "Only 30 seconds left on the timer do you want to extend the timer?"
        )
      ) {
        if (extend === 3) {
          alert("You have exceeded MAX number of reset attempts.");
        } else {
          clearInterval(customTimer);
          timer(duration, element, ++extend);
        }
      } else {
        element.innerHTML = "EXPIRED";
        clearInterval(customTimer);
      }
    }

    if (--time < 0) {
      element.innerHTML = "EXPIRED";
      clearInterval(customTimer);
    }
  }, 1000);
}
