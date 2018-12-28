<?php
/**
 * Created by PhpStorm.
 * User: huyptit
 * Date: 29/12/2018
 * Time: 00:53
 */

class Controller
{
    var $vars = [];
    var $layout = "index";
    function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }
    function render($filename)
    {

        extract($this->vars);

        ob_start();

        require(ROOT . "Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');

        $content_for_layout = ob_get_clean();
        if ($this->layout == false)
        {
            $content_for_layout;
        }
        else
        {
            require(ROOT . "Views/Category/" . $this->layout . '.php');
        }
    }
    private function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    protected function secure_form($form)
    {
        foreach ($form as $key => $value)
        {
            $form[$key] = $this->secure_input($value);
        }
    }

}