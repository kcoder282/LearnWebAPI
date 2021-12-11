<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class users extends Controller
{
    public function user()
    {
        return User::user();
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = User::find(Auth::id());
            $user->remember_token = md5(uniqid($user->username, true));
            $user->save();
            if($user->type===5)
            return ['id'=>-1, 'messen'=>"Tài khoản bị khóa"];
            else
            return [
                'id'=> $user->id,
                'username' => $user->username,
                'avata' => $user->avata,
                'name' => $user->name,
                'birth' => $user->birth,
                'email' => $user->email,
                'sex' => $user->sex,
                'type' => $user->type,
                'key' => $user->remember_token,
                'time' => env('TIME_REMEMBER')
            ];
        } else {
            return ['id'=>-1, 'messen'=>"Sai thông tin đăng nhập"];
        }
    }

    public static function logout()
    {
        if (!empty($_COOKIE['AGU_LEARN_WEB_API']))
        {
            $user = User::where('remember_token', $_REQUEST['key'])->first();
            if ($user) {
                $user->remember_token = NULL;
                $user->save();  
            }
        }
        return 1;
    }
    public static function change(Request $request)
    {
        $user = User::find($request->id);
        if($user->id===$request->id)
        {
            if($user->avata!==null)
            {
                Storage::delete('public/'.$user->avata);
            }
            $img =  explode(",",$request->avata);
            preg_match('/image\/(\w)+/', $img[0], $output_array);
            $name = "avata_image" . $request->id . str_replace('image/', '.', $output_array[0]);
            Storage::put("public/$name", base64_decode($img[1]));
            $user->avata = $name;
            $user->email = $request->email;
            if($request->password!=="")
                $user->password = bcrypt($request->password);
            $user->name = $request->name;
            $user->birth = $request->birth;
            $user->sex = $request->sex;

            $user->save();
        }

        return User::user();
    }
    public static function regis(Request $request){
        if(User::where('username',$request->username)->count()!==0)
        return ["result"=>1];
        else
        if (User::where('email', $request->email)->count() !== 0)
        return ["result"=>0];
        else{
            $user = new User();
            if($request->avata!=null)
            {
                $img =  explode(",", $request->avata);
                preg_match('/image\/(\w)+/', $img[0], $output_array);
                $name = "avata_image_" . time() . str_replace('image/', '.', $output_array[0]);
                Storage::put("public/$name", base64_decode($img[1]));
                $user->avata = $name;
            }
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->name = $request->name;
            $user->birth = $request->birth;
            $user->sex = $request->sex;
            $user->type = 2;
            $user->save();
            return ['result'=>User::item($user->id)];
        }
    }
    public function index(){
        if(User::user()['type']===1)
            return User::all();
        else
            return [];
    } 
    public function block_user($id){
        if(User::user()['type']===1)
        {
            $user = User::find($id);
            if($user->type===2)
            {
                $user->type = 5;
                $user->save();
                return ['type'=>5];
            }else{
                $user->type = 2;
                $user->save();
                return ['type'=>2];
            }
        }else return ['type'=>0];
    }
    public function admin_change($id)
    {
        if (User::user()['type'] === 1) {
            $user = User::find($id);
            if ($user->type === 1) {
                $user->type = 2;
                $user->save();
                return ['type' => 2];
            } else {
                $user->type = 1;
                $user->save();
                return ['type' => 1];
            }
        } else return ['type' => 0];
    }
    public function destroy($id){
        if(User::user()['type']===1)
        {
            $user = User::find($id);
            if($user!==null)
            $user->delete();
            return User::all();
        }
        return [];
    }
}
