<?php

namespace Modules\Log\Classes;

use Modules\Log\Entities\Log;
use Auth;

class Logs
{
  public function set($message)
  {
    if (Auth::check()) {
      Auth::user()->logs()->create([
        'body' => $message,
        'ip' => request()->ip()
      ]);
    } else {
      Log::create([
        'user_id' => 0,
        'body' => $message,
        'ip' => request()->ip()
      ]);
    }
  }
}
