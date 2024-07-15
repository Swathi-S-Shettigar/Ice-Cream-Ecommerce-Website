<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];

    }else{
        $seller_id='';
        header('location:login.php');
    }

    //delete message from database
    if (isset($_POST['delete_msg'])) {
        $delete_id=$_POST['delete_id'];
        $verify_delete=$conn->prepare('select * from message where id=?');
        $verify_delete->execute([$delete_id]);

        if($verify_delete->rowCount()>0){
            $delete_msg=$conn->prepare('delete from message where id=?');
            $delete_msg->execute([$delete_id]);

            $success[]='message deleted successfully';
        }else{
            $warning[]='message already deleted';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - unread messages</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main-container">
    <?php
        include '../components/admin_header.php';
        
    ?> 
    <section class="message-container">
        <div class="heading" style="margin-left: 50%;">
            <h1>Unread message</h1>
            
            <img src="../image/separator-img.png" alt="">
        </div>

        <div class="box-container">
            <?php
                $select_message=$conn->prepare('select * from message');
                $select_message->execute();
                if ($select_message->rowCount()>0) {
                    while ($fetch_message=$select_message->fetch(PDO::FETCH_ASSOC)) {

                        
           
            ?>
            <div class="box">
                <h3 class="name"><?= $fetch_message['name'];?></h3>
                <h4><?= $fetch_message['subject'];?></h4>
                <p><?= $fetch_message['message'];?></p>
                <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?= $fetch_message['id'];?>">
                    <input type="submit" value="delete message" name="delete_msg" class="btn" onclick="return confirm('delete this message?');">
                </form>
            </div>
            <?php
            }
            }else{
                echo '<div class="empty">
                <p>No of unread message yet!</p>
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
