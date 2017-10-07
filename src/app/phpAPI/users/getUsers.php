<?php
require_once '../db.php'; // The mysql database variables

// Tell PHP that we'll be reporting all PHP errors and warnings
error_reporting(E_ALL);

// Tell PHP that we're using UTF-8 strings until the end of the script
mb_internal_encoding('UTF-8');

// Tell PHP that we'll be outputting UTF-8 to the browser
mb_http_output('UTF-8');

$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
    http_response_code(500);
    exit('failed to connect to MySQL. error: '.mysqli_connect_error());
} else {
    $con->set_charset('utf8');
}

$user_name_query = $_GET['name'];

if (strcmp($user_name_query, '*') === 0) { // get all users
    $get_all = true;
} else {
    $get_all = false;
}

if ($get_all) {
    $stmt = mysqli_prepare($con, 'SELECT id, name, image_url FROM users ORDER BY name');
} else {
    $stmt = mysqli_prepare($con, "SELECT id, name, image_url FROM users WHERE name LIKE CONCAT('%',?,'%') ORDER BY id");
}

if (!$stmt) {
    http_response_code(500);
    exit('SQL prepare statement resulted in an error: '.mysqli_error($con));
}

if (!$get_all && isset($user_name_query)) {
    $rc = mysqli_stmt_bind_param($stmt, 's', $user_name_query);
    if (!$rc) {
        http_response_code(500);
        exit('SQL prepare statement bind resulted in an error: '.mysqli_error($con));
    }
}

mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user_id, $user_name, $user_image_url);

//$success = mysqli_stmt_fetch($stmt);
//$result = mysqli_stmt_get_result($stmt);

$users = array();

while (mysqli_stmt_fetch($stmt)) {
    $user = array(
        'id' => $user_id,
        'name' => $user_name,
        'image_url' => $user_image_url,
    );
    array_push($users, $user);
}

//$success = mysqli_stmt_fetch($stmt);

// if (!$success) {
// 	http_response_code(500);
// 	exit("SQL query resulted in an error: " . mysqli_error($con));
// }

$response = array(
    'meta' => array('error' => false),
    'data' => array('users' => $users),
);

mysqli_stmt_close($stmt);
//mysqli_free_result($result);
mysqli_close($con);

$json_response = json_encode($response);

ob_start();
ob_start('ob_gzhandler');

echo $json_response;

ob_end_flush();
header('Content-Type: application/json; charset=UTF-8');
header('Content-Length: '.ob_get_length());
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');
ob_end_flush();
?>
