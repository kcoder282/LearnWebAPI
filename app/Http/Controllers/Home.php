<?php

namespace App\Http\Controllers;

use App\Models\blogs;
use App\Models\courses;
use App\Models\lessons;
use App\Models\topics;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = topics::orderBy('id', 'DESC')->limit(5)->get();
        $data = [];
        foreach ($topics as $value) {
            $content = json_decode(Storage::get('topics/' . $value->content));
            $course = courses::where('id', $value->id_course)->get(['color', 'key'])->first();
            $data[] = [
                'id'=>$value->id,
                'color'=> count($content->img) === 0,
                'key'=> $course->key,
                'img'=> count($content->img)===0? $course->color:$content->img[0],
                'content'=> $content->content,
            ];
        }
        $blog = blogs::orderBy('id', 'DESC')->limit(5)->get();
        $blogs = [];
        foreach ($blog as $value) {
            $tmp = json_decode(Storage::get($value->content));
            $blogs[] = [
                'id'=>$value->id,
                'name'=>$tmp->name,
                'img'=>$tmp->img,
                'description'=>$tmp->description
            ];
        }
        return [
            'content'=> json_decode(Storage::get('home.json')),
            'courses'=> courses::orderBy('id','DESC')->limit(5)->get(),
            'blogs'=> $blogs,
            'topics'=> $data,
            'info'=>[
                'user'=>User::count(),
                'courses'=>courses::count(),
                'lessons'=>lessons::count(),
                'blogs'=>blogs::count()
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =
        [
            "name" => $request->name??"",
            "content" => $request->content??"",
            "content1"=>$request->content1??"",
            "content2"=>$request->content2??"",
            "email" => $request->email??"",
            "sdt" => $request->sdt??"",
        ];
        return Storage::put("home.json", json_encode($data));
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
        //
    }
}
