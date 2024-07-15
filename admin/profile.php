<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];

    }else{
        $seller_id='';
        header('location:login.php');
    }

    $select_products=$conn->prepare('select * from products where seller_id=?');
    $select_products->execute([$seller_id]);
    $total_products=$select_products->rowCount();

    $select_orders=$conn->prepare('select * from orders where seller_id=?');
    $select_orders->execute([$seller_id]);
    $total_orders=$select_orders->rowCount();
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Seller profile page</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main-container">
    <?php
        include '../components/admin_header.php';
        
    ?> 
    <section class="seller-profile">
        <div class="heading" style="margin-left: 50%;">
            <h1>Profile Details</h1>
            
            <img src="../image/separator-img.png" alt="">
        </div>

       <div class="details">
            <div class="seller" style="margin-left: 2%;">
                <img src="../image/profile.jpeg" >
                <h3 class="name"><?= $fetch_profile['name'];?></h3>
                <span>Seller</span>
                <a href="update.php" class="btn" style="border-radius: 45px;">update profile</a>
            </div>
            <div class="flex" style="margin-left: 2%;">
                <div class="box">
                    <span><?= $total_products;?></span>
                    <p>Total products</p>
                    <a href="view_product.php" class="btn" style="border-radius: 45px;">View Products</a>
                </div>
                <div class="box">
                    <span><?= $total_orders;?></span>
                    <p>Total orders placed</p>
                    <a href="admin_order.php" class="btn" style="border-radius: 45px;">View Orders</a>
                </div>
            </div>

       </div>
    </section>
    </div>

    
    



    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/admin_script.js"></script>

    <?php
        include '../components/alert.php';
    ?>

</body>
</html>
