<?php
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $table = 'users';
    protected $guarded = [];

    public function role(){
        return $this->hasOne('Role');
    }
}