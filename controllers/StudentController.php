<?php
require_once './models/StudentModel.php';

class StudentController{
    static function index(){
        // get param
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id';
        $desc = isset($_GET['desc']) ? true : false;

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
            $id = (int)$_POST['student-id'];
            $student = (new Student)
                ->set_name($_POST['student-name'])
                ->set_gender($_POST['student-gender'])
                ->set_major($_POST['student-major'])
                ->set_birthday($_POST['student-birthday'])
                ->set_birthplace($_POST['student-birthplace'])
                ->set_phone($_POST['student-phone'])
                ->set_email($_POST['student-email']);

            StudentModel::edit_student($id, $student);
            header("location: /student/detail?id=" . $id);
        }
        else {
            require_once './views/404.php';
        }
    }

    static function add(){
        if (isset($_POST['btn-add-student'])) {
            $student = (new Student)
                ->set_name($_POST['student-name'])
                ->set_gender($_POST['student-gender'])
                ->set_major($_POST['student-major'])
                ->set_birthday($_POST['student-birthday'])
                ->set_birthplace($_POST['student-birthplace'])
                ->set_phone($_POST['student-phone'])
                ->set_email($_POST['student-email']);

            if (!filter_var($student->email, FILTER_VALIDATE_EMAIL)){
                setcookie("error", "Email không hợp lệ", time() + 1);
                die(header("location: /student"));
            }

            StudentModel::add_student($student);
            die(header("location: /student"));
        }
    }
};