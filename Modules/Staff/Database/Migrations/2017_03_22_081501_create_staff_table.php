<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullName'); // ФИО
            $table->string('position'); // занимаемая должность (должности)
            $table->string('disciplines'); // преподаваемые дисциплины
            $table->string('academicDegree')->default(''); // ученая степень (при наличии)
            $table->string('academicTitle')->default(''); // ученое звание (при наличии)
            $table->string('specialty'); // наименование направления подготовки и (или) специальности
            $table->string('training')->default(''); // данные о повышении квалификации и (или) профессиональной переподготовке (при наличии);
            $table->string('generalExperience'); // общий стаж работы
            $table->string('specialtyExperience'); // стаж работы по специальности
            $table->string('photo')->default(''); // ссылка на фото
            $table->string('slug');
            $table->integer('user_id')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
