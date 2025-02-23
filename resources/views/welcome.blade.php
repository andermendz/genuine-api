<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Genuine Chat Messenger</title>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <style>
      df-messenger {
        --df-messenger-bot-message: #f0f0f0;
        --df-messenger-user-message: #d1e7dd;
        --df-messenger-button-titlebar-color: #007bff;
        --df-messenger-button-titlebar-text-color: white;
        --df-messenger-chat-background-color: #ffffff;
        --df-messenger-chat-text-color: #000000;
        --df-messenger-font: 'Arial', sans-serif;
        --df-messenger-font-size: 14px;
        --df-messenger-width: 350px;
        --df-messenger-height: 500px;
        --df-messenger-border-radius: 10px;
      }

      df-messenger .df-message-bubble {
        border-radius: 10px;
      }

      df-messenger .df-titlebar {
        background-color: #007bff;
        color: white;
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
      }
    </style>
  </head>
  <body>
    <df-messenger
      chat-title="Genuine"
      agent-id="5c75b03f-6de0-4485-8068-cba65d8c0979"
      language-code="en"
    ></df-messenger>
  </body>
</html>
