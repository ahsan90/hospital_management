<?php
use Illuminate\Database\Eloquent\Model;
class Patient extends Model{
    protected $table = 'patients';
    protected $guarded = [];
    public function savePatient($role_id, $name, $healCardNo, $dob, $gender, $phone, $email, $address){
        $this->role_id = $role_id;
        $this->name = $name;
        $this->healthCardNumber = $healCardNo;
        $this->dob = $dob;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->save();
    }
}