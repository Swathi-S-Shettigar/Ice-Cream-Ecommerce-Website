
<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id=$_COOKIE['user_id'];

}else{
    $user_id='';
}

$pid=$_GET['pid'];
include 'components/add_wishlist.php';
include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-View  Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    
    
    <section class="view_page">
        <div class="heading">
            <h1>product details</h1>
            <img src="image/separator-img.png" alt="">
        </div>

        <?php
        if (isset($_GET['pid'])) {
            $pid=$_GET['pid'];
            $select_products=$conn->prepare("SELECT * FROM `products` WHERE id=?");
            $select_products->execute([$pid]);

            if ($select_products->rowCount()>0) {
                while($fetch_products=$select_products->fetch(PDO::FETCH_ASSOC)){
        ?>

        <form action="" method="post" class="box">
            <div class="img-box">
                <img src="uploaded_files/<?= $fetch_products['image']; ?>" alt="">
            </div>

            <div class="detail" >
                <?php if($fetch_products['stock']>9){?>

                    <span class="stock" style="color: green; margin-left: -100px;">in stock</span>

                <?php } elseif($fetch_products['stock']==0){ ?>
                    <span class="stock" style="color: red; margin-left: -100px;">out of stock</span>
                    <?php } else{?>
                        <span class="stock" style="color: red; margin-left: -100px;" >Hurry only <?= $fetch_products['stock']; ?> left</span>
                <?php } ?>


                <p class="price" style=" margin-left: -100px;">Rs <?= $fetch_products['price']; ?>/-</p>

                <div class="name" style=" margin-left: -100px;">
                    <?= $fetch_products['name'];?>
                </div>

                <p class="product-detail" style=" margin-left: -100px;">
                    <?= $fetch_products['product_detail'];?>
                </p>

                <input type="hidden" name="product_id" value="<?= $fetch_products['id'];?>">

                <div class="button" style=" margin-left: -100px;">
                    <button type="submit" name="add_to_wishlist" class="btn" style="border-radius:45px;">add to wishlist <i class="fa fa-heart-o" aria-hidden="true"></i></button>

                    <input type="hidden" name="qty" value="1" min="0" class="quantity">

                    <button type="submit" name="add_to_cart" class="btn" style="border-radius:45px;">add to cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                </div>
            </div>

        </form>

        <?php
                }
            }
        }
        ?>

    </section>

    <div class="products">
        <div class="heading">
            <h1>similar products</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            <img src="image/separator-img.png" alt="">
        </div>
        <?php include 'components/shop.php';?>
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
