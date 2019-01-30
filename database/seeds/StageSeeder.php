<?php

use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stages')->insert([
            ['id' => 1, 'name' => 'published'],
            ['id' => 2, 'name' => 'in process'],
            ['id' => 3, 'name' => 'sold'],
        ]);
    }
}
