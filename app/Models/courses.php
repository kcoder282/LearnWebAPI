<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    use HasFactory;
    /**
     * Return data API list Courses
     */
    public static function list()
    { // get list course
        $list = self::all();
        foreach ($list as $item) {
            // Every $item is data a Course
            $data['id'] = $item->id;
            $data['name'] = $item->name;
            $data['description'] = $item->description;
            $data['key'] = $item->key;
            $data['price'] = $item->price ?? 0;
            $data['status'] = $item->status;
            $data['color'] = $item->color;
            $data['chapter'] = chapters::where('id_course',$item->id)->count('id');
            $data['member'] = regis_courses::where('id_course', $item->id)->count('id_course');
            $list = regis_courses::select(['evaluate'])->where([['id_course', '=', $item->id], ['evaluate', '<>', null]])->get();
            $agv_eval = 0;
            $check = false;
            foreach ($list as $e) {
                $agv_eval += $e->evaluate;
                $check = true;
            }
            if ($agv_eval !== 0) $agv_eval = round($agv_eval / (count($list)), 2);
            $data['evaluate'] = ($check) ? $agv_eval : null;

            $result[] = (object) $data;
        }
        return $result ?? [];
    }
    public static function item($id){
        $item = self::find($id);
        $data['id'] = $item->id;
        $data['name'] = $item->name;
        $data['description'] = $item->description;
        $data['key'] = $item->key;
        $data['price'] = $item->price ?? 0;
        $data['status'] = $item->status;
        $data['color'] = $item->color;
        $data['chapter'] = chapters::where('id_course', $item->id)->count('id');
        $data['member'] = regis_courses::where('id_course', $item->id)->count('id_course');
        $list = regis_courses::select(['evaluate'])->where([['id_course', '=', $item->id], ['evaluate', '<>', null]])->get();
        $agv_eval = 0;
        $check = false;
        foreach ($list as $e) {
            $agv_eval += $e->evaluate;
            $check = true;
        }
        if ($agv_eval !== 0) $agv_eval = round($agv_eval / (count($list)), 2);
        $data['evaluate'] = ($check) ? $agv_eval : null;
        $data['regis'] = regis_courses::where([['id_course','=',$item->id], ['id_user', '=', User::user()['id']]])->count() === 1;
        $data['chapterList'] = $item->chapters();
        return $data;
    }
    public function member()
    { // get list member of course
        $list = regis_courses::select(['id_user', 'sumpoint', 'created_at'])->where('id_course', $this->id)->get();
        foreach ($list as $item) {
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
    public function member_evaluate()
    { // get list member evaluated for course
        $list = regis_courses::select(['id_user', 'evaluate'])->where([['id_course', '=', $this->id], ['evaluate', '<>', null]])->get();
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
    public function chapters()
    { // get list chapters
        $list = chapters::where('id_course', $this->id)->orderBy('name')->get();
        foreach ($list as $item) {
            $data['id'] = $item->id;
            $data['name'] = $item->name;
            $data['number_lesson'] = lessons::where('id_chapter', $item->id)->count('id');
            $result[] = (object) $data;
        }
        return $result ?? [];
    }
}
