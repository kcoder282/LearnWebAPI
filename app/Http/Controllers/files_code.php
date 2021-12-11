<?php

namespace App\Http\Controllers;

use App\Models\files;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class files_code extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = files::where("id_user", User::user()['id'])->get();
        $data=[];
        foreach($file as $item)
        {
            $tmp = json_decode(Storage::get($item->name));
            $data[] = [
                'id'=>$tmp->id,
                'name'=>$tmp->name
            ];
        }
        return $data;  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = User::user()['id'];
        $data = [
            'name'=>$request->name??"",
            'code'=>$request->code??"",
        ];
        $name = 'code/_'.$request->name.'_'.$id.'.json';
        Storage::put($name, json_encode($data));
        $file = new files();
        $file->name = $name;
        $file->id_user = $id;
        $file->save();
        return $file;
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
