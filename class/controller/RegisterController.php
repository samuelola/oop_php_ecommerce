<?php 

class RegisterController extends User{

     public function regUser($name,$email,$password){
         $user = User::addUser($name,$email,$password);
         return $user;
     }
 
}