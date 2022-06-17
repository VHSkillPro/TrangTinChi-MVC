<?php
require_once "./models/ClassModel.php";
require_once "./models/StudentModel.php";

class ClassController{
    static function index(){
        // get param
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id';
        $desc = isset($_GET['desc']) ? true : false;

        $list_class = ClassModel::get_list_order_by($order, $desc);

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
        
        $list_student_in_class = StudentModel::get_student_by_class_id_order_by($id, $order, $desc);

        require_once './views/class/class-detail.php';
    }

    static function edit(){
        if (isset($_POST['btn-edit-class'])){
            $id = (int)$_POST['class-id'];
            $class = (new ClassObj)
                ->set_name($_POST['class-name'])
                ->set_credit($_POST['class-credit'])
                ->set_min_student($_POST['class-min_student'])
                ->set_max_student($_POST['class-max_student'])
                ->set_time_start($_POST['class-time_start'])
                ->set_time_open($_POST['class-time_open']);

            ClassModel::edit_class($id, $class);
            header("location: /class/detail?id=" . $id);
        }
        else {
            require_once './views/404.php';
        }
    }

    static function add(){
        if (isset($_POST['btn-add-class'])){
            $class = (new ClassObj)
                ->set_name($_POST['class-name'])
                ->set_credit($_POST['class-credit'])
                ->set_min_student($_POST['class-min_student'])
                ->set_max_student($_POST['class-max_student'])
                ->set_time_start($_POST['class-time_start'])
                ->set_time_open($_POST['class-time_open']);

            ClassModel::add_class($class);
            header("location: /class");
        }
    }

    static function removeStudent(){
        if (isset($_POST['btn-remove-student'])){
            $class_id = $_POST['class-id'];
            $student_id = $_POST['student-id'];

            StudentModel::remove_class($student_id, $class_id);
            die(header("location: /class/detail?id=" . $class_id));
        }
        else {
            die(require_once './views/404.php');
        }
    }
};