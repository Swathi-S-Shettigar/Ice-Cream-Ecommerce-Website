<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];

    }else{
        $seller_id='';
        header('location:login.php');
    }

    $get_id=$_GET['post_id'];

    //delete product
    if(isset($_POST['delete'])){
        $p_id=$_POST['product_id'];
        $delete_image=$conn->prepare('select * from products where id=? and seller_id=?');
        $delete_image->execute([$p_id,$seller_id]);
        $fetch_delete_image=$delete_image->fetch(PDO::FETCH_ASSOC);
        if($fetch_delete_image['']!=''){
            unlink('../uploaded_files/'.$fetch_delete_image['image']);


        }
        $delete_product=$conn->prepare('DELETE from products where id=? and seller_id=?');
        $delete_product->execute([$p_id,$seller_id]);
        header('loaction:view_product.php');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Show Products page
    </title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main-container">
    <?php
        include '../components/admin_header.php';
        
    ?> 
    <section class="read-post">
        <div class="heading">
            <h1>Product details</h1>
            
            <img src="../image/separator-img.png" alt="">
            <style>
                .read-post .heading h1{
                    margin-left: 50%;
                }
                .read-post .heading img{
                    margin-left: 50%;
                }
            </style>
        </div>
        <div class="box-container">
            <?php
            $select_product=$conn->prepare('select * from products where id=? and seller_id=?');
            $select_product->execute([$get_id,$seller_id]);
            if($select_product->rowCount()>0){
                while($fetch_product=$select_product->fetch(PDO::FETCH_ASSOC)){

               
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="product_id" value="<?= $fetch_product['id']?>">
                <div class="status" style="color: 
                <?php 
                if($fetch_product['status']=='active'){
                    echo 'limegreen';
                }else{
                    echo 'red';
                } ?>;">
                    <?= $fetch_product['status']; ?>
                </div>

                <?php 
                if($fetch_product['image']!=''){?>
                    <img src="../uploaded_files/<?= $fetch_product['image'];?>" class="image">
                <?php } ?>

                <div class="price">Rs <?= $fetch_product['price']?>/-</div>

                <div class="title"><?=$fetch_product['name'];?></div>
                <div class="content"><?=$fetch_product['product_detail'];?></div>

                <div class="flex-btn">
                    <a href="edit_product.php?id=<?= $fetch_product['product_detail'];?>" class="btn">Edit</a>
                    <button type="submit" name="delete" class="btn "  onclick="return confirm('Delete this product?')">Delete</button>
                    <a href="view_product.php?post_id=<?= $fetch_product['product_detail'];?>" class="btn">Back</a>

                </div>

                
            </form>
            <?php 
             }
            }else{
                echo ' <div class="empty">
                <p>No. of products added yet! <br><a href="add_products.php" class="btn" style="margin-top: 1.5rem;">
                Add products</a></p>
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
