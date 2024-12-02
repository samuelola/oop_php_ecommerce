<?php 

class Category extends Dbh{

    private static $db_cat = 'categories';

    public static function addCategory($name){
      $sql = "INSERT INTO ".self::$db_cat." (cat_name,status) VALUES (?,?)";
      $stmt = Dbh::connect()->prepare($sql);
      $result = $stmt->execute([$name,1]);
      if(!$result){
          header("Location:../../oop_ecommerce/index.php");
          exit();
      }else{
          return true;
      }
    
   }

   
   public static function getAllCategories(){
       $result = static::find_by_query("SELECT * FROM ".self::$db_cat." ORDER BY id DESC");
       return $result;
   }

   private static function find_by_query($sql){
       $stmt = Dbh::connect()->query($sql);
       $cats = $stmt->fetchAll();
       return $cats;
   }

   
   public static function addstatus($status,$id){
       $sql = "UPDATE ".self::$db_cat." SET status= ? WHERE id = ?";
       $stmt = Dbh::connect()->prepare($sql);
       if($stmt->execute([$status,$id])){
           $stmt = null;
           return true;
        }else{
            return false;
        }

   }

   public static function removestatus($status,$id){

       $sql = "UPDATE ".self::$db_cat." SET status= ? WHERE id = ?";
       $stmt = Dbh::connect()->prepare($sql);
       if($stmt->execute([$status,$id])){
           $stmt = null;
           return true;
        }else{
            return false;
        }
   }

   public function getCatById($id){
       $result = static::find_by_id("SELECT * FROM ".self::$db_cat." WHERE id= ?",$id);
       return $result;
   }
   
   private static function find_by_id($sql,$id){
       $stmt = Dbh::connect()->prepare($sql);
       $stmt->execute([$id]);
       $cat = $stmt->fetch();
       return $cat;
   }

   public static function update($catname,$id){
       $sql = "UPDATE ".self::$db_cat." SET cat_name= ? WHERE id = ?";
       $stmt = Dbh::connect()->prepare($sql);
       if($stmt->execute([$catname,$id])){
           $stmt = null;
           return true;
        }else{
            return false;
        }

   }

   public static function delete($id){
      $sql = "DELETE FROM ".self::$db_cat." WHERE id = ?";
      $stmt = Dbh::connect()->prepare($sql);
      if($stmt->execute([$id])){
           $stmt = null;
           return true;
      }else{
            return false;
      }
   }

}