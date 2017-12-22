<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'first_name', 
        'middle_name', 
        'last_name', 
        'city', 
        'role_id'
    ];


    //Comment model - opens commentable_id and commentable_type
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }


    //Company model - user has many companies
    public function companies()
    {
        return $this->hasMany('App\Company');
    }


    //ProjectUser model - user belongs to many projects
    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    //Role model - user belongs to 1 role
    public function role()
    {
        return $this->belongsTo('App\Role');
    }


    //TaskUser model - user belongs to many tasks
    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }




    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

?> 