<?php
use Illuminate\Database\Eloquent\Model;
class Patient extends Model{
    protected $table = 'patients';
    protected $guarded = [];

//    public function user(){
//        return $this->hasOne(User::class);
//    }

    public function savePatient($role_id, $user_id, $name, $healCardNo, $dob, $gender, $phone, $email, $address){
        $this->role_id = $role_id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->healthCardNumber = $healCardNo;
        $this->dob = $dob;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->save();
    }

    public static function isValidPatientData($role_id, $name, $healCardNo, $dob, $gender, $phone, $email, $address, $username, $password){

        $flag = false;
        if(Validation::isUserExists($username)){
            return false;
        }
        if (!Validation::isEmpty($role_id) && !Validation::isEmpty($name)
                && !Validation::isEmpty($healCardNo)
                && !Validation::isEmpty($dob) && !Validation::isEmpty($gender)
                && !Validation::isEmpty($phone) && Validation::isValidEmail($email)
                && !Validation::isEmpty($address)){

            self::saveValidPatientInfo($role_id, $name, $healCardNo, $dob, $gender, $phone, $email, $address, $username, $password);
            $flag = true;
        }
        return $flag;
    }

    /**
     * @param $role_id
     * @param $name
     * @param $healCardNo
     * @param $dob
     * @param $gender
     * @param $phone
     * @param $email
     * @param $address
     * @param $username
     * @param $password
     * @return bool
     */
    public static function saveValidPatientInfo($role_id, $name, $healCardNo, $dob, $gender, $phone, $email, $address, $username, $password)
    {
        $user = new User();

        $user->username = $username;
        $user->password = md5($password);
        $user->role_id = $role_id;
        $user->save();

        $user_id = User::all()->where('username', $username)->first()->id;

        (new Patient)->savePatient($role_id, $user_id, $name, $healCardNo, $dob, $gender, $phone, $email, $address);

        //$flag = true;
        //return $flag;
    }
}