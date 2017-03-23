<?php
use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->string('keyCode',255)->default(0);
        });
    }

    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->removeColumn('keyCode');
        });
    }
}
