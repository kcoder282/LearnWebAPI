<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;
    public static function list($id)
    {
        $user = User::user();
        $data = [];
        $qs = self::where('id_lesson', $id)->get();

        foreach ($qs as $item) {
            $res = answer::where('id_user', $user['id'])->where('id_question', $item->id)->first();
            
            $count = 0;

            if($item->type==='qz')
            {

                $answer = a_quizs::where('id_question', $item->id)->get();
                $as = [];
                foreach ($answer as $value) {

                    if ($value->res)
                    $count++;

                    $as[] = [
                        'id' => $value->id,
                        'answer' => $value->plan,
                        'check' => $user['type'] === 1 ? $value->res : false,
                    ];
                }
            }else{
                $answer = a_tests::where('id_question', $item->id)->get();
                $as = [];
                foreach ($answer as $value) {
                        $as[] = [
                        'id' => $value->id,
                        'answer' => $value->input,
                        'check'=>false,
                        'output' => $value->ouput
                    ];
                }
            }

            $data[] = [
                'id' => $item->id,
                'question' => $item->question,
                'type' => $item->type,
                'multi' => $count > 1,
                'answer' => $as,
                'res' => $res === null ? '' : $res->answer
            ];
        }
        return $data;
    }
}
