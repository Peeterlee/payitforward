<?php

include_once('api/Database.php');

$post = new Database();
$getPosts = $post->runQuery("SELECT * FROM comments WHERE post_id=20");
$result = mysqli_fetch_array($getPosts);


echo json_encode($result);