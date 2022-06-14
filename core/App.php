<?php

class App{
    static $routes = [];
    public $controller = DEFAULT_CONTROLLER;
    public $action = DEFAULT_ACTION;
    public $method = DEFAULT_METHOD;
    public $params = [];

    function __construct(){
        // get url and explode
        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
        $arr = !empty($url) ? explode('/', $url) : [];

        // get controller
        if (isset($arr[0])){
            $this->controller = $arr[0];
            unset($arr[0]);
        }

        // get action
        if (isset($arr[1])){
            $this->action = $arr[1];
            unset($arr[1]);
        }

        // get params 
        $this->params = $arr;

        // get method
        $this->method = $_SERVER["REQUEST_METHOD"];

        $haveRoute = false;
        foreach (App::$routes as $route){
            if ($route["controller"] !== $this->controller) continue;
            if ($route["action"] !== $this->action) continue;
            if ($route["method"] !== $this->method) continue;
            call_user_func($route['callback'], ...$this->params);
            $haveRoute = true;
            break;
        }

        if (!$haveRoute) require_once './views/404.php';
    }

    static function route($controller, $action, $method, $callback){
        App::$routes[] = [
            "controller" => empty($controller) ? DEFAULT_CONTROLLER : $controller,
            "action" => empty($action) ? DEFAULT_ACTION : $action,
            "method" => empty($method) ? DEFAULT_METHOD : $method,
            "callback" => $callback
        ];
    }
}