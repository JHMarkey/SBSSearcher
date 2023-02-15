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

<!-- <script type = "text/javascript" src="../View/scripts/WatsonAssistantCreation.js"></script> -->

<script>
    // $(document).ready(function() {
    //     var chatBox = $('#chat-box');

    //     $('#send-btn').on('click', function() {
    //         var message = $('.form-control').val();
    //         chatBox.append('<p>You: ' + message + '</p>');
    //         $('.form-control').val('');

            
    //     });
    // });
    $(document).ready(function() {
  var chatBox = $('#chat-box');

  // Set up the Watson Assistant API credentials
  const assistant = new window.WatsonAssistantV2({
    version: '2021-09-01',
    authenticator: new window.IamAuthenticator({
      apikey: 'HksYF-bPhnnA1cH1qoTPkSci98Evyq23jRzh_4vuqlQZ'
    }),
    url: 'https://api.eu-gb.assistant.watson.cloud.ibm.com/instances/e6aa3b1c-7516-4dbb-bff0-4359e072de17'
  });

  // Handle user input and send it to the Watson Assistant API
  function sendMessageToWatson(inputText) {
    assistant.message({
      input: {
        text: inputText
      },
      assistantId: '429128df-ff1b-488e-851c-b858092bb5b8'
    })
    .then(response => {
      // Display the response in the chat box
      const message = response.result.output.generic[0].text;
      chatBox.append('<p>Watson: ' + message + '</p>');
    })
    .catch(error => {
      console.error(error);
    });
  }

  // Add an event listener to the send button to handle user input
  $('#send-btn').on('click', function() {
    var message = $('.form-control').val();
    chatBox.append('<p>You: ' + message + '</p>');
    sendMessageToWatson(message);
    $('.form-control').val('');
  });
});

</script>

<?php
require("../View/_inc/Footer.php");
?>