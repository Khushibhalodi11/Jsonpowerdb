<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Retrieve data from form
  $rollNo = $_POST['Roll-Number'];
  $fullName = $_POST['fullname'];
  $class = $_POST['class'];
  $birthDate = $_POST['birthdate'];
  $address = $_POST['address'];
  $enrollmentDate = $_POST['enrollmentdate'];

  // Create an associative array of data to insert
  $data = array(
    'Roll No.' => $rollNo,
    'Full Name' => $fullName,
    'Class' => $class,
    'Birth Date' => $birthDate,
    'Address' => $address,
    'Enrollment Date' => $enrollmentDate
  );

  // Convert the data array to JSON
  $json_data = json_encode($data);

  // Set the URL and options for the API request
  $url = "" . $token . "https://api.login2explore.com:443/";
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query(array('dbName' => $Student_DB, 'Student_Table' => $table, 'jsonData' => $json_data)),
    ),
  );

  // Send the API request and store the response
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  // Check if the insert was successful
  if($result === '{"RESPONSE":"SUCCESS"}') {
    echo "Data inserted successfully!";
  } else {
    echo "Error inserting data.";
  }

}

?>
