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
            'description' => 'Подвал',
            'body' => '<p style="text-align:center">Smans CMS / 2017</p>

            <hr />
            <div class="row text-center">
            <div class="col-sm-4">
            <p><a href="#">Пример ссылки на внешний ресурс</a></p>

            <p><a href="#">Пример ссылки на внешний ресурс</a></p>

            <p><a href="#">Пример ссылки на внешний ресурс</a></p>
            </div>

            <div class="col-sm-4">
            <p><a href="#">Пример ссылки на внешний ресурс</a></p>

            <p><a href="#">Пример ссылки на внешний ресурс</a></p>

            <p><a href="#">Пример ссылки на внешний ресурс</a></p>
            </div>

            <div class="col-sm-4">
            <p><a href="#">Пример ссылки на внешний ресурс</a></p>

            <p><a href="#">Пример ссылки на внешний ресурс</a></p>

            <p><a href="#">Пример ссылки на внешний ресурс</a></p>
            </div>
            </div>
            ',
            'role_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
          ],
        ]);
    }
}
