<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Genuine Chat Messenger</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Dialogflow Messenger Bootstrap -->
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

    <style>
      /* -----------------------------------------
         Dialogflow Messenger Custom Styling
      ----------------------------------------- */
      df-messenger {
        --df-messenger-bot-message: #f1f5f9; /* Light gray */
        --df-messenger-user-message: #dcfce7; /* Light green */
        --df-messenger-button-titlebar-color: #3b82f6; /* Tailwind Blue-500 */
        --df-messenger-button-titlebar-text-color: white;
        --df-messenger-chat-background-color: #ffffff;
        --df-messenger-chat-text-color: #111827; /* Tailwind Gray-900 */
        --df-messenger-font: 'Inter', sans-serif;
        --df-messenger-font-size: 14px;
        --df-messenger-width: 100%;
        --df-messenger-height: 600px;
        --df-messenger-border-radius: 8px;
      }

      df-messenger .df-message-bubble {
        border-radius: 8px;
      }

      df-messenger .df-titlebar {
        background-color: #3b82f6;
        color: white;
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
      }

      /* -----------------------------------------
         Fade-in animation for smooth entrance
      ----------------------------------------- */
      .fade-in {
        animation: fadeIn 0.5s ease-in-out;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>
  <body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Top Navigation (optional) -->
    <nav class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
      <div class="text-xl font-semibold text-gray-800">Genuine Chat Messenger</div>
      <div class="space-x-4">
        <a href="#" class="text-gray-600 hover:text-gray-900 transition">Home</a>
        <a href="#" class="text-gray-600 hover:text-gray-900 transition">Features</a>
        <a href="#" class="text-gray-600 hover:text-gray-900 transition">Contact</a>
      </div>
    </nav>

    <!-- Main Content Area: Sidebar + Chat -->
    <div class="flex flex-1 overflow-hidden fade-in">
      <!-- Sidebar: Project Info -->
      <aside class="w-72 bg-white border-r border-gray-200 p-6 overflow-y-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
          About This Project
        </h2>
        <p class="text-sm text-gray-600 mb-6">
          This Laravel-powered web application integrates with Dialogflow to create
          a dynamic chat messenger interface. The chatbot is connected to a Dialogflow
          agent (agent-id) to handle user conversations. The application also includes
          models for Categories and Products, suggesting it can serve as an
          e-commerce or product-focused chatbot system.
        </p>
        <hr class="my-4" />
        <h3 class="text-lg font-medium text-gray-800 mb-2">
          Key Highlights
        </h3>
        <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside">
          <li>Laravel-based Backend</li>
          <li>Dialogflow Integration</li>
          <li>Chat Messenger Interface</li>
          <li>Categories & Products Models</li>
          <li>Potential E-commerce Support</li>
        </ul>
      </aside>

      <!-- Chat Section -->
      <main class="flex-1 p-6 overflow-y-auto flex items-center justify-end">
        <!-- The chat container is set to fill the available right side space -->
        <div class="w-full max-w-3xl">
          <df-messenger
            chat-title="Genuine"
            agent-id="5c75b03f-6de0-4485-8068-cba65d8c0979"
            language-code="en"
          ></df-messenger>
        </div>
      </main>
    </div>
  </body>
</html>
