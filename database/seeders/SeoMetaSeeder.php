<?php

namespace Database\Seeders;

use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class SeoMetaSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'page'             => 'home',
                'meta_title'       => 'Aakar Dermatology | Skin, Hair & Laser Clinic in Lalitpur, Nepal',
                'meta_description' => 'Aakar Dermatology offers comprehensive medical & aesthetic dermatology services in Lalitpur, Nepal. Led by Dr. Rajan Tajhya, expert in LASER and Dermato-surgery.',
                'meta_keywords'    => 'dermatology, skin clinic, hair clinic, laser treatment, Lalitpur, Nepal, Dr. Rajan Tajhya, Aakar Dermatology',
                'og_title'         => 'Aakar Dermatology | Skin, Hair & Laser Clinic',
                'og_description'   => 'Comprehensive Medical & Aesthetic Dermatology Services in Lalitpur. Expert in LASER, Hair Transplant & Dermato-surgery.',
                'canonical_url'    => 'https://aakardermatology.com/',
                'no_index'         => false,
            ],
            [
                'page'             => 'services',
                'meta_title'       => 'Our Dermatology Services | Aakar Dermatology Lalitpur',
                'meta_description' => 'Explore our complete range of skin, hair & laser treatment services at Aakar Dermatology. From acne treatment to hair transplant, we have personalized solutions for you.',
                'meta_keywords'    => 'dermatology services, skin treatment, hair transplant, laser treatment, acne treatment, Lalitpur Nepal',
                'og_title'         => 'Dermatology Services | Aakar Dermatology',
                'og_description'   => 'Complete range of medical and aesthetic dermatology services tailored for you.',
                'canonical_url'    => 'https://aakardermatology.com/services',
                'no_index'         => false,
            ],
            [
                'page'             => 'about',
                'meta_title'       => 'About Dr. Rajan Tajhya | Aakar Dermatology Lalitpur',
                'meta_description' => 'Meet Dr. Rajan Tajhya, Founder of Aakar Dermatology. A decade of expertise in LASER and Dermato-surgery. Providing compassionate, personalized dermatology care in Lalitpur, Nepal.',
                'meta_keywords'    => 'Dr. Rajan Tajhya, dermatologist, laser specialist, dermato-surgery, Aakar Dermatology, about',
                'og_title'         => 'About Dr. Rajan Tajhya | Aakar Dermatology',
                'og_description'   => 'A decade of expertise in LASER and Dermato-surgery at Aakar Dermatology, Lalitpur.',
                'canonical_url'    => 'https://aakardermatology.com/about',
                'no_index'         => false,
            ],
            [
                'page'             => 'blog',
                'meta_title'       => 'Skin & Hair Care Blog | Aakar Dermatology',
                'meta_description' => 'Read expert tips, treatment guides, and skin care advice from Dr. Rajan Tajhya and the Aakar Dermatology team.',
                'meta_keywords'    => 'skin care tips, hair care, dermatology blog, laser treatment guide, Aakar Dermatology',
                'og_title'         => 'Skin & Hair Care Blog | Aakar Dermatology',
                'og_description'   => 'Expert skin care tips, treatment guides and dermatology advice from Aakar Dermatology.',
                'canonical_url'    => 'https://aakardermatology.com/blog',
                'no_index'         => false,
            ],
            [
                'page'             => 'contact',
                'meta_title'       => 'Contact Us | Book Appointment at Aakar Dermatology',
                'meta_description' => 'Contact Aakar Dermatology in Lalitpur, Nepal. Book your consultation with Dr. Rajan Tajhya today. Call us or fill the appointment form.',
                'meta_keywords'    => 'contact Aakar Dermatology, book appointment, dermatologist Lalitpur, skin clinic contact',
                'og_title'         => 'Contact & Appointment | Aakar Dermatology',
                'og_description'   => 'Book your consultation at Aakar Dermatology, Lalitpur. Expert skin, hair & laser care.',
                'canonical_url'    => 'https://aakardermatology.com/contact',
                'no_index'         => false,
            ],
            [
                'page'             => 'videos',
                'meta_title'       => 'Video Tutorials | Aakar Dermatology',
                'meta_description' => 'Watch practical skin, hair, and treatment tutorials from Aakar Dermatology.',
                'meta_keywords'    => 'dermatology videos, skin care tutorials, hair care videos, Aakar Dermatology',
                'canonical_url'    => 'https://aakardermatology.com/videos',
                'menu_label'       => 'Videos',
                'menu_icon'        => 'play',
                'no_index'         => false,
            ],
            [
                'page'             => 'privacy_policy',
                'meta_title'       => 'Privacy Policy | Aakar Dermatology',
                'meta_description' => 'Read the Aakar Dermatology privacy policy and learn how we handle personal information.',
                'canonical_url'    => 'https://aakardermatology.com/privacy-policy',
                'menu_label'       => 'Privacy Policy',
                'menu_icon'        => 'shield',
                'content'          => '<h2>Privacy Policy</h2><p>Aakar Dermatology respects your privacy. We collect only the information needed to respond to enquiries, manage appointments, and provide better care.</p><h3>How we use information</h3><p>Information submitted through this website is used to contact you about your request and is not sold to third parties.</p><h3>Contact</h3><p>For privacy questions, please contact our clinic directly.</p>',
                'no_index'         => false,
            ],
            [
                'page'             => 'terms_and_conditions',
                'meta_title'       => 'Terms & Conditions | Aakar Dermatology',
                'meta_description' => 'Read the terms and conditions for using the Aakar Dermatology website and online services.',
                'canonical_url'    => 'https://aakardermatology.com/terms-and-conditions',
                'menu_label'       => 'Terms & Conditions',
                'menu_icon'        => 'document',
                'content'          => '<h2>Terms &amp; Conditions</h2><p>By using this website, you agree to use the information responsibly and understand that website content does not replace a consultation with a qualified medical professional.</p><h3>Appointments</h3><p>Appointment requests are subject to confirmation by the clinic team. Treatment recommendations are made after an appropriate clinical assessment.</p><h3>Website content</h3><p>We aim to keep information accurate and current, but details may change without notice.</p>',
                'no_index'         => false,
            ],
        ];

        foreach ($pages as $page) {
            SeoMeta::updateOrCreate(['page' => $page['page']], $page);
        }
    }
}
