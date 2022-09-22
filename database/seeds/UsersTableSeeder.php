<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // ! Per non sbattersi troppo nel caso di fresh del DB, creiamo nel seeding manualmente il tutto:
        $myUser = new User();
        $myUser->name = 'Luca';
        $myUser->email = 'lucal@gmail.com';
        // ! Hash::make(), ci permette di criptare le password
        $myUser->password = Hash::make('ciaociaociao');
        $myUser->save();
        for ($i=0; $i < 10; $i++) { 
            $newUser = new User();
            $newUser->name = $faker->userName();
            $newUser->email = $faker->unique()->email();
            $newUser->password = Hash::make($faker->password());
            $newUser->save();
        }
    }
}
