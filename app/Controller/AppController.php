<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text', 'Cache', 'AltTag');

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Auth', 'Session', 'Cookie', 'Paginator', 'Email');

    /**
     * beforeFilter callback
     *
     * @return void
     */
    public function beforeFilter() {

        //echo WEBSITE_URL; exit;
        $scope = array('Customer.is_active' => 1, 'Customer.is_verified' => 1);
        $loginAction = array('plugin' => '', 'controller' => false, 'action' => 'login');
        $loginRedirect = array('plugin' => '', 'controller' => false, 'action' => 'my-profile');
        $logoutRedirect = array('plugin' => '', 'controller' => false, 'action' => 'login');
        $this->Auth->authenticate = array('Form' => array('fields' => array('username' => 'email', 'password' => 'password'), 'scope' => $scope));
        $this->Auth->authError = __('Did you really think you are allowed to see that?');

        AuthComponent::$sessionKey = 'Auth.User';
        $this->Auth->loginRedirect = $loginRedirect;
        $this->Auth->logoutRedirect = $logoutRedirect;
        $this->Auth->loginAction = $loginAction;

        $this->Auth->allow('index', 'dologin', 'visitors_log', 'pr_visitors_log', '_send_otp_mail');
        // $this->loadModel('Customer');
        //$this->visitors_log();

        $authUser = $this->Auth->user();


        $this->set('authUser', $authUser);
    }

    // Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function visitors_log() {
        //echo Router::url( $this->here, true );
        $this->loadModel('VisitorLog');
        $ip = $this->get_client_ip();
        $current_url = Router::url(null, true);
        $time_chk = date("Y-m-d H:i:s", strtotime("-15 minutes"));
        //echo $this->Cookie->read("random_tracking");
        //echo $time_chk;
        $records = $this->VisitorLog->find('count', array(
            'conditions' => array(
                'VisitorLog.ip' => $ip,
                'VisitorLog.random_tracking' => $this->Cookie->read("random_tracking"),
                'VisitorLog.created >' => $time_chk,
                'VisitorLog.page_url' => $current_url,
            ),
        ));
        //echo $records;exit;
        //$records = 1;
        if ($records == 0) {

            if ($this->Cookie->read("random_tracking") == '') {

                $random_tracking = rand(0, 999999999);
                $this->Cookie->write("random_tracking", $random_tracking, true, "+12 months");

                $records_repeate = $this->VisitorLog->find('count', array(
                    'conditions' => array(
                        'VisitorLog.ip' => $ip,
                        'DATE_FORMAT(VisitorLog.created, "%Y-%m-%d")' => date("Y-m-d"),
                        'VisitorLog.page_url' => $current_url,
                    ),
                ));

                if ($records_repeate < 25) {
                    $data_new['VisitorLog']['created'] = date("Y-m-d H:i:s");
                    $data_new['VisitorLog']['ip'] = $ip;
                    $data_new['VisitorLog']['random_tracking'] = $random_tracking;
                    $data_new['VisitorLog']['reapted'] = $records_repeate > 0 ? 1 : 0;
                    $data_new['VisitorLog']['device_type'] = 0;
                    $data_new['VisitorLog']['page_url'] = $current_url;
                    $this->VisitorLog->save($data_new);
                }
            } else {

                $random_tracking = $this->Cookie->read("random_tracking");
                if ($random_tracking) {
                    $records_repeate = $this->VisitorLog->find('count', array(
                        'conditions' => array(
                            'VisitorLog.ip' => $ip,
                            'VisitorLog.random_tracking' => $random_tracking,
                            'VisitorLog.page_url' => $current_url,
                        ),
                    ));

                    $data_new['VisitorLog']['created'] = date("Y-m-d H:i:s");
                    $data_new['VisitorLog']['ip'] = $ip;
                    $data_new['VisitorLog']['random_tracking'] = $random_tracking;
                    $data_new['VisitorLog']['reapted'] = $records_repeate > 0 ? 1 : 0;
                    $data_new['VisitorLog']['device_type'] = 0;
                    $data_new['VisitorLog']['page_url'] = $current_url;
                    $this->VisitorLog->save($data_new);
                }
            }
        }
        return true;
    }

    public function isAuthorized() {
        return true;
    }

   

    public function favicon() {
        $this->loadModel("ImageGallery");
        return $favicon = $this->ImageGallery->findById(104);
        die;
    }

    public function send_message_multiple($phone_no_arry, $msg, $no_response = '') {
        //return true; exit;
        if (!empty($phone_no_arry)) {
            $phone_nos = implode(",", $phone_no_arry);
            if ($phone_nos) {
                //$url = "http://37.58.64.227/server/sendsms.aspx?username=superc&password=superc12&receiver=" . $phone_nos . "&message=" . urlencode($msg) . "&message_type=TEXT&sender=SUPERC";
                //$url = "http://api.clickatell.com/http/sendmsg?user=xabado&password=AUdDOeGcQHffON&api_id=3552366&to=" . $phone_no . "&text=" . urlencode($msg) . "";
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, true);
                if ($no_response == 1) {
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                }
                $data = curl_exec($ch);
                //pr($data);exit;
                if ($data)
                    return true;
                else
                    return false;
            }else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function send_message($phone_no, $msg, $no_response = '') {
        //return true; exit;
        if ($phone_no) {
            //$url = "http://37.58.64.227/server/sendsms.aspx?username=superc&password=superc12&receiver=" . $phone_no . "&message=" . urlencode($msg) . "&message_type=TEXT&sender=SUPERC";
           
            //$execute = file_get_contents($url);
            //echo $url; exit;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, true);
            if ($no_response == 1) {
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            }
            $data = curl_exec($ch);
            //pr($data);

            if ($data)
                return true;
            else
                return false;
        }else {
            return false;
        }
    }

    function downloadFile($filename, $downloadPath, $alt_name = '') {
        $file = $downloadPath . $filename;
        //echo $file;
        //pr(filetype($file));
        if (!is_file($file)) {
            die(__("<b>404 File not found!</b>"));
        }

        //Gather relevent info about file
        $len = filesize($file);
        $filename = basename($file);
        $file_extension = strtolower(substr(strrchr($filename, "."), 1));

        //This will set the Content-Type to the appropriate setting for the file
        switch ($file_extension) {
            case "pdf":
                $ctype = "application/pdf";
                break;
            case "exe":
                $ctype = "application/octet-stream";
                break;
            case "zip":
                $ctype = "application/zip";
                break;
            case "docx":
                $ctype = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
                break;
            case "doc":
                $ctype = "application/msword";
                break;
            case "xlsx":
                $ctype = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                break;
            case "xls":
                $ctype = "application/vnd.ms-excel";
                break;
            case "ppt":
                $ctype = "application/vnd.ms-powerpoint";
                break;
            case "gif":
                $ctype = "image/gif";
                break;
            case "png":
                $ctype = "image/png";
                break;
            case "jpeg":
            case "jpg":
                $ctype = "image/jpg";
                break;
            case "mp3":
                $ctype = "audio/mpeg";
                break;
            case "wav":
                $ctype = "audio/x-wav";
                break;
            case "mpeg":
            case "mpg":
            case "mpe":
                $ctype = "video/mpeg";
                break;
            case "mov":
                $ctype = "video/quicktime";
                break;
            case "avi":
                $ctype = "video/x-msvideo";
                break;

            //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
            case "php":
            case "htm":
            case "html":
                die("<b>Cannot be used for " . $file_extension . " files!</b>");
                break;

            default:
                $ctype = "application/force-download";
        }

        //Begin writing headers
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");

        //Use the switch-generated Content-Type
        header("Content-Type: $ctype");

        //Force the download
        if ($alt_name == '') {
            $alt_name = $filename;
        } else {
            $alt_name = $alt_name . '.' . $file_extension;
        }
        $header = "Content-Disposition: attachment; filename=" . $alt_name . ";";
        header($header);
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . $len);
        @readfile($file);
        exit();
    }

    function _sendMail($to, $from, $replyTo, $subject, $element, $parsingParams = array(), $attachments = "", $sendAs = 'html', $bcc = array()) {

        $toAraay = array();
        if (!is_array($to)) {

            $toAraay[] = $to;
        } else {
            $toAraay = $to;
        }


        $this->Email->smtpOptions = array('port' => MAIL_PORT, 'host' => MAIL_HOST, 'username' => MAIL_USERNAME, 'password' => MAIL_PASSWORD, 'client' => MAIL_CLIENT);
//pr($toAraay); die;
        $this->Email->delivery = 'smtp';

        if (is_array($parsingParams)) {
            foreach ($parsingParams as $key => $value) {
                $this->set($key, $value);
            }
        }


        foreach ($toAraay as $email) {
            $this->Email->to = $email;

            $this->Email->subject = $subject;
            $this->Email->replyTo = $replyTo;
            $this->Email->from = $from;
            if ($attachments != "") {
                $this->Email->attachments = array();
                $this->Email->attachments[0] = ALBUM_UPLOAD_IMAGE_PATH . $attachments;
            }
            $this->Email->template = $element; // note no '.ctp'
            //Send as 'html', 'text' or 'both' (default is 'text')
            $this->Email->sendAs = $sendAs; // because we like to send pretty mail
            $this->Email->send();
            $this->Email->reset();
        }
    }

    function export_file($header_row, $results, $flag = '') {

        if ($flag == 'csv') {
            ini_set('max_execution_time', 600);
            $filename = "export_" . date("Y.m.d") . ".csv";
            $csv_file = fopen('php://output', 'w');
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            fputcsv($csv_file, $header_row, ',', '"');

            foreach ($results as $result) {
                $row = array();
                foreach ($result as $key => $res) {
                    $row[] = $res;
                }
                fputcsv($csv_file, $row, ',', '"');
            }


            fclose($csv_file);
            die;
        } else if ($flag == 'pdf') {


            $detail = PDF_HEADER_HTML;
            foreach ($header_row as $header_item) {
                $detail .= '<th style="border:1px solid #000;">' . $header_item . '</th>';
            }
            $detail .= '</tr>';
            foreach ($results as $key => $result) {
                $row = array();
                $detail .= '<tr >';
                foreach ($result as $key => $res) {
                    $detail .= '<td style="border:1px solid #000;">' . $res . '</td>';
                }
                $detail .= '</tr>';
            }
            $detail .= '</table>' . PDF_FOOTER_HTML;
            require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
            $this->dompdf = new DOMPDF();
            $papersize = "legal";
            $orientation = "landscape";
            $this->dompdf->load_html($detail);

            $this->dompdf->render();
            $filename = "pdf_" . date("Y.m.d") . ".pdf";
            $this->dompdf->stream($filename);

            die;
        }
    }

    public function resize($image_name, $width, $height = '', $folder_name, $thumb_folder) {

        $file_extension = $this->getFileExtension($image_name);
        switch ($file_extension) {
            case 'jpg':
            case 'jpeg':
                $image_src = imagecreatefromjpeg($folder_name . DS . $image_name);
                break;
            case 'png':
                $image_src = imagecreatefrompng($folder_name . DS . $image_name);
                break;
            case 'gif':
                $image_src = imagecreatefromgif($folder_name . DS . $image_name);
                break;
        }
        $true_width = imagesx($image_src);
        $true_height = imagesy($image_src);

        if ($true_width > $true_height) {
            $height = ($true_height * $width) / $true_width;
        } else {
            if ($height == '')
                $height = ($true_height * $width) / $true_width;

            $width = ($true_width * $height) / $true_height;
        }
        $image_des = imagecreatetruecolor($width, $height);

        if ($file_extension == 'png') {
            $nWidth = intval($true_width / 4);
            $nHeight = intval($true_height / 4);
            imagealphablending($image_des, false);
            imagesavealpha($image_des, true);
            $transparent = imagecolorallocatealpha($image_des, 255, 255, 255, 127);
            imagefilledrectangle($image_des, 0, 0, $nWidth, $nHeight, $transparent);
        }

        imagecopyresampled($image_des, $image_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

        switch ($file_extension) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($image_des, $thumb_folder . DS . $image_name, 100);
                break;
            case 'png':
                imagepng($image_des, $thumb_folder . DS . $image_name, 5);
                break;
            case 'gif':
                imagegif($image_des, $thumb_folder . DS . $image_name, 100);
                break;
        }
        return $image_des;
    }

    function getFileExtension($file) {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        return $extension;
    }

}
