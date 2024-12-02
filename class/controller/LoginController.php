<?php


class LoginController extends User{

    public function logUser($email,$password){

        $user = User::setUser($email,$password);
        return $user;
    }
}