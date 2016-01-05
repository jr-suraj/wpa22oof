<?php

/**
 * Created by PhpStorm.
 * User: suraj
 * Date: 1/2/16
 * Time: 10:06 AM
 *
 * Singaleton Pattern for DB Object
 *
 */
class DB extends PDO{

    // SELECT * FROM <table_name>

    private static $_instance = null;

    private $table_name;
    private $first_value = null;
    private $sign = null;
    private $second_value = null;
    private $sql = null;

    public function __construct()
    {
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'wpa22oo';
        $this->user = 'root';
        $this->pass = 'root';
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass );
    }

    public static function table($table_name) {
        if(!self::$_instance instanceof  DB) {
            self::$_instance = new DB();
        }
        self::$_instance->table_name = $table_name;
        return self::$_instance;
    }

    public function sel_all() {
        $this->sql = "SELECT * FROM "
            . $this->table_name;
        return $this->get($this->sql);

    }


    public function sel_where($first_value, $sign, $second_value) {
        $this->first_value = $first_value;
        $this->sign = $sign;
        $this->second_value = $second_value;
        $this->sql = "SELECT * FROM "
            . $this->table_name
            . " WHERE " . $this->first_value . $this->sign . $this->second_value;
        return $this->get($this->sql);

    }

    public function del_where($first_value, $sign, $second_value) {
        $this->first_value = $first_value;
        $this->sign = $sign;
        $this->second_value = $second_value;
        $this->sql = "DELETE FROM "
            . $this->table_name
            . " WHERE " . $this->first_value . $this->sign . $this->second_value;
        return $this->get($this->sql);

    }


    public function get($sql) {
        $query = $this->query($sql);
        return $query->fetchAll();
        $this->first_value = null;
        $this->second_value = null;
        $this->sign = null;
        $this->sql = null;
    }

}