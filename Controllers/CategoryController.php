<?php
/**
 * Created by PhpStorm.
 * User: huyptit
 * Date: 29/12/2018
 * Time: 00:26
 */

class CategoryController extends Controller
{

    public function index(){

        require(ROOT . 'Models/Category.php');
        $category = new Category();
        $d['category'] = $category->showAllCategory();
        $this->set($d);
        $this->render('index');

    }

}