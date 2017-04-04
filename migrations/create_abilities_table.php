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
            $table->string('type')->index();// 权限类别
            $table->string('name')->index();// 权限名称
            $table->string('description'); // 权限描述
            $table->string('keyCode')->default('0');
            $table->timestamps();
        });

        // 用户 角色  多对多   用户 权限 多对多   权限 角色  多对多

        // 用户平台权限  用户资源类型权限  用户资源权限  用户资源请求权限
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
