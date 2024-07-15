<?php
    if (isset($_POST['add_to_cart'])) {
        if($user_id!=''){
            $id=unique_id();
            $product_id=$_POST['product_id'];
            $qty=$_POST['qty'];
            $verify_cart=$conn->prepare('select * from cart where user_id=? and product_id=?');
            $verify_cart->execute([$user_id,$product_id]);
            $max_cart_items=$conn->prepare('select * from cart where user_id=?');
            $max_cart_items->execute([$user_id]);

            if($verify_cart->rowCount()>0){
                $warning[]='product already exists in cart';
            }else if($max_cart_items->rowCount()>20){
                $warning[]='your cart is full';
            }
            else{
                $select_price=$conn->prepare('select * from products where id=? limit 1');
                $select_price->execute([$product_id]);
                $fetch_price=$select_price->fetch(PDO::FETCH_ASSOC);

                $insert_cart=$conn->prepare('insert into cart (id,user_id,product_id,price,qty) values(?,?,?,?,?)');
                $insert_cart->execute([$id,$user_id,$product_id,$fetch_price['price'],$qty]);
                $success[]='product added to cart';
            }
        }else{
            $warning[]='please login to add product to cart';
        }
    }
?>