<?php
require("../View/_inc/head.php");
require("../View/_inc/loggedHeader.php");
session_start();
drawHeader();
?>


    <title>Chatbot Input Example</title>
    <script src="https://github.com/watson-developer-cloud/assistant-web-chat"></script>

    <script>
    var wa_instance;
    window.watsonAssistantChatOptions = {
      integrationID: "f1ffc42f-5126-4917-90b1-875d66d8af1a", // The ID of this integration.
      region: "eu-gb", // The region your integration is hosted in.
      serviceInstanceID: "e6aa3b1c-7516-4dbb-bff0-4359e072de17", // The ID of your service instance.
      onLoad: function(instance) 
      { 
      
        wa_instance = instance;

        instance.render();
        
        instance.on({ type: "receive", handler: function(response) {
        var chatbox = document.getElementById("WatsonAssistantChat");
        var newMessage = document.createElement("div");
        console.log(response.data.output.generic[0].description);
        newMessage.innerHTML = response.data.output.generic[0].text;
        
        chatbox.appendChild(newMessage);

        }});
      }

    };
    setTimeout(function(){
      const t=document.createElement('script');
      t.src="https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
      document.head.appendChild(t);
    });

    // Send the message when the "Enter" key is pressed
    function sendMessage(event) {
        if (event.keyCode === 13) { // 13 is the code for the "Enter" key
            var input = event.target;
            var send_obj = { 
                "input": { 
                    "message_type" : "text", 
                    "text" : input.value
                }
            };
            input.value = ''; // Clear the input field
            wa_instance.send(send_obj, {}).catch(function(error) {
              console.error("Sending message to chatbot failed");
            });
        }
    }

    </script>

<div class="container bg-grey">
  <div class="row justify-content-center">
    <div class="col-md-6 bg-white text-center">
      <div id="WatsonAssistantChat"></div>
      <p>Type your message below and press Enter to send:</p>
      <input type="text" onkeydown="sendMessage(event)">
    </div>
  </div>
</div>





<?php
require("../View/_inc/Footer.php");
?>