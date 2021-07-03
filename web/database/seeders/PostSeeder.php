<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfPosts = 100;
        $faker = Faker::create();
        $postStatus = array(
            'Draft',
            'Published'
        );

        for($i = 0; $i<$numberOfPosts; $i++){
            $post = Post::create([
                'title' => $faker->words(random_int(5, 10), true),
                'description' => $faker->sentences(random_int(1, 5), true),
                'status' => $postStatus[ random_int(0,count($postStatus) - 1) ],
                'content' => $faker->text(),
                'view' => random_int(0, 1000),
            ]);
        }
    }
}
