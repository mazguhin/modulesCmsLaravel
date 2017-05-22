<?php

namespace Modules\Block\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BlockTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        DB::table('blocks')->insert([
          [
            'description' => 'Блок под левым меню',
            'body' => '<h3>Заголовок</h3>
            <p style="text-align:center"><span style="color:#d3d3d3">Здесь располагается текст данного блока.
            Он может содержать в себе ссылки на иные ресурсы или любой другой контент.</span></p>',
            'role_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
          ],
          [
            'description' => 'Подвал',
            'body' => '<div class="text-center">Текст подвала</div>',
            'role_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
          ],
        ]);
    }
}
