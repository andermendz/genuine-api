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
     <!-- Font Awesome CDN (for clipboard icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
      /* ... (rest of your styles) ... */
      df-messenger {
        --df-messenger-bot-message: #f1f5f9;
        --df-messenger-user-message: #dcfce7;
        --df-messenger-button-titlebar-color: #3b82f6;
        --df-messenger-button-titlebar-text-color: white;
        --df-messenger-chat-background-color: #ffffff;
        --df-messenger-chat-text-color: #111827;
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
       /* Styles for the suggestion chips */
        .suggestion-chips {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr)); /* Two columns */
            gap: 0.5rem; /* Tailwind's spacing scale */
            margin-top: 0.5rem;
        }

        .suggestion-chip {
            background-color: #e0e7ff;
            color: #3730a3;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
            white-space: nowrap; /* Prevent line breaks within chips */
            overflow: hidden; /* Hide overflowing text */
            text-overflow: ellipsis; /* Add ellipsis for overflow */
            text-align: center; /* Center the text */
            position: relative; /* Important for icon positioning */
        }
        .suggestion-chip:hover{
          background-color: #c7d2fe;
        }
        /* Separate sections */
        .suggestion-section {
            margin-bottom: 1rem; /* Add spacing between sections */
        }
          /* Clipboard icon styles */
        .suggestion-chip .clipboard-icon {
            position: absolute;
            top: 50%;
            right: 0.5rem; /* Adjust as needed */
            transform: translateY(-50%);
            color: #3730a3; /* Match text color */
            opacity: 0; /* Hidden by default */
            transition: opacity 0.2s ease-in-out;
            pointer-events: none; /* Prevent clicks on hidden icon */
        }

        .suggestion-chip:hover .clipboard-icon {
            opacity: 1; /* Show on hover */
        }
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
     <nav class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
      <div class="text-xl font-semibold text-gray-800">Genuine Dialogflow API</div>
  
    </nav>

    <!-- Main Content Area: Sidebar + Chat -->
    <div class="flex flex-1 overflow-hidden fade-in">
      <!-- Sidebar: Project Info -->
      <aside class="w-1/2 bg-white border-r border-gray-200 p-6 overflow-y-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
          About This Project
        </h2>
        <p class="text-sm text-gray-600 mb-6">
          This Laravel-powered web application integrates with Dialogflow to create
          a dynamic chat messenger interface.  The chatbot is connected to a Dialogflow
          agent to handle user conversations. The application also includes
          models for Categories and Products.
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
      
        </ul>
         <!-- Suggested Questions (Moved to Sidebar) -->
        <div class="mt-6">
            <div class="suggestion-section">
                <h4 class="text-gray-600 text-sm mb-2">Product Questions:</h4>
                <div class="suggestion-chips">
                    <div class="suggestion-chip" data-query="How many Running Shoes do you have in stock?">How many Running Shoes?<i class="fas fa-clipboard clipboard-icon"></i></div>
                    <div class="suggestion-chip" data-query="Are Wireless Earbuds available to purchase?">Wireless Earbuds available?<i class="fas fa-clipboard clipboard-icon"></i></div>
                    <div class="suggestion-chip" data-query="What is the current stock level of Denim Jeans?">Stock level of Denim Jeans?<i class="fas fa-clipboard clipboard-icon"></i></div>
                    <div class="suggestion-chip" data-query="Is the Smart LED TV 55" available?">Smart LED TV 55" available?<i class="fas fa-clipboard clipboard-icon"></i></div>
                    <div class="suggestion-chip" data-query="Do you have any stock of Garden Tool Sets available?">Garden Tool Sets in stock?<i class="fas fa-clipboard clipboard-icon"></i></div>
                </div>
            </div>

            <div class="suggestion-section">
                <h4 class="text-gray-600 text-sm mb-2">Category Questions:</h4>
                <div class="suggestion-chips">
                    <div class="suggestion-chip" data-query="How many products are in the Electronics category?">Products in Electronics?<i class="fas fa-clipboard clipboard-icon"></i></div>
                    <div class="suggestion-chip" data-query="Give me a product count for the Home & Garden category.">Product count for Home & Garden?<i class="fas fa-clipboard clipboard-icon"></i></div>
                    <div class="suggestion-chip" data-query="What categories do you have?">What categories?<i class="fas fa-clipboard clipboard-icon"></i></div>
                    <div class="suggestion-chip" data-query="Total products in Sports & Outdoors?">Total in Sports & Outdoors?<i class="fas fa-clipboard clipboard-icon"></i></div>
                    <div class="suggestion-chip" data-query="How many items do you have in Clothing?">Items in Clothing?<i class="fas fa-clipboard clipboard-icon"></i></div>
                </div>
            </div>
        </div>
      </aside>
       <main class="flex-1 p-6 overflow-y-auto flex flex-col items-center justify-end">
        <div class="w-full max-w-lg">
          <df-messenger
            chat-title="Genuine"
            agent-id="5c75b03f-6de0-4485-8068-cba65d8c0979"
            language-code="en"
          ></df-messenger>

        </div>
       </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
    const suggestionChips = document.querySelectorAll('.suggestion-chip');

    suggestionChips.forEach(chip => {
        chip.addEventListener('click', () => {
            const query = chip.dataset.query;

            // Copy to clipboard
            navigator.clipboard.writeText(query)
                .then(() => {
                    // Optional: Show a brief "Copied!" message (using a tooltip or similar)
                    console.log('Copied to clipboard:', query);
                    // Example using a simple span:
                    const copiedMessage = document.createElement('span');
                    copiedMessage.textContent = 'Copied!';
                    copiedMessage.style.cssText = 'position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0,0,0,0.7); color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; opacity: 0; transition: opacity 0.3s ease-in-out;';
                    chip.appendChild(copiedMessage);

                    // Fade in and out
                    setTimeout(() => { copiedMessage.style.opacity = 1; }, 10); // Small delay for smoother appearance
                    setTimeout(() => {
                        copiedMessage.style.opacity = 0;
                        setTimeout(() => { chip.removeChild(copiedMessage); }, 300); // Remove after fade-out
                    }, 1500);  // Display for 1.5 seconds


                })
                .catch(err => {
                    console.error('Failed to copy:', err);
                });
        });
    });
});
    </script>
  </body>
</html>