<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lessons extends Model
{
    use HasFactory;
    public function questions()
    {
        $question = question::where('id_lesson', $this->id)->get();
        foreach ($question as $it) {
            $plan = [];
            if ($it->type == 'qz') {
                $re = a_quizs::where('id_question', $it->id)
                    ->select(['id', 'plan', 'res'])->get();
                $count = 0;
                foreach ($re as $item) {
                    $temp['id'] = $item->id;
                    $temp['plan'] = $item->plan;
                    $plan[] = (object) $temp;
                    if ($item->res == true) {
                        $count++;
                    }
                }
                if ($count > 0) {
                    $data['id'] = $it->id;
                    $data['question'] = $it->question;
                    $data['type'] = ($count == 1) ? 'single' : 'multi';
                    $data['plan'] = $plan;
                    $result[] = (object) $data;
                }
            } else {
                $data['id'] = $it->id;
                $data['question'] = $it->question;
                $data['type'] = 'code';
                $code = explode(':', $it->model);
                $data['langues'] = $code[0];
                $data['model'] = $code[1];

                $result[] = (object) $data;
            }
        }
        return $result ?? [];
    }
    public static function list($id)
    {
        $list = self::where('id_course', $id)->orderBy('index')->get();
        foreach ($list as $item) {
            $data['id'] = $item->id;
            $data['name'] = $item->name;
            $data['like'] = like_lessons::where('id_lesson', $item->id)->count();
            $data['cmt'] = cmt_lessons::where('id_lesson', $item->id)->count();
            $data['check'] = processes::where('id_lesson', $item->id)->where('id_user', User::user()['id'])->count() === 1;
            $result[] = $data;
        }
        return $result ?? [];
    }
}
