<?php
/**
 * Created by PhpStorm.
 * User: huyptit
 * Date: 29/12/2018
 * Time: 00:25
 */

class Route
{

    static public function parse($url, $request)
    {
        $url = trim($url);
        if ($url == "")
        {
            $request->controller = "Category";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 2);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
        }
    }
}