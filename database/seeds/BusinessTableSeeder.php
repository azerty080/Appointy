<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('businesses')->insert([
		    [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 1,
                'allow_guests' => 1,
		    ],
		    [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 2,
                'allow_guests' => 1,
            ],
            [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 3,
                'allow_guests' => 1,
            ],
            [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 4,
                'allow_guests' => 1,
            ],
            [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 5,
                'allow_guests' => 1,
            ],
            [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 6,
                'allow_guests' => 1,
            ],
            [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 7,
                'allow_guests' => 1,
            ],
            [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 8,
                'allow_guests' => 1,
            ],
            [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 9,
                'allow_guests' => 1,
            ],
            [
                'name' => 'name',
                'profession' => 'profession',
                'description' => 'description',
                'appointmentduration' => 30,
                'user_id' => 10,
                'allow_guests' => 1,
		    ],
		]);
    }
}
