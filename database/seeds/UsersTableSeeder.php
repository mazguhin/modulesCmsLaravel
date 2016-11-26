<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create('App\User');

      $limit = 5;

      for ($i = 0; $i < $limit; $i++) {
          DB::table('users')->insert([
            'name' => $faker->name,
            'email' => $faker->unique()->email,
            'password' => bcrypt('test'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
          ]);
      }
    }
}
