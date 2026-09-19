<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ── Brand Colors — editable live from admin dashboard ────────────────
            ['key' => 'color_primary',      'value' => '#006E61', 'type' => 'color', 'group' => 'brand', 'label' => 'Primary Color (Cobalt Green)'],
            ['key' => 'color_primary_dark',  'value' => '#00584E', 'type' => 'color', 'group' => 'brand', 'label' => 'Primary Dark'],
            ['key' => 'color_primary_mid',   'value' => '#007D6E', 'type' => 'color', 'group' => 'brand', 'label' => 'Primary Mid'],
            ['key' => 'color_primary_light', 'value' => '#E8F7F5', 'type' => 'color', 'group' => 'brand', 'label' => 'Primary Light (BG tint)'],
            ['key' => 'color_accent',        'value' => '#CC9134', 'type' => 'color', 'group' => 'brand', 'label' => 'Accent Color (Mystic Bronze)'],
            ['key' => 'color_accent_dark',   'value' => '#A87228', 'type' => 'color', 'group' => 'brand', 'label' => 'Accent Dark'],
            ['key' => 'color_accent_light',  'value' => '#FBF4E8', 'type' => 'color', 'group' => 'brand', 'label' => 'Accent Light (BG tint)'],
            ['key' => 'color_text',          'value' => '#1A2B29', 'type' => 'color', 'group' => 'brand', 'label' => 'Body Text'],

            // ── General ──────────────────────────────────────────────────────────
            ['key' => 'site_name',        'value' => 'Aakar Dermatology',       'type' => 'text',     'group' => 'general', 'label' => 'Site Name'],
            ['key' => 'site_tagline',     'value' => 'Skin · Hair · Laser',      'type' => 'text',     'group' => 'general', 'label' => 'Tagline'],
            ['key' => 'site_description', 'value' => 'Comprehensive Medical & Aesthetic Dermatology Services in Lalitpur, Nepal', 'type' => 'textarea', 'group' => 'general', 'label' => 'Site Description'],
            // Logo — 400×120 px PNG/SVG transparent background. Max 200 KB.
            ['key' => 'site_logo',        'value' => '',  'type' => 'image', 'group' => 'general', 'label' => 'Logo (400×120 px PNG/SVG, transparent BG)'],
            ['key' => 'header_logo',      'value' => '',  'type' => 'image', 'group' => 'general', 'label' => 'Header Logo (optional separate logo)'],
            ['key' => 'footer_logo',      'value' => '',  'type' => 'image', 'group' => 'general', 'label' => 'Footer Logo (optional separate logo)'],
            ['key' => 'show_header_logo', 'value' => '1', 'type' => 'boolean', 'group' => 'general', 'label' => 'Show Header Logo'],
            ['key' => 'show_footer_logo', 'value' => '1', 'type' => 'boolean', 'group' => 'general', 'label' => 'Show Footer Logo'],
            // Favicon — 512×512 px square PNG. Displays in browser tab.
            ['key' => 'site_favicon',     'value' => '',  'type' => 'image', 'group' => 'general', 'label' => 'Favicon (512×512 px square PNG)'],
            ['key' => 'footer_text',      'value' => '© ' . date('Y') . ' Aakar Dermatology. All rights reserved.', 'type' => 'text', 'group' => 'general', 'label' => 'Footer Text'],

            // ── Hero Section ─────────────────────────────────────────────────────
            ['key' => 'hero_heading',      'value' => 'Nurturing Skin,<br>Carving Confidence', 'type' => 'text',     'group' => 'hero', 'label' => 'Hero Heading'],
            ['key' => 'hero_subheading',   'value' => 'Your skin deserves more than quick fixes—it deserves genuine care that understands you. At Aakar Dermatology, we help you achieve healthy, radiant skin that boosts your confidence every single day.', 'type' => 'textarea', 'group' => 'hero', 'label' => 'Hero Subheading'],
            ['key' => 'hero_btn_primary',  'value' => 'Book Appointment', 'type' => 'text', 'group' => 'hero', 'label' => 'Hero Primary Button Label'],
            ['key' => 'hero_btn_secondary','value' => 'Our Services',     'type' => 'text', 'group' => 'hero', 'label' => 'Hero Secondary Button Label'],

            // Hero collage — 5 images displayed in a mosaic on the right side of the hero
            // Image 1 (large portrait — doctor/clinic) — 800×1000 px portrait (4:5). Shown prominently. Max 400 KB.
            ['key' => 'hero_image_1', 'value' => '', 'type' => 'image', 'group' => 'hero', 'label' => 'Hero Image 1 — Main Portrait (800×1000 px, doctor or clinic)'],
            // Image 2 (top right) — 600×400 px landscape (3:2). Treatment or clinic photo. Max 250 KB.
            ['key' => 'hero_image_2', 'value' => '', 'type' => 'image', 'group' => 'hero', 'label' => 'Hero Image 2 — Top Right (600×400 px, treatment/clinic)'],
            // Image 3 (middle right) — 600×400 px landscape (3:2). Skin/hair close-up. Max 250 KB.
            ['key' => 'hero_image_3', 'value' => '', 'type' => 'image', 'group' => 'hero', 'label' => 'Hero Image 3 — Middle Right (600×400 px, skin/hair)'],
            // Image 4 (bottom right) — 600×400 px landscape (3:2). Patient or procedure. Max 250 KB.
            ['key' => 'hero_image_4', 'value' => '', 'type' => 'image', 'group' => 'hero', 'label' => 'Hero Image 4 — Bottom Right (600×400 px, patient/procedure)'],
            // Image 5 (bottom left small) — 400×400 px square (1:1). Laser/equipment. Max 200 KB.
            ['key' => 'hero_image_5', 'value' => '', 'type' => 'image', 'group' => 'hero', 'label' => 'Hero Image 5 — Bottom Small Square (400×400 px, equipment)'],

            // ── Doctor / About ───────────────────────────────────────────────────
            // Doctor photo — 800×1000 px portrait (4:5). Used in hero & about sections. Max 400 KB.
            ['key' => 'doctor_photo',  'value' => '', 'type' => 'image',    'group' => 'about', 'label' => 'Doctor Photo (800×1000 px portrait, 4:5 ratio)'],
            ['key' => 'doctor_name',   'value' => 'Dr. Rajan Tajhya',              'type' => 'text',     'group' => 'about', 'label' => 'Doctor Name'],
            ['key' => 'doctor_title',  'value' => 'Founder & Lead Dermatologist, Aakar Dermatology', 'type' => 'text', 'group' => 'about', 'label' => 'Doctor Title'],
            ['key' => 'doctor_bio',    'value' => 'Dr. Rajan Tajhya\'s journey in dermatology spans over a decade in hospital settings, where he developed deep expertise as a specialist in LASER and Dermato-surgery. Now, with the founding of Aakar Dermatology, he has reached a new milestone—creating a practice where advanced surgical and laser expertise meets compassionate, personalized care. Every procedure, from complex hair transplants to precise eyelid surgeries, reflects his commitment to helping you achieve results that transform not just your appearance, but your confidence.', 'type' => 'textarea', 'group' => 'about', 'label' => 'Doctor Bio'],
            // About collage image — 800×600 px landscape. Shown beside bio text on About page. Max 350 KB.
            ['key' => 'about_clinic_image', 'value' => '', 'type' => 'image', 'group' => 'about', 'label' => 'About — Clinic Image (800×600 px, shown beside bio)'],

            // ── Stats ────────────────────────────────────────────────────────────
            ['key' => 'stat_years',      'value' => '10+',  'type' => 'text', 'group' => 'stats', 'label' => 'Years Experience'],
            ['key' => 'stat_patients',   'value' => '86+',  'type' => 'text', 'group' => 'stats', 'label' => 'Happy Patients'],
            ['key' => 'stat_procedures', 'value' => '500+', 'type' => 'text', 'group' => 'stats', 'label' => 'Procedures Done'],
            ['key' => 'stat_treatments', 'value' => '20+',  'type' => 'text', 'group' => 'stats', 'label' => 'Treatments Offered'],

            // ── Contact ──────────────────────────────────────────────────────────
            ['key' => 'contact_phone',     'value' => '+977 9801234567',                             'type' => 'text',     'group' => 'contact', 'label' => 'Phone'],
            ['key' => 'contact_phone2',    'value' => '+977 01-5555555',                             'type' => 'text',     'group' => 'contact', 'label' => 'Phone 2'],
            ['key' => 'contact_email',     'value' => 'info@aakardermatology.com',                   'type' => 'text',     'group' => 'contact', 'label' => 'Email'],
            ['key' => 'contact_address',   'value' => 'Lalitpur Metropolitan City, Lalitpur, Nepal', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Address'],
            ['key' => 'contact_hours',     'value' => 'Sun–Fri: 9:00 AM – 6:00 PM | Sat: Closed',   'type' => 'text',     'group' => 'contact', 'label' => 'Office Hours'],
            ['key' => 'google_maps_embed', 'value' => 'https://maps.google.com/maps?q=Lalitpur,Nepal&output=embed', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Google Maps Embed URL'],

            // ── Social ───────────────────────────────────────────────────────────
            ['key' => 'social_facebook',  'value' => 'https://facebook.com/aakardermatology',  'type' => 'text', 'group' => 'social', 'label' => 'Facebook URL'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/aakardermatology', 'type' => 'text', 'group' => 'social', 'label' => 'Instagram URL'],
            ['key' => 'social_youtube',   'value' => 'https://youtube.com/@aakardermatology',  'type' => 'text', 'group' => 'social', 'label' => 'YouTube URL'],
            ['key' => 'social_tiktok',    'value' => 'https://tiktok.com/@aakardermatology',   'type' => 'text', 'group' => 'social', 'label' => 'TikTok URL'],

            // ── CTA ──────────────────────────────────────────────────────────────
            ['key' => 'cta_heading',    'value' => 'Begin Your Journey with Aakar', 'type' => 'text',     'group' => 'cta', 'label' => 'CTA Heading'],
            ['key' => 'cta_subheading', 'value' => 'Whether you\'re dealing with a skin concern or exploring aesthetic enhancements, we are here to help. Schedule your consultation today and discover the difference personalized, expert care can make.', 'type' => 'textarea', 'group' => 'cta', 'label' => 'CTA Subheading'],
            // CTA background image — 1920×600 px wide banner. Optional. Max 500 KB.
            ['key' => 'cta_bg_image', 'value' => '', 'type' => 'image', 'group' => 'cta', 'label' => 'CTA Background Image (1920×600 px wide banner, optional)'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
