<?php

namespace Modules\Block\Classes;

use Modules\Block\Entities\Block;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Settings;
use RoleHelper;

class Blocks
{

  public function get($id)
  {
    try {
      $block = Block::findOrFail($id);
      if (RoleHelper::validatePermissionForPage($block->role->permission)) {
        echo $block->body;
      }
    } catch (ModelNotFoundException $e) {
      if (Settings::get('displayErrorsBlocks')=='1') {
        echo "<b>Вызываемый блок не найден [ID: {$id}]</b>";
      }
    }
  }

}
