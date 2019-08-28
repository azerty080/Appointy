<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
		    [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
		    ],
		    [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
            ],
            [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
            ],
            [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
            ],
            [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
            ],
            [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
            ],
            [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
            ],
            [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
            ],
            [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
            ],
            [
                'township' => 'township',
                'address' => 'address',
                'phonenumber' => 'phonenumber',
                'email' => 'email',
                'password' => 'password',
		    ],
		]);
    }
}
