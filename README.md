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
