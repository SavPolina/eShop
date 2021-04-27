<?php

namespace Core;

class Delivery extends \Core\Unit
{
    public function setTable()
    {
        return 'delivery';
    }

    public function getDataById($id) {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        mysqli_set_charset($link, 'utf8');
        $result =  mysqli_query($link, "SELECT * FROM ".$this->setTable()." WHERE id=".$id);
        $row = mysqli_fetch_assoc($result);
        $this->data = $row;
        mysqli_close($link);
        return ($this->data);
    }
    
}