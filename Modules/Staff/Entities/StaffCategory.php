<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;

class StaffCategory extends Model
{
    protected $table = 'staff_categories';
    protected $fillable = [];

    public function staffs()
    {
      return $this->belongsToMany('Modules\Staff\Entities\Staff', 'staff_staff_categories', 'staff_category_id', 'staff_id');
    }

    public function user()
    {
      return $this->belongsTo('\App\User');
    }
}
