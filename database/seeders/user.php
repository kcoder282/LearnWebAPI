<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user extends Seeder
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
                'username' => 'admin',
                'email' => 'ucduc20@gmail.com',
                'password' => bcrypt("123456"),
                'name' => 'Trần Thanh Khan',
                'birth' => '2000-03-25',
                'sex' => true,
                'type' => 1
            ],
            [
                'username' => 'thanhkhan',
                'email' => 'k.coder.282@gmail.com',
                'password' => bcrypt("123456"),
                'name' => 'Trần Thanh Khan',
                'birth' => '2000-03-25',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'thaihoang123',
                'email' => 'hoangthai123@gmail.com',
                'password' => bcrypt("11223344"),
                'name' => 'Hoàng Văn Thái',
                'birth' => '2000-05-10',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'dthanhnhan',
                'email' => 'dtnhan_19th2@student.agu.edu.vn',
                'password' => bcrypt("112233"),
                'name' => 'Đoàn Thanh Nhân',
                'birth' => '2000-03-20',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'nguyenha123',
                'email' => 'hanguyen123@gmail.com',
                'password' => bcrypt("654321"),
                'name' => 'Nguyễn Thị Hạ',
                'birth' => '2000-10-10',
                'sex' => false,
                'type' => 2
            ],
            [
                'username' => 'thiquyen123',
                'email' => 'thiquyen321@gmail.com',
                'password' => bcrypt("111222"),
                'name' => 'Lê Thì Quyên',
                'birth' => '2000-05-15',
                'sex' => false,
                'type' => 2
            ],
            [
                'username' => 'lthaithanh12',
                'email' => 'ltthanh12@gmail.com',
                'password' => bcrypt("333444"),
                'name' => 'Lê Thái Thành',
                'birth' => '2000-12-20',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'lamthanhnam123',
                'email' => 'lamthanhnam123@gmail.com',
                'password' => bcrypt("654321"),
                'name' => 'Lâm Thành Nam',
                'birth' => '2000-11-10',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'thainguyennguyen',
                'email' => 'nthainguyen123@gmail.com',
                'password' => bcrypt("123456"),
                'name' => 'Nguyễn Thái Nguyên',
                'birth' => '2000-06-23',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'dinhlam123',
                'email' => 'lamvandinh123@gmail.com',
                'password' => bcrypt("112233"),
                'name' => 'Lâm Văn Đinh',
                'birth' => '2000-08-08',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'kieuhoa123',
                'email' => 'kieuhoa123@gmail.com',
                'password' => bcrypt("111111"),
                'name' => 'Phạm Kiều Hoa',
                'birth' => '2000-12-01',
                'sex' => false,
                'type' => 2
            ],
            [
                'username' => 'hoanthanh123',
                'email' => 'quachhoangthanh@gmail.com',
                'password' => bcrypt("666666"),
                'name' => 'Quách Hoàn Thành',
                'birth' => '2000-09-25',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'phuckhaole',
                'email' => 'phuckhao123@gmail.com',
                'password' => bcrypt("333444"),
                'name' => 'Lê Phúc Khảo',
                'birth' => '2000-12-23',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'hoangle2000',
                'email' => 'hoang2000ag@gmail.com',
                'password' => bcrypt("987654"),
                'name' => 'Lê Thanh Hoàng',
                'birth' => '2000-04-11',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'vyphan123',
                'email' => 'vypham123@gmail.com',
                'password' => bcrypt("666666"),
                'name' => 'Phan Thùy Vy',
                'birth' => '2000-01-20',
                'sex' => false,
                'type' => 2
            ],
            [
                'username' => 'bichtuyen123',
                'email' => 'bichtuyen123@gmail.com',
                'password' => bcrypt("999999"),
                'name' => 'Trần Bích Tuyên',
                'birth' => '2000-11-26',
                'sex' => false,
                'type' => 2
            ],
            [
                'username' => 'minhduc20000',
                'email' => 'minhduc20000ag@gmail.com',
                'password' => bcrypt("2000ag"),
                'name' => 'Dương Minh Đức',
                'birth' => '2000-09-15',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'khanhnguyenhcm',
                'email' => 'khanhnguyenhcm@gmail.com',
                'password' => bcrypt("987654"),
                'name' => 'Nguyễn Thành Khanh',
                'birth' => '2000-03-05',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'thanhtam0505',
                'email' => 'thanhtam2000@gmail.com',
                'password' => bcrypt("050500"),
                'name' => 'Lê Thành Tâm',
                'birth' => '2000-05-05',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'xuyenvietfulltime',
                'email' => 'dixuyenviet@gmail.com',
                'password' => bcrypt("xuyenviet"),
                'name' => 'Vũ Xuyên Việt',
                'birth' => '2000-10-31',
                'sex' => true,
                'type' => 2
            ],
            [
                'username' => 'thuyduong123',
                'email' => 'thuyduong123@gmail.com',
                'password' => bcrypt("555555"),
                'name' => 'Đặng Thùy Dương',
                'birth' => '2000-02-28',
                'sex' => false,
                'type' => 2
            ],
            [
                'username' => 'nguyentrangag',
                'email' => 'nguyentrangag@gmail.com',
                'password' => bcrypt("888888"),
                'name' => 'Nguyễn Quỳnh Trang',
                'birth' => '2000-08-27',
                'sex' => false,
                'type' => 2
            ]
        ];
        foreach ($data as $dt) {
            DB::table('users')->insert($dt);
        }
    }
}
