<?php

include_once('Database.php');

class Posts extends Database{

    public function GetPosts(){
        $get = $this->runQuery("SELECT * FROM posts ORDER BY created");
        $row = mysqli_fetch_array($get);
        echo $row;
    }

    public function Upload($img, $title, $desc){
        $upload = $this->runQuery("INSERT INTO posts (image, title, description, created) VALUES('$img', '$title', '$desc', now())");

        if(!$upload){
            echo "Error to MySQL: ".$this->getConnection()->error;
        }

        echo 'uploaded';
    }

    public function Delete($title, $created){
        $delete = $this->runQuery("DELETE FROM posts WHERE title='$title' AND created='$created'");

        if(!$delete){
            echo "Error to MySQL: ".$this->getConnection()->error;
        }

        echo 'deleted';
    }
}