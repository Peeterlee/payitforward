<?php

include_once('Database.php');

class Donation extends Database{
    public function Donate($number,$month,$year,$digit,$amount){
        $add = $this->runQuery("INSERT INTO donations(creadit_number,month,year,security,money) VALUES('$number','$month','$year','$digit','$amount')");

        if(!$add){
            echo "Error to MySQL: ".$this->getConnection()->error;
        }
    
        echo 'donated';
    }

    public function Total(){
        $grab = $this->runQuery("SELECT money FROM donations");
        $total = 0;
        while($row = mysqli_fetch_array($grab)){
            $total += $row['money'];
        }

        echo number_format($total);
    }
    

}