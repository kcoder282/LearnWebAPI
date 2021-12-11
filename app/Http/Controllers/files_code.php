<?php

namespace App\Http\Controllers;

use App\Models\answer;
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
                'id'=> $item->id,
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
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = files::find($id);
        return json_decode(Storage::get($file->name));
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
        $file = files::find($id);
        $code = json_decode(Storage::get($file->name));
        if($request->name)
        {
            $code->name = $request->name;
            Storage::put($file->name, json_encode($code));
        }else{
            $code->code = $request->code;
            Storage::put($file->name, json_encode($code));
            return $this->test($request);
        }

    }

    public function test(Request $request)
    {
        $error = answer::compile($request->code);
        if ($error === null) {
            $output = answer::RunCode($request->input ?? '');
            unlink('tmpcodec.exe');
        }
        return $error??$output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = files::find($id);
        Storage::delete($file->name);
        $file->delete();
        return $this->index();
    }
}
