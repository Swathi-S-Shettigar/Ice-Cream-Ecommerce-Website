<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];

    }else{
        $seller_id='';
        header('location:login.php');
    }

    //update order from database
    if(isset($_POST['update_order'])){
        $order_id=$_POST['order_id'];
        $update_payment=$_POST['update_payment'];
        $update_pay=$conn->prepare('update orders set payment_status=? where id=?');
        $update_pay->execute([$update_payment,$order_id]);
        $success[]='order payment status updated successfully';
    }

    //delete order
    if (isset($_POST['delete_order'])) {
        $delete_id = $_POST['order_id'];
        $verify_delete=$conn->prepare('select * from orders where id=?');
        $verify_delete->execute([$delete_id]);
        if ($verify_delete->rowCount()>0) {
            $delete_order=$conn->prepare('delete from orders where id=?');
            $delete_order->execute([$delete_id]);
            $success[]='order deleted successfully';
        }else{
            $warning[]='order already deleted';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer -orders placed</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main-container">
    <?php
        include '../components/admin_header.php';
        
    ?> 
    <section class="order-container">
        <div class="heading" style="margin-left: 50%;">
            <h1>Total orders placed</h1>
            
            <img src="../image/separator-img.png" alt="">
        </div>

        <div class="box-container">
           <?php
            $select_order=$conn->prepare('select * from orders where seller_id=?');
            $select_order->execute([$seller_id]);
            if ($select_order->rowCount()>0) {
                while ($fetch_order=$select_order->fetch(PDO::FETCH_ASSOC)) {

                    
              
           ?>
           <div class="box">
                    <div class="status" style="color: <?php if ($fetch_order['status']=='in progress') {
                        echo 'limegreen';
                    }else {
                        echo 'red';
                    }
                    ?>;"><?= $fetch_order['status']; ?></div>
                    <div class="details">
                        <p>user name: <span><?= $fetch_order['name']; ?></span></p>
                        <p>user id: <span><?= $fetch_order['user_id']; ?></span></p>
                        <p>placed on: <span><?= $fetch_order['date']; ?></span></p>
                        <p>user number: <span><?= $fetch_order['number']; ?></span></p>
                        <p>user email: <span><?= $fetch_order['email']; ?></span></p>
                        <p>total price: <span><?= $fetch_order['price']; ?></span></p>
                        <p>payment method: <span><?= $fetch_order['method']; ?></span></p>
                        <p>user address: <span><?= $fetch_order['address']; ?></span></p>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?= $fetch_order['id'];?>">
                        <select name="update_payment" class="box" style="width:90%;margin-left:0.1%">
                            <option disabled selected><?= $fetch_order['payment_status'];?></option>
                            <option value="pending">Pending</option>
                            <option value="order delivered">Order delivered</option>
                        </select>
                        <div class="flex-btn" >
                            <input type="submit" value="update payment" class="btn" name="update_order">
                            <input type="submit" value="delete order" class="btn" name="delete_order" onclick="return confirm('delete this order');">

                        </div>
                    </form>
                </div>
          
           <?php
             }
            }else{
                echo '<div class="empty">
                    <p>no order placed yet!</p>
                </div>';
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
