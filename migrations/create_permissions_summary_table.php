<?php

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

class CreatePermissionsSummaryTable extends Migration
{
    public function up()
    {
        Schema::create('janitor_permission_summary', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index(); // 关联用户
            $table->integer('role_id')->index(); // 关联角色
            $table->string('platformKeyCode')->default('0');// 平台权限码
            $table->string('resourceTypeKeyCode')->default('0');// 资源类型权限码
            $table->string('resourceKeyCode')->default('0'); // 资源权限码
            $table->string('apiMethodKeyCode')->default('0');// API 资源请求权限码
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
        Schema::drop('janitor_permission_summary');
    }
}
