
<header>
    
    <div class="logo">
        <img src="../image/flogo.png" width="150">

    </div>
    <div class="right">
        <div class="fa fa-user" id="user-btn"></div>
        <div class="toggle-btn"><i class="fa fa-bars" aria-hidden="true"></i></div>
    </div>
    <div class="profile-detail">
        <?php
        $select_profile=$conn->prepare("SELECT * FROM sellers WHERE id=?");
        $select_profile->execute([$seller_id]);

        if($select_profile->rowCount()>0){
            $fetch_profile=$select_profile->fetch(PDO::FETCH_ASSOC);

        
        ?>
        <div class="profile">
            <img src="../image/profile.jpeg" class="logo-img" width="100"> 
            <p><?=$fetch_profile['name'];?></p>
            <div class="flex-btn">
                <a href="profile.php" class="btn">Profile</a>
                <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?')" class="btn">Logout</a>
            </div>

        </div>
        <?php }?>
    </div>
</header>
<div class="sidebar-container">
    <div class="sidebar">
    <?php
        $select_profile=$conn->prepare("SELECT * FROM sellers WHERE id=?");
        $select_profile->execute([$seller_id]);

        if($select_profile->rowCount()>0){
            $fetch_profile=$select_profile->fetch(PDO::FETCH_ASSOC);

        
        ?>
        <div class="profile">
            <img src="../image/profile.jpeg" class="logo-img" width="100">
            <p><?=$fetch_profile['name'];?></p>
        </div>
        <?php }?> 
        <h5>Menu</h5>
        <div class="navbar">
            <ul>
                <li><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i>Dashboard</a></li>
                <li><a href="add_products.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Add products</a></li>
                <li><a href="view_product.php"><i class="fa fa-eye" aria-hidden="true"></i>View product</a></li>
                <li><a href="user_accounts.php"><i class="fa fa-street-view" aria-hidden="true"></i>Accounts</a></li>
                <!-- <li><a href="user_accounts.php"><i class="fa fa-street-view" aria-hidden="true"></i>Accounts</a></li> -->
                <li><a href="../components/admin_logout.php" onclick="return confirm('Logout from this website');">
                <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
            </ul>
        </div>
        <h5>Find Us</h5>
        <div class="social-links">
            <i class="fa fa-facebook-official" aria-hidden="true"></i>
            <i class="fa fa-instagram" aria-hidden="true"></i>
            <i class="fa fa-linkedin-square" aria-hidden="true"></i>
            <i class="fa fa-twitter" aria-hidden="true"></i>
            <i class="fa fa-pinterest" aria-hidden="true"></i>




        </div>
    </div>
</div>