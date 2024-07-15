<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];

    }else{
        $seller_id='';
        header('location:login.php');
    }
    if(isset($_POST['update'])){
        $product_id=$_POST['product_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $stock = $_POST['stock'];
        $status = $_POST['status'];
        
        $udate_product=$conn->prepare('update products set name=?, price=?, product_detail=?, stock=?,status=? where id=?');
        $udate_product->execute([$name,$price,$description,$stock,$status,$product_id]);
        $success[]='product updated successfully';
        $old_image=$_POST['old_image'];

        $image = $_FILES['image']['name'];
    
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/' . $image;

        $select_image=$conn->prepare('select * from products where image=? and seller_id=?');
        $select_image->execute([$image,$seller_id]);
        if(!empty($image)){
            if($image_size>20000000){
                $warning[]='image size is too large';
            }elseif($select_image->rowCount()>0){
                $warning[]='please rename your image';
            }else{
                $update_image=$conn->prepare('update products set image=? where id=?');
                $update_image->execute([$image,$product_id]);
                move_uploaded_file($image_tmp_name,$image_folder);
                if($old_image != $image and $old_image!= ''){
                    unlink('../uploaded_files/'.$old_image);
                }
                $success[]='image updated successfully';
            }
        }
    }

    //delete image
    if(isset($_POST['delete_image'])){
        $empty_image='';

        $product_id=$_POST['product_id'];
        $delete_image=$conn->prepare('select * from products where id=?');
        $delete_image->execute([$product_id]);
        $fetch_delete_image=$delete_image->fetch(PDO::FETCH_ASSOC);
        if($fetch_delete_image['image']!=''){
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
        }
        $unset_image=$conn->prepare('update products set image=? where id=?');
        $unset_image->execute([$empty_image,$product_id]);
        $success[]='image deleted successfully';
    }

    //delete product
    if(isset($_POST['delete_product'])){
        $product_id=$_POST['product_id'];

        $delete_image=$conn->prepare('select * from products where id=?');
        $delete_image->execute([$product_id]);
        $fetch_delete_image=$delete_image->fetch(PDO::FETCH_ASSOC);

        if($fetch_delete_image['image']!=''){
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
        }
        $delete_product=$conn->prepare('delete from products where id=?');
        $delete_product->execute([$product_id]);
        $success[]='products deleted successfully';
        header('location:view_product.php');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Edit Product</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main-container">
    <?php
        include '../components/admin_header.php';
        
    ?> 
    <section class="post-editor">
        <div class="heading">
            <h1>Edit Product</h1>
            
            <img src="../image/separator-img.png" alt="">
        </div>

        <div class="box-container">
            <?php
            $product_id=$_GET['id'];
            $select_product=$conn->prepare('select * from products where id=? and seller_id=?');
            $select_product->execute([$product_id,$seller_id]);
            if($select_product->rowCount()>0){
                while($fetch_product=$select_product->fetch(PDO::FETCH_ASSOC)){

               
            ?>
            <div class="form-container" style="width:40rem;margin-left:45%;">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <input type="hidden" name="old_image" value="<?= $fetch_product['image'];?>">
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id'];?>">
                    <div class="input-field">
                        <p>Product Status <span>*</span></p>
                        <select name="status" class="box" >
                            <option value="<?=$fetch_product['status']; ?>" Selected><?= $fetch_product['status'];?></option>
                            <option value="active">active</option>
                            <option value="deactive">deactive</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <p>Product name <span>*</span></p>
                        <input type="text" name="name"  value="<?= $fetch_product['name'];?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>Product price <span>*</span></p>
                        <input type="number" name="price"  value="<?= $fetch_product['price'];?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>Product description <span>*</span></p>
                        <textarea class="box" name="description" ><?= $fetch_product['product_detail'];?></textarea>
                    </div>
                    <div class="input-field">
                        <p>Product stock <span>*</span></p>
                        <input type="number" name="stock" value="<?= $fetch_product['stock'];?>" class="box" min='0' max='99999999' maxlength="10">
                    </div>
                    <div class="input-field">
                        <p>Product image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                        <?php
                        if($fetch_product['image']!=''){?>
                        <img src="../uploaded_files/<?= $fetch_product['image'];?>" alt="" class="image" style="border-radius: 50%;border:5px solid pink">
                        <div class="flex-btn">
                            <input type="submit" class="btn" name="delete_image" value="delete image" style="border-radius :45px;width:49%;">
                            <a href="view_product.php" class="btn" style="width: 49%;text-align:center; height:3rem;margin-top:0.7rem;border-radius:45px">
                                Back
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                    
            <div class="flex-btn">
               
                <input type="submit" value="update product" name="update" class="btn" style="border-radius: 45px;">
                <input type="submit" value="delete product" name="delete_product" class="btn" style="border-radius: 45px;">

            </div>

                </form>
            </div>
            <?php
             }
            }else{
                echo ' <div class="empty">
                <p>No of products added yet!</p>
                </div>';
            
            ?><br><br>
             <div class="flex-btn">
               <!--  <a href="view_product.php" class="btn" style="border-radius: 45px;text-align:center;">View product</a>
                <a href="add_product.php" class="btn" style="border-radius: 45px;text-align:center;">Add product</a> -->
                <input type="submit" value="update product" name="update" class="btn" style="border-radius: 45px;">
                <input type="submit" value="delete product" name="delete_post" class="btn" style="border-radius: 45px;">

            </div>
            <?php
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
