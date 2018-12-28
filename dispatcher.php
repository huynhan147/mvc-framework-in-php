<?php
/**
 * Created by PhpStorm.
 * User: huyptit
 * Date: 29/12/2018
 * Time: 00:29
 */
class Dispatcher
{
    private $request;
    public function dispatch()
    {
        $this->request = new Request();
        Route::parse($this->request->url, $this->request);

        $controller = $this->loadController();
        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }
    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $file = ROOT . 'Controllers/' . $name . '.php';
        require($file);
        $controller = new $name();
        return $controller;
    }
}