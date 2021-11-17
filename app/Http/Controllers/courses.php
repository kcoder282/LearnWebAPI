<?php

namespace App\Http\Controllers;

use App\Models\courses as ModelsCourses;
use App\Models\User;
use Illuminate\Http\Request;

class courses extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ModelsCourses::list();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new ModelsCourses();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->key = $request->key;
        $item->color = $request->color;
        $item->price = $request->price;
        if (User::user()["type"]==1)
        $item->save();
        return ModelsCourses::list();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ModelsCourses::item($id);
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
        $item = ModelsCourses::find($id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->key = $request->key;
        $item->color = $request->color;
        $item->price = $request->price;
        $item->status = $request->status;
        if (User::user()["type"] == 1)
        $item->save();
        return ModelsCourses::list();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::user()["type"] == 1)
        ModelsCourses::find($id)->delete();
        return ModelsCourses::list();
    }
}
