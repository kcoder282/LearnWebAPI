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
        [
            [
                'key' => 'C/C++',
                'name' => 'Lập Trình Căn Bản',
                'description' => ' Khóa học này cung cấp cho các bạn các kiến thức nền tảng về lập trình'
            ],
            [
                'key' => 'C/C++',
                'name' => 'Lập Trình Hướng đói tượng',
                'description' => 'Khóa học cung cấp cho bạn các kiến thức về Hướng đối tượng',
                'color' => 'teal;indigo'
            ],
            [
                'key' => 'Java',
                'name' => 'Lập Trình Java Căn bản',
                'description' => ' Khóa học này cung cấp cho các bạn các kiến thức nền tảng về lập trình',
                'color' => 'orangered;orange'
            ],
            [
                'key' => 'Python',
                'name' => 'Lập Trình Python căn bản',
                'description' => 'Khóa học cung cấp cho bạn các kiến thức về Hướng đối tượng',
                'color' => 'blue;green'
            ],
            [
                'key' => 'Web FE',
                'name' => 'Lập trình web tĩnh với html và css',
                'description' => 'Khóa học cung cấp cho bạn các kiến thức về Hướng đối tượng',
                'color' => 'violet;#007bff'
            ],
        ];
        foreach($data as $dt)
        {
            DB::table('courses')->insert($dt);
        }
    }
}
