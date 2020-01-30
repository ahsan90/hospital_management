<?php


class Seeder
{
    //seed doctor data
    public static function doctorsDbSeed(){
        $faker = Faker\Factory::create();
        $gender = $faker->randomElement(['male', 'female']);
        $role_id = Role::all()->where('id', 2)->first()->id;

        $newDoctor = new Doctor();
        $newDoctor->name = $faker->name;
        $newDoctor->role_id = $role_id;
        $newDoctor->specialization = $faker->sentence;
        $newDoctor->gender = $gender;
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
        $gender = $faker->randomElement(['male', 'female']);

        $newPatient->savePatient(4, $faker->name, $faker->randomNumber(8),
            $dobRange, $gender, $faker->phoneNumber, $faker->email, $faker->address);
    }
    //seed nurse data
    public static function nurseDbSeed(){
        $faker = Faker\Factory::create();
        $gender = $faker->randomElement(['male', 'female']);

        $nurse = new Nurse();
        $nurse->saveNurseInfo(3, $faker->name, $gender, $faker->phoneNumber, $faker->email, $faker->address);
    }
    //seed for role data
    public static function roleDbSeed(){
        //$id = array()
        $roles = array('1'=>'admin', '2'=> 'doctor', '3'=>'nurse', '4'=>'patient');
        foreach ($roles as  $key=>$role){
            $newRole = new Role();
            $newRole->id = (int)$key;
            $newRole->roleType = $role;
            //$newRole->user_id = 1;
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
        $user->role_id = Role::all()->where('roleType', 'admin')->first()->id;
        $user->save();

    }

    //create schedule data for appointment table
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
        self::roleDbSeed();
        self::createAdminUser();
        self::scheduleSeedData();

        for ($i = 0; $i<=15; $i++){
            self::doctorsDbSeed();
        }

        for ($i=0; $i <= 50; $i++){
            self::nurseDbSeed();
        }

        for ($i = 0; $i<=200; $i++){
            self::patientDbSeed();
        }
    }
}