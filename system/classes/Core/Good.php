<?php

namespace Core;

class Good extends \Core\Unit
{
    public function setTable(){
        return 'core_goods';
    }

    public function getElements() {
        $connect = new \Core\ConnectDB();
        $filter = '';
        $filter_price = '';

        if(isset($_GET['category_id']) && $cat_id = $_GET['category_id']) {
            $filter .= " AND category_id = $cat_id";
        }

        if(isset($_GET['type']) && $type_id = $_GET['type']) {
            $filter .= " AND type_id = $type_id";
        }

        if(isset($_GET['is_new']) && $is_new = $_GET['is_new']) {
            $filter .= " AND is_new = $is_new";
        }

        if(isset($_GET['size']) && $size_id = $_GET['size']) {
            $filter .= " AND `$size_id` = '1'";
        }

        //Prices

        if(isset($_GET['price']) && $_GET['price'] == 1) {
            $filter_price = " AND price BETWEEN 500 AND 1999";
        }
        if(isset($_GET['price']) && $_GET['price'] == 2) {
            $filter_price = " AND price BETWEEN 2000 AND 4999";
        }
        if(isset($_GET['price']) && $_GET['price'] == 3) {
            $filter_price = " AND price BETWEEN 5000 AND 9999";
        }
        if(isset($_GET['price']) && $_GET['price'] == 4) {
            $filter_price = " AND price >=10000";
        }
        //the end

        $page=1;
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $limit = 8;
        $from = ($page-1)*$limit;

        $result =  mysqli_query($connect->getConnection(), "SELECT `core_goods`.*, `sizes`.* FROM `core_goods`LEFT JOIN `sizes` ON `core_goods`.`id` = `sizes`.`good_id` WHERE `core_goods`.`id`>0 $filter $filter_price LIMIT $from, $limit");
        return $result;
    }

    protected function getData() {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        mysqli_set_charset($link, 'utf8');
        $result =  mysqli_query($link, "SELECT `core_goods`.*, `sizes`.* FROM `core_goods`LEFT JOIN `sizes` ON `core_goods`.`id` = `sizes`.`good_id` WHERE good_id=".$this->id);
        $row = mysqli_fetch_assoc($result);
        $this->data = $row;
        mysqli_close($link);
        
    }
    



    /* public $title;
    public $price;
    public $photo;

    function getInfo() {

        if(!$this->data) {
            $link = mysqli_connect('localhost', 'root', '', 'eshop');
            mysqli_set_charset($link, 'utf8');
            $result =  mysqli_query($link, "SELECT * FROM `core_goods` WHERE id=".$this->id);
            $row = mysqli_fetch_assoc($result);

            $this->data = $row;

            mysqli_close($link);
        }

        $this->title = ($this->data)['title'];
        $this->price = ($this->data)['price'];
        $this->photo = ($this->data)['photo'];

        // var_dump($result);

        mysqli_close($link);
    }

    function title() {
        return $this->title;
    }

    function price() {
        return $this->price;
    }

    function photo() {
        return $this->photo;
    }*/
} 
