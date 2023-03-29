function unbox() {
	var itemCycleDiv = document.getElementById("item-cycle");
	var finalItemDiv = document.getElementById("final-item");

	// array of possible items
	var items = ["bunny.png", "cat.png", "clown1.png", "clown.png", "cowboy.png","cupcake.png", "dead.png", "devil.png", "dracula.png", "robot.png", "soft-drink.png"];
	
	// number of times to cycle through possible items
	var cycles = 25;
	
	// initial time (in milliseconds) between each cycle
	var initialCycleTime = 70;
	
	// time (in milliseconds) to display the final item
	var finalTime = 1000;
	
	var randomItem = null;
	// loop through possible items multiple times before settling on the final item
	for (var i = 0; i < cycles; i++) {
		// calculate the cycle time based on the current iteration number and the total number of iterations
		var cycleTime = initialCycleTime * Math.pow(1.05, i);
		setTimeout(function() {
			randomItem = items[Math.floor(Math.random() * items.length)];
			itemCycleDiv.innerHTML = "<img src='../Assets/Icons/" + randomItem + "' class = 'selectedIcon'/>";
		}, i * cycleTime);
	}
	
	// display the final item after all cycles are complete
	setTimeout(function() {
		randomItem = items[Math.floor(Math.random() * items.length)];
		itemCycleDiv.innerHTML = "<img src='../Assets/Icons/" + randomItem + "' class = 'selectedIcon'/>";
		saveItemToDatabase(randomItem);
	}, cycles * initialCycleTime);

	function saveItemToDatabase(item) {
		// create a JSON object containing the item to be saved
		var itemData = { item: item };
		// Create a new XMLHttpRequest object
		var xhr = new XMLHttpRequest();

		// Open a new POST request to the save-item.php file
		xhr.open("POST", "../Controller/save-item.php");

		// Set the content type header to JSON
		xhr.setRequestHeader("Content-Type", "application/json");

		// Send the JSON object as the request body
		xhr.send(JSON.stringify(itemData));

		// Handle the response
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				console.log(xhr.responseText);
			}
		};
	}
}