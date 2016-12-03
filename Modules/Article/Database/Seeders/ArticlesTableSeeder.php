<?php

namespace Modules\Article\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $faker = \Faker\Factory::create('Modules\Article\Entities\Article');

        $limit = 200;

        for ($i = 0; $i < $limit; $i++) {
          $name=$faker->unique()->sentence;
            DB::table('articles')->insert([
              'title' => $name,
              'description' => $faker->sentence,
              'body' => implode($faker->paragraphs(15)),
              'role_id' => 1,
              'slug' => str_slug($name),
              'user_id' => $faker->numberBetween(1,5),
              'category_id' => $faker->numberBetween(1,10),
              'created_at' => \Carbon\Carbon::now(),
              'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
