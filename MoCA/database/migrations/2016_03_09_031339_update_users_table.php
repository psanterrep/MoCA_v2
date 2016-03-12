<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Users', function ($table) {
            $table->integer('idUserType');
        });

        Schema::create('UserTypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('Admins', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('Users');
            $table->integer('idRole');
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
        Schema::table('Users', function ($table) {
            $table->dropColumn('idUserType');
        });
        Schema::drop('UserTypes');
        Schema::drop('Admins');
    }
}
