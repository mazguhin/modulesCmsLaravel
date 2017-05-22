<?php

namespace Modules\Block\Entities;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [];

    public function role()
    {
      return $this->belongsTo('Modules\Dashboard\Entities\Role');
    }
}
