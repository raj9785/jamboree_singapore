<?php

//error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../include/DbHandler.php';
require_once '../include/PassHash.php';
require '../lib/Slim/Slim.php';
include_once '../include/config.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->response()->headers->set('Access-Control-Allow-Origin', '*');
$app->response()->headers->set('Access-Control-Allow-Headers', 'Accept, Content-Type, Origin');
$app->response()->headers->set('Content-Type', 'application/json');
$app->response()->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');




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
        $response["data"] = array();
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
        $response["data"] = array();
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
$app->get('/batch_schedule_list(/:course_id)(/:schedule_type)', function($course_id = 0, $schedule_type = 0) use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->batch_schedule_list($course_id, $schedule_type);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = array();
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
        $response["data"] = array();
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
        $response["data"] = array();
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
 * method - GET,
 * param:{
  "page_no":1
  }
 */
$app->get('/resource_centre_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
//    $post_data = $app->request->getBody();
//    $post_data = json_decode($post_data, true);
    $post_data = $app->request->get();
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
 * method - GET
 * params:{
  "page_no":1,
  "type":"upcoming"
  }
  type=>upcoming,recent
 */
$app->get('/event_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->get();
    //$post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;
    $type = @$post_data['type'] ? @$post_data['type'] : 'upcoming';
    $eventyear = @$post_data['eventyear'] ? @$post_data['eventyear'] : "";
    $res = $db->event_list($page_no, $type, $eventyear);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["data"] = array();
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
 * contact information
 * url - /contact_info
 * method - GET
 */
$app->get('/home_statistics', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->home_statistics();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Home Statistics";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Blog List
 * url - /blog_list
 * method - GET
 * params:{
  "page_no":1,
  "search_text":"testing"
  }
 */
$app->get('/blog_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->get();
    //$post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;
    $search_text = @$post_data['search_text'] ? @$post_data['search_text'] : '';
    $res = $db->blog_list($page_no, $search_text);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Blog List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Blog detail
 * url - /blog_detail
 * params-slug
 * method - GET
 */
$app->get('/blog_detail/:slug', function($slug) use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->blog_detail($slug);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Blog Detail";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

/**
 * Career List
 * url - /career_list
 * method - GET
 * params:{
  "page_no":1,
  }
 */
$app->get('/career_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->get();
    //$post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;
    $res = $db->career_list($page_no);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["data"] = array();
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Career List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Score List
 * url - /score_list
 * method - POST
 * params:{
  "page_no":1,
  "course_id":1 [1=>gmat,2=>gre,3=>sat,4=>ielts,5=>toefl],
  "pass_year":2018 [YYYY],
  }
 */
$app->post('/score_list11', function() use ($app) {
    //echo "here";exit;
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->getBody();
    $post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;
    $course_id = @$post_data['course_id'] ? @$post_data['course_id'] : 1;
    $pass_year = @$post_data['pass_year'] ? @$post_data['pass_year'] : "";

    $res = $db->score_list($page_no, $course_id, $pass_year);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Score List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

$app->get('/score_list', function() use ($app) {
    //echo "here";exit;
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->get();
    //print_r($app->request->get()); exit;
    //$post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;
    $course_id = @$post_data['course_id'] ? @$post_data['course_id'] : 1;
    $pass_year = @$post_data['pass_year'] ? @$post_data['pass_year'] : "";

    $res = $db->score_list($page_no, $course_id, $pass_year);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        $return['list'] = array();
        $return['page'] = 1;
        $return['next_page'] = 0;
        $return['total'] = 0;
        $response["data"] = $return;
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Score List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Counselling Results List
 * url - /admission_counselling_list
 * method - GET
 * params:{
  "page_no":1,
  "course_id":1 [1=>MBA,2=>MS & PHD,3=>Undergrad],
  "pass_year":2018 [YYYY],
  }
 */
$app->get('/admission_counselling_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->get();
    //$post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;
    $course_id = @$post_data['course_id'] ? @$post_data['course_id'] : 1;
    $pass_year = @$post_data['pass_year'] ? @$post_data['pass_year'] : "";

    $res = $db->admission_counselling_list($page_no, $course_id, $pass_year);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $return['list'] = array();
        $return['page'] = 1;
        $return['next_page'] = 0;
        $return['total'] = 0;
        $response["data"] =$return;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Admission Counselling List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Review List
 * url - /review_list
 * method - GET
 * params:{
  "page_no":1,
  "course_id":1 [1=>gmat,2=>gre,3=>sat,4=>ielts,5=>toefl,6=>Admission],
  }
 */
$app->get('/review_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->get();
    //$post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;
    $course_id = @$post_data['course_id'] ? @$post_data['course_id'] : 1;
    $res = $db->review_list($page_no, $course_id);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $return['videos'] = array();
        $return['list'] = array();
        $return['page'] = 1;
        $return['next_page'] = 0;
        $return['total'] = 0;
        $response["data"] = $return;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Review List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Page
 * url - /page
 * params-slug
 * method - GET
 */
$app->get('/page/:slug', function($slug) use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->page($slug);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = array();
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Page Data";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Preparation Video List
 * url - /videos_list
 * method - GET
 * params:{
  "page_no":1,
  "course_id":1 [1=>gmat,2=>gre,3=>sat,4=>ielts,5=>toefl,6=>Admission],
  }
 */
$app->get('/videos_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $post_data = $app->request->get();
    //$post_data = json_decode($post_data, true);
    $page_no = @$post_data['page_no'] ? @$post_data['page_no'] : 1;
    $course_id = @$post_data['course_id'] ? @$post_data['course_id'] : 1;
    $res = $db->videos_list($page_no, $course_id);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Video List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * Resource center category list
 * url - /get_resource_cat_list
 * method - GET
 */
$app->get('/get_resource_cat_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->get_resource_cat_list();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = array();
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Course List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Student Downloads
 * url - /student_downloads
 * params-course_cat_id[0,=>all,1=>GMAT-MBA,2=>GRE-MS/PHD,3=>SAT-UNDERGRAD]
 * method - GET
 */
$app->get('/student_downloads(/:course_cat_id)', function($course_cat_id = '') use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->student_downloads($course_cat_id);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = array();
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Download List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * Admissions Procedures
 * url - /admissions_procedures
 * params-course_cat_id[1=>GMAT-MBA,2=>GRE-MS/PHD,3=>SAT-UNDERGRAD]
 * method - GET
 */
$app->get('/admissions_procedures(/:course_cat_id)', function($course_cat_id = '') use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->admissions_procedures($course_cat_id);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = array();
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Admissions Procedure";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * University deadlines
 * url - /university_deadlines
 * params-course_cat_id[1=>GMAT-MBA,2=>GRE-MS/PHD,3=>SAT-UNDERGRAD]
 * method - GET
 */
$app->get('/university_deadlines(/:course_cat_id)', function($course_cat_id = '') use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->university_deadlines($course_cat_id);
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = array();
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "University deadline";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Recent Blog List
 * url - /recent_blog_list
 * method - GET

 */
$app->get('/recent_blog_list', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->recent_blog_list();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Recent Post List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Career funtional_area list
 * url - /career_functional_areas
 * method - GET
 */
$app->get('/career_functional_areas', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->career_functional_areas();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = array();
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Career Functional Area List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

/**
 * Post Resume
 * url - /post_resume
 * method - POST
 * params - mobile(mandatory),otp(required)
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/post_resume', function() use ($app) {
    global $config;
    verifyRequiredParams(array('name', 'email', 'mobile', 'ctc', 'career_category_id', 'location'));
    $name = $app->request()->post('name');
    $email = $app->request()->post('email');
    $mobile = $app->request()->post('mobile');
    $ctc = $app->request()->post('ctc');
    $career_category_id = $app->request()->post('career_category_id');
    $location = $app->request()->post('location');

    $response = array();
    $db = new DbHandler();
    $res = $db->post_resume($name, $email, $mobile, $ctc, $career_category_id, $location);

    if ($res == 'ERROR') {
        $response["code"] = ERROR;
        $response["error"] = true;
        $response["message"] = "Some Error Occurred";
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'NO_FILE') {
        $response["code"] = NO_FILE;
        $response["error"] = true;
        $response["message"] = "Please select resume";
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Resume Sent Successfully.";
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});


/**
 * webinars
 * url - /webinars
 * method - GET
 */
$app->get('/webinars', function() use ($app) {
    $response = array();
    $db = new DbHandler();
    $res = $db->webinars();
    if ($res == 'NO_RECORD_FOUND') {
        $response["code"] = NO_RECORD_FOUND;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = array();
        echoRespnse(200, $response);
    } else {
        $response["code"] = SUCCESS;
        $response["error"] = false;
        $response["message"] = "Webinar";
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
