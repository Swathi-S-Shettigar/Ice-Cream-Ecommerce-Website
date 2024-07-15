
<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id=$_COOKIE['user_id'];

}else{
    $user_id='';
}


if(isset($_POST['submit'])){
    $select_seller=$conn->prepare('select * from users where id=? LIMIT 1');
    $select_seller->execute([$user_id]);
    $fetch_seller=$select_seller->fetch(PDO::FETCH_ASSOC);
    $prev_pass=$fetch_seller['password'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    
    //update name
    if(!empty($name)){
        $update_name=$conn->prepare('update users set name=? where id=?');
        $update_name->execute([$name,$user_id]);
        $success[]='Username updated successfully';
    }
    //update email
    if (!empty($email)) {
        $select_email=$conn->prepare('select * from users where id=? and email=?');
        $select_email->execute([$user_id,$email]);

        if ($select_email->rowCount()>0) {

            $warning[]='email already exist';
        }else{
            $update_email=$conn->prepare('update users set email=? where id=?');
            $update_email->execute([$email,$user_id]);
            $success[]='email updated successfully';
        }
    }

    //update password
    $empty_pass='da39a3ee5e6b4b0d3255bfef95601896666';

    $old_pass=$_POST['old_pass'];
    $new_pass=$_POST['new_pass'];

    $cpass=$_POST['cpass'];
    
    if ($old_pass!=$empty_pass) {
        if ($old_pass!=$prev_pass) {
            $warning[]='old password not matched';
        }elseif ($new_pass!=$cpass) {
            $warning[]='password not matched';

        }else{
            if ($new_pass!=$empty_pass) {
                $update_pass=$conn->prepare('update users set password=? where id=?');
                $update_pass->execute([$cpass,$user_id]);
                $success[]='password updated successfully';
            }else{
                $warning[]='please enter a new password';
            }
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-user update Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    
    

    <section class="form-container" >
    <div class="heading" style="margin-left: 1%;">
            <h1 >Update Profile Details</h1>
            
            <img src="image/separator-img.png" alt="">
        </div>
        <form action="" method="post" enctype="multipart/form-data" class="register" style="width: 50%;margin-left:1%;margin-top:40px">
            <div class="img-box">
                <img src="image/profile.jpeg" >
            </div>
            <div class="flex">
                <!-- <div class="input-field">
                    <p>Your name<span>*</span></p>
                    <input type="text" name="name" placeholder="<?=$fetch_profile['name'];?>" class="box" style="border-radius: 45px;"> -->
                <div class="col">
                    <div class="input-field">
                        <p>Your name<span>*</span></p>
                        <input type="text" name="name" placeholder="<?=$fetch_profile['name'];?>" class="box" style="border-radius: 45px;">
                    </div>
                    <div class="input-field">
                        <p>Your email<span>*</span></p>
                        <input type="email" name="email" placeholder="<?=$fetch_profile['email'];?>" class="box" style="border-radius: 45px;">
                    </div>
                    
            
         
                    <div class="input-field">
                        <p>old password<span>*</span></p>
                        <input type="password" name="old_pass" placeholder="enter your old password" class="box" style="border-radius: 45px;">
                    </div>
                    <div class="input-field">
                        <p>new password<span>*</span></p>
                        <input type="password" name="new_pass" placeholder="enter your new password" class="box" style="border-radius: 45px;">
                    </div>
                    <div class="input-field">
                        <p>confirm password<span>*</span></p>
                        <input type="password" name="cpass" placeholder="confirm  password" class="box" style="border-radius: 45px;">
                    </div>
                </div>
             </div>
             <input type="submit" value="update profile" name="submit" class="btn" style="border-radius: 45px;">
        </form>
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
