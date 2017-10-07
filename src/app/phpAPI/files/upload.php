<?php
// Tell PHP that we'll be reporting all PHP errors and warnings
error_reporting(E_ALL);

// Tell PHP that we're using UTF-8 strings until the end of the script
mb_internal_encoding('UTF-8');

// Tell PHP that we'll be outputting UTF-8 to the browser
mb_http_output('UTF-8');

header('Content-Type: application/json; charset=UTF-8');

// 'userfile' is the name of the file that is uploaded via POST method.
// Test using Postman: send a POST request with form-data Body,
// with a paramater called 'userfile' and of type 'File'

if (!isset($_FILES['userfile'])) {
    http_response_code(400);
    $error = "file was not uploaded. please upload a file called 'userfile'.";
}

if (!$error) {
    if (!is_uploaded_file($_FILES['userfile']['tmp_name'])) {
        //print_r($_FILES);
      //echo "\n";
      $tmp_file = $_FILES['userfile']['tmp_name'];

        $target_dir = '../../uploads/';
        $target_file = $target_dir.$_FILES['userfile']['name'];

      //  print_r($tmp_file);
      //  echo "\n";
      //  print_r($target_file);
      //  echo "\n";

      if (move_uploaded_file($tmp_file, $target_file)) {
          $file_url = $target_file;
      } else {
          http_response_code(500);
          $error = "file was uploaded, but could not be moved to '".$target_dir."'";
      }
    } else {
        header('Content-Type: text/plain; charset=utf-8');
        switch ($HTTP_POST_FILES['userfile']['error']) {
          case UPLOAD_ERR_OK: //no error; possible file attack!
              http_response_code(500);
              $error = 'There was a problem with your upload.';
              break;
          case UPLOAD_ERR_INI_SIZE: //uploaded file exceeds the upload_max_filesize directive in php.ini
              http_response_code(400);
              $error = 'The file you are trying to upload is too big.';
              break;
          case UPLOAD_ERR_FORM_SIZE: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
              http_response_code(400);
              $error = 'The file you are trying to upload is too big.';
              break;
          case UPLOAD_ERR_PARTIAL: //uploaded file was only partially uploaded
              http_response_code(500);
              $error = 'The file you are trying upload was only partially uploaded.';
              break;
          case UPLOAD_ERR_NO_FILE: //no file was uploaded
              http_response_code(400);
              $error = 'You must select an image for upload.';
              break;
          case UPLOAD_ERR_NO_TMP_DIR: //missing a temporary folder. introduced in PHP 5.0.3.
              http_response_code(500);
              $error = 'Missing a temporary folder.';
              break;
          case UPLOAD_ERR_CANT_WRITE: //failed to write file to disk. introduced in PHP 5.1.0.
              http_response_code(500);
              $error = 'Failed to write file to disk.';
              break;
          case UPLOAD_ERR_EXTENSION: //a php extension stopped the file upload.
              http_response_code(500);
              $error = 'A PHP extension stopped the file upload.';
              break;
          default: //a default error, just in case!  :)
              $error = 'There was a problem with your upload.';
              break;
      }

        $error = $error.' (error '.$HTTP_POST_FILES['userfile']['error'].')';
    }
}

$response = array();

if (isset($error)) {
    $response['error'] = $error;
}

if (isset($file_url)) {
    $response['file_url'] = 'http://danielts.com/afekaface/app/api/users/'.$file_url; //realpath($file_url);
}

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
