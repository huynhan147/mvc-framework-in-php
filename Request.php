<?php
/**
 * Created by PhpStorm.
 * User: huyptit
 * Date: 29/12/2018
 * Time: 00:22
 */

class Request
{

    public $url;
    public function __construct()
    {
        $this->url = $SERVER['REQUEST_URI'];
    }
}