<?php

class StudentModel{
    static function get_list(){
        $sql = "select * from students";
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return $ls;
    }

    static function get_list_order_by($flag, $desc = false){
        $sql = "select * from students order by " . $flag . ($desc ? ' desc' : '');
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return $ls;
    }

    static function get_student_by_id($id){
        $sql = "select * from students where id = " . $id;
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return count($ls) == 1 ? $ls[0] : null;
    }

    static function get_student_by_class_id($class_id){
        $sql = "select * 
                from students A join `student-class` B on A.id = B.id_student
                where B.id_class = " . $class_id;
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return $ls;
    }

    static function remove_student($id){
        $sql = "delete from students where id = " . $id;
        return DB::query($sql);
    }

    static function edit_student($id, $student){
        $sql =  'update students
                set name = "' . $student["name"] . '",
                    gender = "' . $student["gender"] . '",
                    birthday = "' . $student["birthday"] . '",
                    birthplace = "' . $student["birthplace"] . '",
                    phone = "' . $student["phone"] . '",
                    email = "' . $student["email"] . '",
                    major = "' . $student["major"] . '"
                where id = ' . $id;
        return DB::query($sql);
    }

    static function add_student($student){
        $sql = 'insert into students (name, major, gender, birthday, birthplace, phone, email)
                value ( "' . $student["name"] . '", 
                    "' . $student["major"] . '", 
                    "' . $student["gender"] . '", 
                    "' . $student["birthday"] . '",
                    "' . $student["birthplace"] . '",
                    "' . $student["phone"] . '",
                    "' . $student["email"] . '")';
        return DB::query($sql);
    }
};