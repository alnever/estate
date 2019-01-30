<?php

use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goals')->insert([
            ['id' => 1, 'name' => 'sell'],
            ['id' => 2, 'name' => 'rent'],
        ]);
    }
}
