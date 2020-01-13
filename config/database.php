<?php
use Illuminate\Database\Capsule\Manager;
//Create doctors table on the database
Manager::schema()->dropIfExists('doctors');
Manager::schema()->create('doctors', function($table){
    $table->increments('id');
    $table->string('name');
    $table->string('specialization');
    $table->string('phone')->unique();
    $table->string('email')->unique();
    $table->string('address');
    $table->timestamps();
});
//create patient table on the database
Manager::schema()->dropIfExists('patients');
Manager::schema()->create('patients', function($table){
    $table->increments('id');
    $table->string('name');
    $table->string('healthCardNumber')->unique();
    $table->string('dob');
    $table->string('phone')->unique();
    $table->string('email')->unique();
    $table->string('address');
    $table->timestamps();
});
//create patient_med_info table
Manager::schema()->dropIfExists('patient_med_info');
Manager::schema()->create('patient_med_info', function($table){
    $table->increments('id');
    $table->string('blood_pressure');
    $table->string('weight');
    $table->string('height');
    $table->string('last_visited');
    $table->text('notes');
    $table->integer('patient_id');
    $table->timestamps();
});
//create nurses table
Manager::schema()->dropIfExists('nurses');
Manager::schema()->create('nurses', function($table){
    $table->increments('id');
    $table->string('name');
    $table->string('phone')->unique();
    $table->string('email')->unique();
    $table->string('address');
    $table->timestamps();
});
//create appointments table
Manager::schema()->dropIfExists('appointments');
Manager::schema()->create('appointments', function($table){
    $table->increments('id');
    $table->string('time');
    $table->string('date');
    $table->integer('doctor_id')->nullable(false);
    $table->integer('patient_id')->nullable(false);
    $table->timestamps();
});
//create schedules table
Manager::schema()->dropIfExists('schedules');
Manager::schema()->create('schedules', function($table){
    $table->increments('id');
    $table->string('time');
    $table->timestamps();
});
//create users table
Manager::schema()->dropIfExists('users');
Manager::schema()->create('users', function($table){
    $table->increments('id');
    $table->string('email')->nullable(true);
    $table->string('username')->nullable(true)->unique();
    $table->string('password')->nullable(true)->unique();
    $table->string('healthCardNumber')->nullable(true);
    $table->timestamps();
});
//create roles table
Manager::schema()->dropIfExists('roles');
Manager::schema()->create('roles', function($table){
    $table->increments('id');
    $table->string('roleType');
    $table->timestamps();
});
//joining table for users and roles(many to many relationship)
Manager::schema()->dropIfExists('role_user');
Manager::schema()->create('role_user', function($table){
    $table->increments('id');
    $table->integer('role_id')->unsigned();
    $table->integer('user_id')->unsigned();
});