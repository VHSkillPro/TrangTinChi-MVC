<?php

class DB{
    static private $conn = null;
    static public function connect()
    {
        // Create connection
        $conn = DB::$conn;
        if (!$conn) {
            $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        }
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    static function fetch_all_rows($sql_records){
        $result = [];
        while ($row = $sql_records->fetch_assoc()) {
            $result[] = $row;
        }
        return $result;
    }

    static function query($sql){
        $conn = DB::connect();
        $result = $conn->query($sql);

        // query error
        if ($conn->error){
            echo $conn->error;
            return null;
        }

        $conn->close();
        return $result;
    }
}