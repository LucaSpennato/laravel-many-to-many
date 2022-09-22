<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Coding',
            'Food',
            'TvSeries',
            'Movies',
            'News',
            'Backend',
            'Frontend',
            'GianGianni',
            'Motosega',
            'ELEZIONI',
        ];

        foreach ($tags as $tag) {
           $newTag = new Tag();

           $newTag->name = $tag;
           $newTag->save();
        }
    }
}
