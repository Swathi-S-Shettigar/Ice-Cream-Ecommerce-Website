<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];

    }else{
        $seller_id='';
        header('location:login.php');
    }

    //delete product

    if(isset($_POST['delete'])){
        $p_id=$_POST['products_id'];
        $delete_product=$conn->prepare('DELETE FROM products where id=?');
        $delete_product->execute([$p_id]);
        $success[]= 'product deleted successfully';
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
    <section class="show-post">
        <div class="heading">
            <h1>Your Products</h1>
            
            <img src="../image/separator-img.png" alt="">
            <style>
                .show-post .heading h1{
                    margin-left: 50%;
                }
                .show-post .heading img{
                    margin-left: 50%;
                }
            </style>
        </div>
        <div class="box-container">
            <?php
                $select_products=$conn->prepare('select * from products where seller_id=?');
                $select_products->execute([$seller_id]);
                if($select_products->rowCount()>0){
                    while($fetch_products=$select_products->fetch(PDO::FETCH_ASSOC)){

                    
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="products_id" value="<?=$fetch_products['id'];?>">
                <?php
                if($fetch_products['image']!=''){ ?>
                    <img src="../uploaded_files/<?=$fetch_products['image'];?>" class="image">
                <?php  }?>
                <div class="status" style="color: 
                <?php if($fetch_products['status']=='active'){
                    echo'limegreen';
                }else{
                    echo 'red';
                }
                ?>;">
                <?= $fetch_products['status'];?>
                </div>
                <div class="price">
                    <?=$fetch_products['price'];?>/-
                </div>
                <div class="content">
                    <img src="../image/shape-19.png" class="shap">
                    <div class="title"><?= $fetch_products['name'];?></div>
                    <div class="flex-btn">
                        <a href="edit_product.php?id=<?=$fetch_products['id'];?>" class="btn">Edit </a>
                        <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this product?');">Delete</button>
                        <a href="read_product.php?post_id=<?=$fetch_products['id'];?>" class="btn">Read </a>
                    </div>
                </div>
            </form>
            <?php
                }
            }else{
                echo ' <div class="empty">
                <p>No. of products added yet! <br><a href="add_products.php" class="btn" style="margin-top: 1.5rem;line-height2;">
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
