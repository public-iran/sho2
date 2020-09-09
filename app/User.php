<?php

namespace App;

use App\Listpeople;
use App\Userrequest;
use App\Presence;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Shetabit\Visitor\Traits\Visitor;

class User extends Authenticatable
{
    use Notifiable;
    use Visitor;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'email','family',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin()
    {
        $roles=Role::all();
        foreach ($roles as $role){
                if ($role->id==1 or $role->id==0){
                    return true;
                }
        }
        return false;
    }


}
