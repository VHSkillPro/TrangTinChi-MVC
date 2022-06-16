<?php

class Student{
    private int $id;
    private string $name;
    private string $major;
    private string $gender;
    private string $birthday;
    private string $birthplace;
    private string $phone;
    private string $email;

    // SET 
    function set_id($id){
        $this->id = $id;
        return $this;
    }

    function set_name($name){
        $this->name = $name;
        return $this;
    }

    function set_major($major){
        $this->major = $major;
        return $this;
    }

    function set_gender($gender){
        $this->gender = $gender;
        return $this;
    }

    function set_birthday($birthday){
        $this->birthday = $birthday;
        return $this;
    }

    function set_birthplace($birthplace){
        $this->birthplace = $birthplace;
        return $this;
    }

    function set_phone($phone){
        $this->phone = $phone;
        return $this;
    }

    function set_email($email){
        $this->email = $email;
        return $this;
    }

    // GET
    function __get($name){
        switch ($name){
            case 'id':
                return $this->id;
            case 'name':
                return $this->name;
            case 'major':
                return $this->major;
            case 'gender':
                return $this->gender;
            case 'birthday':
                return $this->birthday;
            case 'birthplace':
                return $this->birthplace;
            case 'phone':
                return $this->phone;
            case 'email':
                return $this->email;
        }
    }   

    static function get_list_student_obj($arr){
        $list_student = [];
        foreach ($arr as $item){
            $list_student[] = (new Student)
                ->set_id($item['id'])
                ->set_name($item['name'])
                ->set_gender($item['gender'])
                ->set_major($item['major'])
                ->set_birthday($item['birthday'])
                ->set_birthplace($item['birthplace'])
                ->set_phone($item['phone'])
                ->set_email($item['email']);
        }
        return $list_student;
    }
};

class StudentModel{
    static function get_list(){
        $sql = "select * from students";
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return Student::get_list_student_obj($ls);
    }

    static function get_list_order_by($flag, $desc = false){
        $sql = "select * from students order by " . $flag . ($desc ? ' desc' : '');
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return Student::get_list_student_obj($ls);
    }

    static function get_student_by_id($id){
        $sql = "select * from students where id = " . $id;
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        if (count($ls) == 1){
            return Student::get_list_student_obj($ls)[0];
        }
        else return null;
    }

    static function get_student_by_class_id($class_id){
        $sql = "select * 
                from students A join `student-class` B on A.id = B.id_student
                where B.id_class = " . $class_id;
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return Student::get_list_student_obj($ls);
    }

    static function remove_student($id){
        $sql = "delete from students where id = " . $id;
        return DB::query($sql);
    }

    static function remove_class($student_id, $class_id){
        $sql = "delete from `student-class` 
                where id_student = " . $student_id . " and id_class = " . $class_id;
        return DB::query($sql);
    }

    static function add_class($student_id, $class_id){
        $sql = 'insert into `student-class` (id_student, id_class) 
                value (' . $student_id . ', ' . $class_id . ')';
        return DB::query($sql);
    }

    static function edit_student($id, $student){
        $sql =  'update students
                set name = "' . $student->name . '",
                    gender = "' . $student->gender . '",
                    birthday = "' . $student->birthday . '",
                    birthplace = "' . $student->birthplace . '",
                    phone = "' . $student->phone . '",
                    email = "' . $student->email . '",
                    major = "' . $student->major . '"
                where id = ' . $id;
        return DB::query($sql);
    }

    static function add_student($student){
        $sql = 'insert into students (name, major, gender, birthday, birthplace, phone, email)
                value ( "' . $student->name . '", 
                    "' . $student->major . '", 
                    "' . $student->gender . '", 
                    "' . $student->birthday . '",
                    "' . $student->birthplace . '",
                    "' . $student->phone . '",
                    "' . $student->email . '")';
        return DB::query($sql);
    }
};