<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();

      //$faker = \Faker\Factory::create('Modules\Category\Entities\Category');

      DB::table('settings')->insert([
        [
          'name' => 'frontTemplate',
          'value' => 'amy',
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ],
        [
          'name' => 'backTemplate',
          'value' => 'amy',
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]
      ]);

    }
}
