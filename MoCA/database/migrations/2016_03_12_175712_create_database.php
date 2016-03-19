<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User\User_Type;

class CreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // UserTypes
        Schema::create('UserTypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        // Users
        Schema::table('Users', function ($table) {
            $table->integer('idUserType')->unsigned();
            $table->foreign('idUserType')->references('id')->on('UserTypes');
        });


        // Roles Table
        Schema::create('Roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('permission');
            $table->timestamps();
        });

        Schema::create('Admins', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('idRole');
            $table->foreign('id')->references('id')->on('Users');
            $table->foreign('idRole')->references('id')->on('Roles');
            $table->timestamps();
        });

        // UserMessage Table
        Schema::create('UserMessages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUserSender')->unsigned();
            $table->integer('idUserReceiver')->unsigned();
            $table->integer('idMessage')->unsigned();
            $table->foreign('idUserSender')->references('id')->on('Users');
            $table->foreign('idUserReceiver')->references('id')->on('Users');
            $table->foreign('idMessage')->references('id')->on('Messages');
            $table->timestamps();
        });

        // Messages Table
        Schema::create('Messages', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('date');
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
            $table->integer('id')->unsigned();
            $table->string('name');
            $table->string('firstname');
            $table->integer('idPlace')->unsigned();
            $table->integer('idRole')->unsigned();
            $table->foreign('id')->references('id')->on('Users');
            $table->foreign('idPlace')->references('id')->on('Places');
            $table->foreign('idRole')->references('id')->on('Roles');
            $table->timestamps();
        });

        // Patient Table
        Schema::create('Patients', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('Users');
            $table->timestamps();
        });

        // DoctorPatients Table
        Schema::create('Follow', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idDoctor')->unsigned();
            $table->integer('idPatient')->unsigned();
            $table->foreign('idDoctor')->references('id')->on('Doctors');
            $table->foreign('idPatient')->references('id')->on('Patients');
            $table->datetime('dateStartFollowed');
            $table->datetime('dateEndFollowed')->nullable();
            $table->timestamps();
        });

        
        // Places Table
        Schema::create('Transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idDoctorSender')->unsigned();
            $table->integer('idDoctorReceiver')->unsigned();
            $table->integer('idPatient')->unsigned();
            $table->foreign('idDoctorSender')->references('id')->on('Doctors');
            $table->foreign('idDoctorReceiver')->references('id')->on('Doctors');
            $table->foreign('idPatient')->references('id')->on('Patients');
            $table->datetime('date');
            $table->timestamps();
        });

        // Consultations Table
        Schema::create('Consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('date');
            $table->integer('idType');
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        // Types Table
        Schema::create('ConsultationTypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        // PatientsConsultations Table
        Schema::create('PatientsConsultations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPatient');
            $table->integer('idConsultation');
            $table->timestamps();
        });

        // DoctorsConsultations Table
        Schema::create('DoctorsConsultations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idDoctor');
            $table->integer('idConsultation');
            $table->timestamps();
        });

        // Tests Table
        Schema::create('Tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('version');
            $table->string('path');
            $table->timestamps();
        });

        // ConsultationTests Table
        Schema::create('ConsultationTests', function (Blueprint $table) {
            $table->increments('id');
            $table->double('result');
            $table->integer('idConsultation')->unsigned();
            $table->integer('idTest')->unsigned();
            $table->foreign('idConsultation')->references('id')->on('Consultations');
            $table->foreign('idTest')->references('id')->on('Tests');
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

        $type = new Consultation_Type();
        $type->name ="supervised";
        $type->save();

        $type = new Consultation_Type();
        $type->name ="unsupervised";
        $type->save();


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
        Schema::drop('Roles');
        Schema::drop('UserTypes');
        Schema::drop('Admins');
        Schema::drop('UserMessages');
        Schema::drop('Messages');
        Schema::drop('Doctors');
        Schema::drop('Patients');
        Schema::drop('Follow');
        Schema::drop('Places');
        Schema::drop('Transfers');
        Schema::drop('Consultations');
        Schema::drop('PatientsConsultations');
        Schema::drop('DoctorsConsultations');
        Schema::drop('ConsultationTypes');
        Schema::drop('ConsultationTests');
        Schema::drop('Tests');

    }
}
