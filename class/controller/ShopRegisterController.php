<?php 

class ShopRegisterController extends User{

     public function regShopUser($name,$email,$password){
         $user = User::addShopUser($name,$email,$password);
         return $user;
     }
 
}