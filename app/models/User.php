<?php
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $table = 'users';
    protected $guarded = [];

    public function role(){
        return $this->hasOne('Role');
    }

    public function getRoleType(){
        //$tempRole = self::find($id)->role;
        //return $tempRole->roleType;
        return Role::where('id', $this->user_id)->first()->roleType;
    }
}