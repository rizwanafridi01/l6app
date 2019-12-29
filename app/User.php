<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFindById($query, $id)
    {
        return $query->where('id', $id);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'user_id','id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user');
    }

    public function setUsernameAttribute($username)
    {
        $username =trim(preg_replace("/[^\w\d]+/i", "", $username)," ");
        $count = User::where('username','like', "%{$username}%")->count();
        if($count > 0)
            $username = $username."-".($count+1);

        $this->attributes['username'] = strtolower($username);
    }
}
