<?php

//error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../include/DbHandler.php';
require_once '../include/PassHash.php';
require '../lib/Slim/Slim.php';
include_once '../include/config.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;
date_default_timezone_set('Asia/Kolkata');


/**
 * home banners
 * url - /home_banners
 * method - GET
 */
$app->get('/home_banners', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->home_banners();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Slider List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * home Page Score
 * url - /slider_scores
 * method - GET
 */
$app->get('/slider_scores', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->slider_scores();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Slider Score List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * home Page Reviews
 * url - /slider_reviews
 * method - GET
 */
$app->get('/slider_reviews', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->slider_reviews();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Slider Reviews List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Batch Schedule List
 * url - /batch_schedule_list
 * params-course_id[0=>all,1=>gmat,2=>gre,3=>sat,4=>ielts,5=>toefl],schedule_type[0=>Both,1=>Classroom,2=>live online]
 * method - GET
 */
$app->get('/batch_schedule_list(/:course_id)(/:schedule_type)', function($course_id = 0,$schedule_type=0) use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->batch_schedule_list($course_id,$schedule_type);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Batch Schedule List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Home Events
 * url - /home_event_list
 * method - GET
 */
$app->get('/home_event_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->home_event_list();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Latest Events";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Home Jamboree Introduction
 * url - /home_introduction
 * method - GET
 */
$app->get('/home_introduction', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->home_introduction();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Jamboree Introduction";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

/**
 * Home Page Resource Centre
 * url - /home_resource_centres
 * method - GET
 */
$app->get('/home_resource_centres', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->home_resource_centres();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Our Resource Centre";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Header Events
 * url - /header_events
 * method - GET
 */
$app->get('/header_events', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->header_events();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Latest Events";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Our Associates
 * url - /associates
 * method - GET
 */
$app->get('/associates', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->associates();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Our Associates";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * All Resource Centre
 * url - /resource_centre_list
 * method - POST,
 * param:{
  "page_no":1
  }
 */
$app->post('/resource_centre_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->getBody();
    $post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;

    $res = $db->resource_centre_list($page_no);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "All Resource Centres";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Event List
 * url - /event_list
 * method - POST
 * params:{
  "page_no":1,
  "type":"upcoming"
  }
  type=>upcoming,recent
 */
$app->post('/event_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->getBody();
    $post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;
    $type = @$post_data['type'] ? @$post_data['type'] : 'upcoming';
    $res = $db->event_list($page_no, $type);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Event List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * Header Menus
 * url - /header_menus
 * method - GET
 */
$app->get('/header_menus', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $type = 1; //header//
    $res = $db->menus($type);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Menus";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Footer Menus
 * url - /header_menus
 * method - GET
 */
$app->get('/footer_menus', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $type = 2; //header//
    $res = $db->menus($type);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Menus";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Socials
 * url - /socials
 * method - GET
 */
$app->get('/socials', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->socials();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Social List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

/**
 * seo scripts
 * url - /seo_scripts
 * method - GET
 */
$app->get('/seo_scripts', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->seo_scripts();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "SEO Script List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * contact information
 * url - /contact_info
 * method - GET
 */
$app->get('/contact_info', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->contact_info();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Contact Information";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
// Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
// Required field(s) are missing or empty
// echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["code"] = 10;
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
// Http response code
    $app->status($status_code);

// setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}

function authenticate(\Slim\Route $route) {
    $app = \Slim\Slim::getInstance();
    $realm = 'Protected APIS';

    $req = $app->request();
    $res = $app->response();
    $post_data = $app->request->getBody();
    $post_data = json_decode($post_data, true);
    $apiKey = @$post_data['apiKey'];

    if ($apiKey) {
        if (($apiKey == APIKEY)) {
            global $apiKey;
            return true;
        } else {
            $res->header('WWW-Authenticate', sprintf('Basic realm="%s"', $realm));
            $res = $app->response();
            $res->status(401);
            $app->stop();
        }
    } else {
        $res->header('WWW-Authenticate', sprintf('Basic realm="%s"', $realm));
        $res = $app->response();
        $res->status(401);
        $app->stop();
    }
}

// functions of image upload

function resize($image_name, $size, $folder_name) {
    $file_extension = getFileExtension($image_name);
    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            $image_src = imagecreatefromjpeg($folder_name . '/' . $image_name);
            break;
        case 'png':
            $image_src = imagecreatefrompng($folder_name . '/' . $image_name);
            break;
        case 'gif':
            $image_src = imagecreatefromgif($folder_name . '/' . $image_name);
            break;
    }
    $true_width = imagesx($image_src);
    $true_height = imagesy($image_src);

    $width = $size;
    $height = ($width / $true_width) * $true_height;

    $image_des = imagecreatetruecolor($width, $height);

    imagecopyresampled($image_des, $image_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($image_des, $folder_name . '/' . $image_name, 100);
            break;
        case 'png':
            imagepng($image_des, $folder_name . '/' . $image_name, 8);
            break;
        case 'gif':
            imagegif($image_des, $folder_name . '/' . $image_name, 100);
            break;
    }
    return $image_des;
}

function resize1($image_name, $size, $folder_name, $thumb_folder) {
    $file_extension = getFileExtension($image_name);
    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            $image_src = imagecreatefromjpeg($folder_name . '/' . $image_name);
            break;
        case 'png':
            $image_src = imagecreatefrompng($folder_name . '/' . $image_name);
            break;
        case 'gif':
            $image_src = imagecreatefromgif($folder_name . '/' . $image_name);
            break;
    }
    $true_width = imagesx($image_src);
    $true_height = imagesy($image_src);

    $width = $size;
    $height = ($width / $true_width) * $true_height;

    $image_des = imagecreatetruecolor($width, $height);

    imagecopyresampled($image_des, $image_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($image_des, $folder_name . '/' . $image_name, 100);
            break;
        case 'png':
            imagepng($image_des, $folder_name . '/' . $image_name, 8);
            break;
        case 'gif':
            imagegif($image_des, $folder_name . '/' . $image_name, 100);
            break;
    }

    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($image_des, $thumb_folder . '/' . $image_name, 100);
            break;
        case 'png':
            imagepng($image_des, $thumb_folder . '/' . $image_name, 5);
            break;
        case 'gif':
            imagegif($image_des, $thumb_folder . '/' . $image_name, 100);
            break;
    }
    return $image_des;
}

function getFileExtension($file) {
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    return $extension;
}

$app->run();
?>
