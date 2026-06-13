<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // "Departments" double as the service categories on the site.
        $services = [
            [
                'code' => 'GMC', 'name' => 'General Medical Consultations',
                'tagline' => 'Everyday care for every age', 'colour' => '#006EA1', 'sort_order' => 1,
                'details' => "Acute illness management\nRoutine medical consultations\nHealth assessments and check-ups\nPreventive healthcare\nMen's health services\nWomen's health services\nChild health services\nElderly care",
            ],
        ];

        foreach ($services as $s) {
            Department::create($s);
        }

        $gp = Department::where('code', 'GMC')->first();

        Doctor::create([
            'name'          => 'Dr. Stanley Tatenda Mukono',
            'title'         => 'Medical Director & General Practitioner — MBChB (UZ)',
            'specialty'     => 'Primary Healthcare',
            'department_id' => $gp->id,
            'days'          => 'Mon – Fri 08:00–17:00 · Sat 08:00–13:00',
            'bio'           => 'Dr. Stanley Mukono is a General Practitioner dedicated to providing comprehensive, patient-centred healthcare for individuals and families. His interests include primary healthcare, chronic disease management, preventive medicine, occupational health, and minor surgical procedures. He is committed to delivering accessible, affordable, and high-quality healthcare services to the Redcliff and Kwekwe communities.',
        ]);

        $articles = [
            [
                'title' => 'Now open at Redcliff Turnoff',
                'category' => 'Notice',
                'excerpt' => 'Stasio Medical Centre is open at Shop 5, Rockodox Filling Station Complex, Redcliff Turnoff — serving Redcliff, Kwekwe, Silobela, Zhombe and surrounding communities.',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Medical aid accepted',
                'category' => 'Notice',
                'excerpt' => 'We accept most major medical aid providers including PSMAS, First Mutual Health, Bonvie, Cellmed, FBC Health, Maisha and Alliance Health. Contact reception to confirm your cover before your visit.',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Occupational health for your workforce',
                'category' => 'Corporate',
                'excerpt' => 'Pre-employment medicals, fitness-to-work and driver\'s examinations, wellness programmes and employee screening — arranged for businesses and organisations of any size.',
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($articles as $a) {
            Article::create($a);
        }
    }
}
