<?php

use Illuminate\Database\Seeder;

class DefinitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create(\App\Definition::class, [], 100);
    }
}
