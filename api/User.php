<?php

include_once('Database.php');  


class User extends Database{

    public function RegisterUser($username, $password){
        $check = $this->runQuery("SELECT * FROM users WHERE username='$username' AND deleted = 0");

        if($check->num_rows>0){
            echo 'username already exists';
        }else{
            $hpassword = password_hash($password, PASSWORD_DEFAULT);
            $doublecheck = $this->runQuery("SELECT * FROM users WHERE username='$username' AND deleted=1");

            if($doublecheck->num_rows>0){
                $edit = $this->runQuery("UPDATE users SET password='$hpassword', deleted = 0 WHERE username='$username'");
            }else{
                $add = $this->runQuery("INSERT INTO users (username, password) VALUES('$username', '$hpassword')");
            }

            if($edit || $add){
                echo 'registered';
            }else{
                echo 'failed';
            }
        }
    }
    
    public function LoginUser($username, $password){
        $grab = $this->runQuery("SELECT * FROM users WHERE username='$username'");
        if($grab->num_rows>0){
            $hashed = mysqli_fetch_assoc($grab)['password'];
            if(password_verify($password,$hashed)){
                echo 'login';
            }else{
                echo 'wrong password';
            }
        }else{
            echo 'no username';
        }
    }

}