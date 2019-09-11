<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->Insert([
        	'name' => 'Kasir',
        	'email' => 'kasir@mediatama.com',
        	'level' => 'Kasir',
        	'password' => Hash::make('123456')
        ]
        );
    }
}
