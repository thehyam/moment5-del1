<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../classes/Courses.php';
 
// Instantiate DB and connect
$database = new Database();
$db = $database->connect();
//New instance of the class
$course = new Courses($db);

// Get code
$course->id = isset($_GET['id']) ? $_GET['id'] : die();

// Create array
$cs_arr = array(htmlspecialchars(strip_tags($course->id))); 


// Get course
$row = $course->get_one($cs_arr);


// JSON
print_r(json_encode($row ));