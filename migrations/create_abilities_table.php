<?php

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

class CreateAbilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('janitor_abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('description');
            // entrances.index
            $table->string('ability_prefix')->index();
            // status sex 等属性字段
            $table->string('ability_attribute')->index();
            // 允许的属性值
            $table->string('ability_attribute_value')->index();
            $table->string('keyCode')->default('0');;
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
        Schema::drop('janitor_abilities');
    }
}
