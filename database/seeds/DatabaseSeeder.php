<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
	            'password' => bcrypt('secret'),
	        ]);
    	}

    	
		DB::table('friends')->insert([
			'id_utente1' => '1',
			'id_utente2' => '2',
		]);
    	DB::table('friends')->insert([
			'id_utente1' => '1',
			'id_utente2' => '3',
		]);
		DB::table('friends')->insert([
			'id_utente1' => '1',
			'id_utente2' => '4',
		]);
		DB::table('friends')->insert([
			'id_utente1' => '2',
			'id_utente2' => '4',
		]);
		DB::table('friends')->insert([
			'id_utente1' => '5',
			'id_utente2' => '1',
		]);
    }
}
