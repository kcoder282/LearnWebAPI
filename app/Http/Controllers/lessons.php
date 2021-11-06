<?php

namespace App\Http\Controllers;

use App\Models\courses;
use App\Models\lessons as ModelsLessons;
use App\Models\User;
use Database\Seeders\lesson;
use Illuminate\Http\Request;

class lessons extends Controller
{
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
        $item->id_course = $request->id_course;
        $item->content = 'Không có dữ liệu';
        $item->index = ModelsLessons::where('id_course',$request->id_course)->count();
        $u = User::user();
        if($u['id']!==0) if($u['type']===1) $item->save();
        return courses::item($request->id_course);
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
        $lesson = ModelsLessons::find($id);
        if(isset($request->name))
            $lesson->name = $request->name;
        if(isset($request->video))
            $lesson->video = $request->video;
        if(isset($request->content))
            $lesson->content = $request->content;
        if(isset($request->index))
            $lesson->index = $request->index;
        if(User::user()['type']===1)
            if($lesson->save()) 
                return $lesson;
        else
            return ['result' => false];
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
