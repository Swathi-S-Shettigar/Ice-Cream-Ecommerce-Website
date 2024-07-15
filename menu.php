
<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id=$_COOKIE['user_id'];

}else{
    $user_id='';
}

include 'components/add_wishlist.php';
include 'components/add_cart.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-user menu Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    
    <div class="products">
        <div class="heading">
            <h1>our latest flavours</h1>
            <img src="image/separator-img.png" alt="">
        </div>
        <div class="box-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE status=?");
            $select_products->execute(['active']);

            if ($select_products->rowCount()>0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            
            ?>
            <form action="" method="post" class="box <?php if($fetch_products['stock']==0){
                echo 'disabled';
            }?>">
            <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
            <?php  if($fetch_products['stock']>0){
            ?>

            <span class="stock" style="color:green;">In stock</span>
            <?php }elseif($fetch_products['stock']==0){
            ?>
            <span class="stock" style="color:red;">out of stock</span>

            <?php }else{?>
            <span class="stock" style="color:red;">hurry,only <?=$fetch_products['stock'];?></span>
               
            <?php } ?>

            <div class="content">
                <img src="image/shape-19.png" class="shap">
                <div class="button">
                    <div><h3 class="name"><?= $fetch_products['name'];?></h3></div>
                    <div>
                        <button type="submit" name="add_to_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>

                        <button type="submit" name="add_to_wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></button>

                        <a href="view_page.php?pid=<?= $fetch_products['id']?>" class="fa fa-eye"></a>
                    </div>
                </div>
                <p class="price">
                    price Rs<?= $fetch_products['price'];?>/-
                    <input type="hidden" name="product_id"  value="<?= $fetch_products['id']?>">


                </p>

                <div class="flex-btn">
                    <!-- -->
                    <input type="number" name="qty" required min='1' max="99" maxlength="2" class="qty box" value="1">

                </div>
            </div>


            </form>



            <?php
                }
            }else{
                echo '<div class="empty">
                    <p>no products added yet!</p>
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
