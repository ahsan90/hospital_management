<?php
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model{
    protected $table = 'doctors';
    protected $guarded = [];

//    public function user(){
//        return $this->hasOne(User::class);
//    }

    //Save doctor's information
    public function saveDoctor($role_id, $user_id, $name, $gender, $specialization, $phone, $email, $address){
        $this->role_id = $role_id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->gender = $gender;
        $this->specialization = $specialization;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;

        $this->save();
    }

    //Validation for doctors data
    public static function isValidDoctorData($role_id, $name, $gender, $specialization, $phone, $email, $address, $username, $password){
        $flag = false;
        if(Validation::isUserExists($username)){
            return $flag;
        }
        if (Validation::isDoctorEmailExists($email)){
            return false;
        }
        if (Validation::isDoctorPhoneExists($phone)){
            return false;
        }

        if (!Validation::isEmpty($role_id) && !Validation::isEmpty($name)
            && !Validation::isEmpty($gender)
            && !Validation::isEmpty($specialization) && !Validation::isEmpty($gender)
            && !Validation::isEmpty($phone) && Validation::isValidEmail($email)
            && !Validation::isEmpty($address)){

            self::saveValidDoctorInfo($role_id, $name, $gender, $specialization, $phone, $email, $address, $username, $password);
            $flag = true;
        }
        return $flag;
    }

    //Save data to user table and doctor table by making an association in between
    public static function saveValidDoctorInfo($role_id, $name, $gender, $specialization, $phone, $email, $address, $username, $password)
    {
        $user = new User();

        $user->username = $username;
        $user->password = md5($password);
        $user->role_id = $role_id;
        $user->save();

        $user_id = User::all()->where('username', $username)->first()->id;

        (new Doctor())->saveDoctor($role_id, $user_id, $name, $gender, $specialization, $phone, $email, $address);

    }
}