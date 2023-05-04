<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()
            ->count(rand(5, 10))
            ->create()
            ->each(function ($category){
                $languages = Language::pluck('locale');
                foreach($languages as $language)
                {
                    CategoryTranslation::factory()->state([
                        'locale' => $language,
                        'category_id' => $category
                    ])->create();
                }
            });
    }
}
