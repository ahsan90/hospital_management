<?php


class UserHelper
{
    public static function findUserIdByUsername($username){
        $user_id = User::all()->where('username', $username)->first()->id;
        return $user_id;
    }
}