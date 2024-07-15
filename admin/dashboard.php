<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];

    }else{
        $seller_id='';
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - admin dashboard</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main-container">
    <?php
        include '../components/admin_header.php';
        
    ?> 
    <section class="dashboard">
        <div class="heading">
            <h1>Dashboard</h1>
            
            <img src="../image/separator-img.png" alt="">
        </div>

        <div class="box-container">
            <div class="box">
                <h3>Welcome!</h3>
                <p><?=$fetch_profile['name'];?></p>
                <a href="update.php" class="btn">Update profile</a>
            </div>
           <!--  -->
            <div class="box">
                <?php 
                $select_products=$conn->prepare('SELECT * FROM products WHERE seller_id=?');
                $select_products->execute([$seller_id]);
                $number_of_products=$select_products->rowCount();
                ?>
                <h3><?=$number_of_products;?></h3>
                <p>Products</p>
                <a href="../admin/view_product.php" class="btn">View Product</a>
            </div>
            
            <div class="box">
                <?php 
                $select_users=$conn->prepare('SELECT * FROM users');
                $select_users->execute();
                $number_of_users=$select_users->rowCount();
                ?>
                <h3><?=$number_of_users;?></h3>
                <p>Users account</p>
                <a href="user_accounts.php" class="btn">See users</a>
            </div>
            <div class="box">
                <?php 
                $select_sellers=$conn->prepare('SELECT * FROM sellers');
                $select_sellers->execute();
                $number_of_sellers=$select_sellers->rowCount();
                ?>
                <h3><?=$number_of_sellers;?></h3>
                <p>Sellers account</p>
                <a href="user_accounts.php" class="btn">See sellers</a>
            </div>
            <div class="box">
                <?php 
                $select_orders=$conn->prepare('SELECT * FROM orders where seller_id=?');
                $select_orders->execute([$seller_id]);
                $number_of_orders=$select_orders->rowCount();
                ?>
                <h3><?=$number_of_orders;?></h3>
                <p>Total orders placed</p>
                <a href="admin_order.php" class="btn">Total orders</a>
            </div>
            <div class="box">
                <?php 
                $select_confirm_orders=$conn->prepare('SELECT * FROM orders where seller_id=? and status=?');
                $select_confirm_orders->execute([$seller_id,'in progress']);
                $number_of_confirm_orders=$select_confirm_orders->rowCount();
                ?>
                <h3><?=$number_of_confirm_orders;?></h3>
                <p>Total confirm orders</p>
                <a href="admin_order.php" class="btn">Confirm orders</a>
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
