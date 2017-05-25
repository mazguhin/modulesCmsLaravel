<?php

namespace Modules\Log\Entities;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['body','ip'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
