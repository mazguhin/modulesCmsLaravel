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
          'title' => 'Сведения об ОО',
          'description' => 'Cведения об образовательной организации',
          'activated' => 1,
          'role_id' => 1,
          'icon' => 'fa-info',
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Основные сведения',
          'description' => '',
          'url' => '/article/id/1',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Структура и органы управления',
          'description' => '',
          'url' => '/article/id/2',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Документы',
          'description' => '',
          'url' => '/article/id/3',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Образовательные программы',
          'description' => '',
          'url' => '/article/id/4',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Образовательные стандарты',
          'description' => '',
          'url' => '/article/id/5',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Руководство и педагогический состав',
          'description' => '',
          'url' => '/article/id/6',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Материально-техническое обеспечение и оснащенность образовательного процесса',
          'description' => '',
          'url' => '/article/id/7',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Стипендии и иные виды материальной поддержки',
          'description' => '',
          'url' => '/article/id/8',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Платные образовательные услуги',
          'description' => '',
          'url' => '/article/id/9',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Финансово-хозяйственная деятельность',
          'description' => '',
          'url' => '/article/id/10',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('menu_items')->insert([
          'title' => 'Вакантные места для приема/перевода',
          'description' => '',
          'url' => '/article/id/11',
          'activated' => 1,
          'role_id' => 1,
          'target' => '_self',
          'menu_id' => 1,
          'required' => 1,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
