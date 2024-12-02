<?php
   
  function del_cart_items(){

        $cartObject = new CartController();
        $cartObject->deleteAllCartByDate();
    }

   
