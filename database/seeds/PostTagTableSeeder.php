<?php

use App\Admin\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ? Importiamo entrambi i model
        $posts = Post::all();
        $tags = Tag::all();

        foreach ($posts as $post) {
            // $randTag = Tag::inRandomOrder()->first()->id;
            // -take(), ->get(), ->random() 
            // ? prendiamo in modo randomico, 3 tag, e ne passiamo in attached l'id data la natura della tabella pivot
            $randTags = Tag::inRandomOrder()->limit(3)->get();
            foreach ($randTags as $tag) {
                
                // tags o posts (in base da dove partiamo),
                // ! va preso con la relazione, quindi tags()!!!
                // ? quando creiamo la relazione, per scrivere all'interno di questa, usiamo attacch()! ->detach() per rimuovere, ->sync() per entrambe
                $post->tags()->attach($tag->id);
                
            }

        }
    }
}
