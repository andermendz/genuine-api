<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Genuine Chat Messenger</title>

    <script src="https://cdn.tailwindcss.com"></script> 
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
      body { font-family: 'Inter', sans-serif; }
      
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
        --df-messenger-height: 500px;
        --df-messenger-border-radius: 8px;
      }

      df-messenger .df-message-bubble { border-radius: 8px; }

      df-messenger .df-titlebar {
        background-color: #3b82f6;
        color: white;
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
      }

      .category-header {
        background-color: #e0e7ff;
        color: #3730a3;
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
      }
      
      .category-header:hover { background-color: #c7d2fe; }
      
      .category-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
      }
      
      .category-content.active { max-height: 500px; }

      .suggestion-chips {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); 
        gap: 0.5rem;
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
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
        text-align: center; 
        position: relative; 
      }
      
      .suggestion-chip:hover { background-color: #c7d2fe; }
   
      .suggestion-section { margin-bottom: 1rem; }
       
      .suggestion-chip .clipboard-icon {
        position: absolute;
        top: 50%;
        right: 0.5rem;
        transform: translateY(-50%);
        color: #3730a3; 
        opacity: 0; 
        transition: opacity 0.2s ease-in-out;
        pointer-events: none;
      }

      .suggestion-chip:hover .clipboard-icon { opacity: 1; }
      
      .fade-in { animation: fadeIn 0.5s ease-in-out; }

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
      
      .scrollbar-custom::-webkit-scrollbar { width: 6px; }
      
      .scrollbar-custom::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
      }
      
      .scrollbar-custom::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
      }
      
      .scrollbar-custom::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
  </head>
  <body class="bg-gray-100 min-h-screen flex flex-col">
    <nav class="flex items-center justify-between px-6 py-3 bg-white border-b border-gray-200 shadow-sm">
      <div class="text-xl font-semibold text-gray-800">Genuine Dialogflow API</div>
   
    </nav>

    <div class="flex-1 overflow-auto fade-in">
      <main class="w-full bg-white p-5 overflow-y-auto scrollbar-custom">
        <div class="max-w-4xl mx-auto">
          <h2 class="text-xl font-semibold text-gray-800 mb-3">About This Project</h2>
          <p class="text-sm text-gray-600 mb-4">
            This Laravel-powered web application integrates with Dialogflow to create
            a dynamic chat messenger interface. The chatbot is connected to a Dialogflow
            agent to handle user conversations. The application also includes
            models for Categories and Products.
          </p>
          <hr class="my-4" />
          <h3 class="text-lg font-medium text-gray-800 mb-2">Key Highlights</h3>
          <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside mb-4">
            <li>Laravel-based Backend</li>
            <li>Dialogflow Integration</li>
            <li>Chat Messenger Interface</li>
            <li>Categories & Products Models</li>
          </ul>

          <hr class="my-4" />
          
          <h3 class="text-lg font-medium text-gray-800 mb-3">Available Categories & Products</h3>
          
          <div class="space-y-2 mb-4">
            <div class="category-section">
              <div class="category-header flex justify-between items-center p-3 rounded-lg">
                <h4 class="font-medium">Electronics</h4>
                <div class="flex items-center">
                  <span class="text-gray-500 text-sm mr-2">(10 products)</span>
                  <i class="fas fa-chevron-down text-sm"></i>
                </div>
              </div>
              <div class="category-content bg-gray-50 rounded-b-lg px-3 pt-0 pb-2 mt-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-1 text-sm text-gray-600 py-2">
                  <div>Smart LED TV 55" (12)</div>
                  <div>Wireless Earbuds (30)</div>
                  <div>Gaming Laptop (8)</div>
                  <div>Smartphone (20)</div>
                  <div>Smartwatch (25)</div>
                  <div>Tablet (15)</div>
                  <div>Bluetooth Speaker (22)</div>
                  <div>Digital Camera (10)</div>
                  <div>VR Headset (5)</div>
                  <div>Gaming Console (7)</div>
                </div>
              </div>
            </div>

            <div class="category-section">
              <div class="category-header flex justify-between items-center p-3 rounded-lg">
                <h4 class="font-medium">Clothing</h4>
                <div class="flex items-center">
                  <span class="text-gray-500 text-sm mr-2">(7 products)</span>
                  <i class="fas fa-chevron-down text-sm"></i>
                </div>
              </div>
              <div class="category-content bg-gray-50 rounded-b-lg px-3 pt-0 pb-2 mt-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-1 text-sm text-gray-600 py-2">
                  <div>Denim Jeans (60)</div>
                  <div>Cotton T-Shirt (80)</div>
                  <div>Winter Jacket (35)</div>
                  <div>Running Shoes (55)</div>
                  <div>Leather Belt (40)</div>
                  <div>Wool Sweater (30)</div>
                  <div>Summer Dress (25)</div>
                </div>
              </div>
            </div>

            <div class="category-section">
              <div class="category-header flex justify-between items-center p-3 rounded-lg">
                <h4 class="font-medium">Home & Garden</h4>
                <div class="flex items-center">
                  <span class="text-gray-500 text-sm mr-2">(7 products)</span>
                  <i class="fas fa-chevron-down text-sm"></i>
                </div>
              </div>
              <div class="category-content bg-gray-50 rounded-b-lg px-3 pt-0 pb-2 mt-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-1 text-sm text-gray-600 py-2">
                  <div>Garden Tool Set (20)</div>
                  <div>Coffee Table (12)</div>
                  <div>Bed Sheets Set (45)</div>
                  <div>Indoor Plant Pot (35)</div>
                  <div>Wall Clock (28)</div>
                  <div>Kitchen Knife Set (18)</div>
                  <div>LED Floor Lamp (15)</div>
                </div>
              </div>
            </div>

            <div class="category-section">
              <div class="category-header flex justify-between items-center p-3 rounded-lg">
                <h4 class="font-medium">Books</h4>
                <div class="flex items-center">
                  <span class="text-gray-500 text-sm mr-2">(5 products)</span>
                  <i class="fas fa-chevron-down text-sm"></i>
                </div>
              </div>
              <div class="category-content bg-gray-50 rounded-b-lg px-3 pt-0 pb-2 mt-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-1 text-sm text-gray-600 py-2">
                  <div>Programming Guide (40)</div>
                  <div>Cookbook (25)</div>
                  <div>Science Fiction Novel (30)</div>
                  <div>Self-Help Book (20)</div>
                  <div>Children's Book Set (15)</div>
                </div>
              </div>
            </div>

            <div class="category-section">
              <div class="category-header flex justify-between items-center p-3 rounded-lg">
                <h4 class="font-medium">Sports & Outdoors</h4>
                <div class="flex items-center">
                  <span class="text-gray-500 text-sm mr-2">(9 products)</span>
                  <i class="fas fa-chevron-down text-sm"></i>
                </div>
              </div>
              <div class="category-content bg-gray-50 rounded-b-lg px-3 pt-0 pb-2 mt-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-1 text-sm text-gray-600 py-2">
                  <div>Yoga Mat (50)</div>
                  <div>Tennis Racket (18)</div>
                  <div>Camping Tent (10)</div>
                  <div>Basketball (30)</div>
                  <div>Hiking Backpack (22)</div>
                  <div>Fitness Dumbbells (16)</div>
                  <div>Fishing Rod (8)</div>
                  <div>Running Cap (12)</div>
                  <div>Cycling Gloves (15)</div>
                </div>
              </div>
            </div>
          </div>
          
          <hr class="my-4"/>

          <h3 class="text-lg font-medium text-gray-800 mb-3">Quick Actions</h3>
          <div>
            <div class="suggestion-section">
              <h4 class="text-gray-600 text-sm mb-2">Product Questions:</h4>
              <div class="suggestion-chips">
                <div class="suggestion-chip" data-query="How many Running Shoes do you have in stock?">How many Running Shoes?<i class="fas fa-clipboard clipboard-icon"></i></div>
                <div class="suggestion-chip" data-query="Are Wireless Earbuds available to purchase?">Wireless Earbuds available?<i class="fas fa-clipboard clipboard-icon"></i></div>
                <div class="suggestion-chip" data-query="What is the current stock level of Denim Jeans?">Stock level of Denim Jeans?<i class="fas fa-clipboard clipboard-icon"></i></div>
                <div class="suggestion-chip" data-query="Is the Smart LED TV 55\" available?">Smart LED TV 55" available?<i class="fas fa-clipboard clipboard-icon"></i></div>
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

            <div class="suggestion-section">
              <h4 class="text-gray-600 text-sm mb-2">Browse Products & Categories:</h4>
              <div class="suggestion-chips">
                <div class="suggestion-chip" data-query="Show me all Electronics products">Browse Electronics<i class="fas fa-clipboard clipboard-icon"></i></div>
                <div class="suggestion-chip" data-query="List all Clothing items">Browse Clothing<i class="fas fa-clipboard clipboard-icon"></i></div>
                <div class="suggestion-chip" data-query="Show Home & Garden products">Browse Home & Garden<i class="fas fa-clipboard clipboard-icon"></i></div>
                <div class="suggestion-chip" data-query="List all Books">Browse Books<i class="fas fa-clipboard clipboard-icon"></i></div>
                <div class="suggestion-chip" data-query="Show Sports & Outdoors items">Browse Sports & Outdoors<i class="fas fa-clipboard clipboard-icon"></i></div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- Dialogflow floating button is already included in your code -->
    <df-messenger
      chat-title="Genuine"
      agent-id="5c75b03f-6de0-4485-8068-cba65d8c0979"
      language-code="en"
    ></df-messenger>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Suggestion chips functionality
      const suggestionChips = document.querySelectorAll('.suggestion-chip');
      
      suggestionChips.forEach(chip => {
        chip.addEventListener('click', () => {
          const query = chip.dataset.query;
          
          navigator.clipboard.writeText(query)
            .then(() => {
              console.log('Copied to clipboard:', query);
              
              const copiedMessage = document.createElement('span');
              copiedMessage.textContent = 'Copied!';
              copiedMessage.style.cssText = 'position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0,0,0,0.7); color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; opacity: 0; transition: opacity 0.3s ease-in-out;';
              chip.appendChild(copiedMessage);
              
              setTimeout(() => { copiedMessage.style.opacity = 1; }, 10); 
              setTimeout(() => {
                copiedMessage.style.opacity = 0;
                setTimeout(() => { chip.removeChild(copiedMessage); }, 300); 
              }, 1500);
            })
            .catch(err => {
              console.error('Failed to copy:', err);
            });
        });
      });
      
      // Category dropdown functionality
      const categoryHeaders = document.querySelectorAll('.category-header');
      
      // Show the first category by default
      const firstCategoryContent = document.querySelector('.category-content');
      firstCategoryContent.classList.add('active');
      const firstChevron = categoryHeaders[0].querySelector('.fa-chevron-down');
      firstChevron.classList.add('fa-chevron-up');
      firstChevron.classList.remove('fa-chevron-down');
      
      categoryHeaders.forEach(header => {
        header.addEventListener('click', () => {
          const content = header.nextElementSibling;
          const chevron = header.querySelector('.fas');
          
          if (content.classList.contains('active')) {
            // Close this category
            content.classList.remove('active');
            chevron.classList.remove('fa-chevron-up');
            chevron.classList.add('fa-chevron-down');
          } else {
            // Open this category
            content.classList.add('active');
            chevron.classList.add('fa-chevron-up');
            chevron.classList.remove('fa-chevron-down');
          }
        });
      });
    });
    </script>
  </body>
</html>