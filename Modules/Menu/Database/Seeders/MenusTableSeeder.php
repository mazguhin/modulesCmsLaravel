<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$faker = \Faker\Factory::create('Modules\Menu\Entities\Menu');

        DB::table('menus')->insert([
          'title' => 'Главное меню',
          'description' => 'Описание главного меню',
          'activated' => 1,
          'role' => 'main',
          'role_id' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
