<?php
require_once "./models/ClassModel.php";
require_once "./models/StudentModel.php";

class ClassController{
    static function index(){
        // get param
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id';
        $desc = isset($_GET['desc']) ? true : false;

        $title = [
            "id" => "Mã lớp", 
            "name" => "Tên lớp",
            "credit" => "Số tín chỉ"
        ];

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
        if (!isset($_GET['id'])) {
            require_once './views/404.php';
            die();
        }

        $id = (int)$_GET['id'];
        $class = ClassModel::get_class_by_id($id);

        if (is_null($class)){
            require_once './views/404.php';
            die();
        }

        $formRow = [
            "id" => [
                "label" => "Mã lớp",
                "type" => "text",
                "readonly" => true
            ],
            "name" => [
                "label" => "Tên lớp",
                "type" => "text"
            ],
            "credit" => [
                "label" => "Số tín chỉ",
                "type" => "number"
            ],
            "min_students" => [
                "label" => "Số SV tối thiểu",
                "type" => "number"
            ],
            "max_students" => [
                "label" => "Số SV tối đa",
                "type" => "number"
            ],
            "time_start" => [
                "label" => "Ngày bắt đầu học",
                "type" => "date"
            ],
            "time_open" => [
                "label" => "Ngày mở lớp",
                "type" => "date"
            ]
        ];

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id';
        $desc = isset($_GET['desc']) ? true : false;
        $title = [
            "id" => "Mã sinh viên", 
            "name" => "Họ và tên",
            "gender" => "Giới tính",
            "birthday" => "Ngày sinh",
            "major" => "Ngành học"
        ];

        $list_student_in_class = StudentModel::get_student_by_class_id($id);

        require_once './views/class/class-detail.php';
    }
};