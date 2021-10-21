<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class a_quizs extends Seeder
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
                'id_question' => 1,
                'plan' => 'Đầu Thập niên 90',
                'res' => false
            ],
            [
                'id_question' => 1,
                'plan' => 'Đầu Thập niên 80',
                'res' => false
            ],
            [
                'id_question' => 1,
                'plan' => 'Đầu Thập niên 70',
                'res' => true
            ],
            [
                'id_question' => 1,
                'plan' => 'Đầu Thập niên 60',
                'res' => false
            ],

            [
                'id_question' => 2,
                'plan' => 'Ngôn ngữ C có thể chạy trên Unix',
                'res' => true
            ],
            [
                'id_question' => 2,
                'plan' => 'Ngôn ngữ C Không thể viết Web',
                'res' => false
            ],
            [
                'id_question' => 2,
                'plan' => 'Ngôn ngữ C có thể viết ra các phần mềm giao diện',
                'res' => true
            ],
            [
                'id_question' => 2,
                'plan' => 'C chỉ chạy được trên màng hình console',
                'res' => false
            ],
            [
                'id_question' => 2,
                'plan' => 'C chỉ là tên gọi khác của assembly',
                'res' => false
            ]
        ];

        foreach ($data as $item)
            DB::table('a_quizs')->insert($item);
    }
}
