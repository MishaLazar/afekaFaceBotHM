<?php
require_once '../db.php'; // The mysql database variables
require '../password.php'; //for password hashing on php < 5.5

// Tell PHP that we'll be reporting all PHP errors and warnings
//error_reporting(E_ALL);

// Tell PHP that we're using UTF-8 strings until the end of the script
mb_internal_encoding('UTF-8');

// Tell PHP that we'll be outputting UTF-8 to the browser
mb_http_output('UTF-8');

$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
	http_response_code(500);
	exit("failed to connect to MySQL. error: " . mysqli_connect_error());
} else {
	$con->set_charset('utf8');
}

//-----------------------------

$password = $_POST["password"];
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$stmt = mysqli_prepare($con, "INSERT INTO users (name, email, password, image_url) VALUES (?, ?, ?, ?)");
if (!$stmt) {
	http_response_code(500);
	exit("SQL prepare statement resulted in an error: " . mysqli_error($con));
}

$rc = mysqli_stmt_bind_param($stmt, "ssss", $_POST["name"], $_POST["email"], $password_hash, $_POST["image_url"]);
if (!$rc) {
	http_response_code(500);
	exit("SQL prepare statement bind resulted in an error: " . mysqli_error($con));
}

mysqli_stmt_execute($stmt);

$user_created_id = mysqli_insert_id($con);

if (!$user_created_id) {
		$response = array(
			'meta' => array('error' => true, 'error_message' => 'register failed. Please check credentials. SQL error: ' . mysqli_stmt_error($stmt))
		);
} else {
	$user = array(
		'id' => $user_created_id,
		'name' => $_POST["name"],
		'email' => $_POST["email"],
		'image_url' => $_POST["image_url"],
	);
	$response = array(
		'meta' => array('error' => false),
		'data' => array('user' => $user)
	);
}

mysqli_stmt_close($stmt);
mysqli_free_result($result);
mysqli_close($con);

$json_response = json_encode($response);

ob_start();
ob_start('ob_gzhandler');

echo $json_response;

ob_end_flush();
header('Content-Type: application/json; charset=UTF-8');
header('Content-Length: ' . ob_get_length());
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');
ob_end_flush();
?>
