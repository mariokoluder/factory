<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\TagTranslation;
use App\Models\Language;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory()
            ->count(rand(5, 10))
            ->create()
            ->each(function ($tag){
                $languages = Language::pluck('locale');
                foreach($languages as $language)
                {
                    TagTranslation::factory()->state([
                        'locale' => $language,
                        'tag_id' => $tag
                    ])->create();
                }
            });
        
    }
}
