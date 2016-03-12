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
            $table->integer('idUserReceiver');
            $table->integer('idUserSender');
            $table->timestamps();
        });

        // Messages Table
        Schema::create('Messages', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->text('content');
            $table->timestamps();
        });

        // Doctors Table
        Schema::create('Doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser')->unique();
            $table->string('name');
            $table->string('firstname');
            $table->string('email')->unique();
            $table->integer('idPlace');
            $table->integer('idRole');
            $table->timestamps();
        });

        // Patient Table
        Schema::create('Patients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser')->unique();
            $table->timestamps();
        });

        // DoctorPatients Table
        Schema::create('DoctorPatients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idDoctor');
            $table->integer('idPatient');
            $table->date('dateStartFollowed');
            $table->date('dateEndFollowed');
            $table->string('firstname');
            $table->string('email')->unique();
            $table->integer('idPlace');
            $table->integer('idRole');
            $table->timestamps();
        });

        // Places Table
        Schema::create('Places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->timestamps();
        });

        // Places Table
        Schema::create('Transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idDoctorSender');
            $table->integer('idDoctorReceiver');
            $table->integer('idPatient');
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
        
        // ConsultationTests Table
        Schema::create('ConsultationTests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idConsultation');
            $table->integer('idTest');
            $table->double('result');
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
