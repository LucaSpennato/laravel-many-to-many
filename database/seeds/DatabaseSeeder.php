<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            UsersDetailsTableSeeder::class,
            PostSeeder::class,
            // ? in quanto many to many, può andare ovunque
            TagTableSeeder::class,
            // ? data la sua dipendenza sia da post che da tag, andrà necessariamente eseguita dopo queste due!
            PostTagTableSeeder::class,
        ]);
    }
}
