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
                'id_chapter' => 1,
                'name' => 'Bài 1. Lịch sử hình thành',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_chapter' => 1,
                'id_lesson' => 1,
                'name' => 'Bài 2. Lịch sử phát triển',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_chapter' => 1,
                'id_lesson' => 2,
                'name' => 'Bài 3. Xu hướng hướng tại',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_chapter' => 2,
                'id_lesson' => 3,
                'name' => 'Bài 1. Tìm hiểu MinGW là gì',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_chapter' => 2,
                'id_lesson' => 4,
                'name' => 'Bài 2. Cài Đặt biến môi trường',
                'content' => 'Không co nội dung.'
            ],
            [
                'id_chapter' => 2,
                'id_lesson' => 5,
                'name' => 'Bài 3. Cài Đặt IDE phát triển',
                'content' => 'Không co nội dung.'
            ]
        ];

        foreach ($data as $item)
            DB::table('lessons')->insert($item);
    }
}
