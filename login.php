
<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id=$_COOKIE['user_id'];

}else{
    $user_id='';
}

if (isset($_POST['submit'])) {
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['pass'];
    

    $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? and password=?");
    $select_user->execute([$email,$pass]);
    $row=$select_user->fetch(PDO::FETCH_ASSOC);

   if ($select_user->rowCount() > 0) {
    setcookie('user_id', $row['id'],time()+60*60*24*30,'/');
    header('location: home.php');
}
else{
    $warning[]='Incorrect email or password';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-user login Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    
    

    <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data" class="login">
        <h3>Login Now</h3>
        <div class="input-field">
             <p>Your Email<span>*</span></p>
            <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
        </div>
        <div class="input-field">
             <p>Your Password<span>*</span></p>
            <input type="password" name="pass" placeholder="Enter password" maxlength="50" required class="box">
        </div>
       
        <p class="link"> Do not have an account?<a href="register.php">  Register Now!</a></p>
        <input type="submit" value="login now" name="submit" class="btn">
    </form>
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
