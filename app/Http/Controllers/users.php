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
            return [
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
            return 0;
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

        return $user;
    }
}
