<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Staff extends Model
{
    protected $table='staffs';
    protected $fillable = [];

    public function categories()
    {
      return $this->belongsToMany('Modules\Staff\Entities\StaffCategory', 'staff_staff_categories', 'staff_id', 'staff_category_id');
    }

    public function user()
    {
      return $this->belongsTo('\App\User');
    }

    public function getPhoto()
    {
      if ($this->photo=="") {
        return '/images/user.png';
      }

      return Storage::url($this->photo);
    }
}
