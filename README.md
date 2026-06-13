# Stasio Medical Centre — Website (Laravel)

A one-page, full-featured public website for Stasio Medical Centre —
a GP surgery at Redcliff Turnoff, Rockodox Filling Station Complex.
Includes: services with expandable detail lists, doctor profile,
medical aid partners, opening hours with a live open/closed badge,
news noticeboard, online appointment booking, a contact form,
Google Maps embed, WhatsApp click-to-chat, and local SEO
(meta tags + MedicalClinic structured data).

This package contains the **project-specific files only**. You drop
them into a fresh Laravel installation on your machine.

## Requirements

- PHP 8.2+
- Composer
- SQLite (simplest) or MySQL

## Setup

1. **Create a fresh Laravel app**

   ```bash
   composer create-project laravel/laravel stasio-medical
   cd stasio-medical
   ```

2. **Copy these files into the project**, overwriting where prompted:

   ```
   routes/web.php
   app/Http/Controllers/HomeController.php
   app/Http/Controllers/AppointmentController.php
   app/Http/Requests/StoreAppointmentRequest.php
   app/Http/Controllers/ContactController.php
   app/Http/Requests/StoreContactMessageRequest.php
   app/Models/Appointment.php
   app/Models/ContactMessage.php
   app/Models/Article.php
   app/Models/Department.php
   app/Models/Doctor.php
   database/migrations/2026_06_11_000001_create_departments_table.php
   database/migrations/2026_06_11_000002_create_doctors_table.php
   database/migrations/2026_06_11_000003_create_articles_table.php
   database/migrations/2026_06_11_000004_create_appointments_table.php
   database/migrations/2026_06_11_000005_create_contact_messages_table.php
   database/seeders/DatabaseSeeder.php
   resources/views/layouts/app.blade.php
   resources/views/home.blade.php
   public/css/stasio.css
   ```

3. **Migrate and seed sample data**

   The default Laravel `.env` already uses SQLite, so just run:

   ```bash
   php artisan migrate --seed
   ```

   This creates the tables and loads the 6 service categories,
   Dr. Mukono's profile and 3 noticeboard notices.

   If you ran the older version before, reset with:
   `php artisan migrate:fresh --seed`

4. **Run it**

   ```bash
   php artisan serve
   ```

   Open http://127.0.0.1:8000

## What's included

| Area | Detail |
|---|---|
| Services | Currently one service: General Medical Consultations (per the owner's request). To add more, add rows to the seeder/`departments` table — the page renders every row automatically. |
| Medical aid logos | Drop official logo PNGs into `public/images/aids/` (see the README.txt in that folder for exact filenames). Each appears automatically; until then a styled name card shows instead. |
| Doctor | Dr. Stanley Tatenda Mukono is seeded; add more clinicians as rows in `doctors`. |
| Hours | Mon-Fri 08:00-17:00, Sat 08:00-13:00, closed Sun/holidays. The live badge script is at the bottom of `layouts/app.blade.php`. |
| Booking | POSTs to `/appointments`, saved with status `pending`. |
| Contact form | POSTs to `/contact`, saved in `contact_messages`. |
| WhatsApp | Floating button + links use +263 71 974 2125 (`wa.me/263719742125`). |
| Map | Google Maps embed searches for the Rockodox Filling Station, Redcliff Turnoff. Replace the iframe `src` with an exact pin once you have coordinates. |
| SEO | Meta description/keywords, Open Graph tags and MedicalClinic JSON-LD live in `layouts/app.blade.php`. |

## Things to update before going live

- The Facebook link in the footer (placeholder until the page exists).
- The map pin: the embed currently searches by name; replace with exact
  coordinates for a precise marker.
- Confirm the email address `info@stasiomedicalcentre.co.zw` is live.

## Next phase: the practice management system

The schema was designed to grow into the internal system:

- `appointments.status` already supports a workflow
  (`pending → confirmed → seen → cancelled`) — the staff dashboard
  can be built directly on top of it.
- Natural next steps: an authenticated `/admin` area (Laravel Breeze)
  with appointment management, a patients table, visit notes,
  and billing.
