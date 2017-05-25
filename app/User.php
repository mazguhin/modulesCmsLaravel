<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Authenticatable
{
    use Notifiable;
    use AuthenticableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
      return $this->hasMany('Modules\Article\Entities\Article');
    }

    public function role()
    {
      return $this->belongsTo('Modules\Dashboard\Entities\Role');
    }


    public function categories()
    {
      return $this->hasMany('Modules\Category\Entities\Category');
    }

    public function staffCategories()
    {
      return $this->hasMany('Modules\Staff\Entities\StaffCategory');
    }

    public function staffs()
    {
      return $this->hasMany('Modules\Staff\Entities\Staff');
    }

    public function clubs()
    {
      return $this->belongsToMany('Modules\Club\Entities\Club');
    }

    public function answers()
    {
      return $this->hasMany('Modules\Guestbook\Entities\Answer');
    }

    public function questions()
    {
      return $this->hasMany('Modules\Guestbook\Entities\Question');
    }

    public function logs()
    {
      return $this->hasMany('Modules\Log\Entities\Log');
    }
}
