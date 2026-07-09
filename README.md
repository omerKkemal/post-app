<!-- LOGO IMAGE -->
<p align="center">
  <img src="screen_shot/logo.png" alt="Blogging Platform Logo" width="200">
</p>

<p align="center">
  <strong>DYNAMIC BLOGGING PLATFORM</strong><br>
  <em>Where words go to live</em>
</p>

---

## So Here We Are

Another blogging platform. Because the world definitely needed one more.  
Built with Laravel because apparently I hate myself and enjoy pain.  
SQLite for the database because who needs scalability anyway?

This is where writers write, readers read, and admins admin.  
Everyone's happy. Mostly.

---

## What It Does (Besides Exist)

### For The Bosses (Admin Panel)

| Thing | What It Does |
|:------|:-------------|
| Posts | Create, edit, delete – the usual CRUD stuff |
| Images | Upload pictures so your posts aren't boring |
| YouTube | Embed videos because text is so 1990s |
| Categories | Organize your chaos into folders |
| Library | A place for everything and everything in its place |
| What's New | Tell people you did something |

### For The Visitors (Public Website)

| Thing | What They See |
|:------|:-------------|
| Homepage | Featured posts, recent stuff – you know the drill |
| Categories | Posts organized by topic (revolutionary) |
| Library | Everything, everywhere, all at once |
| What's New | The stuff you just posted |

---

## What's Under The Hood

| Technology | What It Pretends To Do |
|:-----------|:----------------------|
| Laravel 10.x | The backbone (or the skeleton, depends on the day) |
| PHP 8.1+ | The language I pretend to know |
| Blade | Makes HTML less annoying |
| SQLite 3.x | Where your words sleep |
| JavaScript ES6 | Makes things move (sometimes) |
| CSS3 | Makes it not ugly |
| HTML5 | The bare minimum |

---

## Media Stuff (Because Text Is Boring)

Your posts can have:

- Images – because a picture is worth a thousand words (or whatever)
- YouTube videos – for when words aren't enough
- Titles, subtitles, lists – the basic building blocks of content

Basically, you can write stuff and make it look decent.  
Groundbreaking, I know.

---

## Getting It Running (Without Breaking Everything)

### Step 1: Get The Code

```bash
git clone https://github.com/yourusername/your-repo.git
cd your-repo
```

### Step 2: Install The Noise

```bash
composer install
```

### Step 3: Make It Yours

```bash
cp .env.example .env
```

### Step 4: Generate The Magic Key

```bash
php artisan key:generate
```

### Step 5: Create The Database (Because Data Needs A Home)

```bash
touch database/database.sqlite
```

Then edit `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/your/project/database/database.sqlite
```

### Step 6: Build The Tables

```bash
php artisan migrate
```

### Step 7: See It Live

```bash
php artisan serve
```

Then open:

```
http://127.0.0.1:8000
```

Congrats. You're a blogger now.

---

## The Layout (If You Care)

```
blogging-platform/
│
├── app/                 # The brains
├── bootstrap/           # The startup sequence
├── config/              # All the settings you'll ignore
├── database/            # Where data sleeps
│   └── database.sqlite  # The little engine that could
├── public/              # The face of the operation
├── resources/           # Views, assets, the pretty stuff
├── routes/              # Where everything goes
├── storage/             # Where files hide
├── tests/               # The things I should write but don't
└── vendor/              # The stuff I didn't write
```

---

## What's Next (If I Get Bored)

| Thing | Description |
|:------|:------------|
| Rich Text Editor | Because writing HTML is for masochists |
| Search | For finding things (revolutionary) |
| Tags | Because categories aren't enough |
| Comments | So people can argue in the comments |
| API | For the overachievers |
| User Roles | Because everyone needs a title |
| SEO | So Google actually finds you |
| Social Sharing | Because sharing is caring |

---

## Screenshots (Visual Proof That It Exists)

<div align="center">

|                         |                         |
|:-----------------------:|:-----------------------:|
| ![Home](screen_shoot/home.png) | ![Login](screen_shoot/login.png) |
| **Home Page** | **Login Page** |
| ![Admin Panel](screen_shoot/admin_panel.png) | ![Dashboard](screen_shoot/dashbord.png) |
| **Admin Panel** | **Dashboard** |

</div>

They look fine. Move on.

---

## The Person Behind The Curtain

**Omer Kemal** – developer, coffee drinker, and occasional human.

- GitHub: [omerKkemal](https://github.com/omerKkemal)
- Website: [omerkemal.com](https://www.omerkemal.com)

Found something broken? Tell me.  
Want to fix something? Send a PR.  
Just here to complain? Go somewhere else.

---

## The Fine Print

MIT License – use it, break it, fix it. Just don't blame me.

Copyright (c) 2024 Omer Kemal

---

<p align="center">
  <sub>Made with caffeine, questionable decisions, and a distinct lack of sleep.</sub>
  <br>
  <sub>Go outside. Touch grass. I'll still be here. Writing code. Questioning everything.</sub>
</p>
