<?php

namespace App\Http\Controllers;

use App\Models\cmt_blogs;
use App\Models\cmt_lessons;
use App\Models\cmt_topics;
use App\Models\like_blogs;
use App\Models\like_lessons;
use App\Models\like_topics;
use App\Models\User;
use Illuminate\Http\Request;

class comment extends Controller
{
    public function list($type, $id_lesson){
        if ($type === 'lesson') {
            $cmt = cmt_lessons::where("id_lesson", $id_lesson)
            ->where('id_cmt', null)->orderBy('id', 'DESC')->get();
            $data = [];
            foreach ($cmt as $item) {
                $cm = [];
                $c = cmt_lessons::where("id_cmt", $item->id)->get();
                foreach ($c as $i) {
                    $cm[] = [
                        'id'=>$i->id,
                        'user' => User::item($i->id_user),
                        'like' => like_lessons::where('id_cmt', $i->id)->count(),
                        'mlike'=> like_lessons::where('id_user', $item->id_user)->where('id_cmt', $i->id)->count() === 1,
                        'content' => $i->content,
                    ];
                }
                $data[] = [
                    'id' => $item->id,
                    'user' => User::item($item->id_user),
                    'like'=> like_lessons::where('id_cmt', $item->id)->count(),
                    'mlike'=>like_lessons::where('id_user',$item->id_user)->where('id_cmt', $item->id)->count()===1,
                    'content' => $item->content,
                    'cmt' => $cm
                ];
            }
            return $data;
        } 
        elseif ($type === 'topic') {
            $cmt = cmt_topics::where("id_topic", $id_lesson)
            ->where('id_cmt', null)->orderBy('id', 'DESC')->get();
            $data = [];
            foreach ($cmt as $item) {
                $cm = [];
                $c = cmt_topics::where("id_cmt", $item->id)->get();
                foreach ($c as $i) {
                    $cm[] = [
                        'id' => $i->id,
                        'user' => User::item($i->id_user),
                        'like' => like_topics::where('id_cmt', $i->id)->count(),
                        'mlike' => like_topics::where('id_user', $item->id_user)->where('id_cmt', $i->id)->count() === 1,
                        'content' => $i->content,
                    ];
                }
                $data[] = [
                    'id' => $item->id,
                    'user' => User::item($item->id_user),
                    'like' => like_topics::where('id_cmt', $item->id)->count(),
                    'mlike' => like_topics::where('id_user', $item->id_user)->where('id_cmt', $item->id)->count() === 1,
                    'content' => $item->content,
                    'cmt' => $cm
                ];
            }
            return $data;
        } elseif ($type === 'blog') {
            $cmt = cmt_blogs::where("id_blog", $id_lesson)
                ->where('id_cmt', null)->orderBy('id', 'DESC')->get();
            $data = [];
            foreach ($cmt as $item) {
                $cm = [];
                $c = cmt_blogs::where("id_cmt", $item->id)->get();
                foreach ($c as $i) {
                    $cm[] = [
                        'id' => $i->id,
                        'user' => User::item($i->id_user),
                        'like' => like_blogs::where('id_cmt', $i->id)->count(),
                        'mlike' => like_blogs::where('id_user', $item->id_user)->where('id_cmt', $i->id)->count() === 1,
                        'content' => $i->content,
                    ];
                }
                $data[] = [
                    'id' => $item->id,
                    'user' => User::item($item->id_user),
                    'like' => like_blogs::where('id_cmt', $item->id)->count(),
                    'mlike' => like_blogs::where('id_user', $item->id_user)->where('id_cmt', $item->id)->count() === 1,
                    'content' => $item->content,
                    'cmt' => $cm
                ];
            }
            return $data;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->list($_REQUEST['type'],$_REQUEST['id_lesson']);
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
        if($request->type==='lesson'){
            if($request->id == -1)
            {
                $cmt = new cmt_lessons();
                $cmt->id_user = $user['id'];
                $cmt->id_cmt = $request->id_cmt;
                $cmt->id_lesson = $request->id_lesson;
                $cmt->content = $request->content;
            }
            else
            {
                $cmt = cmt_lessons::find($request->id);
                $cmt->content = $request->content;
            }
            $cmt->save();
        }else
        if ($request->type === 'topic') {
            if ($request->id == -1) {
                $cmt = new cmt_topics();
                $cmt->id_user = $user['id'];
                $cmt->id_cmt = $request->id_cmt;
                $cmt->id_topic = $request->id_lesson;
                $cmt->content = $request->content;
            } else {
                $cmt = cmt_topics::find($request->id);
                $cmt->content = $request->content;
            }
            $cmt->save();
        }else
        if ($request->type === 'blog') {
            if ($request->id == -1) {
                $cmt = new cmt_blogs();
                $cmt->id_user = $user['id'];
                $cmt->id_cmt = $request->id_cmt;
                $cmt->id_blog = $request->id_lesson;
                $cmt->content = $request->content;
            } else {
                $cmt = cmt_blogs::find($request->id);
                $cmt->content = $request->content;
            }
            $cmt->save();
        }
        return $this->list($request->type, $request->id_lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::user();
        if ($_REQUEST['type'] === 'lesson') {
            $like = like_lessons::where('id_user', $user['id'])
            ->where('id_cmt',$id)->first();
            if($like===null)
            {
                $like = new like_lessons();
                $like->id_user = $user['id'];
                $like->id_cmt = $id;
                $like->save();
            }else{
                $like->delete();
            }
        }
        if ($_REQUEST['type'] === 'topic') {
            $like = like_topics::where('id_user', $user['id'])
                ->where('id_cmt', $id)->first();
            if ($like === null) {
                $like = new like_topics();
                $like->id_user = $user['id'];
                $like->id_cmt = $id;
                $like->save();
            } else {
                $like->delete();
            }
        }
        if ($_REQUEST['type'] === 'blog') {
            $like = like_blogs::where('id_user', $user['id'])
                ->where('id_cmt', $id)->first();
            if ($like === null) {
                $like = new like_blogs();
                $like->id_user = $user['id'];
                $like->id_cmt = $id;
                $like->save();
            } else {
                $like->delete();
            }
        }
        return $this->list($_REQUEST['type'], $_REQUEST['id_lesson']);
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
        if($_REQUEST['type']==='lesson')
        {
            cmt_lessons::find($id)->delete();
        }
        if ($_REQUEST['type'] === 'topic') {
            cmt_topics::find($id)->delete();
        }
        if ($_REQUEST['type'] === 'blog') {
            cmt_blogs::find($id)->delete();
        }
        return $this->list($_REQUEST['type'],$_REQUEST['id_lesson']);
    }
}
