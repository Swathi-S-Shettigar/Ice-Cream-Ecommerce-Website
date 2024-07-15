
<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id=$_COOKIE['user_id'];

}else{
    $user_id='';
    header('location:login.php');
}


if(isset($_POST['place_order'])){
    $name = $_POST['name'];
    $number=$_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['flat'].",".$_POST['street'].','.$_POST['city'].','.$_POST['country'].','.$_POST['pin'];
    $address_type=$_POST['address_type'];
    $method=$_POST['method'];

    $verify_cart=$conn->prepare('select * from cart where user_id=?');
    $verify_cart->execute([$user_id]);

    if (isset($_GET['get_id'])) {
        $get_product=$conn->prepare('select * from products where id=? limit 1');
        $get_product->execute([$_GET['get_id']]);

        if ($get_product->rowCount()>0) {
            while($fetch_p=$get_product->fetch(PDO::FETCH_ASSOC)){
                $seller_id=$fetch_p['seller_id'];

                $insert_order= $conn->prepare('insert into orders (id,user_id,seller_id,name,number,email,address,address_type,method,product_id,price,qty) values(?,?,?,?,?,?,?,?,?,?,?,?)');
                $insert_order->execute([uniqid(),$user_id,$seller_id,$name,$number,$email,$address,$address_type,$method,$fetch_p['id'],$fetch_p['price'],1]);

                header('location:home.php');
            }
        }else{
            $warning[]='something went wrong';
        }
    }elseif($verify_cart->rowCount()>0){
        while($f_cart=$verify_cart->fetch(PDO::FETCH_ASSOC)){
            $s_products=$conn->prepare('select * from products where id=? limit 1');
            $s_products->execute([$f_cart['product_id']]);
            $f_product=$s_products->fetch(PDO::FETCH_ASSOC);
            $seller_id=$f_product['seller_id'];

            $insert_order= $conn->prepare('insert into orders (id,user_id,seller_id,name,number,email,address,address_type,method,product_id,price,qty) values(?,?,?,?,?,?,?,?,?,?,?,?)');
            $insert_order->execute([uniqid(),$user_id,$seller_id,$name,$number,$email,$address,$address_type,$method,$f_cart['product_id'],$f_cart['price'],$f_cart['qty']]);




        }
        if ($insert_order) {
            $delete_cart=$conn->prepare('delete from cart where user_id=?');
            $delete_cart->execute([$user_id]);
            header('location:home.php');
        }
    }else{
        $warning[]='something went wrong';
    }


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-Payment Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    
    <div class="checkout">
        <div class="heading">
            <h1>Payment summary</h1>
            <img src="image/separator-img.png" alt="">
        </div>
        <div class="row">
            <form action="" method="post" class="register">
                <input type="hidden" name="p_id" value="<?= $get_id;?>">
                <h3>billing details</h3>
                <div class="flex">
                    <div class="box">
                        <div class="input-field">
                            <p>your name <span>*</span></p>
                            <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="input">
                        </div>


                        <div class="input-field">
                            <p>your number <span>*</span></p>
                            <input type="number" name="number" required maxlength="10" placeholder="enter your number" class="input">
                        </div>

                        <div class="input-field">
                            <p>your email <span>*</span></p>
                            <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="input">
                        </div>

                        <div class="input-field">
                            <p>payment method<span>*</span></p>
                            <select name="method" class="input" id="">
                                <option value="cash on delivery">cash on delivery</option>
                                <option value="credit or debit">credit or debit</option>
                                <option value="net banking">net banking</option>
                                <option value="UPI orRuPay">UPI or RuPay</option>
                                <option value="paytm">paytm</option>

                            </select>
                        </div>

                        <div class="input-field">
                            <p>address type<span>*</span></p>
                            <select name="address_type" class="input" id="">
                                <option value="home">Home</option>
                                <option value="office">office</option>
                                

                            </select>
                        </div>
                    </div>

                    <div class="box">
                    <div class="input-field">
                            <p>address line 1 <span>*</span></p>
                            <input type="text" name="flat" required maxlength="10" placeholder="e.g flat or building name" class="input">
                        </div>

                        <div class="input-field">
                            <p>address line 2 <span>*</span></p>
                            <input type="text" name="street" required maxlength="10" placeholder="e.g street name" class="input">
                        </div>

                        <div class="input-field">
                            <p>city name <span>*</span></p>
                            <input type="text" name="city" required maxlength="10" placeholder="e.g city name" class="input">
                        </div>
                        
                        <div class="input-field">
                            <p>country name <span>*</span></p>
                            <input type="text" name="country" required maxlength="10" placeholder="e.g country name" class="input">
                        </div>

                        <div class="input-field">
                            <p>pincode <span>*</span></p>
                            <input type="number" name="pin" required maxlength="6" min="0" placeholder="e.g 110181 " class="input">
                        </div>
                    </div>

                    <button type="submit" name="place_order" class="btn" style="border-radius: 45px;">Place order</button>

                </div>
            </form>

            <div class="summary">
                <h3>my bag</h3>
                <div class="box-container">
                    <?php
                    $grand_total=0;
                    if(isset($_GET['get_id'])){
                        $select_get=$conn->prepare('select * from products where id=?');
                        $select_get->execute($_GET['get_id']);

                        while($fetch_get=$select_get->fetch(PDO::FETCH_ASSOC)){
                            $sub_total=$fetch_get['price'];
                            $grand_total+=$sub_total;
                       
                    ?>

                    <div class="flex">
                        <img src="uploaded_files/<?= $fetch_get['image'];?>" class="image" alt="">

                        <div class="">
                            <h3 class="name">
                                <?= $fetch_get['name'];?>
                            </h3>
                            <p class="price">
                                Rs <?= $fetch_get['price'];?>/-
                            </p>
                        </div>
                    </div>


                    <?php
                     }
                    }else{
                        $select_cart=$conn->prepare('select * from cart where user_id=?');
                        $select_cart->execute([$user_id]);

                        if($select_cart->rowCount()>0){
                            while($fetch_cart=$select_cart->fetch(PDO::FETCH_ASSOC)){
                                $select_products=$conn->prepare('select * from products where id=?');
                                $select_products->execute([$fetch_cart['product_id']]);
                                $fetch_products=$select_products->fetch(PDO::FETCH_ASSOC);
                                $sub_total=($fetch_cart['qty']*$fetch_products['price']);
                                $grand_total+=$sub_total;
                           
                    ?>

                    <div class="flex">
                        <img src="uploaded_files/<?= $fetch_products['image'];?>" class="image" alt="">

                        <div class="">
                            <h3 class="name">
                                <?= $fetch_products['name'];?>
                            </h3>
                            <p class="price">
                                Rs <?= $fetch_products['price'];?> X <?= $fetch_cart['qty'];?>

                            </p>
                        </div>
                    </div>

                    
                    <?php
                                }
                            }else{
                                echo '<p class="empty" style="margin-left:25px;">Your Cart is Empty!</p>';
                            }
                        }
                    ?>
                </div>
                <div class="grand-total">
                    <span>Total Amount Payable:</span>
                    <p>Rs <?= $grand_total;?>/-</p>
                </div>


            </div>
        </div>
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
