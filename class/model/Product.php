<?php 

class Product extends Dbh{

    private static $db_prod = 'products';
    private static $db_cat = 'categories';

    public static function addProduct($product_name,$category_id,$mrp,$price,$qty,$description,$img_name){
      $sql = "INSERT INTO ".self::$db_prod." (category_id,product_name,mrp,price,qty,image,description,status) VALUES (?,?,?,?,?,?,?,?)";
      $stmt = Dbh::connect()->prepare($sql);
      $result = $stmt->execute([$category_id,$product_name,$mrp,$price,$qty,$img_name,$description,1]);
     
      if(!$result){
          header("Location:../../oop_ecommerce/index.php");
          exit();
      }else{
          return true;
      }
    
   }

   
   public static function getAllProducts(){
    //    $result = static::find_by_query("SELECT * FROM ".self::$db_prod." ORDER BY p_id DESC");
       $result = static::find_by_query("SELECT products.p_id,products.product_name,products.mrp,products.price,products.qty,products.image,products.description,products.status,categories.cat_name FROM ".self::$db_prod." 
       INNER JOIN ".self::$db_cat." 
       ON products.category_id = categories.id ORDER BY p_id DESC");
       return $result;
   }

   private static function find_by_query($sql){
       $stmt = Dbh::connect()->query($sql);
       $cats = $stmt->fetchAll();
       return $cats;
   }

   
   public static function addstatus($status,$id){
       $sql = "UPDATE ".self::$db_prod." SET status= ? WHERE id = ?";
       $stmt = Dbh::connect()->prepare($sql);
       if($stmt->execute([$status,$id])){
           $stmt = null;
           return true;
        }else{
            return false;
        }

   }

   public static function removestatus($status,$id){

       $sql = "UPDATE ".self::$db_prod." SET status= ? WHERE id = ?";
       $stmt = Dbh::connect()->prepare($sql);
       if($stmt->execute([$status,$id])){
           $stmt = null;
           return true;
        }else{
            return false;
        }
   }

   public function getProdById($id){
       $result = static::find_by_id("SELECT * FROM ".self::$db_prod." WHERE p_id= ?",$id);
       return $result;
   }
   
   private static function find_by_id($sql,$id){
       $stmt = Dbh::connect()->prepare($sql);
       $stmt->execute([$id]);
       $cat = $stmt->fetch();
       return $cat;
   }

   public static function update($catname,$id){
       $sql = "UPDATE ".self::$db_prod." SET cat_name= ? WHERE id = ?";
       $stmt = Dbh::connect()->prepare($sql);
       if($stmt->execute([$catname,$id])){
           $stmt = null;
           return true;
        }else{
            return false;
        }

   }

   public static function delete($id){
      $sql = "DELETE FROM ".self::$db_prod." WHERE id = ?";
      $stmt = Dbh::connect()->prepare($sql);
      if($stmt->execute([$id])){
           $stmt = null;
           return true;
      }else{
            return false;
      }
   }

}