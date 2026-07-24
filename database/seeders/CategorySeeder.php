<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Core Pillar 1: FOTOGRAFI
        $fotografi = Category::create([
            'name' => 'FOTOGRAFI',
            'slug' => 'fotografi',
            'description' => 'Master the art of photography from fundamentals to advanced techniques',
            'parent_id' => null,
            'order' => 1,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Segitiga Exposure',
            'slug' => 'segitiga-exposure',
            'description' => 'Understanding ISO, Aperture, and Shutter Speed relationships',
            'parent_id' => $fotografi->id,
            'order' => 1,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Komposisi Gambar',
            'slug' => 'komposisi-gambar',
            'description' => 'Rule of thirds, leading lines, and visual storytelling',
            'parent_id' => $fotografi->id,
            'order' => 2,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Pencahayaan Studio',
            'slug' => 'pencahayaan-studio',
            'description' => 'Professional lighting setups and techniques',
            'parent_id' => $fotografi->id,
            'order' => 3,
            'is_active' => true,
        ]);

        // Core Pillar 2: VIDEOGRAFI
        $videografi = Category::create([
            'name' => 'VIDEOGRAFI',
            'slug' => 'videografi',
            'description' => 'Cinematic video production and camera techniques',
            'parent_id' => null,
            'order' => 2,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Camera Movement',
            'slug' => 'camera-movement',
            'description' => 'Dynamic camera movements for cinematic storytelling',
            'parent_id' => $videografi->id,
            'order' => 1,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Shot Framing & Angle',
            'slug' => 'shot-framing-angle',
            'description' => 'Professional shot types, framing, and camera angles',
            'parent_id' => $videografi->id,
            'order' => 2,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Manajemen Produksi',
            'slug' => 'manajemen-produksi',
            'description' => 'Video production workflow and project management',
            'parent_id' => $videografi->id,
            'order' => 3,
            'is_active' => true,
        ]);

        // Core Pillar 3: EDITING
        $editing = Category::create([
            'name' => 'EDITING',
            'slug' => 'editing',
            'description' => 'Professional video editing and post-production',
            'parent_id' => null,
            'order' => 3,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Pacing dan Ritme',
            'slug' => 'pacing-ritme',
            'description' => 'Editing rhythm, pacing, and narrative flow',
            'parent_id' => $editing->id,
            'order' => 1,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Colour Grading & Correction',
            'slug' => 'colour-grading-correction',
            'description' => 'Color science, grading, and color correction techniques',
            'parent_id' => $editing->id,
            'order' => 2,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Sound Design',
            'slug' => 'sound-design',
            'description' => 'Audio editing, sound effects, and mixing',
            'parent_id' => $editing->id,
            'order' => 3,
            'is_active' => true,
        ]);

        // Core Pillar 4: DESIGN
        $design = Category::create([
            'name' => 'DESIGN',
            'slug' => 'design',
            'description' => 'Graphic design principles and visual communication',
            'parent_id' => null,
            'order' => 4,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Prinsip Desain Grafis',
            'slug' => 'prinsip-desain-grafis',
            'description' => 'Fundamental design principles and visual hierarchy',
            'parent_id' => $design->id,
            'order' => 1,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Tipografi & Layout',
            'slug' => 'tipografi-layout',
            'description' => 'Typography, font pairing, and layout composition',
            'parent_id' => $design->id,
            'order' => 2,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Visual Identity',
            'slug' => 'visual-identity',
            'description' => 'Branding, logo design, and visual identity systems',
            'parent_id' => $design->id,
            'order' => 3,
            'is_active' => true,
        ]);
    }
}
