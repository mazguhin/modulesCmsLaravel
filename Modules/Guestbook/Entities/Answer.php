<?php

namespace Modules\Guestbook\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [];

    public function question()
    {
      return $this->hasOne('Modules\Guestbook\Entities\Question');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
