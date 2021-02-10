function logout(){
    $.ajax({
        type: 'post',
        url: 'functions.php',
        data: {
            "logout": null
        }
    });
    location.reload();
}
function post(a, b, c) {
    $.ajax({
        type: 'post',
        url: 'functions.php',
        data: {
            "post": null,
            "post_body": a,
            "reply": b,
            "reply_post_id": c
        }
    });
    location.reload();
}
function deletepost(a, b) {
    $("#post"+a).remove();
    $.ajax({
        type: 'post',
        url: 'functions.php',
        data: {
            "deletepost": null,
            "post_id": a,
            "post_user_id": b
        }
    });
}
function like(a) {
    $("#"+a).attr("src", "https://img.icons8.com/ios-filled/26/000000/like--v1.png");
    $("#likes"+a).text(parseInt($("#likes"+a).text(),10) + 1);
    $("#btn"+a).attr("onclick", "unlike("+a+");");
    $.ajax({
        type: 'post',
        url: 'functions.php',
        data: {
            "likepost": null,
            "post_id": a
        }
    });
}
function unlike(a) {
    $("#"+a).attr("src", "https://img.icons8.com/metro/26/000000/like.png");
    $("#likes"+a).text(parseInt($("#likes"+a).text(),10) - 1);
    $("#btn"+a).attr("onclick", "like("+a+");");
    $.ajax({
        type: 'post',
        url: 'functions.php',
        data: {
            "unlikepost": null,
            "post_id": a
        }
    });
}
function follow(a) {
    $("#"+a).attr("src", "https://img.icons8.com/ios-filled/64/000000/add-user-male.png");
    $("#followers"+a).text(parseInt($("#followers"+a).text(),10) + 1);
    $("#btn"+a).attr("onclick", "unfollow("+a+");");
    $.ajax({
        type: 'post',
        url: 'functions.php',
        data: {
            "follow": null,
            "pull_user_id": a
        }
    });
}
function unfollow(a) {
    $("#"+a).attr("src", "https://img.icons8.com/ios/64/000000/add-user-male.png");
    $("#followers"+a).text(parseInt($("#followers"+a).text(),10) - 1);
    $("#btn"+a).attr("onclick", "follow("+a+");");
    $.ajax({
        type: 'post',
        url: 'functions.php',
        data: {
            "unfollow": null,
            "pull_user_id": a
        }
    });
}