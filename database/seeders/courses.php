<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class courses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =  
        [[
            'name' => 'Khóa học lập trình C++ căn bản',
            'description' => 'Hiện nay, C++ đã là cái tên rất quen thuộc trong ngành lập trình. Mặc dù C++ là ngôn ngữ lập trình đã ra đời khá lâu, nhưng không phải ai cũng có cơ hội để tìm hiểu về nó. Vì vậy, Kteam.',
            'img' => 'https://trungtq.com/wp-content/uploads/2018/12/c-sharp-logo-filled.png'
        ],
        [
            'name' => 'Lập trình Python cơ bản',
            'description' => 'Với mục đích giới thiệu đến mọi người NGÔN NGỮ PYTHON, một ngôn ngữ lập trình khá mới mẻ so với C, C++, Java, PHP ở Việt Nam. Thông qua khóa học LẬP TRÌNH PYTHON CƠ BẢN.',
            'img' => 'https://vietnix.vn/wp-content/uploads/2021/07/python-la-gi.webp'
        ]];
        foreach($data as $dt)
        {
            DB::table('courses')->insert($dt);
        }
    }
}
