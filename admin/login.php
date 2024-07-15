<?php
include '../components/connect.php';

if (isset($_POST['submit'])) {
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['pass'];
    

    $select_seller = $conn->prepare("SELECT * FROM sellers WHERE email = ? and password=?");
    $select_seller->execute([$email,$pass]);
    $row=$select_seller->fetch(PDO::FETCH_ASSOC);

   if ($select_seller->rowCount() > 0) {
    setcookie('seller_id', $row['id'],time()+60*60*24*30,'/');
    header('location: dashboard.php');
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
    <title>Blue Sky Summer - Registration</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

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
<script src="../js/script.js"></script>

<?php
include '../components/alert.php';
?>

</body>
</html>
