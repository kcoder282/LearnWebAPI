<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class lesson extends Seeder
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
                'id_course' => 1,
                'index'=>1,
                'name' => 'Lịch sử hình thành',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 2,
                'name' => 'Lịch sử phát triển',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 3,
                'name' => 'Xu hướng hướng tại',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 4,
                'name' => 'Tìm hiểu MinGW là gì',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 5,
                'name' => 'Cài Đặt biến môi trường',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 6,
                'name' => 'Cài Đặt IDE phát triển',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 7,
                'name' => 'Biến là gì?',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 8,
                'name' => 'Phạm vi biến?',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 9,
                'name' => 'Hằng số là gì? Ứng dụng hằng số',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 10,
                'name' => 'Cấu trúc rẻ nhánh',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 10,
                'name' => 'Vòng lập for',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_course' => 1,
                'index' => 11,
                'name' => 'Vòng lập while',
                'content' => 'Không co nội dung.'
            ]
        ];

        foreach ($data as $item)
            DB::table('lessons')->insert($item);
    }
}
