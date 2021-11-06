<?php

namespace App\Http\Controllers;

class main extends Controller
{
    public function menu(){
        return [
            ['name' => 'Home', 'path' => '/'],
            ['name' => 'Courses', 'path' => '/courses'],
            ['name' => 'Topics', 'path' => '/topics'],
            ['name' => 'Blogs', 'path' => '/blogs'],
            ['name' => 'files', 'path' => '/files'],
        ];
    }
}
