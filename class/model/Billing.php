<?php 

class Billing extends Dbh{

   private static $db_billing = 'billing_details';
   private static $db_tranx = 'transactions';

   public static function addBill($address,$phone,$user_id){
      $sql = "INSERT INTO ".self::$db_billing."(user_id,address,phone,created_at) VALUES (?,?,?,?)";
      $stmt = Dbh::connect()->prepare($sql);
      $result = $stmt->execute([$user_id,$address,$phone,Date('Y-m-d H:i:s')]);
      return $result;
    
   }

   public static function addTrnx($user_id,$reference,$status,$amount,$gateway_response,$paid_at,$currency,$authorization_code,$customer_email,$customer_name){
      $sql = "INSERT INTO ".self::$db_tranx."(user_id,reference,status,amount,gateway_response,paid_at,currency,authorization_code,email,customer_name,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
      $stmt = Dbh::connect()->prepare($sql);
      $result = $stmt->execute([$user_id,$reference,$status,$amount,$gateway_response,$paid_at,$currency,$authorization_code,$customer_email,$customer_name,Date('Y-m-d H:i:s')]);
      return $result;
   }
}