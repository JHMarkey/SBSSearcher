
let level = 1;
let progress = 0;
const progressBarFill = document.querySelector(".progress-bar__fill");
const progressBarText = document.querySelector(".progress-bar__text");
const nextLevelText = document.querySelector(".progress-bar__next-level");

function updateProgressBar() {
  progress += 5;
  if (progress >= 100) {
    level++;
    progress = 0;
    progressBarText.innerText = `Level ${level} - 0%`;
    nextLevelText.innerText = `Level ${level+1} - 5%`;
  } else {
    progressBarText.innerText = `Level ${level} - ${progress}%`;
    nextLevelText.innerText = `Level ${level+1} - ${progress+5}%`;
  }
  progressBarFill.style.width = `${progress}%`;
}