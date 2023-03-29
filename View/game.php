<?php
require("../View/_inc/head.php");
require("../View/_inc/sidebar.php");
?>
<body>
<div id="counter" style="font-size:75px">0</div>
    <div id="game-container" style="padding-left:25%;">
        
            <div>
                <img id="game-image-left" src="../Assets/Icons/cupcake.png" alt="Game Image" style="height: 40%; width: 40%;">
            </div>
            <div>
                <div id="gameprogress-bar">
                    <div id="gameprogress-bar-fill" style="width: 0%;"></div>
                </div>
        
                <img id="game-image" src="../Assets/Icons/monster.png" alt="Game Image" style="height: 40%; width: 40%;">
            </div>
    </div>
    <script src="../View/scripts/game.js"></script>
</body>
</html>
