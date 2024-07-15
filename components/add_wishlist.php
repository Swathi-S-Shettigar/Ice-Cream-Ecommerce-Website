<?php
if (isset($_POST['add_to_wishlist'])) {
    if($user_id!=''){
        $id=unique_id();
        $product_id=$_POST['product_id'];
        $verify_wishlist=$conn->prepare('select * from wishlist where user_id=? and product_id=?');
        $verify_wishlist->execute([$user_id,$product_id]);
        $cart_num=$conn->prepare('select * from cart where user_id=? and product_id=?');
        $cart_num->execute([$user_id,$product_id]);

        if ($verify_wishlist->rowCount()>0) {
            $warning[]='product already exists';
        }else if($cart_num->rowCount()>0){
            $warning[]='product already exists in your cart';
        
        }else if($user_id!=''){
            $select_price=$conn->prepare('select * from  products where id=? limit 1');
            $select_price->execute([$product_id]);
            $fetch_price=$select_price->fetch(PDO::FETCH_ASSOC);

            $insert_wishlist=$conn->prepare('insert into wishlist (id,user_id,product_id,price) values(?,?,?,?)');
            $insert_wishlist->execute([$id,$user_id,$product_id,$fetch_price['price']]);
            $success[]='product added to wishlist';
        }
    }else{
        $warning[]='please  login first';
    }
}
?>