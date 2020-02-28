<?php

include_once('User.php'); 
include_once('Post.php');
include_once('Comment.php');
include_once('Donation.php');

if(isset($_POST['username'])){
       
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User();
    $login = $user->LoginUser($username, $password); 
}

if(isset($_POST['delete'])){
    
    $title = $_POST['title'];
    $created = $_POST['created'];

    $post = new Posts();
    $delete = $post->Delete($title,$created);
}

if(isset($_POST['comment'])){

    $name = $_POST['user_name'];
    $content = $_POST['comment'];

    $comment = new Comment();
    $add = $comment->AddComment($_POST['post_id'],$name,$content);

    // require_once('./Database.php');
    // $comment = new Database();
    // $upload = $comment->runQuery("INSERT INTO posts (image, title, description, created) VALUES('$imgContent', '$title', '$desc', now())");
}

if(isset($_POST['getcomment'])){
    $comment = new Comment();
    $get = $comment->GetComment($_POST['post_id']);
}

if(isset($_POST['card_number'])){
    $hnumber = sha1($_POST['card_number']);
    $hmonth = sha1($_POST['expire_month']); 
    $hyear = sha1($_POST['expire_year']); 
    $hdigit = sha1($_POST['digit']);
    $amount = $_POST['amount'];

    $donation = new Donation();
    $donate = $donation->Donate($hnumber,$hmonth,$hyear,$hdigit,$amount);
}


