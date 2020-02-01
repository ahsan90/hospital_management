<?php
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model{
    protected $table = 'doctors';
    protected $guarded = [];

//    public function user(){
//        return $this->hasOne(User::class);
//    }
}