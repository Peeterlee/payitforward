<?php

include_once('Database.php');

class Comment extends Database {

    public function AddComment($post_id, $name, $content){
        $add = $this->runQuery("INSERT INTO comments(post_id, name, content) VALUES($post_id, '$name', '$content')");

        if(!$add){
            echo "Error to MySQL: ".$this->getConnection()->error;
        }

        echo 'commented';
    }

    public function GetComment($post_id){
        $grab = $this->runQuery("SELECT * FROM comments WHERE post_id=$post_id");

        if($grab->num_rows>0){
            $result = mysqli_fetch_array($grab);
            echo  $result['name'].': '.$result['content'];
        }else{
            echo 'no';
        }
    }

}