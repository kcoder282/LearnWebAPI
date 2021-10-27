<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class regis extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'id_user'=>2,
                'id_course'=>1,
                'evaluate'=>5
            ],
            [
                'id_user' => 3,
                'id_course' => 1,
                'evaluate' => 4
            ],
            [
                'id_user' => 4,
                'id_course' => 1,
                'evaluate' => 5
            ],
            [
                'id_user' => 5,
                'id_course' => 1,
                'evaluate' => 4
            ],
            [
                'id_user' => 6,
                'id_course' => 1,
                'evaluate' => 5
            ],
            [
                'id_user' => 7,
                'id_course' => 1,
                'evaluate' => 5
            ],
            [
                'id_user' => 8,
                'id_course' => 1,
                'evaluate' => 5
            ],
            [
                'id_user' => 9,
                'id_course' => 1,
                'evaluate' => 5
            ],
            [
                'id_user' => 10,
                'id_course' => 1,
                'evaluate' => 5
            ],
            [
                'id_user' => 11,
                'id_course' => 2,
                'evaluate' => 4
            ],
            [
                'id_user' => 12,
                'id_course' => 2,
                'evaluate' => 4
            ],
            [
                'id_user' => 13,
                'id_course' => 1
            ],
            [
                'id_user' => 14,
                'id_course' => 1
            ],
            [
                'id_user' => 15,
                'id_course' => 1
            ],
            [
                'id_user' => 16,
                'id_course' => 2
            ],
            [
                'id_user' => 17,
                'id_course' => 2
            ]

        ];

        foreach ($data as $dt) {
            DB::table('regis_courses')->insert($dt);
        }
    }
}
