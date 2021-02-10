<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mobile</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style> @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap'); </style>
        <link rel="stylesheet" href="index.css">
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="functions.js"></script>
		<?php 
            include('connect.php');
            include('session.php');
		?>
    </head>
    <body>
        <div class="main-container">
            <div class="top-container">
                <ul class="nav-top">
                    <li><a href="#"><img style="padding-top: 1.5vh; padding-right: 10vw;" class="img-icon" src="https://img.icons8.com/material/24/ffffff/squared-menu--v1.png"></a></li>
                    <li><a href="#"><img class="img-logo" src="assets/link_white.svg"></a></li>
                    <li><a href="#"></a></li>
                </ul>
            </div>
            <div class="center-container">
                <div id="home-page" class="inactive-page active-page">
                    <?php
                        $query = mysqli_query($conn,"SELECT * from posts LEFT JOIN users on users.user_id = posts.post_user_id where reply=0 order by post_id DESC");
                        foreach($query as $row) {
                            $post_id = $row['post_id'];	
                            $post_user_id = $row['post_user_id'];	
                            $date_created = $row['date_created'];
                            $post_display_name = utf8_decode($row['display_name']);
                            $post_username = $row['username'];
                            $verified = $row['verified'];
                            $post_body = $row['post_body'];
                            $liked = false;

                            $query = mysqli_query($conn,"SELECT * from likes WHERE user_id=$user_id AND post_id=$post_id");
                            foreach($query as $row) {
                                $liked = true;
                            }

                            $query = mysqli_query($conn,"SELECT * from likes WHERE post_id=$post_id");
                            $likes = mysqli_num_rows($query);

                            $query = mysqli_query($conn,"SELECT * from posts WHERE reply=1 and reply_post_id=$post_id");
                            $replies = mysqli_num_rows($query);
                    ?>
                    <div class="post-outer" id="<?php echo 'post'.$post_id; ?>" onclick="showpage(document.getElementById('home-page'), document.getElementById('post-page'));">
                        <div class="post">
                            <div class="post-left">
                                <a><img class="profile-icon-tweet" src="assets/profilepic1.jpg"/></a>
                            </div>
                            <div class="post-center">
                                <h3 class="user-tweet-name"><?php echo $post_display_name; ?><span class="user-tweet-name-grey">@<?php echo $post_username; ?></span></h3>
                                <div class="message"><?php echo utf8_decode($post_body); ?></div>
                            </div>
                            <div class="post-right">
                                <ul class="interactions">
                                    <li><a><img class="interact-icon" src="assets/open-heart.png"/></a></li>
                                    <li><a><img class="interact-icon" src="https://img.icons8.com/fluent-systems-filled/24/ffffff/ellipsis.png"/></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div id="post-page" class="inactive-page">
                    <div class="post-outer" onclick="showpage(document.getElementById('post-page'), document.getElementById('home-page'));">
                        <div class="post">
                            <div class="post-left">
                                <a><img class="profile-icon-tweet" src="assets/profilepic1.jpg"/></a>
                            </div>
                            <div class="post-center">
                                <h3 class="user-tweet-name">Display Name <span class="user-tweet-name-grey">@Username</span></h3>
                                <div class="message">This is just a test post. No need to pay any attention to it. :)</div>
                            </div>
                            <div class="post-right">
                                <ul class="interactions">
                                    <li><a><img class="interact-icon" src="assets/open-heart.png"/></a></li>
                                    <li><a><img class="interact-icon" src="https://img.icons8.com/fluent-systems-filled/24/ffffff/ellipsis.png"/></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="discovery-page" class="inactive-page">
                    <div class="discovery-container">
                        <center><h2>Artist Discovery</h2>
                        <h4><i>Coming soon...</i></h4></center>
                    </div>
                </div>
                <div id="profile-page" class="inactive-page">
                    <div class="profile-outer">
                        <div class="profile">
                            <div class="profile-left">
                                <a href="#"><img class="profile-icon-profile" src="assets/profilepic1.jpg"/></a>
                            </div>
                            <div class="profile-right">
                                <h3 class="user-profile-name">Display Name <span class="user-profile-name-grey">@Username</span></h3>
                                <div class="bio">This is basically where the bio would go but this is not an actual bio. Why are you reading this??</div>
                            </div>
                        </div>
                        <button type="button" class="follow-button">Edit Profile</button>
                    </div>
                    <div class="post-outer">
                        <div class="post">
                            <div class="post-left">
                                <a href="#"><img class="profile-icon-tweet" src="assets/profilepic1.jpg"/></a>
                            </div>
                            <div class="post-center">
                                <h3 class="user-tweet-name">Display Name <span class="user-tweet-name-grey">@Username</span></h3>
                                <div class="message">This is just a test post. No need to pay any attention to it. :)</div>
                            </div>
                            <div class="post-right">
                                <ul class="interactions">
                                    <li><a href="#"><img class="interact-icon" src="assets/open-heart.png"/></a></li>
                                    <li><a href="#"><img class="interact-icon" src="https://img.icons8.com/fluent-systems-filled/24/ffffff/ellipsis.png"/></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-container">
                <ul class="nav">
                    <li onclick="bottomNav(document.getElementById('home-button'), document.getElementById('home-page'));" ><a><img id="home-button" class="img-icon active" src="https://img.icons8.com/material/96/ffffff/home--v5.png"></a></li>
                    <li onclick="bottomNav(document.getElementById('discover-button'), document.getElementById('discovery-page'));"><a><img id="discover-button" class="img-icon" src="https://img.icons8.com/ios-glyphs/90/ffffff/detective.png"></a></li>
                    <li onclick="bottomNav(document.getElementById('notifications-button'), document.getElementById('profile-page'));"><a><img id="notifications-button" class="img-icon" src="https://img.icons8.com/android/96/ffffff/appointment-reminders.png"></a></li>
                    <li onclick="bottomNav(document.getElementById('profile-button'), document.getElementById('profile-page'));"><a><img id="profile-button" class="img-icon" src="https://img.icons8.com/material/96/ffffff/user-male-circle--v1.png"></a></li>
                </ul>
            </div>
        </div>
    </body>
    <script>
        function bottomNav(event, pageid) {
            document.getElementById("home-button").classList = "img-icon";
            document.getElementById("discover-button").classList = "img-icon";
            document.getElementById("notifications-button").classList = "img-icon";
            document.getElementById("profile-button").classList = "img-icon";

            document.getElementById("home-page").classList = "inactive-page";
            document.getElementById("post-page").classList = "inactive-page";
            document.getElementById("discovery-page").classList = "inactive-page";
            document.getElementById("profile-page").classList = "inactive-page";

            event.classList = "img-icon active";
            pageid.classList = "inactive-page active-page";
        }
        function showpage(oldPageId, newPageid) {
            oldPageId.classList = "inactive-page";
            newPageid.classList = "inactive-page active-page";
        }
    </script>
</html>