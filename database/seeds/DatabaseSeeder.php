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
    	
        DB::table('users')->insert([
            'name' => 'Matteo',
            'surname' => 'Gemelli',
            'email' => str_random(10).'@gmail.com',
            'sex' => 'M',
            'born' => '2017-12-12',
            'job' => str_random(10),
            'relation' => str_random(10),
            'image' => '0',
            'password' => bcrypt('secret')
	    ]);
        DB::table('users')->insert([
            'name' => 'Franco',
            'surname' => 'Rossi',
            'email' => str_random(10).'@gmail.com',
            'sex' => 'M',
            'born' => '2017-12-12',
            'job' => str_random(10),
            'relation' => str_random(10),
            'image' => '0',
            'password' => bcrypt('secret')
        ]);
        DB::table('users')->insert([
            'name' => 'Gianni',
            'surname' => 'Falco',
            'email' => str_random(10).'@gmail.com',
            'sex' => 'M',
            'born' => '2017-12-12',
            'job' => str_random(10),
            'relation' => str_random(10),
            'image' => '0',
            'password' => bcrypt('secret')
        ]);

    	
		DB::table('friends')->insert([
			'id_utente1' => '1',
			'id_utente2' => '2',
            'type' => '0',
		]);
    	DB::table('friends')->insert([
			'id_utente1' => '1',
			'id_utente2' => '3',
            'type' => '0',
		]);
        DB::table('friends')->insert([
            'id_utente1' => '2',
            'id_utente2' => '3',
            'type' => '0',
        ]);


		DB::table('posts')->insert([
			'group_id' => null,
            'user_id' => '2',
			'body' => 'Qusto è il primo post',
			'photo' => '0',
		]);

        DB::table('posts')->insert([
            'group_id' => null,
            'user_id' => '1',
            'body' => 'Qusto è il secondo post',
            'photo' => '1',
        ]);

        DB::table('posts')->insert([
            'group_id' => null,
            'user_id' => '1',
            'body' => 'Questo è il primo post per il secondo gruppo',
            'photo' => '0',
        ]);


		
    	DB::table('notifies')->insert([
    		'body' => 'Notifica_1',
    		'type' => 'Richiesta d\'amicizia',
    		'from_request' => '2',
    		'from_comment' => NULL,
    		'from_post' => NULL,
    		'from_like' => NULL,
    		'id_utente' => '1',
    	]);
    	DB::table('notifies')->insert([
    		'body' => 'Notifica_2',
    		'type' => 'Notifica da un mi piace su un post',
    		'from_request' => NULL,
    		'from_comment' => '1',
    		'from_post' => '1',
    		'from_like' => NULL,
    		'id_utente' => '2',
    	]);
        

    	foreach (range(1,2) as $index) {
	        DB::table('conversations')->insert([
	        	'tipo' => 1,
	            'created_at' => NULL,
	            'updated_at' => NULL
	        ]);
    	}
    }
}