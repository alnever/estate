<?php

use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reasons')->insert([
            ['id' => 0, 'name' => 'other'],
            ['id' => 1, 'name' => 'buy'],
            ['id' => 2, 'name' => 'sell'],
            ['id' => 3, 'name' => 'rent'],
            ['id' => 4, 'name' => 'rent out'],
        ]);
    }
}
