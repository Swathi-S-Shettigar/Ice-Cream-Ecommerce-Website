
<?php
include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id=$_COOKIE['user_id'];

}else{
    $user_id='';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-Home Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>

    <!-- slider section -->
     <div class="slider-container">
        <div class="slider">
            <div class="slideBox active">
                <div class="textBox">
                    <h1>We pride ourselfs on <br>exceptional flavors</h1>
                    <a href="menu.php" class="btn" style="border-radius: 45px;">Shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider.jpg">
                </div>
            </div>
            <div class="slideBox">
                <div class="textBox">
                    <h1>cold treats are my kind <br>of comfort food</h1>
                    <a href="menu.php" class="btn" style="border-radius: 45px;">Shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider0.jpg">
                </div>
            </div>
        </div>
        <ul class="controls">
            <li onclick="nextSlide();" class="next"><i class="fa fa-chevron-circle-right"></i></li>
            <li onclick="prevSlide();" class="prev"><i class="fa fa-chevron-circle-left"></i></li>


        </ul>
     </div>

     <!-- service section -->
      <div class="service">
        <div class="box-container">
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">

                    </div>
                </div>
                <div class="detail">
                    <h4>Delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (2).png" class="img1">
                        <img src="image/services (3).png" class="img2">

                    </div>
                </div>
                <div class="detail">
                    <h4>Payment</h4>
                    <span>100% secure</span>
                </div>
            </div>

          <!--   <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (5).png" class="img1">
                        <img src="image/services (6).png" class="img2">

                    </div>
                </div>
                <div class="detail">
                    <h4>Support</h4>
                    <span>24*7 hours</span>
                </div>
            </div> -->

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (7).png" class="img1">
                        <img src="image/services (8).png" class="img2">

                    </div>
                </div>
                <div class="detail">
                    <h4>Gift Service</h4>
                    <span>support gift service</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service.png" class="img1">
                        <img src="image/service (1).png" class="img2">

                    </div>
                </div>
                <div class="detail">
                    <h4>Return</h4>
                    <span>24*7 free  return</span>
                </div>
            </div>
        </div>
      </div>

    <!-- category section -->
     <div class="categories">
        <div class="heading">
            <h1>categories features</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories.jpg" >
                <a href="menu.php" class="btn">coconuts</a>
            </div>

            <div class="box">
                <img src="image/categories0.jpg" >
                <a href="menu.php" class="btn">chocolate</a>
            </div>

            <div class="box">
                <img src="image/categories2.jpg" >
                <a href="menu.php" class="btn">strawberry</a>
            </div>

            <div class="box">
                <img src="image/categories1.jpg" >
                <a href="menu.php" class="btn">cornetto</a>
            </div>
        </div>
     </div>

     <img src="image/menu-banner.jpg" class="menu-banner">

     <!-- taste section -->
      <div class="taste">
        <div class="heading">
            <span>Taste </span>
            <h1>buy any ice cream @ get ont free</h1>
            <img src="image/separator-img.png" alt="">
        </div>

        <div class="box-container">
            <div class="box">
                <img src="image/taste.webp" >
                <div class="detail">
                    <h2>
                        natural sweetness
                    </h2>
                    <h1>vanila </h1>
                </div>
            </div>

            <div class="box">
                <img src="image/taste0.webp" >
                <div class="detail">
                    <h2>
                        natural sweetness
                    </h2>
                    <h1>matcha </h1>
                </div>
            </div>

            <div class="box">
                <img src="image/taste1.webp" >
                <div class="detail">
                    <h2>
                        natural sweetness
                    </h2>
                    <h1>blueberry </h1>
                </div>
            </div>
        </div>
      </div>

      <!-- container section -->
       <div class="ice-container">
        <div class="overlay"></div>
        <div class="detail">
            <h1>Ice cream is cheaper than <br>therapy for stress</h1>
            <p>jdhksjkhaflkhflfshksjmmmkoswghtnnjswfetppglvbdjjsgemlaamdeqrlds</p>
            <a href="menu.php" class="btn">shop now</a>
        </div>
       </div>

       <!-- taste2 section -->
        <div class="taste2">
            <div class="t-banner">
                <div class="overlay"></div>
                <div class="detail">
                <h1>find your taste of desserts</h1>
                <p>jjmdkitmnq wbfhkfjjfkdf</p>
                <a href="menu.php" class="btn" style="border-radius: 45px;">shop now</a>
                </div>
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="box-overlay"></div>
                    <img src="image/type4.jpg" >
                    <div class="box-details fadeIn-bottom">
                        <h1>Strawberry</h1>
                        <p>find your taste of desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
                </div>

                <div class="box">
                    <div class="box-overlay"></div>
                    <img src="image/type.avif" >
                    <div class="box-details fadeIn-bottom">
                        <h1>Strawberry</h1>
                        <p>find your taste of desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
                </div>

                <div class="box">
                    <div class="box-overlay"></div>
                    <img src="image/type1.png" >
                    <div class="box-details fadeIn-bottom">
                        <h1>Strawberry</h1>
                        <p>find your taste of desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
                </div>

                <div class="box">
                    <div class="box-overlay"></div>
                    <img src="image/type2.png" >
                    <div class="box-details fadeIn-bottom">
                        <h1>Strawberry</h1>
                        <p>find your taste of desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-overlay"></div>
                    <img src="image/type0.avif" >
                    <div class="box-details fadeIn-bottom">
                        <h1>Strawberry</h1>
                        <p>find your taste of desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-overlay"></div>
                    <img src="image/type3.jpg" >
                    <div class="box-details fadeIn-bottom">
                        <h1>Strawberry</h1>
                        <p>find your taste of desserts</p>
                        <a href="menu.php" class="btn">explore more</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- flavours section -->
         <div class="flavor">
            <div class="box-container">
                <img src="image/left-banner2.webp" >
                <div class="detail">
                    <h1>Hot Deal! Sale Up To <span>20% off</span></h1>
                    <p>expired</p>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
            </div>
         </div>

         <!-- usage section -->
          <div class="usage">
            <div class="heading">
                <h1>How It Works</h1>
                <img src="image/separator-img.png" alt="">
            </div>
            <div class="row">
                <div class="box-container">
                    <div class="box">
                        <img src="image/icon.avif" >
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>htmmkighhqwfethttt</p>
                        </div>
                    </div>

                    <div class="box">
                        <img src="image/icon0.avif" >
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>htmmkighhqwfethttt</p>
                        </div>
                    </div>

                    <div class="box">
                        <img src="image/icon1.avif" >
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>htmmkighhqwfethttt</p>
                        </div>
                    </div>
                </div>
                <img src="image/sub-banner.png" class="divider">
                <div class="box-container">
                    <div class="box">
                        <img src="image/icon2.avif" >
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>htmmkighhqwfethttt</p>
                        </div>
                    </div>

                    <div class="box">
                        <img src="image/icon3.avif" >
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>htmmkighhqwfethttt</p>
                        </div>
                    </div>

                    <div class="box">
                        <img src="image/icon4.avif" >
                        <div class="detail">
                            <h3>scoop ice-cream</h3>
                            <p>htmmkighhqwfethttt</p>
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <!-- pride section -->
           <div class="pride">
                <div class="detail">
                    <h1>We pride ourselves on <br>Exceptional flavors</h1>
                    <p>bgndhhhtheopltngjjjt</p>
                    <a href="menu.php" class="btn" style="border-radius: 45px;">shop now</a>
                </div>
           </div>

           <!-- footer -->
            <?php include 'components/footer.php'; ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../icecream_shop/js/user_script.js"></script>

    <?php
        include '../icecream_shop/components/alert.php';
    ?>  
</body>
</html>
