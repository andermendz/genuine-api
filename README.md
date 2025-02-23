# Genuine API - Product Inventory with Dialogflow Integration

A Laravel-based API that manages product inventory and integrates with Dialogflow for natural language processing of product availability queries.

## Features

- RESTful API for managing products and categories
- Dialogflow webhook integration for natural language product queries
- Product availability checking by category or specific product
- Database-driven inventory management

## Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL/MariaDB
- Dialogflow account and project setup

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/genuine-api.git
   cd genuine-api
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure database in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. Run migrations and seeders:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

## Development Setup

### Running the Application

1. Start the Laravel development server:
   ```bash
   php artisan serve
   ```
   The API will be available at `http://localhost:8000`

### Setting up Ngrok for Dialogflow Webhook

1. Install Ngrok:
   - Download from [https://ngrok.com/download](https://ngrok.com/download)
   - Extract the executable to a convenient location
   - Sign up for a free account and get your auth token

2. Authenticate Ngrok:
   ```bash
   ngrok config add-authtoken YOUR_AUTH_TOKEN
   ```

3. Start Ngrok tunnel (in a new terminal):
   ```bash
   ngrok http 8000
   ```
   This will create a public URL (e.g., `https://your-tunnel-id.ngrok.io`)

4. Configure Dialogflow Webhook:
   - Go to your Dialogflow agent's settings
   - Navigate to the "Fulfillment" tab
   - Enable the webhook
   - Set the URL to: `https://your-tunnel-id.ngrok.io/api/dialogflow/webhook`
   - Click "Save"

5. Test the Integration:
   - Use the Dialogflow simulator or test your queries
   - Check the Ngrok web interface (http://localhost:4040) to monitor requests
   - Verify webhook responses in the Laravel logs (`storage/logs/laravel.log`)

## API Endpoints

### Dialogflow Integration

- `GET /api/dialogflow/status` - Check Dialogflow integration status
- `POST /api/dialogflow/webhook` - Webhook endpoint for Dialogflow requests

### Data Endpoints

- `GET /data` - Retrieve all categories with their products

## Dialogflow Setup

### Intents

1. **Default Welcome Intent**
   - Handles initial greetings
   - Response: "Hello! How can I assist you today?"

2. **Product Availability Intent**
   - Name: `product.availability`
   - Training phrases examples:
     - "How many products are in [category]?"
     - "Do you have [product] in stock?"
     - "What's the quantity of [product] in [category]?"

### Entities

1. **Category**
   - Type: List
   - Used to identify product categories in queries

2. **Product**
   - Type: List
   - Used to identify specific products in queries

## Example Queries

- "How many products are in the Electronics category?"
- "Do you have iPhone in stock?"
- "What's the quantity of Samsung TV in Electronics?"

## Response Format

The API returns JSON responses in the following format:

```json
{
    "fulfillmentText": "There are 5 products in the Electronics category."
}
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
