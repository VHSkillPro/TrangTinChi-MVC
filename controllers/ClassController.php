<?php
require_once "./models/ClassModel.php";
require_once "./models/StudentModel.php";

class ClassController{
    static function index(){
        // get param
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id';
        $desc = isset($_GET['desc']) ? true : false;

        // $formRowTitles = [
        //     "name" => "Họ và tên",
        //     "gender" => "Giới tính",
        //     "birthday" => "Ngày sinh",
        //     "birthplace" => "Nơi sinh",
        //     "phone" => "Số điện thoại",
        //     "email" => "Email", 
        //     "major" => "Ngành học"
        // ];

        $list_class = ClassModel::get_list();

        require_once './views/class/class-list.php';
    }

    static function remove(){
        if (isset($_POST['btn-remove-class'])){
            $id = (int)$_POST['class-id'];
            ClassModel::remove_class($id);
        }

        header("location: /class");
    }

    static function detail(){
        // nếu không có id 
        if (!isset($_GET['id'])) {
            require_once './views/404.php';
            die();
        }

        // lấy class có mã lớp = id 
        $id = (int)$_GET['id'];
        $class = ClassModel::get_class_by_id($id);

        // nếu không có class 
        if (is_null($class)){
            require_once './views/404.php';
            die();
        }

        // get params
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id';
        $desc = isset($_GET['desc']) ? true : false;
        
        $list_student_in_class = StudentModel::get_student_by_class_id($id);

        require_once './views/class/class-detail.php';
    }

    static function edit(){
        if (isset($_POST['btn-edit-class'])){
            $id = (int)$_POST['id'];
        }
    }
};