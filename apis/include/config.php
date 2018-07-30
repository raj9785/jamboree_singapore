<?php

define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'jamboree');
define('APIURL', 'http://localhost/jamboree/');
define('BANNER_IMAGE_HTTP_PATH', APIURL . 'uploads/banners/');
define('APIKEY', 'AIzaSyBV5RfhWafhuRTovv9T9eif8KOCRZyOfBE');
define("REVIEWS_IMAGE_HTTP_PATH", APIURL . 'uploads/reviews/');
define("EVENT_IMAGE_HTTP_PATH", APIURL . 'uploads/events/');
define("ASSOCIATES_IMAGE_HTTP_PATH", APIURL . 'uploads/associates/');
define("BLOG_IMAGE_HTTP_PATH", APIURL . 'uploads/blogs/');
define("STUDENTS_IMAGE_HTTP_PATH", APIURL . 'uploads/students/');

define('SUBDIR_IMAGE', '/jamboree/');
define("APP_WEBROOT_ROOT_PATH_IMAGE", $_SERVER['DOCUMENT_ROOT'] . SUBDIR_IMAGE . 'app/webroot/');
define("DOCS_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/docs/');

define('SUCCESS', '1000');
define('NO_RECORD_FOUND', '1001');
define('BAD_REQUEST', '1002');

define('ERROR', '1003');
define('NO_FILE', '1004');
?>
