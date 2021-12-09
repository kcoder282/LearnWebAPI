<?php

namespace App\Http\Controllers;

use App\Models\blogs as ModelsBlogs;
use App\Models\cmt_blogs;
use App\Models\like_blogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class blogs extends Controller
{
    public function search()
    {
        $blog = ModelsBlogs::all();
        $list = [];
        foreach($blog as $value)
        {
            $user = User::item($value->id_user)['name'];
            $content = json_decode(Storage::get($value->content));
            if(str_contains(strtolower($content->name), $_REQUEST['search']))
            {
                $list[]=[
                    'id'=>$value->id,
                    'name'=>$content->name,
                    'user_name'=>$user
                ];
            }else
            if(str_contains(strtolower($user), $_REQUEST['search']))
            {
                $list[] = [
                    'id' => $value->id,
                    'name' => $content->name,
                    'user_name' => $user
                ];
            }
        }
        return $list;
    }
    
    public function like(Request $request)
    {
        $user = User::user();
        if ($user['id'] !== 0) {
            $like = new like_blogs();
            $like->id_user = $user['id'];
            $like->id_blog = $request->id;
            $like->save();
            return like_blogs::where('id_blog', $request->id)->count();
        } else return "require";
    }
    public function unlike(Request $request)
    {
        $user = User::user();
        if ($user['id'] !== 0) {
            $like = like_blogs::where('id_user', $user['id'])
            ->where('id_blog', $request->id)->first();
            $like->delete();
            return like_blogs::where('id_blog', $request->id)->count();
        } else return ["messen" => "require"];
    }
    public function list($blogs)
    {
        $data = [];
        foreach ($blogs as $item) {
            $content = json_decode(Storage::get($item->content));
            $data[] = [
                'id' => $item->id,
                'user' => User::item($item->id_user),
                'name' => $content->name,
                'img' => $content->img,
                'description' => $content->description,
                'cmt' => cmt_blogs::where('id_blog', $item->id)->count(),
                'like' => like_blogs::where('id_blog', $item->id)->count(),
                'mlike'=> like_blogs::where('id_blog', $item->id)->where('id_user', $item->id_user )->count() > 0,
                'time' => date('H:i - d/m/Y', strtotime($item->created_at)),
                'view' => $item->view
            ];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($blogs = null)
    {
        if($blogs=== null)
            $blogs = ModelsBlogs::orderBy('id','DESC')->paginate(5);
        $data = $this->list($blogs);
        return ['list'=>$data, 'pagi'=>$blogs->toArray()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blogs = new ModelsBlogs();
        $blogs->id_user = $request->id_user;
        $content = [
            'name'=>$request->name,
            'content'=>$request->content,
            'img' => $request->img,
            'description' => $request->description,
        ];
        $name = 'blogs/blog_' . Str::uuid()->toString() . '.json';
        Storage::put($name, json_encode($content));
        $blogs->content = $name;
        $blogs->view = 0;
        $result = $blogs->save();
        return ['result'=> $result];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item=ModelsBlogs::find($id);
        $blogs = ModelsBlogs::orderBy('id', 'DESC')->take(5)->get();
        $content = json_decode(Storage::get($item->content));
        $blog =  [
            'id' => $item->id,
            'user' => User::item($item->id_user),
            'name' => $content->name,
            'img' => $content->img,
            'content'=>$content->content,
            'description'=>$content->description,
            'cmt' => cmt_blogs::where('id_blog', $item->id)->count(),
            'like' => like_blogs::where('id_blog', $item->id)->count(),
            'mlike' => like_blogs::where('id_blog', $item->id)->where('id_user', $item->id_user)->count() > 0,
            'time' => date('H:i - d/m/Y', strtotime($item->created_at)),
            'view' => $item->view
        ];
        
        return ['blog'=>$blog, 'new'=>$this->list($blogs)];
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
        $blogs = ModelsBlogs::find($id);
        $blogs->id_user = $request->id_user;
        $content = [
            'name' => $request->name,
            'content' => $request->content,
            'img' => $request->img,
            'description' => $request->description,
        ];
        $name = 'blogs/blog_' . Str::uuid()->toString() . '.json';
        Storage::put($name, json_encode($content));
        Storage::delete($blogs->content);
        $blogs->content = $name;
        $blogs->save();
        return [
            'id' => $blogs->id,
            'user' => User::item($blogs->id_user),
            'name' => $request->name,
            'img' => $request->img,
            'content' => $request->content,
            'description' => $request->description,
            'cmt' => cmt_blogs::where('id_blog', $blogs->id)->count(),
            'like' => like_blogs::where('id_blog', $blogs->id)->count(),
            'time' => date('H:i - d/m/Y', strtotime($blogs->created_at)),
            'view' => $blogs->view
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogs = ModelsBlogs::find($id);
        Storage::delete($blogs->content);
        $blogs->delete();
    }

    public function view($id){
        $blog = ModelsBlogs::find($id);
        $blog->view++;
        $blog->save();
        return $blog->view;
    }
    
}
