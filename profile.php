
<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id=$_COOKIE['user_id'];

}else{
    $user_id='location:login.php';
}

$select_orders=$conn->prepare('select * from orders where user_id=?');
$select_orders->execute([$user_id]);
$total_orders=$select_orders->rowCount();

$select_message=$conn->prepare('select * from message where user_id=? ');
$select_message->execute([$user_id]);
$total_message=$select_message->rowCount();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-user profile Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    
    <section class="profile">
    
        <div class="heading">
            <h1>profile detail</h1>
            <img src="image/separator-img.png" alt="">
        </div>

        <div class="details">
            <div class="user">
                <img src="image/profile.jpeg" alt="">
                <h3><?=$fetch_profile['name'];?></h3>
                <p>user</p>
                <a href="update.php" class="btn" style="border-radius: 45px;">update profile</a>
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="flex">
                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                        <h3><?=$total_orders?></h3>
                    </div>
                    <a href="order.php" class="btn" style="border-radius: 45px;">view orders</a>
                </div>

                <div class="box">
                    <div class="flex">
                    <i class="fa fa-commenting" aria-hidden="true"></i>
                        <h3><?=$total_message?></h3>
                    </div>
                    <a href="message.php" class="btn" style="border-radius: 45px;">view message</a>
                </div>
            </div>
        </div>
    </section>



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
