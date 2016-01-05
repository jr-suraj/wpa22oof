<?php
/**
 * Created by PhpStorm.
 * User: suraj
 * Date: 1/2/16
 * Time: 9:49 AM
 */


define("DD", realpath( __DIR__ . "/.."));

require DD . "/vendor/autoload.php";


// Only one object
// Can call from everywhere
// Can use constructor
// Method Chain


$sel_all = DB::table("student")->sel_all();
$sel_where = DB::table("student")->sel_where("id", "=", 1);
//$del_where = DB::table("student")->del_where("id","=", 2);

//var_dump($sel_all);
var_dump($sel_where);
//var_dump($del_where);

