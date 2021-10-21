<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class processes extends Seeder
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
                'id_user'=>1,
                'id_lesson'=>1,
                'check'=>true
            ]
        ];

        foreach ($data as $item)
            DB::table('processes')->insert($item);
    }
}
