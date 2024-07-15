<div class="products">
       
        <div class="box-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE status=? limit 6");
            $select_products->execute(['active']);

            if ($select_products->rowCount()>0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            
            ?>
            <form action="" method="post" class="box <?php if($fetch_products['stock']==0){
                echo 'disabled';
            }?>">
            <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
            <?php  if($fetch_products['stock']>0){
            ?>

            <span class="stock" style="color:green;">In stock</span>
            <?php }elseif($fetch_products['stock']==0){
            ?>
            <span class="stock" style="color:red;">out of stock</span>

            <?php }else{?>
            <span class="stock" style="color:red;">hurry,only <?=$fetch_products['stock'];?></span>
               
            <?php } ?>

            <div class="content">
                <img src="image/shape-19.png" class="shap">
                <div class="button">
                    <div><h3 class="name"><?= $fetch_products['name'];?></h3></div>
                    <div>
                        <button type="submit" name="add_to_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>

                        <button type="submit" name="add_to_wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></button>

                        <a href="view_page.php?pid=<?= $fetch_products['id']?>" class="fa fa-eye"></a>
                    </div>
                </div>
                <p class="price">
                    price Rs<?= $fetch_products['price'];?>/-
                    <input type="hidden" name="product_id"  value="<?= $fetch_products['id']?>">


                </p>

                <div class="flex-btn">
                    <a href="checkout.php?get_id<?= $fetch_products['id']; ?>" class="btn" style="border-radius: 45px;">buy now</a>

                    <input type="number" name="qty" required min='1' max="99" maxlength="2" class="qty box" value="1">

                </div>
            </div>


            </form>



            <?php
                }
            }else{
                echo '<div class="empty">
                    <p>no products added yet!</p>
                </div>';
            }
            ?>
        </div>
    </div>