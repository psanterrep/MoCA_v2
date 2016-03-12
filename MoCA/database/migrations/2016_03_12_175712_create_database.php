<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Roles Table
        Schema::create('Roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('permission');
            $table->timestamps();
        });

        // UserMessage Table
        Schema::create('UserMessages', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('idUserSender')->references('id')->on('Users');
            $table->foreign('idUserReceiver')->references('id')->on('Users');
            $table->foreign('idMessage')->references('id')->on('Messages');
            $table->timestamps();
        });

        // Messages Table
        Schema::create('Messages', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->text('content');
            $table->timestamps();
        });

        // Places Table
        Schema::create('Places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->timestamps();
        });

        // Doctors Table
        Schema::create('Doctors', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('Users');
            $table->string('name');
            $table->string('firstname');
            $table->foreign('idPlace')->references('id')->on('Places');
            $table->foreign('idRole')->references('id')->on('Roles');
            $table->timestamps();
        });

        // Patient Table
        Schema::create('Patients', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('Users');
            $table->timestamps();
        });

        // DoctorPatients Table
        Schema::create('DoctorPatients', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('idDoctor')->references('id')->on('Doctors');
            $table->foreign('idPatient')->references('id')->on('Patients');
            $table->date('dateStartFollowed');
            $table->date('dateEndFollowed');
            $table->string('firstname');
            $table->string('email')->unique();
            $table->timestamps();
        });

        
        // Places Table
        Schema::create('Transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('idDoctorSender')->references('id')->on('Doctors');
            $table->foreign('idDoctorReceiver')->references('id')->on('Doctors');
            $table->foreign('idPatient')->references('id')->on('Patients');
            $table->date('date');
            $table->timestamps();
        });

        // Consultations Table
        Schema::create('Consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->text('comment');
            $table->integer('idType');
            $table->date('date');
            $table->timestamps();
        });

        // Types Table
        Schema::create('Types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        // Tests Table
        Schema::create('Tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('version');
            $table->string('path');
            $table->timestamps();
        });

        // ConsultationTests Table
        Schema::create('ConsultationTests', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('idConsultation')->references('id')->on('Consultations');
            $table->foreign('idTest')->references('id')->on('Tests');
            $table->double('result');
            $table->timestamps();
        });

        // Insert User Types
        $type = new User_Type();
        $type->name ="admin";
        $type->save();

        $type = new User_Type();
        $type->name ="doctor";
        $type->save();

        $type = new User_Type();
        $type->name ="patient";
        $type->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Roles');
        Schema::drop('UserMessages');
        Schema::drop('Messages');
        Schema::drop('Doctors');
        Schema::drop('Patients');
        Schema::drop('DoctorPatients');
        Schema::drop('Places');
        Schema::drop('Transfers');
        Schema::drop('Consultations');
        Schema::drop('Types');
        Schema::drop('ConsultationTests');
        Schema::drop('Tests');

    }
}
