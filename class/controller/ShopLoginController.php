<?php


class ShopLoginController extends User{

    public function logUser($email,$password){

        $user = User::setShopUser($email,$password);
        return $user;
    }
}