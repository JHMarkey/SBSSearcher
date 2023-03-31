let progressBar = document.getElementById("gameprogress-bar-fill");
let gameImage = document.getElementById("game-image");
let counter = document.getElementById("counter");
let increaseAmount = 25; // Change this value to set the amount by which the progress bar should increase.
let progress = 0;

let intervalId = setInterval(function() {
    progress += increaseAmount;
    if (progress >= 100) {
        progress = 0;
        counter.innerHTML = parseInt(counter.innerHTML) + 1;
    }
    progressBar.style.width = progress + "%";
}, 1000);