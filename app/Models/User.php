<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function user()
    {
        if (!empty($_REQUEST['key']))
            $user = self::where('remember_token', $_REQUEST['key'])->first();
        else {
            return ['id' => 0, 'type' => 'request login'];
        }
        if ($user!==null) {
            //$time = Carbon::now()->diffInSeconds(new Carbon($user->updated_at));
            // if ($time > env('TIME_REMEMBER')) {
            //     $user->remember_token = NULL;
            //     $user->save();
            //     return ['id' => 0, 'type' => 'time out'];
            // } else {
                // $user->updated_at = Carbon::now();
                // $user->save();
                return [
                    'id' => $user->id,
                    'username' => $user->username,
                    'avata' => $user->avata,
                    'name' => $user->name,
                    'birth' => $user->birth,
                    'email' => $user->email,
                    'sex' => $user->sex,
                    'type' => $user->type,
                    'timecreate' => $user->updated_at
                ];
        //     }
        // } else {
        //     return ['id' => 0, 'type' => 'Auth out'];
        }
        return ['id'=>0, 'type' => 'request login'];
    }
    public static function item($id)
    {
        $user = self::find($id);
        if($user!==null)
        return [
            'id'=>$user->id,
            'name'=>$user->name,
            'avata'=>$user->avata
        ];else
        return [
            'id'=>0,
            'name'=>"",
            'avata'=>null
        ];
    }
}
