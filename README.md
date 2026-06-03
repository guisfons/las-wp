# LAS WP — Case Study

> **Custom WordPress Theme** · LAS for Life Institutional Site · ACF-Powered · PHP 8

![WordPress](https://img.shields.io/badge/WordPress-6.0+-21759B?logo=wordpress&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?logo=php&logoColor=white)
![ACF Pro](https://img.shields.io/badge/ACF-Pro-00A0D2)
![Live](https://img.shields.io/badge/Live-lasforlife.com.br-brightgreen)

<!-- TODO: Add screenshot of the LAS WP homepage here -->

---

## 1. Project Overview

LAS WP is the WordPress-powered institutional and marketing website for LAS for Life (lasforlife.com.br) — serving as the public-facing presence and lead generation layer for the platform. The theme is engineered as a lean, high-performance WordPress theme with ACF Pro content management, optimized for conversion and SEO.

This repository complements the main LAS Next.js application (`las` repo) by providing the institutional marketing layer managed through WordPress, while the authenticated platform experience is served by the Next.js SaaS application.

<!-- TODO: Add screenshot of the about or services section here -->

---

## 2. The Problem

LAS for Life needed two distinct web experiences: a dynamic, authenticated platform application (built in Next.js) and a public-facing institutional website that non-technical team members could manage independently. Building the institutional site within the Next.js application would have required developer involvement for every content change. A WordPress theme provides the ideal separation: a managed CMS layer for public content, while the complex platform logic lives in the dedicated Next.js app.

---

## 3. The Solution & Architecture

A purpose-built WordPress theme with ACF Pro field groups covering all institutional content sections: hero, about, services, team, testimonials, and contact. The theme is architected for performance — no page builder runtime, minimal JavaScript, clean semantic HTML output — ensuring the institutional site does not compromise the organization's Core Web Vitals scores.

### Architecture

- **`functions.php`** — Theme setup, ACF field group registration, menu locations, and asset enqueuing.
- **`inc/`** — Modular PHP includes for custom post types, taxonomy registrations, and admin customizations.
- **ACF field groups** — One group per major page section, registered programmatically to avoid database dependency.
- **Page templates** — Dedicated templates for specialized pages (services, team, contact) with section-specific field sets.

---

## 4. Technologies Used

- **CMS & Backend:** WordPress 6.0+, PHP 8.0+, MySQL
- **Content Management:** ACF Pro — programmatic field groups for all institutional sections
- **Styling:** Custom CSS/SCSS — mobile-first responsive layout
- **Live Site:** [lasforlife.com.br](https://www.lasforlife.com.br/)

---

## 5. Design Process & UI/UX

The visual identity of the WordPress institutional site was aligned with the Next.js platform design system, ensuring brand continuity across both touchpoints. Content sections were designed modularly so that the marketing team can reorder, show, or hide sections without developer involvement.

<!-- TODO: Add screenshot of the full homepage layout here -->
<!-- TODO: Add screenshot of the WP admin ACF fields for a page section here -->

---

## 6. Project Outcomes

- **Content autonomy:** The marketing team manages all institutional content, landing pages, and blog posts independently.
- **Brand alignment:** Visual consistency between the WordPress institutional site and the Next.js platform creates a seamless user experience across both touchpoints.
- **Performance:** No page builder overhead — clean template output supporting strong Core Web Vitals metrics.
- **Separation of concerns:** Clear architectural boundary between the managed institutional CMS (WordPress) and the complex interactive platform (Next.js) — each optimized for its specific use case.
