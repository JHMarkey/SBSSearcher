// Initialize variables
var currentLevel = 1;
var maxLevel = 20;
var progress = 0;
var rewards = [
	'Reward A',
	'Reward B',
	'Reward C',
	// and so on for all 20 levels
];

updateProgress();
updateRewards();

// Update progress bar function
function updateProgress() {
	var progressPercent = (progress / 100) * 100;
	document.querySelector('.progress-bar').style.width = progressPercent + '%';
}

// Update rewards function
function updateRewards() {
	var rewardList = document.querySelector('.level-rewards ul');
	rewardList.innerHTML = '';
	for (var i = 0; i < currentLevel; i++) {
		var rewardItem = document.createElement('li');
		rewardItem.textContent = 'Level ' + (i + 1) + ': ' + rewards[i];
		rewardList.appendChild(rewardItem);
	}
}

// Next level button event listener
document.querySelector('.next-level').addEventListener('click', function() {

    console.log("Btton Press");

	if (currentLevel < max){
        //Increase Progress
        progress+=5;

        if(progress == 100){
            progress = 0;
            currentLevel ++
            if(currentLevel == maxLevel){
                alert("Congratulations! You are now max level");
            }
        }

    }

    //Update UI
    updateProgress();
	updateRewards();
});


