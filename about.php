<?php include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="navFooter.css">
    <link rel="stylesheet" href="about.css">
    <title>Online Food Ordering System</title>
</head>
<body>
<nav class="navbar">    
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse-nav">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
                <a href="index.php" class="navbar-brand"><svg height="38" width="20">
                    <polyline points="0,40 0,30 1,29.5 3,30 8,30 8,25 0,25 3,20 4,19 5,18 7,16 9,15 10,15 11,15 13,16 14,17 16,19 17,20 20,25 12,25 12,30 17,30 19,29.5 20,30 20,40" style="fill: none;stroke:#343434;stroke-width:2;" />
                </svg> Ofos</a>
            </div>
            <div class="collapse navbar-collapse" id="collapse-nav">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="order.php" class="nav-order"><span class="glyphicon glyphicon-shopping-cart"></span> Order</a></li>
                    <li><a href="contact.php" class="nav-order"><span class="glyphicon glyphicon-phone-alt"></span> Contact Us</a></li>
                    <?php 
                        $order = $new_food = $userOrder = "";
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            $foods_own = "SELECT * FROM orders WHERE username = '$username'";
                            $foods_found = $connect->query($foods_own);
                            $ordered_num = $foods_found->num_rows;
                            if ($_SESSION['username'] == 'admin') {
                                $ordered_food = "SELECT * FROM orders";
                                $orders_found = $connect->query($ordered_food);
                                $order_num = $orders_found->num_rows;
                                $order =  "<li><a href='orderRecieved.php' class='nav-order'><span class='glyphicon glyphicon-menu-hamburger'></span> Orders Recieved <span class='badge'>".$order_num."</span></a></li>";
                                $new_food = "<li><a href='newFood.php' class='nav-order'><span class='glyphicon glyphicon-new-window'></span> Post A New Food</a></li>";
                            }
                            if ($_SESSION['username'] != 'admin') {
                                $userOrder = "<li><a href='myOrders.php' class='nav-order'><span class='glyphicon glyphicon-expand'></span> My Orders <span class='badge'>".$ordered_num."</span></a></li>";
                            }
                            $profile = "SELECT * FROM profiles WHERE username = '$username'";
                            $profile_found = $connect->query($profile);
                            if ($profile_found->num_rows > 0 ) {
                                while ($profile_img = $profile_found->fetch_assoc()) {
                                    $profile_image = "profile_images/".$profile_img['profile_image']."";
                                }
                            }   
                            else {
                                $profile_image = "profile_images/profile.png";
                            }
                            echo "<span class='dropdown'>
                            <a class='nav-order dropdown-toggle' data-toggle='dropdown'><span><img src=".$profile_image." class='img-circle img-thumbnail' width='40' height='40'></span> ".$_SESSION['username']."<span class='caret'></span></a>
                            <ul class='dropdown-menu'>
                            <li><a href='profile.php' class='nav-order'><span class='glyphicon glyphicon-user'></span> Profile</a></li>
                            $order $new_food $userOrder
                            <li><a href='logout.php' class='nav-order'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
                            </ul>
                            </span>";
                        }
                        else {
                            echo "<li><a href='login.php' class='nav-login'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                        }
                    ?>
                    <li><a href='about.php' class='nav-about'>About</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="about-all col-md-12 col-sm-12">
    <div class="about-nav col-md-12 col-sm-12">
        <ul>
            <li><a data-page="developer" href="about.php"><span class="glyphicon glyphicon-link"></span> Develepor</a></li>
            <li><a data-page="company" href="about.php"><span class="glyphicon glyphicon-pushpin"></span> Company</a></li>
            <li><a data-page="admin" href="about.php"><span class="glyphicon glyphicon-user"></span> Adminstrator</a></li>
            <div class="location"></div>
        </ul>
    </div>
    <section data-index="0" class="developer">
        <h3>Developer</h3>
        <div class="text">
            <h3>Mulugeta Gebrekirstos !!!</h3>
            <p>i am begginner developer</p>
        </div>
        <div class="photo">
        
        </div>
    </section>
    <section data-index="1" class="company">
        <h3>company</h3>
    </section>
    <section data-index="2" class="admin">
        <h3>admin</h3>
    </section>
    <!--<div class="about-me col-md-8 col-sm-8">
        <h1><strong>About Me</strong></h1>
        <h3>Mulugeta Gebrekirstos</h3>
        <p>hii i am front end web developer <br> this website is mine, i hope you will enjoy it</p>
        <p>comment me for any suggestions or any feedbacks or <br> call me <span class="glyphicon glyphicon-phone"></span> for more information</p>
        <div class="social-media text-center">
            <h4><strong>You can found me:</strong></h4>
            <span class="glyphicon glyphicon-envelope"></span>
            <span class="glyphicon glyphicon-phone-alt"></span>
            <span class="fb-twit"><span class="glyphicon glyphicon-thumbs-up"></span> Like</span>
            <span class="glyphicon glyphicon-comment"></span>
        </div>
    </div>
    <div class="about-me2 col-md-6 col-sm-6">
        <h3>Comment Us: </h3>
        <?php 
            if (isset($_POST['aboutComment'])) {
                $comment = $connect->real_escape_string($_POST['comment']);
                $username = $_SESSION['username'];
                $save = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
                $connect->query($save);
            }
            ?>
        <form method="POST">
            <textarea name="comment" cols="90" rows="6" placeholder="Write Comment..." class="form-control"></textarea>
            <button class="btn" type="submit" name="aboutComment">Comment</button>
        </form>
    </div>-->
    </div>
    <div class="comments col-md-12 col-sm-12 text-center">
        <h3 style="text-decoration: underline">Comments</h3>
        <?php
            $comments = "SELECT * FROM comments LIMIT 10";
            $comments_received = $connect->query($comments);
            while ($comment = $comments_received->fetch_assoc()) {
                $commenter = $comment['username'];
                $profile = "SELECT * FROM profiles WHERE username = '$commenter'";
                $profile_found = $connect->query($profile);
                if ($profile_found->num_rows > 0 ) {
                    while ($profile_img = $profile_found->fetch_assoc()) {
                        $commenter_img = "profile_images/".$profile_img['profile_image']."";
                    }
                }   
                else {
                    $commenter_img = "profile_images/profile.png";
                }  
                echo "
                        <div class='individual-comments'>
                            <div class='commenter'>
                                <img src=".$commenter_img." alt='profile' class='img-circle img-thumbnail'>
                                <h4>".$comment['username']." :-</h4>
                            </div>
                            <div>
                                <p>".$comment['comment']."</p>
                            </div>
                        </div>
                    ";
            }
        ?>
    </div>
    <footer class="col-md-12 col-sm-12">
        <div class="logo col-md-3 col-sm-3">
        <a href="index.php" class="navbar-brand"><svg height="38" width="20">
            <polyline points="0,40 0,30 1,29.5 3,30 8,30 8,25 0,25 3,20 4,19 5,18 7,16 9,15 10,15 11,15 13,16 14,17 16,19 17,20 20,25 12,25 12,30 17,30 19,29.5 20,30 20,40" style="fill: none;stroke:#ffffff;stroke-width:2;" />
        </svg> Ofos</a>
        </div>
        <div class="about-us col-md-4 col-sm-4">
            <h3><span class="glyphicon glyphicon-info-sign"></span> About Us</h3>
            <a href="about.php"><span class="glyphicon glyphicon-link"></span> Develepor</a>
            <a href="about.php"><span class="glyphicon glyphicon-pushpin"></span> Company</a>
            <a href="about.php"><span class="glyphicon glyphicon-user"></span> Adminstrator</a>
            <a href="about.php"><span class="glyphicon glyphicon-retweet"></span> About All</a>
        </div>
        <div class="colmd-5 col-sm-5">
        <h3 style="color: #f6f6f6">Comment Us:</h3>
        <div class="comment">
            <?php 
                if (isset($_POST['footerComment'])) {
                    $comment = $connect->real_escape_string($_POST['comment']);
                    $username = $_SESSION['username'];
                    $save = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
                    $connect->query($save);
                }
            ?>
            <form method="POST">
                <p>Send comment</p>
                <textarea name="comment"  cols="30" rows="3" placeholder="Comment Or Message..."></textarea>
                <button class="btn" type="submit" name="footerComment"><span class="glyphicon glyphicon-comment"></span> Go</button>
            </form>
        </div>
        </div>
        <div class="copyright col-md-12 col-sm-12">
        <p>&copy;Copyright 2020. All Right Reserved! </p>
            
        </div>
    </footer>
    <script src="aboutSlider.js"></script>
</body>
</html>