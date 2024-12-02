<?php

class CategoryController extends Category {

    public function regCat($name){
         $cat = Category::addCategory($name);
         return $cat;
     }

     public function deactivate($status,$id){
        $cat_status = Category::removestatus($status,$id);
        return $cat_status;
     }

     public function activate($status,$id){
        $cat_status = Category::addstatus($status,$id);
        return $cat_status;
     }

     public function getSingleCat($edit_cat_id){
         $result = Category::getCatById($edit_cat_id);
         return $result;
     }

     public function getSingleCats(){
         $result = Category::getAllCategories();
         return $result;
     }

     

     public function updateCat($category_name,$edit_cat_id){
        $result = Category::update($category_name,$edit_cat_id);
        return $result;
     }

     public function delete_cat($id){
        $result = Category::delete($id);
     }

     
}