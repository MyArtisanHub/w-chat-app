
# Laravel Chat App (with Reverb WebSocket Support)

This is a real-time chat application built with **Laravel**, using **Laravel Reverb** for WebSocket communication and **Laravel Echo + Vite** on the frontend.

---

## 🚀 Features

- Realtime WebSocket-based chat  
- Laravel Reverb as WebSocket server  
- Laravel Echo + Pusher JS on frontend  
- Vue/React/Blade frontend (Vite-based)  
- Simple and clean architecture for learning or extending  

---

## 🧱 Requirements

- PHP >= 8.1  
- Node.js >= 16  
- Composer  
- Redis (if using broadcasting)  
- MySQL/PostgreSQL/SQLite  
- Laravel Reverb (`^1.0`)  

---

## 🛠️ Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/laravel-chat-app.git
cd laravel-chat-app
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Copy `.env` File and Generate Key

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database

Edit your `.env` file and set up your database credentials:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

---

## ⚡ Setup Laravel Reverb (WebSocket)

### 6. Install Laravel Reverb (if not already)

```bash
composer require laravel/reverb
```

### 7. Configure `.env` for Reverb

Make sure the following Reverb-related keys are present:

```env
REVERB_APP_ID="{Your APP ID}"
REVERB_APP_KEY="{Your APP KEY}"
REVERB_APP_SECRET="{Your APP SECRET}"
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"

BROADCAST_DRIVER=reverb
```

### 8. Start the Reverb WebSocket Server

```bash
php artisan reverb:start --host=localhost --port=8080
```

> Make sure this runs in a separate terminal tab or use `tmux`/`screen`.

---

## 🧩 Frontend Setup (Vite)

### 9. Install JS Dependencies

```bash
npm install
```

### 10. Compile Frontend Assets

```bash
npm run dev
```

---

## 🧪 Run the App

Visit:

```
http://localhost:8000
```

Login or register a user, and try chatting in real-time 🎉

---

## 🧹 Useful Commands

```bash
# Clear cache and config
php artisan optimize:clear

# Re-run migrations fresh
php artisan migrate:fresh --seed

# Start WebSocket server
php artisan reverb:start
```

---

## 🧑‍💻 Author

**Your Name**  
GitHub: [@dev-sudip](https://github.com/dev-sudip)

---

## 🪪 License

This project is open-sourced under the MIT license.
