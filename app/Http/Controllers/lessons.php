<?php

namespace App\Http\Controllers;

use App\Models\cmt_lessons;
use App\Models\lessons as ModelsLessons;
use App\Models\like_lessons;
use App\Models\regis_courses;
use App\Models\User;
use Database\Seeders\lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class lessons extends Controller
{
    public function like(Request $request){
        $user = User::user();
        if($user['id']!==0)
        {
            $like = new like_lessons();
            $like->id_user = $user['id'];
            $like->id_lesson = $request->id;
            $like->save();
            return like_lessons::where('id_lesson', $request->id)->count();
        } else return ["messen" => "require"];
    }
    public function unlike(Request $request)
    {
        $user = User::user();
        if ($user['id'] !== 0) {
            $like = like_lessons::where('id_user',$user['id'])
            ->where('id_lesson',$request->id)->first();
            $like->delete();
            return like_lessons::where('id_lesson', $request->id)->count();
        }else return ["messen"=>"require"];
    }
    public function change(Request $request){
        if(User::user()['type']===1)
        {
            $l1 = ModelsLessons::find($request->id1);
            $l2 = ModelsLessons::find($request->id2);

            if ($l1 && $l2) {
                $index = $l1->index;
                $l1->index = $l2->index;
                $l2->index = $index;
                $l1->save();
                $l2->save();
            }
            return ModelsLessons::list($l1->id_course);
        }
        http_response_code('500');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!empty($_REQUEST['id_course']))
        return ModelsLessons::list($_REQUEST['id_course']);
        else return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new ModelsLessons();
        $item->name = $request->name;
        $item->video = $request->video;
        $item->id_course = $request->id_course;
        $item->index = ModelsLessons::where('id_course', $request->id_course)->count()??1;
        if (User::user()['type'] === 1)
         if($item->save()){
            $name = "lesson_" . ($item->id) . ".html";
            Storage::put("lessons/$name", $request->content);
            $item->content = $name;
            $item->save();
            $item->content = Storage::get("lessons/$name");
            return $item;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = ModelsLessons::find($id);
        $id_user = User::user()['id'];
        $regis = regis_courses::where('id_user', $id_user)
        ->where('id_course', $lesson->id_course)->count()!==0;
        return [
            'id' => $lesson->id,
            'id_course' => $lesson->id_course,
            'name'=>$lesson->name,
            'video'=>$regis?$lesson->video??'':'',
            'content' => $regis?Storage::get('lessons/' . $lesson->content):'',
            'like'=>like_lessons::where('id_lesson', $id)->count(),
            'mylike'=> like_lessons::where('id_lesson', $id)->where('id_user', $id_user)->count() === 1,
            'cmt'=> cmt_lessons::where('id_lesson', $id)->count()
        ];
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
        $lesson = ModelsLessons::find($id);
        if(isset($request->name))
            $lesson->name = $request->name;
        if(isset($request->video))
            $lesson->video = $request->video;
        if(isset($request->content))
        {
            Storage::delete('lessons/' . $lesson->content);
            $name = "lesson_$id.html";
            Storage::put("lessons/$name", $request->content);
            $lesson->content = $name;
        }
        if(User::user()['type']===1)
            if($lesson->save())
        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = ModelsLessons::find($id);
        if(User::user()['type']===1 && $lesson){
            Storage::delete('lessons/'.$lesson->content);
            $lesson->delete();
        }
        return ModelsLessons::list($lesson->id_course);
    }
}
