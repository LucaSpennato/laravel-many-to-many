<?php

use App\User;
use App\Admin\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
// ? preso per lo slug, controlla i docs!
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // ? Chiamo user, lo salvo in users
        $users = User::all();

        for ($i=0; $i < 200; $i++) { 
            $newpost = new Post();
            $newpost->title = $faker->realText(35);
            // ? Prendiamo users e lo inseriamo nelo user is randomicamente con il faker random element
            $newpost->user_id = $faker->randomElement($users)->id;
            $newpost->post_image = $faker->imageUrl();
            $newpost->post_date = $faker->dateTimeThisYear();
            $newpost->post_content = $faker->paragraphs(5, true);
            $newpost->slug = Str::slug($newpost->title . ' ' . $i, '-' );
            $newpost->save();
        }
        
    }
}
