<?php
use Illuminate\Database\Eloquent\Model;
class Nurse extends Model
{
    protected $table = 'nurses';
    protected $guarded = [];

//    public function user(){
//        return $this->hasOne(User::class);
//    }


    private function saveNurseInfo($role_id, $user_id, $name, $gender, $phone, $email, $address){
        $this->role_id = $role_id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->save();
    }


    //check validation before saving
    public static function isValidNurseData($role_id, $name, $gender, $phone, $email, $address, $username, $password){

        $flag = false;
        if(Validation::isUserExists($username)){
            return false;
        }
        if (!Validation::isEmpty($role_id) && !Validation::isEmpty($name)
            && !Validation::isEmpty($gender)
            && !Validation::isEmpty($phone) && Validation::isValidEmail($email)
            && !Validation::isEmpty($address)){

            self::saveValidNurseInfo($role_id, $name, $gender, $phone, $email, $address, $username, $password);
            $flag = true;
        }
        return $flag;
    }

    //save valid nurse data
    public static function saveValidNurseInfo($role_id, $name, $gender, $phone, $email, $address, $username, $password)
    {
        $user = new User();

        $user->username = $username;
        $user->password = md5($password);
        $user->role_id = $role_id;
        $user->save();

        $user_id = User::all()->where('username', $username)->first()->id;

        (new Nurse())->saveNurseInfo($role_id, $user_id, $name, $gender, $phone, $email, $address);

    }
}