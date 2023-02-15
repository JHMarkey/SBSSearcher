<?php
require("../View/_inc/head.php");
require("../View/_inc/header.php");
require("../Controller/DBConnect.php");
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="inner-container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Wade </h1>
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