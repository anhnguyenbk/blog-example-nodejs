<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory as Faker;
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
        $numberOfCategory = 4;
        $numberOfSubCategory1 = 5;

        $faker = Faker::create();
        /*  insert categories   */
        for($i = 0; $i<$numberOfCategory; $i++){
            $category = Category::create([
                'name' => $faker->words(3, true),
                'slug' => $faker->words(3, true)
            ]);

            for($j = 0; $j<$numberOfSubCategory1; $j++){
                Category::create([
                    'name' => $faker->words(3, true),
                    'slug' => $faker->words(3, true),
                    'parent_id' => $category->id
                ]);
            }
        }
    }
}
