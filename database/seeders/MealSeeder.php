<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Meal;
use App\Models\MealTranslation;
use App\Models\Language;
use App\Models\Tag;
use App\Models\Ingredient;
use App\Models\Category;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Meal::factory()
                ->trashed()
                ->count(rand(5, 10))
                ->create()
                ->each(function ($meal){
                    $meal->tags()->attach(Tag::all()->random(rand(1, 5)));
                    $meal->ingredients()->attach(Ingredient::all()->random(rand(1, 5)));
                    $languages = Language::pluck('locale');
                    foreach($languages as $language)
                    {
                        MealTranslation::factory()->state([
                            'locale' => $language,
                            'meal_id' => $meal
                        ])->create();
                    }
                });
            
                Meal::factory()
                ->count(rand(5, 10))
                ->create()
                ->each(function ($meal){
                    $meal->tags()->attach(Tag::all()->random(rand(1, 5)));
                    $meal->ingredients()->attach(Ingredient::all()->random(rand(1, 5)));
                    $languages = Language::pluck('locale');
                    foreach($languages as $language)
                    {
                        MealTranslation::factory()->state([
                            'locale' => $language,
                            'meal_id' => $meal
                        ])->create();
                    }
                });
                Meal::factory()
                ->count(rand(5, 10))
                ->state([
                    'updated_at' => fake()->dateTimeBetween(now(), '+2 weeks')
                ])
                ->create()
                ->each(function ($meal){
                    $meal->tags()->attach(Tag::all()->random(rand(1, 5)));
                    $meal->ingredients()->attach(Ingredient::all()->random(rand(1, 5)));
                    $languages = Language::pluck('locale');
                    foreach($languages as $language)
                    {
                        MealTranslation::factory()->state([
                            'locale' => $language,
                            'meal_id' => $meal
                        ])->create();
                    }
                });
            
    }
}
