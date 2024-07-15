
<?php
    include 'components/connect.php';
    if (isset($_COOKIE['user_id'])) {
        $user_id=$_COOKIE['user_id'];

    }else{
        $user_id='location:login.php';
    }

    /* update cart */
    if(isset($_POST['update_cart'])){
        $cart_id=$_POST['cart_id'];
        $qty=$_POST['qty'];
        $update_qty=$conn->prepare('update cart set qty=? where id=?');
        $update_qty->execute([$qty,$cart_id]);
        $success[]='cart quantity updated successfully'; 
    }

    /* delete */
    if(isset($_POST['delete_item'])){
        $cart_id=$_POST['cart_id'];
        $verify_delete_item=$conn->prepare('select * from cart where id=?');
        $verify_delete_item->execute([$cart_id]);

        if($verify_delete_item->rowCount()>0){
            $delete_cart_id=$conn->prepare('delete from cart where id=?');
            $delete_cart_id->execute([$cart_id]);
            $success[]='product deleted from cart';
        }else{
            $warning[]='product already deleted from cart';
        }
    }


    /* empty */
    if(isset($_POST['empty_cart'])){
        $verify_empty_item=$conn->prepare('select * from cart where user_id=?');
        $verify_empty_item->execute([$user_id]);

        if($verify_empty_item->rowCount()>0){
            $delete_cart_id=$conn->prepare('delete from cart where user_id=?');
            $delete_cart_id->execute([$user_id]);
            $success[]='cart empty successfully';
        }else{
            $warning[]='cart already empty';
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-user cart Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    
    <div class="products">
        <div class="heading">
            <h1>my cart</h1>
            <img src="image/separator-img.png" alt="">
        </div>

        <div class="box-container">
            <?php
            $grand_total=0;
            $select_cart=$conn->prepare('select * from cart where user_id=?');
            $select_cart->execute([$user_id]);

            if($select_cart->rowCount()>0){
                while($fetch_cart=$select_cart->fetch(PDO::FETCH_ASSOC)){
                    $select_products=$conn->prepare('select * from products where id=?');
                    $select_products->execute([$fetch_cart['product_id']]);

                    if ($select_products->rowCount()>0) {
                        $fetch_products=$select_products->fetch(PDO::FETCH_ASSOC);
                    

            ?>

            <form action="" method="post" class="box <?php if($fetch_products['stock']==0){
                echo 'disabled';
            }?>">

            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
            <img src="uploaded_files/<?= $fetch_products['image'];?>" class="image" alt="">

            <?php if($fetch_products['stock']>9){?>

                <span class="stock" style="color: green;">In stock</span>
            <?php }elseif($fetch_products['stock']){ ?>
                <span class="stock" style="color: red;">out of stock</span>
            <?php } else{ ?>
                <span class="stock" style="color: red;">Hurry,only <?= $fetch_products['stock'];?> left</span>
           <?php }?>
            
            <div class="content">
                <img src="image/shape-19.png" class="shap" alt="">
                <h3 class='name'><?= $fetch_products['name'];?></h3>
                <div class="flex-btn">
                    <p class="price">
                        price<?= $fetch_products['price'];?>/-
                    </p>
                    <input type="number" name="qty" required min="1" max="99" value="<?=  $fetch_cart['qty']; ?>" class="qty" maxlength="2" class='box qty' style="border: 2px solid pink;">


                </div>
                <div class="flex-btn">
                    <p class="sub-total">
                        Subtotal: <span>Rs<?= $sub_total=($fetch_cart['qty']*$fetch_cart['price']);?></span> /-</p>

                    </p>
                    <button type="submit" name="delete_item" class="btn" onclick="return confirm('remove from cart?');" style="border-radius: 45px;">Delete</button>
                </div>
            </div>
        
        </form>

            <?php
                    $grand_total+=$sub_total;
                    }else{
                        echo '<div class="empty">
                        <p> your cart is empty!</p></div>';

                    }
                }
            }else{
                echo '<div class="empty" style="margin-left:25%;">
                <p> your cart is empty!</p></div>';   
            }
            ?>
        </div>
        <?php
        if($grand_total!=0){
        ?>
        <div class="cart-total">
            <p>Total amount payable : <span>Rs <?= $grand_total; ?>/-</span></p> 

            <div class="button">
                <form action="" method="post">
                    <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to empty your cart?');" style="border-radius: 45px;">empty cart</button>
                </form>

                <a href="checkout.php" class="btn" style="border-radius: 45px;">proceed to buy</a>

            </div>
        </div>
        <?php } ?>
    </div>

    


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/user_script.js"></script>

<?php
include 'components/alert.php';
?>


    <!-- footer -->
    <?php include 'components/footer.php'; ?>

    <script src="../icecream_shop/js/user_script.js"></script>
    </body>
</html>
