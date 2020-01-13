<?php
use Illuminate\Database\Eloquent\Model;
class Nurse extends Model
{
    protected $table = 'nurses';
    protected $guarded = [];
    public function saveNurseInfo($name, $phone, $email, $address){
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->save();
    }
}