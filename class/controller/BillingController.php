<?php

class BillingController extends Billing{
    
   public function billUser($address,$phone,$user_id){
         $bill = Billing::addBill($address,$phone,$user_id);
         return $bill;
     }

    public function userPayment($address,$phone,$user_id,$email,$total_price){
      // delete cart items after payment

       // initiate payment
        $newamount = (int)$total_price;
        $key = "Bearer sk_test_bd26d3bef795b1b0896128cc607ce244af635f69";
        $callback_url = 'http://localhost/oop_ecommerce/payment_callback.php';
        $url = "https://api.paystack.co/transaction/initialize";
        $fields = [
            'email' => $email,
            'amount' => $newamount * 100,
            'callback_url' => $callback_url
        ];
        $data_string = json_encode($fields);
        $curl = curl_init();
        curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                  'Content-Type: application/json',  
                  "Authorization: $key"
                ),
              ));
        
        //execute post
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $ress = json_decode($response);
        return $ress;
    } 
    
    
    public function verifyPayment($reference,$user_id){

        $key = "Bearer sk_test_bd26d3bef795b1b0896128cc607ce244af635f69";
         // verify transaction 
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.paystack.co/transaction/verify/'.$reference,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',  
                "Authorization: $key"
            ),
        ));
        $new_response = curl_exec($curl);
        $err = curl_error($curl);
        $ress_new = json_decode($new_response);
        $reference = $ress_new->data->reference;
        $status = $ress_new->data->status;
        $amount = $ress_new->data->amount/100;
        $gateway_response = $ress_new->data->gateway_response;
        $paid_at = $ress_new->data->paid_at;
        $currency = $ress_new->data->currency;
        $authorization_code = $ress_new->data->authorization->authorization_code;
        $customer_email = $ress_new->data->customer->email;
        $customer_name = $ress_new->data->customer->first_name;
        $result = Billing::addTrnx($user_id,$reference,$status,$amount,$gateway_response,$paid_at,$currency,$authorization_code,$customer_email,$customer_name);
        if($result){
            //get cart items
            $items_sold = Cart::checkItemsSoldByUser($user_id);
            //insert into cart sold
             Cart::cartSold($items_sold);
            //delete items in cart after transaction is successful
             Cart::deleteCartByUserId($user_id);
            //redirect here
             header('Location:index.php?receipt');
        }

        
    }

   
    
   
}