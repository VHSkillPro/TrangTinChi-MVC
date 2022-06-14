<?php
require_once './controllers/Bridge.php';

App::route('home', 'index', 'GET', 'HomeController::index');

// Student
    App::route('student', 'index', 'GET', 'StudentController::index');
    App::route('student', 'detail', 'GET', 'StudentController::detail');
    App::route('student', 'edit', 'POST', 'StudentController::edit');
    App::route('student', 'remove', 'POST', 'StudentController::remove');
    App::route('student', 'add', 'POST', 'StudentController::add');

// Class
    App::route('class', 'index', 'GET', 'ClassController::index');
    App::route('class', 'remove', 'POST', 'ClassController::remove');
    App::route('class', 'detail', 'GET', 'ClassController::detail');