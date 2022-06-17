<?php
require_once './models/StudentModel.php';
require_once './models/ClassModel.php';

class StudentController{
    static function index(){
        // get param
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id';
        $desc = isset($_GET['desc']) ? true : false;

        $list_student = StudentModel::get_list_order_by($order, $desc);

        $student_id = !empty($_GET['student-id']) ? (int)$_GET['student-id'] : null;
        $student_name = !empty($_GET['student-name']) ? $_GET['student-name'] : null;
        $student_gender = !empty($_GET['student-gender']) ? $_GET['student-gender'] : null;
        $student_major = !empty($_GET['student-major']) ? $_GET['student-major'] : null;

        $urlSort = "";

        if (!empty($student_id)){
            $urlSort .= "&student-id=" . $student_id;
            for ($i = count($list_student) - 1; $i >= 0; $i--){
                if ($list_student[$i]->id === $student_id) continue;
                array_splice($list_student, $i, 1);
            }
        }

        if (!empty($student_name)){
            $urlSort .= "&student-name=" . $student_name;
            for ($i = count($list_student) - 1; $i >= 0; $i--){
                if ($list_student[$i]->name === $student_name) continue;
                array_splice($list_student, $i, 1);
            }
        }

        if (!empty($student_gender)){
            $urlSort .= "&student-gender=" . $student_gender;
            for ($i = count($list_student) - 1; $i >= 0; $i--){
                if ($list_student[$i]->gender === $student_gender) continue;
                array_splice($list_student, $i, 1);
            }
        }

        if (!empty($student_major)){
            $urlSort .= "&student-major=" . $student_major;
            for ($i = count($list_student) - 1; $i >= 0; $i--){
                if ($list_student[$i]->major === $student_major) continue;
                array_splice($list_student, $i, 1);
            }
        }

        if (strlen($urlSort) > 0) $urlSort = substr($urlSort, 1);

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

    static function class(){
        if (!isset($_GET['id'])){
            die(require_once './views/404.php');
        }

        $id = (int)$_GET['id'];
        $student = StudentModel::get_student_by_id($id);
        $list_class_registed = ClassModel::get_classes_by_student_id($id);

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id';
        $desc = isset($_GET['desc']) ? true : false;

        if ($order !== "direc"){
            $list_class = ClassModel::get_list_order_by($order, $desc);
        }
        else {
            $list = ClassModel::get_list();
            $list_class_first = [];
            $list_class_second = [];
            foreach ($list as $class){
                if (in_array($class, $list_class_registed)){
                    $list_class_first[] = $class;
                }
                else {
                    $list_class_second[] = $class;
                }
            }

            if (!$desc){
                $list_class = array_merge($list_class_first, $list_class_second);
            }
            else {
                $list_class = array_merge($list_class_second, $list_class_first);
            }
        }
        
        require_once './views/student/student-add-class.php';
    }

    static function remove_class(){
        if (isset($_POST['btn-remove-class'])){
            $class_id = $_POST['class-id'];
            $student_id = $_POST['student-id'];

            StudentModel::remove_class($student_id, $class_id);
            die(header("location: /student/class?id=" . $student_id));
        }
        else {
            die(require_once './views/404.php');
        }
    }

    static function add_class(){
        if (isset($_POST['btn-add-class'])){
            $class_id = $_POST['class-id'];
            $student_id = $_POST['student-id'];

            StudentModel::add_class($student_id, $class_id);
            die(header("location: /student/class?id=" . $student_id));
        }
        else {
            die(require_once './views/404.php');
        }
    }
};