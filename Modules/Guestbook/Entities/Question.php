<?php

namespace Modules\Guestbook\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['body'];

    public function answer()
    {
      return $this->belongsTo('Modules\Guestbook\Entities\Answer');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
