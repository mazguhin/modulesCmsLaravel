<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();

      $faker = \Faker\Factory::create('Modules\Category\Entities\Category');

      $limit = 10;

      for ($i = 0; $i < $limit; $i++) {
        $name=$faker->unique()->word;
          DB::table('categories')->insert([
            'name' => $name,
            'description' => $faker->sentence,
            'permission' => 'all',
            'slug' => $name,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
          ]);
      }
    }
}
