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
	exit("failed to connect to MySQL. error: " . mysqli_connect_error());
} else {
	$con->set_charset('utf8');
}

$user_id = $_GET["user_id"];

$stmt = mysqli_prepare($con, "SELECT p.id, p.message, p.image_url, p.date, p.likes, p.private, u.id, u.name, u.image_url FROM posts p LEFT JOIN users u ON p.user_id = u.id WHERE (p.user_id in (SELECT f.friend_id from friends f WHERE f.user_id = ?) AND p.private = 0) OR (p.user_id = ?) ORDER BY p.date DESC");
if (!$stmt) {
	http_response_code(500);
	exit("SQL prepare statement resulted in an error: " . mysqli_error($con));
}

$rc = mysqli_stmt_bind_param($stmt, "ii", $user_id, $user_id);
if (!$rc) {
	http_response_code(500);
	exit("SQL prepare statement bind resulted in an error: " . mysqli_error($con));
}

mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $post_id, $post_message, $post_image_url, $post_date, $post_likes, $post_private, $user_id, $user_name, $user_image_url);

//$success = mysqli_stmt_fetch($stmt);
//$result = mysqli_stmt_get_result($stmt);

$posts = array();

while (mysqli_stmt_fetch($stmt)) {
 	$post = array(
		'id' => $post_id,
		'message' => $post_message,
		'image_url' => $post_image_url,
		'date' => $post_date,
		'likes' => $post_likes,
		'private' => $post_private,
		'user' => array(
			'id' => $user_id,
			'name' => $user_name,
			'image_url' => $user_image_url,
		)
	);

	// get comments

	// $url = 'http://danielts.com/afekaface/app/api/posts/getComments.php';
	// $data = array('post_id' => $post_id);
	//
	// $options = array(
	//     'http' => array(
	// 			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	//         'method'  => 'GET',
	//         'content' => http_build_query($data),
	//     ),
	// );
	// $context  = stream_context_create($options);
	// $html = file_get_contents($url, false, $context);

	$comments_response = file_get_contents("http://afekaface.danielts.com/api/comments/getComments.php?post_id=" . $post_id);
	$comments_response_json = json_decode($comments_response, true);

	$post['comments'] = $comments_response_json["data"]["comments"];
	array_push($posts, $post);
}

//$success = mysqli_stmt_fetch($stmt);

// if (!$success) {
// 	http_response_code(500);
// 	exit("SQL query resulted in an error: " . mysqli_error($con));
// }

$response = array(
	'meta' => array('error' => false),
	'data' => array('posts' => $posts)
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
header('Content-Length: ' . ob_get_length());
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');
ob_end_flush();
?>
