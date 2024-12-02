<?php 

class Cart extends Dbh{

     private static $db_cart = 'cart';
     private static $db_prod = 'products';
     private static $db_user = 'users';
     private static $db_tranx = 'transactions';
     private static $db_billing_details = 'billing_details';
     private static $db_items_sold = 'sold_items';

     public static function getCartById($id){
       $result = static::find_by_id("SELECT * FROM ".self::$db_cart." WHERE user_id= ?",$id);
       return $result;
     }

     public static function getCartByIdd($id){
       $result = static::find_by_id("SELECT COUNT(*) AS count FROM ".self::$db_items_sold." WHERE user_id= ?",$id);
       return $result;
     }

     public static function checkItemsSoldByUser($id){
       $result = static::find_by_id_cart("SELECT * FROM ".self::$db_cart." WHERE user_id= ?",$id);
       return $result;
     }

     public  function getCartByUser($id,$p_id){
       $result = static::find_by_id_cart_id("SELECT COUNT(*) AS count FROM ".self::$db_cart." WHERE user_id= ? AND product_id= ? ",$id,$p_id);
       return $result;
     }
     

     public  function getItemsByUser($id,$p_id){
       $result = static::find_by_id_cart_id("SELECT COUNT(*) AS count FROM ".self::$db_items_sold." WHERE user_id= ? AND product_id= ? ",$id,$p_id);
       return $result;
     }

     public static function getItemsById($id){
       $result = static::find_by_id("SELECT * FROM ".self::$db_items_sold." WHERE user_id= ?",$id);
       return $result;
     }

     public static function getCartByIdPro($id,$p_id){
       $result = static::find_by_id_cart_id("SELECT * FROM ".self::$db_cart." WHERE user_id= ? AND product_id= ?",$id,$p_id);
       return $result;
     }
     
     private static function find_by_id_cart_id($sql,$id,$p_id){
       $stmt = Dbh::connect()->prepare($sql);
       $stmt->execute([$id,$p_id]);
       $cat = $stmt->fetch();
       return $cat;
     }
     
     public static function getAllCartByid($id){
       $result = static::find_by_id("SELECT * FROM ".self::$db_cart." WHERE product_id= ?",$id);
       return $result;
   }

   public static function getAlCartByIdPro($id){
       $result = static::find_by_id_cart("SELECT products.price AS theprice, products.p_id,products.product_name,products.mrp,products.image,products.description,products.status,cart.qty,cart.price,cart.product_id FROM ".self::$db_prod." 
       INNER JOIN ".self::$db_cart." 
       ON products.p_id = cart.product_id WHERE user_id=?",$id);
       return $result;

   }

   public static function getAlItemsByIdPro($id){
       $result = static::find_by_id_cart("SELECT products.price AS theprice, products.p_id,products.product_name,products.mrp,products.image,products.description,products.status,sold_items.qty,sold_items.price,sold_items.product_id FROM ".self::$db_prod." 
       INNER JOIN ".self::$db_items_sold." 
       ON products.p_id = sold_items.product_id WHERE user_id=?",$id);
       return $result;

   }

   public static function userReceiptDetails($id){
       $result = static::find_by_user_receipt("SELECT users.name,users.email,transactions.reference,transactions.created_at
       FROM ".self::$db_user." 
       INNER JOIN ".self::$db_tranx." 
       ON users.id = transactions.user_id WHERE user_id=?",$id);
       return $result;

   }

   public static function userReceiptDetailss($id){
       $result = static::find_by_user_receipt("SELECT users.name,users.email,billing_details.address,billing_details.phone
       FROM ".self::$db_user." 
       INNER JOIN ".self::$db_billing_details." 
       ON users.id = billing_details.user_id WHERE user_id=?",$id);
       return $result;

   }    

     public function addToCart($user_id,$p_id,$qty,$price){
        $sql = "INSERT INTO ".self::$db_cart." (user_id,product_id,qty,price,created_at,expire) VALUES (?,?,?,?,?,?)";
        $stmt = Dbh::connect()->prepare($sql);
        $result = $stmt->execute([$user_id,$p_id,$qty,$price,Date('Y-m-d H:i:s'),Date('Y-m-d',strtotime(' + 1 days'))]); 
     }

     public function deleteCartItems(){
        $sql = "DELETE FROM ".self::$db_cart." WHERE expire = ?";
        $stmt = Dbh::connect()->prepare($sql);
        if($stmt->execute([Date('Y-m-d')])){
           $stmt = null;
           return true;
        }else{
              return false;
        }
     }

     public static function deleteCartByUserId($user_id){
        $sql = "DELETE FROM ".self::$db_cart." WHERE user_id = ?";
        $stmt = Dbh::connect()->prepare($sql);
        if($stmt->execute([$user_id])){
           $stmt = null;
           return true;
        }else{
              return false;
        } 
     }

     public static function deleteCartByuserCart($user_id,$prod_id){
        $sql = "DELETE FROM ".self::$db_cart." WHERE user_id = ? AND product_id = ?";
        $stmt = Dbh::connect()->prepare($sql);
        if($stmt->execute([$user_id,$prod_id])){
           $stmt = null;
           return true;
        }else{
              return false;
        } 
     }


     public static function update($p_id,$newqty,$total_price,$user_id){
       $sql = "UPDATE ".self::$db_cart." SET qty= ?, price= ? WHERE product_id = ? AND user_id = ?";
       $stmt = Dbh::connect()->prepare($sql);
       if($stmt->execute([$newqty,$total_price,$p_id,$user_id])){
           $stmt = null;
           return true;
        }else{
            return false;
        }

     }

     public function counterCart($user_id){
        $result = static::find_by_id("SELECT SUM(qty) as theqty  FROM ".self::$db_cart." WHERE user_id= ?",$user_id);
        return $result;
     }

     public function sumItems($user_id){
        $result = static::find_by_id("SELECT SUM(price) as totalprice  FROM ".self::$db_cart." WHERE user_id= ?",$user_id);
        return $result;
     }

     public function sumCartItems($user_id){
        $result = static::find_by_id("SELECT SUM(price) as totalprice  FROM ".self::$db_items_sold." WHERE user_id= ?",$user_id);
        return $result;
     }
    

     private static function find_by_id($sql,$id){
       $stmt = Dbh::connect()->prepare($sql);
       $stmt->execute([$id]);
       $cat = $stmt->fetch();
       return $cat;
     }

     private static function find_by_id_cart($sql,$id){
       $stmt = Dbh::connect()->prepare($sql);
       $stmt->execute([$id]);
       $cat = $stmt->fetchAll();
       return $cat;
     }

      private static function find_by_user_receipt($sql,$id){
       $stmt = Dbh::connect()->prepare($sql);
       $stmt->execute([$id]);
       $cat = $stmt->fetch();
       return $cat;
     }

      private static function find_by_query($sql){
       $stmt = Dbh::connect()->query($sql);
       $cats = $stmt->fetchAll();
       return $cats;

      }

      public static function cartSold($items){
         foreach($items as $item){
             $sql = "INSERT INTO sold_items (user_id,product_id,qty,price,created_at) VALUES (?,?,?,?,?)";
             $stmt = Dbh::connect()->prepare($sql);
             $stmt->execute([$item['user_id'],$item['product_id'],$item['qty'],$item['price'],Date('Y-m-d H:i:s')]);
         }

       }

     
}