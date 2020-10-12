<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../config/Database.php';
include_once '../classes/Courses.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//New instance of the class
$courses = new Courses($db);

// Get json
$data = json_decode(@file_get_contents('php://input'));
if (isset($data)) {
	
	// Set ID to update

	$cs_arr[]= htmlspecialchars(strip_tags($data->code));
	$cs_arr[] = htmlspecialchars(strip_tags($data->course_name));
	$cs_arr[] = htmlspecialchars(strip_tags($data->progression));
	$cs_arr[] = htmlspecialchars(strip_tags($data->course_plan));
	$cs_arr[]= htmlspecialchars(strip_tags($data->id));

	// Update post
	if($courses->update($cs_arr)) {
	    echo json_encode(
	        array('message' => 'Course updated')
	    );
	} else {
	    echo json_encode(
	        array('message' => 'Course not updated')
	    );
	}

}