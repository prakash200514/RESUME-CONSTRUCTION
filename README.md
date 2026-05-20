# AuraCV — Premium Resume Builder

> Craft a stunning, professional resume in minutes. Stand out from the crowd with premium templates designed for modern recruitment.


## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [Database Setup](#database-setup)
- [Google OAuth Setup](#google-oauth-setup)
- [Configuration](#configuration)
- [Usage](#usage)
- [License](#license)

## Overview

**AuraCV** is a PHP/MySQL-powered resume builder web application that lets users create, customize, and export professional resumes in minutes. It offers multiple premium templates (Modern Executive, Creative Bold, Minimal Tech), seamless Google OAuth login, and a clean, animated UI designed for a premium user experience.

## Features

- 🔐 **User Authentication** — Email/password registration & login with session management
- 🔑 **Google OAuth 2.0** — One-click sign-in via Google Identity Services
- 🎨 **Premium Templates** — Three curated resume templates (Modern Executive, Creative Bold, Minimal Tech)
- ✨ **Smart Suggestions** — AI-powered skill and description suggestions
- 🚀 **One-Click Export** — Export resumes as PDF, Word, or shareable link
- 📱 **Responsive Design** — Fully responsive layout with smooth animations
- 🌙 **Dark Mode UI** — Glassmorphism-inspired dark aesthetic with gradient accents
 ## Tech Stack

| Layer      | Technology                          |
|------------|-------------------------------------|
| Backend    | PHP 8+                              |
| Database   | MySQL (via PDO)                     |
| Frontend   | HTML5, Vanilla CSS, JavaScript      |
| Fonts      | Google Fonts (Inter, Outfit)        |
| Auth       | Google Identity Services (OAuth 2.0)|
| Server     | Apache (XAMPP recommended)          |

---
## Project Structure

```
Resume builder/
├── assets/                  # Images and static assets
│   ├── hero-resume.png
│   ├── template-modern.png
│   ├── template-creative.png
│   └── template-minimal.png
├── index.php                # Landing page (home)
├── auth.php                 # Login & registration page (tabbed UI)
├── login.php                # Login form handler
├── register.php             # Registration form handler
├── logout.php               # Session destroy & redirect
├── google-auth.php          # Google OAuth callback handler
├── templates.php            # Template selection page
├── config.php               # Database & Google OAuth configuration
├── database.sql             # Database schema
├── style.css                # Global stylesheet
└── script.js                # Frontend interactivity & animations

## Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (or any Apache + PHP + MySQL stack)
- PHP 8.0 or higher
- MySQL 5.7 or higher

### Installation

1. **Clone or copy the project** into your XAMPP `htdocs` directory:
   ```
   C:\xampp\htdocs\Resume builder\
   ```

2. **Start Apache and MySQL** from the XAMPP Control Panel.

3. **Set up the database** (see [Database Setup](#database-setup) below).

4. **Configure** `config.php` with your credentials (see [Configuration](#configuration)).

5. **Open your browser** and navigate to:
   ```
   http://localhost/Resume%20builder/
   ```
## Database Setup

1. Open **phpMyAdmin**: `http://localhost/phpmyadmin`
2. Create a new database named `auracv_db`.
3. Import the schema by running the provided SQL file:

   - Go to the **Import** tab in phpMyAdmin
   - Select `database.sql` from the project root
   - Click **Go**

   **Or** run it via the MySQL CLI:
   ```bash
   mysql -u root -p auracv_db < database.sql
   `
### Schema

```sql
CREATE TABLE IF NOT EXISTS users (
    id          INT(11) AUTO_INCREMENT PRIMARY KEY,
    google_id   VARCHAR(255) DEFAULT NULL,
    first_name  VARCHAR(50)  NOT NULL,
    last_name   VARCHAR(50)  NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    password    VARCHAR(255) DEFAULT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```
## Google OAuth Setup

1. Go to the [Google Cloud Console](https://console.cloud.google.com/).
2. Create a new project (or select an existing one).
3. Navigate to **APIs & Services → Credentials**.
4. Click **Create Credentials → OAuth 2.0 Client IDs**.
5. Set the **Authorized JavaScript Origins** to:
   ```
   
## Configuration

Open `config.php` and update the following values:

```php
// Database Configuration
$host     = 'localhost';
$dbname   = 'auracv_db';
$username = 'root';         // Your MySQL username
$password = '';             // Your MySQL password (blank for XAMPP default)

// Google OAuth
define('GOOGLE_CLIENT_ID', 'YOUR_GOOGLE_CLIENT_ID_HERE');
```

> ⚠️ **Security Note:** Do not commit `config.php` with real credentials to a public repository. Add it to `.gitignore` in production.

---
   http://localhost
   ```
6. Copy the generated **Client ID** and paste it into `config.php`:
   ```php
   define('GOOGLE_CLIENT_ID', 'YOUR_GOOGLE_CLIENT_ID_HERE');
   ```
# Usage

| Page              | URL                                  | Description                          |
|-------------------|--------------------------------------|--------------------------------------|
| Home              | `/Resume%20builder/`                 | Landing page with features & hero    |
| Login / Register  | `/Resume%20builder/auth.php`         | Tabbed auth form with Google login   |
| Templates         | `/Resume%20builder/templates.php`    | Browse and select resume templates   |
| Logout            | `/Resume%20builder/logout.php`       | Destroys session and redirects home  |

---
