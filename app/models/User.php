<?php

//namespace Model;

use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $table = 'users';
    protected $guarded = [];

    public function role(){
        return $this->belongsTo(Role::class);
    }

//    public function patient(){
//        return $this->belongsTo(Patient::class);
//    }
//
//    public function doctor(){
//        return $this->belongsTo(Doctor::class);
//    }
//
//    public function nurse(){
//        return $this->belongsTo(Nurse::class);
//    }

    public function getRoleType(){
        //$tempRole = self::find($id)->role;
        //return $tempRole->roleType;
        return Role::where('id', $this->user_id)->first()->roleType;
    }
}