<?php

namespace App\Http\Controllers;

use App\Models\courses;
use App\Models\User;
use App\Models\regis_courses;
use Illuminate\Http\Request;

class regis extends Controller
{
    public function regis($id){
        $u = User::user();
        if($u['id']!==0)
        {
            $regis = new regis_courses();
            $regis->id_user = $u['id'];
            $regis->id_course = $id;
            $regis->save();
        }
        return courses::list();
    }

    public function evaluate($id,Request $request )
    {
        $u = User::user();
        if ($u['id'] !== 0) {
            $regis = regis_courses::where('id_user', $u['id'])
                 ->where('id_course', $id)->first();
            if($regis)
            {
                $regis->evaluate = $request->evaluate;
                $regis->save();
            }  
        }
        return courses::item($id);
    }

}
