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
            ['id' => 0, 'name' => 'process'],
            ['id' => 1, 'name' => 'sold'],
        ]);
    }
}
