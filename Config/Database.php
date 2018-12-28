<?php
/**
 * Created by PhpStorm.
 * User: huyptit
 * Date: 29/12/2018
 * Time: 01:26
 */

class Database
{
    private static $bdd = null;
    private function __construct() {
    }
    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:host=localhost;dbname=vj_nguvan", 'huyptit', 'huynhan147');
            self::$bdd->exec("set names utf8");
        }
        return self::$bdd;
    }

}