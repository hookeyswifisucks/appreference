<?php 
    include('connect.php');
    include('session.php');

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
        $count = mysqli_num_rows($query);
        $row = mysqli_fetch_array($query);

        if ($count > 0 && password_verify($password, $row["password"])){
            $_SESSION['id']=$row['user_id'];
            header('location:index.php');
        } else {
            header('location:login.php?error=login');
        }
    }
    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $display_name = mysqli_real_escape_string($conn, utf8_encode($_POST['display_name']));
        if(!preg_match('/[^A-Za-z0-9]/', $username) && !preg_match('/[^A-Za-z0-9]/', $_POST['password'])) {
            if(mysqli_num_rows(mysqli_query($conn,"select * from users where  username='$username'")) != 0){
                header('location:login.php?error=takenusername');
            } else {
                mysqli_query($conn,"insert into users (username, password, display_name, date_created) values ('$username', '$password', '$display_name', '".strtotime(date("Y-m-d h:i:sa"))."')");
                header('location:login.php');
            }
        } else {
            header('location:login.php?error=register');
        }
    }
    if(isset($_POST['logout'])) {
        session_destroy();
    }
    if(isset($_POST['post'])){
        $post_body  = mysqli_real_escape_string($conn, utf8_encode($_POST['post_body']));
        $reply = $_POST['reply'];
        $reply_post_id = $_POST['reply_post_id'];
        mysqli_query($conn,"insert into posts (post_user_id, post_body, date_created, reply, reply_post_id) values ('$user_id', '$post_body', '".strtotime(date("Y-m-d h:i:sa"))."', '$reply', '$reply_post_id') ");
    }
    if(isset($_POST['deletepost'])) {
        $post_id = $_POST["post_id"];
        $post_user_id = $_POST["post_user_id"];

        mysqli_query($conn,"delete from posts where post_id='$post_id'") or die (mysqli_error());
        mysqli_query($conn,"delete from likes where post_id=$post_id")or die(mysqli_error());
    }
    if(isset($_POST['likepost'])){
        $post_id = $_POST['post_id'];
        if(mysqli_num_rows(mysqli_query($conn,"SELECT * from likes WHERE user_id=$user_id AND post_id=$post_id")) == 0){
            mysqli_query($conn,"insert into likes (user_id,post_id,date_created) values ($user_id,$post_id,'".strtotime(date("Y-m-d h:i:sa"))."') ");
        }
    }
    if(isset($_POST['unlikepost'])){
        $post_id = $_POST['post_id'];
        mysqli_query($conn,"delete from likes where user_id=$user_id and post_id=$post_id");
    }
    if(isset($_POST['follow'])){
        $pull_user_id = $_POST['pull_user_id'];
        if(mysqli_num_rows(mysqli_query($conn,"SELECT * from follows WHERE followed_user_id=$pull_user_id AND follower_user_id=$user_id")) == 0){
            mysqli_query($conn,"insert into follows (follower_user_id,followed_user_id,date_created) values ($user_id,$pull_user_id,'".strtotime(date("Y-m-d h:i:sa"))."') ");
        }
    }
    if(isset($_POST['unfollow'])){
        $pull_user_id = $_POST['pull_user_id'];
        mysqli_query($conn,"delete from follows where follower_user_id=$user_id and followed_user_id=$pull_user_id");
    }
?>