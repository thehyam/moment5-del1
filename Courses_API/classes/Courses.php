<?php

class Courses {
    // DB stuff
    private $conn;

    // Course properties
    public $id;
    public $code;
    public $course_name;
    public $progression;
    public $course_plan;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all courses
    public function get_all() {
        $sql = "SELECT * FROM admin";
        $query = $this->conn->prepare($sql);
        $query->execute(array());

        if($query->rowCount() > 0){
            $results = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $results[] =  $row;
            }
            return $results;

        }
    }


    // Get single course
    public function get_one(array $data) {
        $sql = "SELECT * FROM admin WHERE id = ?";
        $query = $this->conn->prepare($sql);
        $query->execute($data);
        if ($row = $query->fetch(PDO::FETCH_ASSOC)){
            return $row;
        }
    }


    // Create new course
    public function create(array $data) {        
        $sql = "INSERT INTO admin(code,course_name,progression,course_plan)
            VALUES(?, ?, ?, ?)";
        $query = $this->conn->prepare($sql);
        // Execute
        $row = $query->execute($data);
        //checking result 
        if($query->rowCount() > 0){
            return true;
         
        }
        
    }

    // Update course
    public function update(array $data) {
        $sql = "UPDATE admin 
        SET
            code =?,
            course_name = ?,
            progression = ?,
            course_plan = ?
        WHERE
            id = ?";

        $query = $this->conn->prepare($sql);
        // Execute
        $row = $query->execute($data);
        //checking result 
        if($query->rowCount() > 0){
            return true;
         
        }
    }

    //Delete post
    public function delete(array $data) {
         
        $sql = "DELETE FROM admin WHERE id = ?";
        
        $query = $this->conn->prepare($sql);
        // Execute
        $row = $query->execute($data);
        //checking result 
        if($query->rowCount() > 0){
            return true;
         
        }
    }

    public function makeApiCall($url,$dt)
    {

        $options = ['http' => [
            'method' => 'POST',
            'header' => 'Content-type:application/json',
            'content' => $json_dt
        ]];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response) {
            return $response;
        }
    }

}