<?php
require_once './models/StudentModel.php';

class StudentController{
    static function index(){
        // get param
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

        $formRowTitles = [
            "name" => "Họ và tên",
            "gender" => "Giới tính",
            "birthday" => "Ngày sinh",
            "birthplace" => "Nơi sinh",
            "phone" => "Số điện thoại",
            "email" => "Email", 
            "major" => "Ngành học"
        ];

        $list_student = StudentModel::get_list_order_by($order, $desc);
        require_once './views/student/student-list.php';
    }

    static function detail(){
        // no param id
        if (!isset($_GET['id'])) {
            require_once './views/404.php';
            die();
        }

        // get student with id
        $id = (int)$_GET['id'];
        $student = StudentModel::get_student_by_id($id);

        // no student have id
        if (is_null($student)) {
            require_once './views/404.php';
            die();
        }

        $title = [
            "id" => "Mã sinh viên", 
            "name" => "Họ và tên",
            "gender" => "Giới tính",
            "birthday" => "Ngày sinh",
            "birthplace" => "Nơi sinh",
            "phone" => "Số điện thoại",
            "email" => "Email", 
            "major" => "Ngành học"
        ];

        require_once './views/student/student-detail.php';
    }

    static function remove(){
        if (isset($_POST['btn-remove-student'])){
            $id = (int)$_POST['student-id'];
            StudentModel::remove_student($id);
        }

        header("location: /student");
    }

    static function edit(){
        if (isset($_POST['btn-edit-student'])){
            $id = (int)$_POST['id'];
            StudentModel::edit_student($id, $_POST);
            header("location: /student/detail?id=" . $id);
        }
        else {
            require_once './views/404.php';
        }
    }

    static function add(){
        if (isset($_POST['btn-add-student'])) {
            $student['name'] = $_POST['name'];
            $student['gender'] = $_POST['gender'];
            $student['birthday'] = $_POST['birthday'];
            $student['birthplace'] = $_POST['birthplace'];
            $student['phone'] = $_POST['phone'];
            $student['email'] = $_POST['email'];
            $student['major'] = $_POST['major'];

            if (!filter_var($student['email'], FILTER_VALIDATE_EMAIL)){
                setcookie("error", "Email không hợp lệ", time() + 1);
                die(header("location: /student"));
            }

            StudentModel::add_student($student);
            die(header("location: /student"));
        }
    }
};