<?php

namespace Core;

abstract class Unit 
{
    protected $id;
    protected $data;

    public function __construct($id = null) {
        $this->id = $id;
    }
    protected function getTable($table) {
        $this->table = $table;
    }
    public function setTable(){
        return $this->table;
    }

    public function getElements() {
        $connect = new \Core\ConnectDB();
        $result =  mysqli_query($connect->getConnection(), "SELECT * FROM ".$this->setTable());
        return $result;
    }

    protected function getData() {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        mysqli_set_charset($link, 'utf8');
        $result =  mysqli_query($link, "SELECT * FROM ".$this->setTable()." WHERE id=".$this->id);
        $row = mysqli_fetch_assoc($result);
        $this->data = $row;
        mysqli_close($link);
    }

    public function getField($field) {

        if(!$this->data) {
            $this->getData();
        }
        
        return ($this->data)[$field];
    }

    
}