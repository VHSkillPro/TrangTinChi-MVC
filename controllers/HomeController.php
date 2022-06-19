<?php

class HomeController{
    static public function index(){
        require './views/home.php';
    }

    static public function error(){
        require './views/404.php';
    }
}