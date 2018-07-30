<?php

define('SUBDIR', '/');
define('SUBDIR_IMAGE', '/jamboree/');
define('DBHOST', "localhost");
define('DBUSERNAME', "root");
define('DBPASSWORD', "");
define('DB', "jamboree");
/* * **************************************** End Database details ***************************************** */
/* * **************************************** End Database details ***************************************** */
define('WEBSITE_URL', 'http://localhost/jamboree/');
define('WEBSITE_URL_IMAGE', "http://localhost/jamboree/");



define('WEBSITE_JS_URL', WEBSITE_URL . 'js/');
define('WEBSITE_CSS_URL', WEBSITE_URL . 'css/');
define('WEBSITE_IMAGE_URL', WEBSITE_URL . 'img/');
define('WEBSITE_IMG_URL', WEBSITE_URL . 'img/');
define('WEBSITE_IMAGES_URL', WEBSITE_URL . 'images/');
define('WEBSITE_APP_WEBROOT_ROOT_PATH', dirname(__FILE__) . '/app/webroot/');
define('WEBSITE_ADMIN_WEBROOT_ROOT_PATH', dirname(__FILE__) . '/admin/webroot/');

if (!defined('RESULT_FORMAT_PATH')) {
    define("RESULT_FORMAT_PATH", WEBSITE_ADMIN_WEBROOT_ROOT_PATH . 'uploads/formats/');
}
define('IMPORTS_WBROOT_PATH', WEBSITE_ADMIN_WEBROOT_ROOT_PATH . "uploads/imports/");


define('WEBSITE_APP_WEBROOT_IMG_ROOT_PATH', dirname(__FILE__) . '/app/webroot/img/');
define('PROFILE_PIC_STORE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH . 'uploads/users/');
define('DEFAULT_DATE_FORMAT', "m/d/Y");


/* * **************************************** Include all settings ***************************************** */
require_once('settings.php');
/* * **************************************** Include all settings ***************************************** */
//$config['pagingViews'] = array(10 => '10', 20 => '20', 100 => '100');
$config['defaultPaginationLimit'] = 10;
/* Admin Configuration */
if (!defined('APP_CACHE_PATH')) {
    define("APP_CACHE_PATH", ROOT . '/app/tmp/cache');
}
if (!defined('ADMIN_FOLDER')) {
    define("ADMIN_FOLDER", "admin");
}
if (!defined('WEBSITE_ADMIN_URL')) {
    define("WEBSITE_ADMIN_URL", WEBSITE_URL . ADMIN_FOLDER . '/');
}
if (!defined('WEBSITE_ADMIN_IMG_URL')) {
    define("WEBSITE_ADMIN_IMG_URL", WEBSITE_ADMIN_URL . 'img/');
}
if (!defined('WEBSITE_ADMIN_JS_URL')) {
    define("WEBSITE_ADMIN_JS_URL", WEBSITE_ADMIN_URL . 'js/');
}
if (!defined('WEBSITE_ADMIN_CS_URL')) {
    define("WEBSITE_ADMIN_CS_URL", WEBSITE_ADMIN_URL . 'css/');
}




if (!defined('APP_WEBROOT_ROOT_PATH')) {
    define("APP_WEBROOT_ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . SUBDIR . 'app/webroot/');
}
if (!defined('APP_WEBROOT_ROOT_PATH_IMAGE')) {
    define("APP_WEBROOT_ROOT_PATH_IMAGE", $_SERVER['DOCUMENT_ROOT'] . SUBDIR_IMAGE . 'app/webroot/');
}

if (!defined('APP_UPLOADS_ROOT_PATH_IMAGE')) {
    define("APP_UPLOADS_ROOT_PATH_IMAGE", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/');
}
if (!defined('APP_UPLOADS_HTTP_PATH_IMAGE')) {
    define("APP_UPLOADS_HTTP_PATH_IMAGE", WEBSITE_URL_IMAGE . 'uploads/');
}




define('MEMORY_TO_ALLOCATE', '100M');
define('DEFAULT_QUALITY', 90);
define('CACHE_DIR', WEBSITE_APP_WEBROOT_ROOT_PATH . 'imagecache' . DS);
define('DISCOUNT_SYMBOL', '%');
define('DATE_FORMAT', 'd-m-Y');



if (!defined('SETTING_FILE_PATH')) {
    define("SETTING_FILE_PATH", ROOT . '/settings.php');
}




$config['valid_mime_types'] = array('image/jpeg', 'image/png', 'image/gif', 'image/pjpeg');
$config['file_valid_mime_types'] = array('text/plain', 'text/plain', 'text/plain', 'text/plain');
$config['valid_image_types'] = array('jpg', 'jpeg', 'png', 'gif', 'pjpeg');
$config['valid_image_size'] = 52428800; //50MB

$config['date_format'] = array('basic' => 'd M, Y h:i a', 'profile' => 'F d, Y');
$config['front_date_format'] = array('basic' => 'M d, Y h:i a', 'profile' => 'd/m/Y');
$config['date_picker_formate'] = 'dd/mm/yy';
$config['registration'] = array('email' => 'EMAIL_ADDRESS', 'website_url' => 'WEBSITE_URL', 'verify_link' => 'VERIFY_LINK');
$config['register_verify'] = array('email' => 'EMAIL_ADDRESS', 'website_url' => 'WEBSITE_URL');
$config['forgot_password'] = array('email' => 'EMAIL_ADDRESS', 'website_url' => 'WEBSITE_URL', 'reset_link' => 'RESET');
$config['reset_forgot_password'] = array('email' => 'EMAIL_ADDRESS', 'website_url' => 'WEBSITE_URL');
$config['campaign_activated'] = array('partner_name' => 'PARTNER_NAME', 'campaign_name' => 'CAMPAIGN_NAME', 'start_date' => 'START_DATE', 'end_date' => 'END_DATE', 'price' => 'PRICE');


define('PDF_HEADER_HTML', '<html><style>
				.Table{clear:both; display:table; width:100%; border-left:1px solid #eee;}
				.Table th, .Table td{border-right:1px solid #eee; border-bottom:1px solid #eee; padding:5px 10px; text-align:left; font:12px Arial, Helvetica, sans-serif; color:#666;}
				.Table th{font:bold 13px Arial, Helvetica, sans-serif; color:#fff; background:#333;}
				.Table td{background:#fdfdfd;}
				.Table tr:hover td{background:#f6f6f6;}
				</style><body><script  type="text/php">$pdf->page_text(550, $y, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, $color);</script><div style="text-align:right;float;right"><img src="' . WEBSITE_APP_WEBROOT_ROOT_PATH . 'img/main-logo.png' . '" ></div><br/><br/><table class="Table" width="100%" colspan="0" cellpadding="0" cellspacing="0" style="border:1px solid #000;"><tr>');

define('PRINT_HEADER_HTML', '<html><style>
				.Table{clear:both; display:table; width:100%; border-left:1px solid #eee;}
				.Table th, .Table td{border-right:1px solid #eee; border-bottom:1px solid #eee; padding:5px 10px; text-align:left; font:12px Arial, Helvetica, sans-serif; color:#666;}
				.Table th{font:bold 13px Arial, Helvetica, sans-serif; color:#fff; background:#333;}
				.Table td{background:#fdfdfd;}
				.Table tr:hover td{background:#f6f6f6;}
				</style><body><img src="' . WEBSITE_APP_WEBROOT_ROOT_PATH . 'img/main-logo.png' . '"><br/><br/>');


define('PDF_FOOTER_HTML', '</br></br>&nbsp;' . Configure::read('Site.Copyright_text'));


define('MAIL_PORT', 25);
define('PAGELIMIT', 1);
define('MAIL_HOST', 'mail.uptostart.com');
define('MAIL_USERNAME', 'aniima@aniima.uptostart.com');
define('MAIL_PASSWORD', 'Champ@123');
define('MAIL_CLIENT', 'gmail.com');





define('URL_DOMAIN', "live");
define('WEBSITE_NAME', "Jamboree");

//define('MAP_API_KEY', "AIzaSyBMyrT1bAZlCEvAKnRNz_6H5ecOgstwCFg");
define('MAP_API_KEY', "AIzaSyBV5RfhWafhuRTovv9T9eif8KOCRZyOfBE");

define('DATETIME_FORMAT', 'd-m-y h:i A');



define("BLOG_IMAGE_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/blogs/');
define("BLOG_LARGE_IMAGE_PATH", BLOG_IMAGE_PATH . 'large/');
define("BANNER_IMAGE_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/banners/');
define("EVENT_IMAGE_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/events/');
define("MEDIA_IMAGE_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/medias/');
define("REVIEWS_IMAGE_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/reviews/');
define("STUDENTS_IMAGE_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/students/');
define("ASSOCIATES_IMAGE_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/associates/');
define("SOCIALS_IMAGE_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/socials/');

define("PAGE_ICON_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/icons/');
define("DOCS_PATH", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/docs/');
//http paths
define("BLOG_IMAGE_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/blogs/');
define("BLOG_LARGE_IMAGE_HTTP_PATH", BLOG_IMAGE_HTTP_PATH . 'large/');
define("BANNER_IMAGE_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/banners/');
define("EVENT_IMAGE_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/events/');
define("MEDIA_IMAGE_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/medias/');
define("REVIEWS_IMAGE_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/reviews/');
define("STUDENTS_IMAGE_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/students/');
define("ASSOCIATES_IMAGE_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/associates/');
define("SOCIALS_IMAGE_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/socials/');

define("PAGE_ICON_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/icons/');
define("DOCS_HTTP_PATH", WEBSITE_URL_IMAGE . 'uploads/docs/');
