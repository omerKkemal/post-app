<!-- LOGO IMAGE - Add your logo here -->
<p align="center">
  <img src="screen_shot/logo.png" alt="Blogging Platform Logo" width="200">
</p>

<!--- Animated Header --->
<p align="center">
    <img src="https://readme-typing-svg.demolab.com?font=Fira+Code&weight=600&size=32&duration=2000&pause=500&color=FF6B6B&center=true&vCenter=true&width=600&lines=Dynamic+Blogging+Platform;Laravel+%2B+SQLite;Content+Management+System;Modern+Blog+Engine;Rich+Media+Support" alt="Typing SVG" />
</p>

<!-- MAIN TITLE -->
<p align="center">
  <img src="https://img.shields.io/badge/DYNAMIC-BLOGGING%20PLATFORM-FF6B6B?style=for-the-badge&logo=laravel&logoColor=white&labelColor=1a1a2e" alt="Dynamic Blogging Platform">
</p>

<!-- MODULE BADGES - CLEAN HEADER -->
<p align="center">
  <img src="https://img.shields.io/badge/Module-Admin%20Panel-FF6B6B?style=flat-square&logo=laravel">
  <img src="https://img.shields.io/badge/Module-Public%20Website-4ECDC4?style=flat-square&logo=web">
  <img src="https://img.shields.io/badge/Module-Category%20Manager-45B7D1?style=flat-square&logo=category">
  <img src="https://img.shields.io/badge/Module-Media%20Upload-96CEB4?style=flat-square&logo=image">
  <img src="https://img.shields.io/badge/Module-YouTube%20Embed-FF0000?style=flat-square&logo=youtube">
  <img src="https://img.shields.io/badge/Module-SQLite%20DB-003B57?style=flat-square&logo=sqlite">
</p>

<!-- VERSION BADGES -->
<p align="center">
  <img src="https://img.shields.io/badge/version-1.0.0-FF6B6B?style=for-the-badge&logo=git&logoColor=white&labelColor=1a1a2e">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white&labelColor=1a1a2e">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white&labelColor=1a1a2e">
  <img src="https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white&labelColor=1a1a2e">
  <img src="https://img.shields.io/badge/license-MIT-green?style=for-the-badge&logo=open-source&logoColor=white&labelColor=1a1a2e">
</p>

<!-- REPO STATS -->
<p align="center">
  <img src="https://api.visitorbadge.io/api/visitors?path=yourusername%2Fyour-repo&countColor=%23FF6B6B&style=for-the-badge" alt="Visitors">
  <img src="https://img.shields.io/github/stars/yourusername/your-repo?style=for-the-badge&logo=github&color=gold&labelColor=1a1a2e" alt="Stars">
  <img src="https://img.shields.io/github/forks/yourusername/your-repo?style=for-the-badge&logo=github&color=blue&labelColor=1a1a2e" alt="Forks">
</p>

---

<!-- ASCII ART HEADER -->
<pre align="center">
╔═══════════════════════════════════════════════════════════════════╗
║  ██████╗  ██████╗  ██████╗ ██╗███╗   ██╗ ██████╗                 ║
║  ██╔══██╗██╔════╝ ██╔════╝ ██║████╗  ██║██╔════╝                 ║
║  ██║  ██║██║  ███╗██║  ███╗██║██╔██╗ ██║██║  ███╗                ║
║  ██║  ██║██║   ██║██║   ██║██║██║╚██╗██║██║   ██║                ║
║  ██████╔╝╚██████╔╝╚██████╔╝██║██║ ╚████║╚██████╔╝                ║
║  ╚═════╝  ╚═════╝  ╚═════╝ ╚═╝╚═╝  ╚═══╝ ╚═════╝                 ║
║                                                                   ║
║              Dynamic Blogging Platform v1.0                      ║
║         Laravel + SQLite Content Management System               ║
╚═══════════════════════════════════════════════════════════════════╝
</pre>

---

## 📋 NAVIGATION MENU

<p align="center">
  <a href="#-overview"><img src="https://img.shields.io/badge/Overview-FF6B6B?style=for-the-badge&logo=readme&logoColor=white"></a>
  <a href="#-features"><img src="https://img.shields.io/badge/Features-4ECDC4?style=for-the-badge&logo=readme&logoColor=white"></a>
  <a href="#-architecture"><img src="https://img.shields.io/badge/Architecture-45B7D1?style=for-the-badge&logo=readme&logoColor=white"></a>
  <a href="#-tech-stack"><img src="https://img.shields.io/badge/Tech%20Stack-96CEB4?style=for-the-badge&logo=readme&logoColor=white"></a>
  <a href="#-installation"><img src="https://img.shields.io/badge/Installation-FF0000?style=for-the-badge&logo=readme&logoColor=white"></a>
  <a href="#-future-improvements"><img src="https://img.shields.io/badge/Future-003B57?style=for-the-badge&logo=readme&logoColor=white"></a>
  <a href="#-license"><img src="https://img.shields.io/badge/License-green?style=for-the-badge&logo=readme&logoColor=white"></a>
</p>

---

## OVERVIEW

A **dynamic blogging and content management platform built with Laravel** that allows authors to publish structured articles with rich media support. The system supports **image uploads, YouTube video embeds, structured content formatting (titles, subtitles, lists), and category-based organization**.

The platform is divided into two main parts:

* **Admin Panel** – for managing content and categories
* **Public Website** – for visitors to browse articles and updates

It also includes a **dynamic homepage, categorized library, and a "What's New" section** showing recent posts grouped by categories.

```mermaid
graph TD
    A[Dynamic Blogging Platform] --> B[Admin Panel]
    A --> C[Public Website]
    
    B --> B1[Post Management]
    B --> B2[Category Management]
    B --> B3[Media Upload]
    B --> B4[What's New Updates]
    
    C --> C1[Dynamic Homepage]
    C --> C2[Category Pages]
    C --> C3[Library Section]
    C --> C4[What's New Page]
    
    style A fill:#FF6B6B,stroke:#fff,stroke-width:2px,color:#fff
    style B fill:#4ECDC4,stroke:#fff,color:#fff
    style C fill:#45B7D1,stroke:#fff,color:#fff
```

---

## FEATURES

### Admin Panel

The admin dashboard allows content managers to control the platform with the following capabilities:

| Feature | Description |
|:--------|:------------|
| Post Management | Create, edit, and delete posts with full content control |
| Image Upload | Upload and manage images for articles |
| YouTube Integration | Add YouTube video links to posts |
| Category Management | Create, edit, and organize content categories |
| Library Organization | Organize posts inside the categorized library |
| What's New Management | Control which updates appear in the What's New section |

---

### Public Website

Visitors can browse content through several dynamic sections.

#### Dynamic Homepage
- Displays featured and recent posts
- Automatically updates when new articles are published
- Clean, responsive design for all devices

#### Categories Pages
- Articles are organized into logical categories
- Each category page displays related content
- Easy navigation between categories

#### Library Section
- A categorized content library for easy browsing
- Helps users discover resources and articles
- Filter and sort capabilities

#### What's New Page
- Shows recently published articles
- Organized by categories for quick discovery
- Helps users stay updated with latest content

---

## ARCHITECTURE

```
┌─────────────────────────────────────────────────────────────────┐
│                    DYNAMIC BLOGGING PLATFORM                     │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  ┌──────────────────┐              ┌──────────────────┐        │
│  │   ADMIN PANEL    │              │  PUBLIC WEBSITE  │        │
│  │                  │              │                  │        │
│  │ • Dashboard      │              │ • Homepage       │        │
│  │ • Posts CRUD     │◄────────────►│ • Category Pages │        │
│  │ • Categories     │   Database    │ • Library        │        │
│  │ • Media Library  │   Layer       │ • What's New     │        │
│  │ • Settings       │              │ • Article View   │        │
│  └──────────────────┘              └──────────────────┘        │
│           │                                 │                   │
│           └──────────────┬──────────────────┘                   │
│                          │                                      │
│                    ┌─────▼─────┐                               │
│                    │  SQLite   │                               │
│                    │ Database  │                               │
│                    └───────────┘                               │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │                    MEDIA HANDLING                         │  │
│  │  ┌────────────┐  ┌────────────┐  ┌────────────────────┐  │  │
│  │  │   Images   │  │  YouTube   │  │ Structured Content │  │  │
│  │  │   Upload   │  │   Embeds   │  │  (Titles, Lists)   │  │  │
│  │  └────────────┘  └────────────┘  └────────────────────┘  │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘
```

---

## TECH STACK

| Technology | Version | Purpose |
|:-----------|:-------:|:--------|
| Laravel | 10.x | Backend PHP framework |
| PHP | 8.1+ | Core programming language |
| Blade | - | Template engine |
| SQLite | 3.x | Lightweight database |
| JavaScript | ES6 | Frontend interactions |
| CSS3 | - | Styling and responsive design |
| HTML5 | - | Page structure |

---

## MEDIA SUPPORT

The platform supports rich content inside articles:

* **Image uploads** with automatic optimization
* **YouTube video embeds** for multimedia content
* **Structured article formatting** for professional layouts

Content elements supported:

* Titles and headings
* Subtitles and subheadings
* Bullet and numbered lists
* Inline images with captions
* Video embeds with responsive players

---

## INSTALLATION

### Step 1: Clone the repository

```bash
git clone https://github.com/yourusername/your-repo.git
cd your-repo
```

### Step 2: Install dependencies

```bash
composer install
```

### Step 3: Create environment file

```bash
cp .env.example .env
```

### Step 4: Generate application key

```bash
php artisan key:generate
```

### Step 5: Configure SQLite database

Create the database file:

```bash
touch database/database.sqlite
```

Edit `.env` file:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/your/project/database/database.sqlite
```

### Step 6: Run migrations

```bash
php artisan migrate
```

### Step 7: Start the development server

```bash
php artisan serve
```

Visit in browser:

```
http://127.0.0.1:8000
```

---

## FUTURE IMPROVEMENTS

| Feature | Description |
|:--------|:------------|
| Rich Text Editor | Enhanced WYSIWYG editor for post creation |
| Search Functionality | Full-text search across all content |
| Tag System | Additional content organization with tags |
| Comments System | User engagement through comments |
| API Support | RESTful API for headless CMS capabilities |
| User Roles | Multi-level permissions for contributors |
| SEO Optimization | Meta tags and SEO-friendly URLs |
| Social Sharing | Built-in social media sharing buttons |

---

## LICENSE

This project is licensed under the **MIT License**.

```
MIT License

Copyright (c) 2024 Your Name

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

<!-- FOOTER -->
<p align="center">
    <img src="https://readme-typing-svg.demolab.com?font=Fira+Code&weight=400&size=16&duration=3000&pause=500&color=FF6B6B&center=true&vCenter=true&width=400&lines=Dynamic+Blogging+Platform;Built+with+Laravel+and+SQLite;Modern+Content+Management;Open+Source+Project" alt="Footer Typing SVG" />
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Dynamic%20Blogging%20Platform-v1.0.0-FF6B6B?style=for-the-badge">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge">
  <br>
  <sub>© 2024 Dynamic Blogging Platform. MIT License.</sub>
</p>

<p align="center">
  <img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&height=100&section=footer&gradient=FF6B6B,4ECDC4,45B7D1"/>
</p>
