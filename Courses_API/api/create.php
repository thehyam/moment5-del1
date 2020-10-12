<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../classes/Courses.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//New instance of the class
$courses = new Courses($db);

	// Get raw posted data
	$data = json_decode(@file_get_contents("php://input"));
	if (isset($data)) {
		
		$cs_arr[]= htmlspecialchars(strip_tags($data->code));
		$cs_arr[] = htmlspecialchars(strip_tags($data->course_name));
		$cs_arr[] = htmlspecialchars(strip_tags($data->progression));
		$cs_arr[] = htmlspecialchars(strip_tags($data->course_plan));
			
		// Create post
		if($courses->create($cs_arr)) {
		    echo json_encode(
		        array('message' => 'New course added')
		    );
		} else {
		    echo json_encode(
		        array('message' => 'Course not added')
		    );
		}
	}