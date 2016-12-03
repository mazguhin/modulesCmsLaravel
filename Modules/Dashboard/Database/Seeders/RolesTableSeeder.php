<?php

namespace Modules\Dashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
        [
          'name' => 'guest',
          'permission' => 1,
          'title' => 'Гость',
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ],
        [
          'name' => 'user',
          'permission' => 2,
          'title' => 'Пользователь',
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ],
        [
          'name' => 'moderator',
          'permission' => 3,
          'title' => 'Модератор',
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ],
        [
          'name' => 'administrator',
          'permission' => 4,
          'title' => 'Администратор',
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ],
        [
          'name' => 'banned',
          'permission' => 0,
          'title' => 'Заблокированный',
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]
      ]);
    }
}
