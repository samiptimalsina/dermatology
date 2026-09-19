<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::updateOrCreate(
            ['name' => 'Dr. Rajan Tajhya'],
            [
                'name'            => 'Dr. Rajan Tajhya',
                'designation'     => 'Founder & Lead Dermatologist',
                'qualification'   => 'MD, Dermatology & Venereology',
                'specialization'  => 'LASER & Dermato-surgery',
                'bio'             => 'Dr. Rajan Tajhya\'s journey in dermatology spans over a decade in hospital settings, where he developed deep expertise as a specialist in LASER and Dermato-surgery. Now, with the founding of Aakar Dermatology, he has reached a new milestone—creating a practice where advanced surgical and laser expertise meets compassionate, personalized care. Every procedure, from complex hair transplants to precise eyelid surgeries, reflects his commitment to helping you achieve results that transform not just your appearance, but your confidence.',
                'years_experience' => 10,
                'total_patients'   => 86,
                'is_featured'      => true,
                'is_active'        => true,
                'sort_order'       => 1,
            ]
        );
    }
}
