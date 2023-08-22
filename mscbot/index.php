<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bot</title>

    <link rel="stylesheet" href="static/css/chat.css">
    <link rel="stylesheet" href="static/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <!-- CHAT BAR BLOCK -->
    <div class="chat-bar-collapsible">
    <button style="font-family: 'Ubuntu', sans-serif; color: white; border: none; cursor: pointer;" id="chat-button" type="button" class="collapsible">
    <center>
        <div style="display: inline-block; margin-right: 5px;">
            <i style="font-size: 50px; position: relative;top: 5px; right: 10px;" id="chat-icon" class="fa fa-fw fa-comments-o" style="color: white; font-size: 20px;"></i>
        </div>
        <div style="display: inline-block; text-align: left;">
            <div style="font-size: 24px;"><b>Support Chatbot</b></div>
            <div style="font-size: 12px;">Online</div>
        </div>
    </center>
</button>



        <div class="content">
            <div class="full-chat-block">
                <!-- Message Container -->
                <div class="outer-container">
                    <div class="chat-container">
                        <!-- Messages -->
                        <div id="chatbox">
                            <h5 id="chat-timestamp"></h5>
                            <p id="botStarterMessage" class="botText"><span>Loading...</span></p>
                        </div>

                        <!-- User input box -->
                        <div class="chat-bar-input-block">
                            <div id="userInput">
                                <input id="textInput" class="input-box" type="text" name="msg"
                                    placeholder="Type 'Services' to know more...">
                                <p></p>
                            </div>

                            <div class="chat-bar-icons">
                                <i id="chat-icon" style="color: #333;" class="fa fa-fw fa-send"
                                    onclick="sendButton()"></i>
                            </div>
                        </div>

                        <div id="chat-bar-bottom">
                            <p></p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="static/scripts/rest.js"></script>
<script src="static/scripts/chat.js"></script>

</html>