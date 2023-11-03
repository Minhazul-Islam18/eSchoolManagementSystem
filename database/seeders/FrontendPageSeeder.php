<?php

namespace Database\Seeders;

use App\Models\FrontendPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrontendPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FrontendPage::updateOrCreate([
            'title' => 'About us',
            'slug' => 'about-us',
            'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'body' => '<h2 class="block text-center text-black py-2 border-b">About us</h2>',
            'meta_description' => 'Lorem ipsum dolor sit amet.',
            'meta_keywords' => 'Lorem, ipsum, dolor, sit, amet.',
            'status' => true
        ]);
        FrontendPage::updateOrCreate([
            'title' => 'Contact us',
            'slug' => 'contact-us',
            'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'body' => '<h2 class="block text-center text-black py-2 border-b">Contact us</h2>',
            'meta_description' => 'Lorem ipsum dolor sit amet.',
            'meta_keywords' => 'Lorem, ipsum, dolor, sit, amet.',
            'status' => true
        ]);
    }
}
