<?php

class ClassModel{
    static function get_list(){
        $sql = "select * from classes";
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return $ls;
    }

    static function get_class_by_id($id){
        $sql = "select * from classes where id = " . $id;
        $result = DB::query($sql);
        $ls = DB::fetch_all_rows($result);
        return count($ls) == 1 ? $ls[0] : null;
    }

    static function remove_class($id){
        $sql = "delete from classes where id = " . $id;
        return DB::query($sql);
    }
};