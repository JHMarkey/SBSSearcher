<!DOCTYPE html>
<html>
<head>
	<title>Chatbot Button Example</title>
	<style>
	#WatsonAssistantChat {
	  display: block !important;
	  height: 400px;
	  width: 400px;
	  border: 1px solid black;
	  overflow: auto;
	}
	</style>
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


    	instance.on({ type: "receive", handler: function(response) {
        var chatbox = document.getElementById("WatsonAssistantChat");
        var newMessage = document.createElement("div");
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

	// Send "Recommend me a course" to the chatbot when the button is clicked
	function sendMessage() {
	    var send_obj = { 
	        "input": { 
	            "message_type" : "text", 
	            "text" : "Recommend me a course"
	        }
	    };
	    wa_instance.send(send_obj, {}).catch(function(error) {
	      console.error("Sending message to chatbot failed");
	    });
	}

	</script>
</head>
<body>
<h1>Chatbot Button Example</h1>
	<p>Click the button below to send a message to the chatbot:</p>
	<button onclick="sendMessage()">Send Message</button>
	<div id="WatsonAssistantChat"></div>
</body>
</html>
