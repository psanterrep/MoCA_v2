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
        // $this->call(UsersTableSeeder::class);
        // Insert User Types
       	DB::table('UserTypes')->insert([	
        	'name' => "admin",
        ]);
        DB::table('UserTypes')->insert([	
        	'name' => "doctor",
        ]);
        DB::table('UserTypes')->insert([	
        	'name' => "patient",
        ]);


        // Unsupervised
       	DB::table('ConsultationTypes')->insert([	
        	'name' => "supervised",
        ]);
        DB::table('ConsultationTypes')->insert([	
        	'name' => "unsupervised",
        ]);

        //	Test
		DB::table('Tests')->insert([
			'version' => 1,
				'name' =>'Letters2Back',
			'active' => true,
			'path' =>'Letters2Back_v1.html',
		]);
        
 		// User
 		DB::table('Users')->insert([
 			'username' => 'admin',
 			'email' => 'pascal.santerre.perras@gmail.com',
 			'password' => bcrypt('adminSecure'),
 			'idUserType' => 1,
		]);
    }
}
