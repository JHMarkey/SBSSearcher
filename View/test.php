<?php
require("../View/_inc/head.php");
require("../View/_inc/sidebar.php");
session_start();

?>

<head>
    <style>
        body {
            background-color: #f2f2f2; /* Set the background color to grey */
        }
        #chat-container {
            height: 100vh; /* Set the height of the container to the full height of the viewport */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #chat-window {
            height: 1000px;
            width: 2500px;
            text-align: center;
        }
        #chat-messages {
            max-height: 500px;
            overflow-y: auto;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        #chat-input {
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            border: none;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>

<title>Chatbot Input Example</title>
<script src="https://github.com/watson-developer-cloud/assistant-web-chat"></script>

<script>
    var wa_instance;
    window.watsonAssistantChatOptions = {
        integrationID: "f1ffc42f-5126-4917-90b1-875d66d8af1a", // The ID of this integration.
        region: "eu-gb", // The region your integration is hosted in.
        serviceInstanceID: "e6aa3b1c-7516-4dbb-bff0-4359e072de17", // The ID of your service instance.
        onLoad: function(instance) {

        sessionStorage.clear();

wa_instance = instance;

instance.render();

// Send a message to reset conversation context
instance.send({
    input: {
        message_type: 'text',
        text: '',
        options: {
            reset_context: true
        }
    }
});

instance.on({
    type: "receive",
    handler: function(response) {
        var chatbox = document.getElementById("chat-messages");
        console.log(response.data.output.generic)
        
        // loop through the generic array and create a new message for each element
        response.data.output.generic.forEach(function(element) {
            var newMessage = document.createElement("div");
            
            // check if element is a string before setting innerHTML
            if (typeof element.text === 'string') {
                newMessage.innerHTML = element.text;
            } else if (typeof element.description === 'string') {
                newMessage.innerHTML = element.description;
            } else if (typeof element.title === 'string') {
                newMessage.innerHTML = element.title;
            } else {
                // if element is not a string, do nothing
                return;
            }
            
            chatbox.appendChild(newMessage);
        });

    }
});



}


    };
    setTimeout(function() {
        const t = document.createElement('script');
        t.src = "https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
        document.head.appendChild(t);
    });

    // Send the message when the "Enter" key is pressed
    function sendMessage(event) {
        if (event.keyCode === 13) { // 13 is the code for the "Enter" key
            var input = event.target;
            var send_obj = {
                "input": {
                    "message_type": "text",
                    "text": input.value
                }
            };
            input.value = ''; // Clear the input field
            wa_instance.send(send_obj, {}).catch(function(error) {
                console.error("Sending message to chatbot failed");
            });
        }
    }
</script>



    <div class="row justify-content-center">
        <div class="col-md-6" id="chat-window">
            <div id="chat-messages">
      <p>Type your message below and press Enter to send:</p>
      <input type="text" onkeydown="sendMessage(event)">
    </div>
    </div>
  </div>






<?php
require("../View/_inc/Footer.php");
?>