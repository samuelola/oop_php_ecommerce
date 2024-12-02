<?php

class Categoryview extends Category{

    public function allCategory(){
        $get_all = Category::getAllCategories();
         return $get_all;
    }
}