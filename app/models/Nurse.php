<?php
use Illuminate\Database\Eloquent\Model;
class Nurse extends Model
{
    protected $table = 'nurses';
    protected $guarded = [];

//    public function user(){
//        return $this->hasOne(User::class);
//    }

    public function saveNurseInfo($role_id, $name, $gender, $phone, $email, $address){
        $this->role_id = $role_id;
        $this->name = $name;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->save();
    }


}