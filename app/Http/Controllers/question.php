<?php

namespace App\Http\Controllers;

use App\Models\a_quizs;
use App\Models\a_tests;
use App\Models\answer;
use App\Models\question as ModelsQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class question extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ModelsQuestion::list($_REQUEST['id']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::user();
        if($request->type==='qz')
        {
            $as = answer::where('id_user', $user['id'])->where('id_question', $request->id)->first();
            if (!$as === null) {
                return 1;
            }
        }

        if($request->role==='answer')
        {
            $question = ModelsQuestion::find($request->id);

            if($request->type==='cd')
            {
                $res = [];
                if (answer::compile($request->code) === null) {
                    try {
                    answer::where('id_user',$user['id'])
                    ->where('id_question',$question->id)->delete();
                    } catch (\Throwable $th) {}
                    $as = new answer();
                    $as->id_user = $user['id'];
                    $as->id_question = $question->id;
                    $as->answer = $request->code;
                    $as->save();
                    
                    $answer = a_tests::where('id_question', $question->id)->get();
                    foreach($answer as $item)
                    {
                        $output = answer::RunCode($item->input);
                        $res[] = [
                            'answer'=>$item->input,
                            'output'=> $output,
                            'check'=> $item->output === $output
                        ];
                    }
                    return $res;
                }
                return $res;
            }else{             
                $answer = a_quizs::where('id_question', $question->id)->get();
                $res = [];
                foreach ($answer as $item) {
                    if ($item->res) $res[] = $item->id;
                }
                if ($res === $request->answer) {
                    $as = new answer();
                    $as->id_user = $user['id'];
                    $as->id_question = $request->id;
                    $as->answer = Json::encode($res);
                    $as->save();
                    return 1;
                } else {
                    return 0;
                }
            }

        }

        if($request->role==='add' && $user['type']===1)
        {
            if($request->id === -1)
                $question = new ModelsQuestion();
            else
                $question = ModelsQuestion::find($request->id);

            $question->id_lesson = $request->id_lesson;
            $question->type = $request->type;
            $question->question = $request->question;
            $question->save();

            if($question->type==="qz")
            {
                try {
                    a_quizs::where('id_question',$request->id)->delete();
                } catch (\Throwable $th) {}
                $as = [];
                foreach($request->answer as $item)
                {
                    $answer = new a_quizs();
                    $answer->id_question = $question->id;
                    $answer->plan = $item['answer'];
                    $answer->res = $item['check'];
                    $answer->save();
                    if($item['check']) $as[] = $answer->id;
                }
                $answer = answer::where('id_question', $question->id)->get();
                foreach($answer as $item)
                {
                    $item->answer = Json::encode($as);
                    $item->save();
                }
            }else{
                try {
                    a_tests::where('id_question', $request->id)->delete();
                } catch (\Throwable $th) {}

                if(answer::compile($request->code)===null)
                {
                    foreach($request->answer as $item)
                    {
                        $at = new a_tests();
                        $at->id_question = $question->id;
                        $at->input = $item['answer']??'';
                        $at->output = answer::RunCode($item['answer']??'');
                        $at->save();
                    }
                }
            }
            return ModelsQuestion::list($request->id_lesson);
        }else
        return "require login";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ModelsQuestion::find($id);
        if(User::user()['type']===1)
            $data->delete();
        return ModelsQuestion::list($data->id_lesson);
    }
    public function test(Request $request){
        $data = [];
        $error = answer::compile($request->code);
        if($error===null)
        {
            foreach ($request->input as $item) {
                $data[] = answer::RunCode($item['answer'] ?? '');
            }
            unlink('tmpcodec.exe');
        }

        return ['error'=> $error, 'data'=> $data];
    }
}
