<p align="center">
  <img src="public/images/logo.png" width="100" alt="DCMS Logo">
</p>

<h1 align="center">DCMS — Department Content Management System</h1>

<p align="center">
  A full-featured CMS built for the <strong>Department of Computer Science</strong> at <strong>Nasarawa State University, Keffi (NSUK)</strong>.<br>
  <em>Pioneering Innovation in Computing</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10-FF2D20?logo=laravel&logoColor=white" alt="Laravel 10">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php&logoColor=white" alt="PHP 8.1+">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?logo=tailwindcss&logoColor=white" alt="Tailwind CSS 3">
  <img src="https://img.shields.io/badge/Vite-5-646CFF?logo=vite&logoColor=white" alt="Vite 5">
  <img src="https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="MIT License">
</p>

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Screenshots](#screenshots)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Admin Panel](#admin-panel)
- [Public Pages](#public-pages)
- [Data Models](#data-models)
- [Contributing](#contributing)
- [License](#license)

---

## Overview

DCMS is a purpose-built content management system designed for university departments. It provides a modern, responsive public-facing website alongside a powerful admin dashboard — enabling faculty and administrators to manage every aspect of their department's online presence without writing code.

Built with **Laravel 10**, **Tailwind CSS**, and **Alpine.js**, the system is fast, mobile-friendly, and completely admin-editable through a settings-driven architecture using key-value `DepartmentSetting` records.

---

## Features

### Public Website
- **Dynamic Homepage** — Carousel slider, latest news, events, announcements, discover-more grid, and NACOS student association section
- **About Page** — Department history, mission, vision, and key statistics
- **Academics** — Programme listings grouped by category (Undergraduate, Postgraduate, etc.) with course breakdowns
- **Staff Directory** — Browse department staff with detailed profiles, qualifications, and publications
- **News & Research** — News articles with emoji reactions (Like, Love, Clap, Insightful, Celebrate)
- **Gallery** — Photo albums with lightbox-style image browsing
- **Contact Page** — Contact form, department info cards, Google Maps embed, partnership CTA, and social links
- **NACOS Presidents** — History of student association leaders with about, activities, and leadership sections
- **Past HODs** — Timeline of former Heads of Department
- **Dynamic CMS Pages** — Create unlimited custom pages from the admin panel
- **Breadcrumb Navigation** — Auto-generated breadcrumbs via `diglactic/laravel-breadcrumbs`
- **SEO-Friendly** — Clean URLs, semantic HTML, proper meta tags

### Admin Dashboard
- **Analytics Dashboard** — Charts, KPI cards, and content statistics with PDF report export
- **Full CRUD** for Staff, Programmes, Courses, News, Events, Announcements, Gallery Albums/Images, Pages, and more
- **Inline Page Editors** — Visual editors for Home, About, Academics, Blog, Contact, and NACOS pages
- **Carousel Manager** — Upload/reorder/toggle homepage slideshow slides
- **Social Links Manager** — Add/edit social media profiles (shown across footer and contact page)
- **External Systems** — Manage links to portals, LMS, and other university systems
- **Department Settings** — Key-value settings store powering all editable text across the site
- **System Backup** — One-click backup download
- **Staff Roles** — Define and assign roles (HOD, Lecturer, Lab Technician, etc.)
- **Partner Management** — Manage institutional and industry partners
- **Authentication** — Laravel Breeze-powered login with session management

---

## Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | [Laravel 10](https://laravel.com) (PHP 8.1+) |
| **Frontend** | [Blade Templates](https://laravel.com/docs/blade) + [Tailwind CSS 3](https://tailwindcss.com) + [Alpine.js](https://alpinejs.dev) |
| **Build Tool** | [Vite 5](https://vitejs.dev) with PostCSS & Autoprefixer |
| **Database** | MySQL 8 |
| **Auth** | [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) + [Sanctum](https://laravel.com/docs/sanctum) |
| **Charts** | [Chart.js 4](https://www.chartjs.org) |
| **Icons** | [Font Awesome 6](https://fontawesome.com) |
| **Fonts** | Google Fonts (Inter + Outfit) |
| **Images** | [Intervention Image v3](https://image.intervention.io) |
| **PDFs** | [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) |
| **Breadcrumbs** | [diglactic/laravel-breadcrumbs](https://github.com/diglactic/laravel-breadcrumbs) |

---

## Screenshots

> Add screenshots of the homepage, admin dashboard, and key pages here.

---

## Requirements

- **PHP** >= 8.1
- **Composer** >= 2.x
- **Node.js** >= 18.x & **npm** >= 9.x
- **MySQL** >= 8.0 (or MariaDB >= 10.6)
- **Apache/Nginx** (or XAMPP for local development)

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Jay-kod/cmp.cs_cms.git
cd cmp.cs_cms
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and configure your database:

```env
DB_DATABASE=dcms_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Database Setup

```bash
php artisan migrate --seed
```

### 5. Storage Link

```bash
php artisan storage:link
```

### 6. Build Frontend Assets

```bash
# Development (with hot-reload)
npm run dev

# Production
npm run build
```

### 7. Start the Server

```bash
php artisan serve
```

Or use the included batch scripts on Windows (XAMPP):

```bash
start_servers/start_all.bat
```

Visit `http://localhost:8000` (or your configured URL).

---

## Configuration

### Department Settings

Edit `config/university.php` to set core department identity:

```php
return [
    'name'             => 'Department of Computer Science',
    'university'       => 'Nasarawa State University, Keffi',
    'short_name'       => 'CMP NSUK',
    'tagline'          => 'Pioneering Innovation in Computing',
    'established'      => 1972,
    'primary_color'    => '#16a34a',
    'secondary_color'  => '#15803d',
];
```

All other page content (hero text, descriptions, CTAs, etc.) is managed through the **Admin Panel → Page Content** editors — no code changes needed.

---

## Usage

### Default Admin Login

After running seeders, log in at `/login` with the seeded admin credentials. From the admin dashboard you can:

1. **Manage Content** — Create news, events, announcements, and gallery albums
2. **Edit Pages** — Use inline page editors for each section of the website
3. **Manage People** — Add staff members with qualifications, publications, and roles
4. **Configure Settings** — Update department info, social links, carousel slides, and partner logos
5. **View Analytics** — Monitor content statistics and download PDF reports
6. **Backup System** — Download a full system backup

---

## Project Structure

```
dcms/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Route controllers (admin + public)
│   │   ├── Middleware/         # Auth & request middleware
│   │   └── Requests/          # Form request validation
│   ├── Models/                # Eloquent models (20+ domain models)
│   ├── Providers/             # Service providers
│   └── View/Components/       # Blade components
├── config/
│   └── university.php         # Department identity config
├── database/
│   ├── migrations/            # 31 schema migrations
│   └── seeders/               # Sample data seeders
├── public/
│   ├── build/                 # Compiled Vite assets
│   └── images/                # Static images & logos
├── resources/
│   ├── css/                   # Source stylesheets
│   ├── js/                    # Source JavaScript
│   └── views/
│       ├── admin/             # Admin panel views
│       ├── components/        # Reusable Blade components
│       ├── layouts/           # Layout templates (admin + public)
│       └── pages/             # Public page views
├── routes/
│   ├── web.php                # Web routes (public + admin)
│   ├── api.php                # API routes (search, etc.)
│   └── breadcrumbs.php        # Breadcrumb definitions
└── start_servers/             # Windows batch scripts for XAMPP
```

---

## Admin Panel

Access the admin panel at `/admin` after authentication.

| Module | Path | Description |
|---|---|---|
| Dashboard | `/admin` | Analytics overview with charts & KPIs |
| Staff | `/admin/staff` | Manage department staff & profiles |
| Programmes | `/admin/programmes` | Academic programme CRUD |
| Courses | `/admin/courses` | Course management |
| News | `/admin/news` | News article CRUD |
| Events | `/admin/events` | Event management |
| Announcements | `/admin/announcements` | Announcement CRUD |
| Gallery | `/admin/gallery` | Album & image management |
| Pages | `/admin/pages` | Dynamic CMS pages |
| Carousel | `/admin/carousel` | Homepage slider management |
| Social Links | `/admin/social-links` | Social media profiles |
| Settings | `/admin/settings` | Department settings (key-value) |
| Page Content | `/admin/page-content/{page}` | Inline editors for each page |
| Partners | `/admin/partners` | Partner/sponsor logos |
| Backup | `/admin/backup` | System backup download |

---

## Public Pages

| Page | URL | Description |
|---|---|---|
| Home | `/` | Landing page with slider, news, events, sections |
| About | `/about` | Department overview, history, and stats |
| Academics | `/academics` | Programme categories and course listings |
| Staff Directory | `/people` | Browse and search staff members |
| Staff Profile | `/people/{slug}` | Individual staff details |
| News & Research | `/research-news` | News archive with reactions |
| Gallery | `/gallery` | Photo album showcase |
| Contact | `/contact` | Contact form, info cards, and map |
| NACOS Presidents | `/nacos-presidents` | Student association leadership |
| Past HODs | `/past-hods` | Former department heads |
| Custom Pages | `/page/{slug}` | Dynamic admin-created pages |

---

## Data Models

The system uses **20+ Eloquent models** to represent the department's domain:

| Model | Purpose |
|---|---|
| `User` | Authentication & authorship |
| `Staff` | Department faculty & personnel |
| `StaffRole` | Staff position titles |
| `Programme` | Academic degree programmes |
| `ProgrammeCategory` | Programme groupings (UG, PG, etc.) |
| `Course` | Individual courses (many-to-many with Staff) |
| `News` | News articles with slug routing |
| `Reaction` | Emoji reactions on news (session-tracked) |
| `Event` | Department events |
| `Announcement` | Announcements with priority |
| `GalleryAlbum` | Photo gallery albums |
| `GalleryImage` | Images within albums |
| `CarouselSlide` | Homepage carousel slides |
| `Page` | Dynamic CMS pages |
| `DepartmentSetting` | Key-value settings store |
| `ExternalSystem` | External portal links |
| `SocialLink` | Social media profiles |
| `NacosPresident` | NACOS association presidents |
| `PastHod` | Former Heads of Department |
| `Partner` | Institutional & industry partners |
| `Publication` | Staff research publications |
| `Qualification` | Staff academic qualifications |

---

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "feat: add your feature"`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## License

This project is open-sourced under the [MIT License](LICENSE).
