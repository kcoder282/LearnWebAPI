<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    use HasFactory;
    /**
     * Return data API list Courses
     * 
     * 
     */
    public static function list(){// get list course
        $list = self::all();
        foreach($list as $item)
        {
            // Every $item is data a Course
            $data['id'] = $item->id;
            $data['name'] = $item->name;
            $data['description'] = $item->description;
            $data['price'] = $item->price;
            $data['evaluate'] = $item->avg_evaluate;
            $data['status'] = $item->status;
            $data['img'] = $item->img;
            $data['member'] = regis_courses::
                    where('id_course',$item->id)
                    ->count('id_course');
            $result[] = (object) $data;
        }
        return $result ?? [];
    }
    public function member(){// get list member of course
        $list = regis_courses::select(['id_user', 'sumpoint','created_at'])->where('id_course',$this->id)->get();
        foreach($list as $item)
        {
            $user = User::find($item->id_user);
            $data['id'] = $user->id;
            $data['avata'] = $user->avata;
            $data['name'] = $user->name;
            $data['sex'] = $user->sex;
            $data['type'] = $user->type;
            $data['point'] = $item->sumpoint;
            $data['date_regis'] = $item->created_at;
            $result[] = (object) $data;
        }
        return $result ?? [];
    }
    public function member_evaluate(){ // get list member evaluated for couse
        $list = regis_courses::select(['id_user', 'evaluate'])->where([['id_course','=',$this->id],['evaluate','<>',null]])->get();
        foreach ($list as $item) {
            $user = User::find($item->id_user);
            $data['id'] = $user->id;
            $data['avata'] = $user->avata;
            $data['name'] = $user->name;
            $data['sex'] = $user->sex;
            $data['type'] = $user->type;
            $data['evaluate'] = $item->evaluate;
            $result[] = (object) $data;
        }
        return $result ?? [];
    }
    public function chapters() {// get list chapters
        $list = chapters::where('id_course',$this->id)->orderBy('name')->get();
        foreach($list as $item)
        {
            $data['id'] = $item->id;
            $data['name'] = $item->name;
            $data['number_lesson'] = lessons::where('id_chapter',$item->id)->count('id');
            $result[] = (object) $data;
        }
        return $result ?? [];
    }
}
