<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class question extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id_lesson' => 1,
                'question' => 'Ngôn ngữ C ra đời vào năm mấy?',
            ],
            [
                'id_lesson' => 1,
                'question' => 'Những Phát biểu nào sau đây là Đúng?',
            ]
        ];

        foreach ($data as $item)
            DB::table('questions')->insert($item);
    }
}
