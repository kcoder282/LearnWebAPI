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
                'point' => 50
            ],
            [
                'id_lesson' => 1,
                'question' => 'Những Phát biểu nào sau đây là <strong>Đúng</strong>?',
                'point' => 50
            ]
        ];

        foreach ($data as $item)
            DB::table('questions')->insert($item);
    }
}
