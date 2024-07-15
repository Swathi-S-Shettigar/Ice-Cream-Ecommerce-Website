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
    <title>Blue Sky Summer - Registered users page</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main-container">
    <?php
        include '../components/admin_header.php';
        
    ?> 
    <section class="user-container">
        <div class="heading" style="margin-left: 50%;">
            <h1>Registered users</h1>
            
            <img src="../image/separator-img.png" alt="">
        </div>

        <div class="box-container">
            <?php
            $select_users=$conn->prepare('select * from users ');
            $select_users->execute();

            if ($select_users->rowCount()>0) {
                while($fetch_users=$select_users->fetch(PDO::FETCH_ASSOC)){
                    $user_id=$fetch_users['id'];
                
            ?>
            <div class="box">
                <img src="../image/profile.jpeg" >
                <p>User id: <span><?= $user_id;?></span></p>
                <p>User name: <span><?= $fetch_users[ 'name']; ?></span></p>
                <p>User email: <span><?= $fetch_users[ 'email']; ?></span></p>
                


            </div>
            <?php
            }
            }else{
                echo '<div class="empty">
                <p>no user registered yet!</p>';
            }
            ?>
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
