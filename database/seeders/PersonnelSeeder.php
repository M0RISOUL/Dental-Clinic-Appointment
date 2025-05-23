<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Personnel;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert personnel data
        Personnel::create([
            'name' => 'Ovielyn Estioco',
            'position' => 'Dental Assistant',
            'description' => 'Experienced dental assistant dedicated to patient care and comfort.',
            'facebook' => 'https://facebook.com/ovielyn.estioco', // Optional
            'twitter' => 'https://twitter.com/ovielyn_estioco', // Optional
            'instagram' => 'https://instagram.com/ovielyn_estioco', // Optional
            'image' => 'images/ovielyn.jpg' 
        ]);

        Personnel::create([
            'name' => 'Jennifer Vanguardia',
            'position' => 'Front Desk Officer',
            'description' => 'Friendly and efficient, ensuring smooth clinic operations.',
            'facebook' => 'https://facebook.com/jennifer.vanguardia', // Optional
            'twitter' => 'https://twitter.com/jennifer_vanguardia', // Optional
            'instagram' => 'https://instagram.com/jennifer_vanguardia', // Optional
            'image' => 'images/jennifer.jpg' // Path to the image file (local or URL)
        ]);

        Personnel::create([
            'name' => 'John Mark Paulo Estioco',
            'position' => 'Dental Assistant',
            'description' => 'Skilled professional with attention to detail.',
            'facebook' => 'https://facebook.com/johnmarkpaulo.estioco', // Optional
            'twitter' => 'https://twitter.com/johnmarkpaulo_estioco', // Optional
            'instagram' => 'https://instagram.com/johnmarkpaulo_estioco', // Optional
            'image' => 'images/johnmark.jpg' // Path to the image file (local or URL)
        ]);

        Personnel::create([
            'name' => 'Kevin Clark Afable',
            'position' => 'Dental Assistant',
            'description' => 'Committed to providing excellent patient support.',
            'facebook' => 'https://facebook.com/kevinclark.afable', // Optional
            'twitter' => 'https://twitter.com/kevinclark_afable', // Optional
            'instagram' => 'https://instagram.com/kevinclark_afable', // Optional
            'image' => 'images/kevin.jpg' // Path to the image file (local or URL)
        ]);
    }
}
