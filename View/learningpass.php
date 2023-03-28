<?php 
require ("../View/_inc/head.php");
require("../View/_inc/header.php");
?>
<script src = "../View/scripts/LearningPass.js"></script>

	<div class="battle-pass">
		<div class="level-progress">
			<h3>Level Progress</h3>
			<div id="progress-bar">
                <div id="progress-bar-fill"></div>
            </div>
		</div>
		<div class="level-rewards">
			<h3>Level Rewards</h3>
			<ul>
				<li>Level 1: Reward A</li>
				<li>Level 2: Reward B</li>
				<li>Level 3: Reward C</li>
			</ul>
		</div>
		<button class="next-level">Next Level</button>
	</div>