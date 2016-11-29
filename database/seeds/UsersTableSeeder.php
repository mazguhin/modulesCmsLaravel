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
      //create admin
      DB::table('users')->insert([
        'name' => 'admin',
        'email' => 'admin@admin.loc',
        'password' => bcrypt('admin'),
        'role_id' => 3,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
      ]);

      //generate users
      $faker = \Faker\Factory::create('App\User');
      $limit = 4;

      for ($i = 0; $i < $limit; $i++) {
          DB::table('users')->insert([
            'name' => $faker->name,
            'email' => $faker->unique()->email,
            'password' => bcrypt('test'),
            'role_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
          ]);
      }
    }
}
