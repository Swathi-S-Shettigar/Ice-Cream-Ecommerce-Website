
<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id=$_COOKIE['user_id'];

}else{
    $user_id='';
}

if (isset($_POST['submit'])) {
    $id = unique_id();
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    $select_seller = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $select_seller->execute([$email]);

    if ($select_seller->rowCount() > 0) {
        $warning[] = 'You have already registered!Please login.';
    } else {
        if ($pass != $cpass) {
            $warning[] = 'Confirm password does not match!';
        } else {
            $insert_seller = $conn->prepare("INSERT INTO users (id, name, email, password) VALUES (?, ?, ?, ?)");
            if ($insert_seller->execute([$id, $name, $email, $pass])) {
                $success[] = 'New user is successfully registered! Please login now.';
            } else {
                $error[] = 'Registration failed! Please try again.';
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
    <title>Blue Sky Summer-user register Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    <!-- <div class="banner" style="background-image: url(../icecream_shop/image/banner.jpg);
    background-position:center;background-attachment:fixed;">
        <div class="detail">
            <h1>register</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora quas rem sequi expedita mollitia, cumque, eos dignissimos alias incidunt culpa nulla voluptas a iusto iure nam quam. Quasi, vero reiciendis?</p>
            <span><a href="home.php">Home</a><i class="fa fa-arrow-right" aria-hidden="true"></i>register</span>
        </div>
    </div> -->
    

    <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Register Now</h3>
        <div class="flex">
            <div class="col">
                <div class="input-field">
                    <p>Your Name<span>*</span></p>
                    <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box">
                </div>
                <div class="input-field">
                    <p>Your Email<span>*</span></p>
                    <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
                </div>
            </div>
            <div class="col">
                <div class="input-field">
                    <p>Your Password<span>*</span></p>
                    <input type="password" name="pass" placeholder="Enter password" maxlength="50" required class="box">
                </div>
                <div class="input-field">
                    <p>Confirm Password<span>*</span></p>
                    <input type="password" name="cpass" placeholder="Confirm password" maxlength="50" required class="box">
                </div>
            </div>
        </div>
        <p class="link">Already have an account?<a href="login.php">  Login now!</a></p>
        <input type="submit" value="Register Now" name="submit" class="btn">
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
