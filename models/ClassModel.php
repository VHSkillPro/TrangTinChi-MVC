<?php

class ClassObj{
    private int $id;
    private string $name;
    private int $credit;
    private int $min_student;
    private int $max_student;
    private string $time_start;
    private string $time_open;

    // SET
    function set_id($id){
        $this->id = $id;
        return $this;
    }

    function set_name($name){
        $this->name = $name;
        return $this;
    }

    function set_credit($credit){
        $this->credit = $credit;
        return $this;
    }

    function set_min_student($min_student){
        $this->min_student = $min_student;
        return $this;
    }

    function set_max_student($max_student){
        $this->max_student = $max_student;
        return $this;
    }

    function set_time_start($time_start){
        $this->time_start = $time_start;
        return $this;
    }

    function set_time_open($time_open){
        $this->time_open = $time_open;
        return $this;
    }

    // GET
    function __get($name){
        switch ($name){
            case 'id':
                return $this->id;
            case 'name':
                return $this->name;
            case 'credit':
                return $this->credit;
            case 'min_student':
                return $this->min_student;
            case 'max_student':
                return $this->max_student;
            case 'time_start':
                return $this->time_start;
            case 'time_open':
                return $this->time_open;
        }
    }

    static function get_list_classes_obj($arr){
        $list_class = [];
        foreach ($arr as $item){
            $list_class[] = (new ClassObj)
                ->set_id($item['id'])
                ->set_name($item['name'])
                ->set_credit($item['credit'])
                ->set_min_student($item['min_student'])
                ->set_max_student($item['max_student'])
                ->set_time_start($item['time_start'])
                ->set_time_open($item['time_open']);
        }
        return $list_class;
    }
};

class ClassModel{
    static function get_list(){
        $sql = "select * from classes";
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return ClassObj::get_list_classes_obj($ls);
    }

    static function get_class_by_id($id){
        $sql = "select * from classes where id = " . $id;
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        if (count($ls) == 1){
            return ClassObj::get_list_classes_obj($ls)[0];
        }
        else {
            return null;
        }
    }

    static function get_list_order_by($order, $desc){
        $sql = "select * from classes order by " . $order . ($desc ? ' desc' : '');
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return ClassObj::get_list_classes_obj($ls);
    }

    static function get_classes_by_student_id($student_id){
        $sql = "select * 
                from classes A join `student-class` B on A.id = B.id_class
                where B.id_student = " . $student_id;
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return ClassObj::get_list_classes_obj($ls);
    }

    static function remove_class($id){
        $sql = "delete from classes where id = " . $id;
        return DB::query($sql);
    }

    static function edit_class($id, $class){
        $sql = 'update classes 
                set name = "' . $class->name . '",
                    credit = ' . $class->credit . ',
                    min_student = ' . $class->min_student . ',
                    max_student = ' . $class->max_student . ',
                    time_start = "' . $class->time_start . '",
                    time_open = "' . $class->time_open . '"
                where id = ' . $id;
        return DB::query($sql);
    }

    static function add_class($class){
        $sql = 'insert into classes (name, credit, min_student, max_student, time_start, time_open)
                value ( "' . $class->name . '", 
                    ' . $class->credit . ', 
                    ' . $class->min_student . ', 
                    ' . $class->max_student . ',
                    "' . $class->time_start . '",
                    "' . $class->time_open . '")';
        return DB::query($sql);
    }
};