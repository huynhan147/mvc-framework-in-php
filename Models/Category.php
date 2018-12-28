<?php
/**
 * Created by PhpStorm.
 * User: huyptit
 * Date: 29/12/2018
 * Time: 01:27
 */

class Category
{
    public function showAllCategory()
    {
        $sql = "SELECT * FROM categories WHERE depth=3 LIMIT 10";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

}