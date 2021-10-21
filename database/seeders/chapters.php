<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class chapters extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
        [
            [
                'id_course'=>1,
                'name'=>'1. Lịch Sử C'
            ],
            [
                'id_course' => 1,
                'name' => '2. Chương Trình Hello World'
            ],
            [
                'id_course' => 1,
                'name' => '3. Nhập xuất trong C'
            ],
            [
                'id_course' => 1,
                'name' => '4. Kiểu dữ liệu'
            ],
            [
                'id_course' => 1,
                'name' => '5. Vòng lập'
            ],
            [
                'id_course' => 1,
                'name' => '6. Cấu trúc rẻ nhánh'
            ],
            [
                'id_course' => 1,
                'name' => '7. Hàm trong C'
            ],
            [
                'id_course' => 1,
                'name' => '8. Thư Viện Math.h'
            ],
            [
                'id_course' => 1,
                'name' => '9. Thư Viện string.h'
            ],
            [
                'id_course' => 2,
                'name' => '1. Lịch Sử Python'
            ],
            [
                'id_course' => 2,
                'name' => '2. Chương Trình Hello World'
            ],
            [
                'id_course' => 2,
                'name' => '3. Nhập xuất trong Python'
            ],
            [
                'id_course' => 2,
                'name' => '4. Kiểu dữ liệu'
            ],
            [
                'id_course' => 2,
                'name' => '5. Vòng lập'
            ],
            [
                'id_course' => 2,
                'name' => '6. Cấu trúc rẻ nhánh'
            ],
            [
                'id_course' => 2,
                'name' => '7. Hàm trong Python'
            ],           
        ];
        foreach ($data as $dt) {
            DB::table('chapters')->insert($dt);
        }
    }
}
