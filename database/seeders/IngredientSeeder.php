<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\Language;
use App\Models\IngredientTranslation;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ingredient::factory()
            ->count(rand(5, 10))
            ->create()
            ->each(function ($ingredient){
                $languages = Language::pluck('locale');
                foreach($languages as $language)
                {
                    IngredientTranslation::factory()->state([
                        'locale' => $language,
                        'ingredient_id' => $ingredient
                    ])->create();
                }
            });
    }
}
