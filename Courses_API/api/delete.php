<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../classes/Courses.php';


//New instance of the class
$database = new Database();
$db = $database->connect();

// Instatiate post object
$courses = new Courses($db);

// Get code
$courses->id = isset($_GET['id']) ? $_GET['id'] : die();

// Create array
$cs_arr = array($courses->id); 


// Update post
if($courses->delete($cs_arr)) {
    echo json_encode( 
        array('message' => 'Course deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Course not deleted')
    );
}