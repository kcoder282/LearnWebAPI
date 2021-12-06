<?php

namespace App\Http\Controllers;

use App\Models\cmt_topics;
use App\Models\courses;
use App\Models\like_topics;
use App\Models\topics as ModelsTopics;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class topics extends Controller
{
    public function like(Request $request)
    {
        $user = User::user();
        if ($user['id'] !== 0) {
            $like = new like_topics();
            $like->id_user = $user['id'];
            $like->id_topic = $request->id;
            $like->save();
            return like_topics::where('id_topic', $request->id)->count();
        } else return "require";
    }
    public function unlike(Request $request)
    {
        $user = User::user();
        if ($user['id'] !== 0) {
            $like = like_topics::where('id_user', $user['id'])
            ->where('id_topic', $request->id)->first();
            $like->delete();
            return like_topics::where('id_topic', $request->id)->count();
        } else return ["messen" => "require"];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = ModelsTopics::orderBy('id','DESC')->paginate(10);
        $data = [];
        foreach ($topics as $value) {
            $course = courses::find($value->id_course);
            $data[] = [
                'course'=>[
                    'id'=>$course->id,
                    'name'=>$course->name,
                    'color'=>$course->color,
                    'key'=>$course->key
                ],
                'id'=>$value->id,
                'like'=> like_topics::where('id_topic', $value->id)->count(),
                'mlike'=>like_topics::where('id_topic', $value->id)->where('id_user', User::user()['id'])->count()===1,
                'time'=> date('H:i - d/m/Y', strtotime($value->created_at)),
                'user'=>User::item($value->id_user),
                'cmt'=> cmt_topics::where('id_topic',$value->id)->count(),
                'content'=> json_decode(Storage::get('topics/'.$value->content))
            ];
        }
        return ['topics'=>$data,'paginate'=>$topics->toArray()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topic = new ModelsTopics();
        $topic->id_course = $request->id_course;
        $topic->id_user = User::user()['id'];
        $name = 'data_topic_'. Str::uuid()->toString().'.json';
        $data = [
            'content'=> $request->content,
            'img'=> $request->img
        ];
        Storage::put("topics/$name", json_encode($data));
        $topic->content = $name;
        $topic->save();
        $course = courses::find($topic->id_course);
        return [
            'course' => [
                'id' => $course->id,
                'name' => $course->name,
                'color' => $course->color,
                'key' => $course->key
            ],
            'id' => $topic->id,
            'like' => 0,
            'mlike' => false,
            'time' => date('H:i - d/m/Y', strtotime($topic->created_at)),
            'user' => User::item($topic->id_user),
            'cmt' => 0,
            'content' => json_decode(Storage::get('topics/' . $topic->content))
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $topic = ModelsTopics::find($id);
        Storage::delete('topics/'.$topic->content);
        $topic->delete();
    }
}
