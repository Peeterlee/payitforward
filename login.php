<?php

session_start();

require_once('./database.php');
require_once('./queries.php');
require_once('./helpers.php');

$username = $_POST['username'];
$password = $_POST['password'];

header("Content-type:application/json");
$check_username = runQuery("SELECT * FROM users WHERE username = '$username'");

if($check_username){
    echo json_encode('Please register. Username Doesnt Exist');
} else {
    $add = runQuery("SELECT id, username, password FROM users WHERE username = '$username'");
    $user_id = $grab[0]['id'];
    $hashed = $grab[0]['password'];
    if(password_verify($password, $hashed)){
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $username;
        echo json_encode(['message' => "Nice one", 'session' => $_SESSION]);
    } else 
        echo json_encode(["Password is Incorrect" => $grab, 'hashed' => $hashed, 'pass' => $password]);
}