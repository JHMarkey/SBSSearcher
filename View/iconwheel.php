<?php
require("../View/_inc/avatarhead.php");
require("../View/_inc/sidebar.php");
?>

<div class="unboxing-container">
		<h1>Get Your New Icon</h1>
		<button onclick="unbox()">Unbox</button>
		<div id="unboxing-area">
	        <p>Click the button to unbox an icon</p>
	        <div id="item-cycle" ></div>
	        <div id="final-item" ></div>
        </div>
		<div id="user-history">
			<h2>Your Unboxing History</h2>
			<?php
				// PHP code to retrieve and display user's unboxing history
			?>
		</div>
	</div>