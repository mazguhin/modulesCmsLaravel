<?php

namespace Modules\Block\Classes;

use Modules\Block\Entities\Block;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Settings;
use RoleHelper;
use Cache;

class Blocks
{

  public function get($id)
  {
    try {
      $block = Cache::get('block.'.$id, function () use ($id) {
        $tmpBlock = Block::findOrFail($id);
        Cache::add('block.'.$id, $tmpBlock, 1440); // cache 1440 min
        return $tmpBlock;
      });

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
