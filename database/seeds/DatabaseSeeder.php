<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('users')->insert([
	            'name' => str_random(10),
	            'surname' => str_random(10),
	            'email' => str_random(10).'@gmail.com',
	            'sex' => 'M',
	            'born' => '2017-12-12',
	            'job' => str_random(10),
	            'relation' => str_random(10),
	            'image' => '0',
	            'password' => bcrypt('secret')
	        ]);
    	}
    	foreach (range(1,2) as $index) {
	        DB::table('conversations')->insert([
	        	'tipo' => 1,
	            'created_at' => NULL,
	            'updated_at' => NULL
	        ]);
    	}
    }
}
