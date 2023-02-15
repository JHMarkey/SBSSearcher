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
</body>
<script>
    $(document).ready(function() {
        var chatBox = $('#chat-box');

        $('#send-btn').on('click', function() {
            var message = $('.form-control').val();
            chatBox.append('<p>You: ' + message + '</p>');
            $('.form-control').val('');

            window.watsonAssistantChatOptions = {
            integrationID: "f1ffc42f-5126-4917-90b1-875d66d8af1a", // The ID of this integration.
            region: "eu-gb", // The region your integration is hosted in.
            serviceInstanceID: "e6aa3b1c-7516-4dbb-bff0-4359e072de17", // The ID of your service instance.
            onLoad: function(instance) { instance.render(); }
        };
        setTimeout(function(){
            const t=document.createElement('script');
            t.src="https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
            document.head.appendChild(t);
        });
        });
    });
</script>
<?php
require("../View/_inc/Footer.php");
?>