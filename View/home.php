<?php
require("../View/_inc/head.php");
require("../View/_inc/loggedHeader.php");

if(null != $_GET["FN"] && null != $_GET["SN"] && null != $_GET["E"]){

    $_SESSION["FN"] = $_GET["FN"];
    $_SESSION["SN"] = $_GET["SN"];
    $_SESSION["E"] = $_GET["E"];
} else{
    ?> <script> alert("Error Authenticating Credentials.\nReturning to Login.");</script><?php
    header("location:SkillsBuildSearcher/View/index.php ");
}

drawHeader();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>
    <div class="container">
        <div class="inner-container">
            <div class="row">
                <div class="col-md-12">
                    <h1>The Wade Bot</h1>
                    <div id="chat-box"></div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Type your message...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="send-btn">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script type = "text/javascript" src="../View/scripts/WatsonAssistantCreation.js"></script>

<script>
    $(document).ready(function() {
        var chatBox = $('#chat-box');

        $('#send-btn').on('click', function() {
            var message = $('.form-control').val();
            chatBox.append('<p>You: ' + message + '</p>');
            $('.form-control').val('');

            
        });
    });
</script>