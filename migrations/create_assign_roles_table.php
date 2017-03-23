<?php
use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

class CreateAssignRolesTable extends Migration
{
    public function up()
    {
        Schema::create('janitor_assign_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->index();
            $table->string('role_id')->index();
            $table->integer('forbidden')->index()->default('0');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('janitor_assign_roles');
    }
}
