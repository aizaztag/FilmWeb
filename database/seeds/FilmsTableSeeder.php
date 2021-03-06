<?php

use App\Film;
use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Film::class, 3)->create()->each(function ($film) {
            $film->comments()->save(factory(App\Comment::class)->make());
        });

    }
}
