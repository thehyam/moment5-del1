<?php 

	include_once 'classes/Courses.php';
	
	//New instance of the class
	$courses = new Courses($db);
	//encode data
    $json_dt = json_encode($dt = []);

    //make request to this url

    //$url = 'http://localhost:8888/DT173g%20-%20Webbutveckling%20III/Courses_API/api/read_single.php?id=2';
	//$url = 'http://localhost:8888/DT173g%20-%20Webbutveckling%20III/Courses_API/api/read.php';
	//$url = 'http://studenter.miun.se/~emha1904/Courses_API/';

	$rows = $courses->makeApiCall($url, json_dt);
	$rows = json_decode($rows,true);
	
	//fetching users records
	if ($rows) {
		$ct  = count($rows);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test</title>

	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body class="container ">

	<h2 class="mt-5">My Courses </h2>
	<h3>Records: <?php echo isset($ct) ? $ct : 0; ?> </h3>
	<div class="table-responsive mt-5">
		<table class="table table table-striped ">
			<?php 
					//when records are avilable
					if (!empty($rows )) {


						echo '<thead class="thead-dark">
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">code</th>
						      <th scope="col">Course Name</th>
						      <th scope="col">Progression</th>
						      <th scope="col">Course Plan</th>
						      
						    </tr>
					  	</thead>
						<tbody>';

						$i = 0;
						//looping through
						foreach ($rows as $row ) {
							$i++;
							echo '<tr>
								      <th scope="row">'.$i.'</th>
								      
								      <td>'.$row['code'].'</td>
								      <td>'.$row['course_name'].'</td>
								      <td>'.$row['progression'].' '.$row['last_name'].'</td>
								      <td>'.$row['course_plan'].'</td>
								      
								    </tr>
								    ';
						
						}


					}else {
						echo '<h5 class="alert alert-danger">Records not found</h5>';
					}


				 ?>
			    
			    
			</tbody>
		</table>
	</div>
</body>
</html>