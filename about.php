
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
    <title>Blue Sky Summer-About us Page </title>
    <link rel="stylesheet" href="../icecream_shop/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include '../icecream_shop/components/user_header.php';?>
    <div class="banner" style="background-image: url(../icecream_shop/image/banner.jpg);
    background-position:center;background-attachment:fixed;">
        <div class="detail">
            <h1>About us</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora quas rem sequi expedita mollitia, cumque, eos dignissimos alias incidunt culpa nulla voluptas a iusto iure nam quam. Quasi, vero reiciendis?</p>
            <span><a href="home.php">Home</a><i class="fa fa-arrow-right" aria-hidden="true"></i>about us</span>
        </div>
    </div>
    <!-- chef -->
    <div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>Alex Doe</span>
                    <h1>Masterchef</h1>
                    <img src="image/separator-img.png" >
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatem eius nisi, doloremque assumenda sint vel debitis, cupiditate in id deserunt. Laboriosam animi dicta fugiat ad iusto praesentium! Suscipit, saepe?</p>
                <div class="flex-btn">
                    <a href="" class="btn" >explore our menu</a>
                    <a href="menu.php" class="btn">visit our shop</a>
                </div>
            </div>

            <div class="box">
                <img src="image/ceaf.png" class="img">
            </div>
        </div>
    </div>

    <!-- story -->

    <div class="story">
        <div class="heading">
            <h1>Our Story</h1>
            <img src="image/separator-img.png" >

        </div>
       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias facilis odit ab facere iure a, <br>nihil nostrum soluta consequatur ea accusamus aut labore impedit amet quasi illum recusandae quos <br> In dolorem, aperiam ipsa enim velit error illo autem cumque accusamus omnis aspernatur nobis reiciendis <br> et possimus optio sunt quibusdam aliquam natus! Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>Iste laborum enim, quis labore quibusdam quia, nam aliquid eligendi, at quo unde provident magnam. </p> 
       <a href="menu.php" class="btn" style="border-radius: 45px;">our services</a>
    </div>

    <div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="image/about.png" >

            </div>
            <div class="box">
                <div class="heading">
                    <h1>Taking Ice Cream To New Heights</h1>
                    <img src="image/separator-img.png" >
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus dicta iusto qui minima distinctio, amet fugit atque aut incidunt mollitia. Repellendus molestias suscipit magni sit voluptatibus repellat possimus qui saepe!</p>
                <a href="" class="btn" style="border-radius: 45px;">learn more</a>
            </div>
        </div>
    </div>

    <!-- team -->
     <div class="team">
        <div class="heading">
            <h1>Quality and passion with our services</h1>
            
            <img src="image/separator-img.png" >
        </div>
        <div class="box-container" style="margin-left: -300px;">
            <div class="box">
                <img src="image/team-1.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>Ralph Johnson</h2>
                    <p>Coffee Chef</p>
                </div>
            </div>

            <div class="box">
                <img src="image/team-2.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>Fiona Johnson</h2>
                    <p>Pastry Chef</p>
                </div>
            </div>

            <div class="box">
                <img src="image/team-3.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>Tom Knelitonns</h2>
                    <p>Baker</p>
                </div>
            </div>

            
        </div>

     </div>

     <!-- standers -->
     <!--  <div class="standers">
        <div class="detail">
            <div class="heading">
                <h1>Our standerts</h1>
                <img src="image/separator-img.png" alt="">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            <i class="fa fa-heart" aria-hidden="true"></i>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            <i class="fa fa-heart" aria-hidden="true"></i>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            <i class="fa fa-heart" aria-hidden="true"></i>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            <i class="fa fa-heart" aria-hidden="true"></i>

        </div>
      </div> -->
     <!-- testimonial -->
      <!-- <div class="testimonial">
        <div class="heading">
            <h1>Testimonial</h1>
            <img src="image/separator-img.png" alt="">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
                <div class="slide-col">
                    <div class="user-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>

                    <div class="user-img">
                        <img src="image/testimonial (1).jpg" alt="">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>

                    <div class="user-img">
                        <img src="image/testimonial (2).jpg" alt="">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>

                    <div class="user-img">
                        <img src="image/testimonial (3).jpg" alt="">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>

                    <div class="user-img">
                        <img src="image/testimonial (4).jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="indicator">
            <span class="btn1 active"></span>
            <span class="btn1"></span>

            <span class="btn1"></span>
            <span class="btn1"></span>

        </div>
      </div> -->


    <!-- mission -->
    <div class="mission">
        <div class="box-container">
            <div class="box">
            <div class="heading">
                    <h1>Our Mission</h1>
                    <img src="image/separator-img.png" alt="">
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission1.webp" alt="">
                    </div>
                    <div>
                        <h2>vanila with honey</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, consequuntur! Rerum, dignissimos nobis? Totam eius consectetur rerum fuga impedit rem, assumenda iure harum reiciendis placeat, maiores officia quidem commodi quasi!</p>
                    </div>
                </div>

                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission2.webp" alt="">
                    </div>
                    <div>
                        <h2>pappermint chip</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, consequuntur! Rerum, dignissimos nobis? Totam eius consectetur rerum fuga impedit rem, assumenda iure harum reiciendis placeat, maiores officia quidem commodi quasi!</p>
                    </div>
                </div>

                <div class="detail">
                    <div class="img-box">
                        <img src="image\products\547235148_012c012ccc@2x.jpg" alt="">
                    </div>
                    <div>
                        <h2>rasberry sorbat</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, consequuntur! Rerum, dignissimos nobis? Totam eius consectetur rerum fuga impedit rem, assumenda iure harum reiciendis placeat, maiores officia quidem commodi quasi!</p>
                    </div>
                </div>

                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission.webp" alt="">
                    </div>
                    <div>
                        <h2>mexican chocolate</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, consequuntur! Rerum, dignissimos nobis? Totam eius consectetur rerum fuga impedit rem, assumenda iure harum reiciendis placeat, maiores officia quidem commodi quasi!</p>
                    </div>
                </div>
            </div>

            <div class="box">
                <img src="image/form.png" class="img">
            </div>
        </div>
    </div>












    <!-- footer -->
    <?php include 'components/footer.php'; ?>

    <script src="../icecream_shop/js/user_script.js"></script>
    </body>
</html>
