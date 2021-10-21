<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class chapters extends Model
{
    use HasFactory;
    public function lessons(){// get list chapter
        $list = lessons::where('id_chapter',$this->id)->get();
        foreach($list as $item)
        {
            $process = processes::where([['id_user', '=', Auth::id()], ['id_lesson', '=', $item->id_lesson]])->first()->check ?? false;
            $data['id'] = $item->id;
            $data['name'] = $item->name;
            $data['unlock'] = $item->id_lesson == null || $process;
            $data['like'] = like_lessons::where('id_lesson',$item->id)->count('id');
            $data['cmt'] = cmt_lessons::where('id_lesson',$item->id)->count('id');
            $result[] = (object) $data;
        }
        return $result ?? [];
    }
}
