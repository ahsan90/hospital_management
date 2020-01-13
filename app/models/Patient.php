<?php
use Illuminate\Database\Eloquent\Model;
class Patient extends Model{
    protected $table = 'patients';
    protected $guarded = [];
    public function savePatient($name, $healCardNo, $dob, $phone, $email, $address){
        $this->name = $name;
        $this->healthCardNumber = $healCardNo;
        $this->dob = $dob;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->save();
    }
}