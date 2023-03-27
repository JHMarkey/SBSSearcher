function unbox() {
	var itemCycleDiv = document.getElementById("item-cycle");
	var finalItemDiv = document.getElementById("final-item");
	
	// array of possible items
	var items = ["Bunny", "Cat", "Clown1", "Clown", "Cowboy","Cupcake", "Dead", "Devil", "Dracula", "Robot", "Softdrink"];
	
	// number of times to cycle through possible items
	var cycles = 20;
	
	// time (in milliseconds) between each cycle
	var cycleTime = 100;
	
	// time (in milliseconds) to display the final item
	var finalTime = 1000;
	
	var randomItem = null;
	// loop through possible items multiple times before settling on the final item
	for (var i = 0; i < cycles; i++) {
		setTimeout(function() {
			randomItem = items[Math.floor(Math.random() * items.length)];
			itemCycleDiv.innerHTML = randomItem;
		}, i * cycleTime);
	}
	
	// display the final item after all cycles are complete
	setTimeout(function() {
		finalItemDiv.innerHTML = randomItem;
		itemCycleDiv.style.display = "none";
		finalItemDiv.style.display = "block";
		
		saveItemToDatabase(randomItem);
	}, cycles * cycleTime + finalTime);
}

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
