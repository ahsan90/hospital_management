<?php
//namespace Model;

use Illuminate\Database\Eloquent\Model;



class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = [];

    public function user(){
        return $this->hasOne(User::class);
    }
}