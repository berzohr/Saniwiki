<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'accessGroup',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isInGroup($groupId) {
        $userGroup = \Auth::user()->accessGroup;
        if ($groupId == $userGroup) {
            return true;
        } else {
            return false;
        }
    }

    public function isLastAdmin($userGroup) {
        if ($userGroup == 3) {
            $admin = DB::table('users')->where('accessGroup', 3)->count();
            if ($admin > 1) {
                return false;
            } else {
                return true;
            }
        }
    }
}
