<?php
class DbSeed
{
    //seed doctor data
    public static function doctorsDbSeed(){
        $faker = Faker\Factory::create();
        $newDoctor = new Doctor();
        $newDoctor->name = $faker->name;
        $newDoctor->specialization = $faker->sentence;
        $newDoctor->phone = $faker->phoneNumber;
        $newDoctor->email = $faker->email;
        $newDoctor->address = $faker->address;
        $newDoctor->save();
    }

    //seed patient data
    public static function patientDbSeed(){
        $faker = Faker\Factory::create();
        $newPatient = new Patient();
        $dobRange = $faker->dateTimeBetween('-150 years', 'now');
        $newPatient->savePatient($faker->name, $faker->randomNumber(8),
            $dobRange, $faker->phoneNumber, $faker->email, $faker->address);

    }

    //seed nurse data
    public static function nurseDbSeed(){
        $faker = Faker\Factory::create();
        $nurse = new Nurse();
        $nurse->saveNurseInfo($faker->name, $faker->phoneNumber, $faker->email, $faker->address);
    }

    //seed for role data
    public static function roleDbSeed(){
        $roles = array('admin', 'staff', 'patient');
        foreach ($roles as  $role){
            $newRole = new Role();
            $newRole->roleType = $role;
            $newRole->save();
        }
    }

    //create an Admin user for test
    public static function createAdminUser(){
        $username = 'cisAdmin';
        $password = 'cispassword';

        $user = new User();
        $user->username = $username;
        $user->password = md5($password);
        $user->save();
    }

    //create shedule data for appointment table
    public static function scheduleSeedData(){
        $startTime = 9.00;
        $endTime = 17.00;
        for ($startTime; $startTime<=$endTime; $startTime++){
            $schedule = new Schedule();
            $scheduleTime = $startTime;
            $schedule->time = number_format($scheduleTime, 2);
            $schedule->save();
        }
    }

    //this method provides seed data to database
    public static function loadSeed(){
        for ($i = 0; $i<=15; $i++){
            self::doctorsDbSeed();
        }
        for ($i=0; $i <= 50; $i++){
            DbSeed::nurseDbSeed();
        }
        for ($i = 0; $i<=200; $i++){
            self::patientDbSeed();
        }
        self::roleDbSeed();
        self::createAdminUser();
        self::scheduleSeedData();
    }
}