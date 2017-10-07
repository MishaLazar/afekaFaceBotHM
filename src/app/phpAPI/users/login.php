<?php
header("Access-Control-Allow-Origin:*");
require_once '../db.php'; // The mysql database variables
require '../password.php'; //for password hashing on php < 5.5

// Tell PHP that we'll be reporting all PHP errors and warnings
//error_reporting(E_ALL);

// Tell PHP that we're using UTF-8 strings until the end of the script
mb_internal_encoding('UTF-8');

// Tell PHP that we'll be outputting UTF-8 to the browser
mb_http_output('UTF-8');
//print $DB_HOST.','.$DB_USER.','.$DB_PASS.','.$DB_NAME.',';
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (mysqli_connect_errno()) {
    http_response_code(500);
    exit('failed to connect to MySQL. error: '.mysqli_connect_error());
} else {
    $con->set_charset('utf8');
}

$stmt = mysqli_prepare($con, 'SELECT id, name, password, email, image_url FROM users WHERE email = ?');
if (!$stmt) {
    http_response_code(500);
    exit('SQL prepare statement resulted in an error: '.mysqli_error($con));
}
$rc = mysqli_stmt_bind_param($stmt, 's', $_GET['email']);
if (!$rc) {
    http_response_code(500);
    exit('SQL prepare statement bind resulted in an error: '.mysqli_error($con));
}

//print ($user_id.' '.$user_name.' '.$user_hashed_password.' '.$user_email.' '.$user_image_url);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user_id, $user_name, $user_hashed_password, $user_email, $user_image_url);
//$success = mysqli_stmt_fetch($stmt);
//$result = mysqli_stmt_get_result($stmt);
 //while (mysqli_stmt_fetch($stmt)) {
//      echo("aaa " . $result);
 //}
$success = mysqli_stmt_fetch($stmt);

// if (!$success) {
// 	http_response_code(500);
// 	exit("SQL query resulted in an error: " . mysqli_error($con));
// }

if ($success) {
    $password = $_GET['password'];
    //echo 'user Password'.$password.' returned password'.$user_hashed_password;
    if(strcmp($password, $user_hashed_password)){
        $success = true;
    }else{
        $sucess = false;
    }
    /*if (!password_verify($password, $user_hashed_password)) {
        $success = false;
    }*/
}

if (!$success) {
    $response = array(
            'meta' => array('error' => true, 'error_message' => 'Login failed. Please check credentials.'),
        );
} else {
    $user = array(
        'id' => $user_id,
        'name' => $user_name,
        'email' => $user_email,
        'image_url' => $user_image_url,
    );
    $response = array(
        'meta' => array('error' => false),
        'data' => array('user' => $user),
    );
}

mysqli_stmt_close($stmt);
if(isset($result)){
  mysqli_free_result($result);
}

mysqli_close($con);

$json_response = json_encode($response);

//ob_start();
//ob_start('ob_gzhandler');

echo $json_response;

//ob_end_flush();
header('Content-Type: application/json; charset=UTF-8');
header('Content-Length: '.ob_get_length());
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');
//ob_end_flush();
?>
