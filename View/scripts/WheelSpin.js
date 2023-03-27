function unbox() {
	var itemCycleDiv = document.getElementById("item-cycle");
	var finalItemDiv = document.getElementById("final-item");
	
	// array of possible items
	var items = ["bunny", "cat", "clown(1)", "clown", "cowboy","cupcake", "dead", "devil", "dracula", "robot", "softdrink"];
	
	// number of times to cycle through possible items
	var cycles = 50;
	
	// time (in milliseconds) between each cycle
	var cycleTime = 100;
	
	// time (in milliseconds) to display the final item
	var finalTime = 20000;
	
	// loop through possible items multiple times before settling on the final item
	for (var i = 0; i < cycles; i++) {
		setTimeout(function() {
			var randomItem = items[Math.floor(Math.random() * items.length)];
			itemCycleDiv.innerHTML = randomItem;
		}, i * cycleTime);
	}
	
	// display the final item after all cycles are complete
	setTimeout(function() {
		finalItemDiv.innerHTML = randomItem;
		itemCycleDiv.style.display = "none";
		finalItemDiv.style.display = "block";
		
		// JavaScript code to save the final item to the database using PHP and AJAX
	}, cycles * cycleTime + finalTime);
}
