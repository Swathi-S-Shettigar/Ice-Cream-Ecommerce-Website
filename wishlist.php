
<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id=$_COOKIE['user_id'];

}else{
    $user_id='location:login.php';
}


include 'components/add_cart.php';


/* delete */
if(isset($_POST['delete_item'])){
    $wishlist_id=$_POST['wishlist_id'];
    $verify_delete=$conn->prepare('select * from wishlist where id=?');
    $verify_delete->execute([$wishlist_id]);

    if($verify_delete->rowCount()>0){
        $delete_wishlist_id=$conn->prepare('delete from wishlist where id=?');
        $delete_wishlist_id->execute([$wishlist_id]);
        $success[]='item removed from wishlist';
    }else{
        $warning[]='item already removed';
    }
    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-wishlist Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    
    <div class="products">
        <div class="heading">
            <h1>my wishlist</h1>
            <img src="image/separator-img.png" alt="">
        </div>
        <div class="box-container">
            <?php
            $grand_total=0;
            $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id =?");
            $select_wishlist->execute([$user_id]);

            if($select_wishlist->rowCount() > 0){
                while($fetch_wishlist=$select_wishlist->fetch(PDO::FETCH_ASSOC)){
                    $select_products=$conn->prepare('select * from products where id=?');
                    $select_products->execute([$fetch_wishlist['product_id']]);

                    if($select_products->rowCount()>0){
                        $fetch_products=$select_products->fetch(PDO::FETCH_ASSOC);
            ?>

            <form action="" method="post" class="box <?php if($fetch_products['stock']==0){
                echo 'disabled';
            }; ?>">
            <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
            <img src="uploaded_files/<?= $fetch_products['image'];?>" class="image">
            
            <?php
            if($fetch_products['stock']>0){
            ?>

            <span class="stock" style="color: green;">in stock</span>
            <?php }elseif($fetch_products['stock']==0){ ?>
                <span class="stock" style="color: red;">out of stock</span>
                <?php } else {?>

                    <span class="stock " style="color: red;">Hurry,only <?= $fetch_products['stock']; ?> left</span>


                <?php } ?>

                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <div class="button">
                        <div><h3><?= $fetch_products['name']; ?></h3></div>
                        <div>
                            <button type="submit" name="add_to_cart"><i class="fa fa-shopping-cart"></i></button> 
                            <a href="view_page.php?pid=<?= $fetch_products['id'];?>" class="fa fa-eye"></a>
                            <button type="submit" name="delete_item" onclick="return confirm('remove from wishlist');"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                    </div>

                    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">

                    <div class="flex">
                        <p class="price">price Rs<?=  $fetch_products['price']; ?>/-</p>

                    </div>

                    <div class="flex">
                        <input type="hidden" name="qty" required min="1" value="1" max="99" class="qty" maxlength="2">

                    </div>

                </div>
            

            </form>

            <?php

                    $grand_total+=$fetch_wishlist['price'];
             }
            }
            
        }else{
            echo '<div class="empty" style="margin-left:25%;">
            <p>your wishlist is empty<p>
            </div>';
        }
        ?>
            
        </div>
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
