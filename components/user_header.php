<header class="header">
    <section class="flex">
        <a href="home.php" class="logo"><img src="image/flogo1.png" width="130px" ></a>

        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About us</a>
            <a href="menu.php">Shop</a>
            <a href="cart.php">Order</a>
            <!-- <a href="../contact.php">Contact us</a> -->

        </nav>
        <form action="search_product.php" method="post" class="search-form">
            <input type="text" name="search_product" placeholder="Search products..." required maxlength="100">
            <button type="submit" class="fa fa-search" id="search_product_btn"></button>
        </form>
        <div class="icons">
            <div class="fa fa-list" id="menu-btn"></div>
            <div class="fa fa-search" id="search-btn"></div>

            <?php
            $count_wishlist_item=$conn->prepare('select * from wishlist where user_id=?');
            $count_wishlist_item->execute([$user_id]);
            $total_wishlist_items=$count_wishlist_item->rowCount();
            ?>


            <a href="wishlist.php" ><i class="fa fa-heart-o" aria-hidden="true"></i><sup><?= $total_wishlist_items;?></sup></a>


            <?php
            $count_cart_item=$conn->prepare('select * from cart where user_id=?');
            $count_cart_item->execute([$user_id]);
            $total_cart_items=$count_cart_item->rowCount();
            ?>


            <a href="cart.php" ><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup><?=$total_cart_items;?></sup></a>
            <div class="fa fa-user" id="user-btn"></div>

        </div>
        <div class="profile-detail">
            <?php
                $select_profile=$conn->prepare('select * from users where id=?');
                $select_profile->execute([$user_id]);

                if($select_profile->rowCount() > 0){
                    $fetch_profile=$select_profile->fetch(PDO::FETCH_ASSOC);

                
            ?>
            <img src="image/profile.jpeg" >
            <h3 style="margin-bottom:1rem;"><?= $fetch_profile['name'];?></h3>
            <div class="flex-btn">
                <a href="profile.php" class="btn">view profile</a>
                <a href="components/user_logout.php" onclick="return confirm('logout from this website');" class="btn">Logout</a>
            </div>
            <?php
            }else{
                
           
            ?>
            <h3 style="margin-bottom: 1rem;">Please login or register</h3>
            <div class="flex-btn">
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="btn">Register</a>
            </div>
            <?php  } ?>
        </div>

    </section>

</header>