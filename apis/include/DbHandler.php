<?php

class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        require_once dirname(__FILE__) . '/class.phpmailer.php';

        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function home_banners() {
        $is_active = 1;
        $stmt = $this->conn->prepare("SELECT image,image_url,alt_text FROM banners WHERE is_active=?");
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($image, $image_url, $alt_text);
            while ($stmt->fetch()) {
                $r['image'] = BANNER_IMAGE_HTTP_PATH . $image;
                $r['target_url'] = $image_url;
                $r['alt_text'] = $alt_text;
                $response[] = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function slider_scores() {
        $stmt = $this->conn->prepare("SELECT name,id FROM courses WHERE is_active=1 and is_course=1 order by id ASC");
        $courses = array();
        if ($stmt->execute()) {

            $stmt->bind_result($name, $id);
            while ($stmt->fetch()) {
                $courses[$id] = $name;
            }
            $stmt->close();
        }
        if (!empty($courses)) {
            $LIMIT = 10;
            $response = array();

            foreach ($courses as $course_id => $cname) {
                $cid = $course_id;
                $stmt = $this->conn->prepare("SELECT name,marks FROM scores WHERE is_active=1 and course_id=? order by pass_year desc,marks desc LIMIT $LIMIT");
                $stmt->bind_param("i", $cid);
                if ($stmt->execute()) {

                    $stmt->bind_result($name, $marks);
                    while ($stmt->fetch()) {
                        $r['student'] = $name . " " . $marks;
                        $response[$cname][] = $r;
                    }
                    $stmt->close();
                }
            }
            if (!empty($response)) {
                return $response;
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function slider_reviews() {
        $is_active = 1;
        $LIMIT = 18;
        $q = "SELECT student_name,marks,image,reviews,courses.name as course_name,reviews.id as review_id FROM reviews ";
        $q .= " inner join courses on courses.id=reviews.course_id WHERE courses.is_course=1 and reviews.is_active=? order by reviews.id desc,reviews.marks desc LIMIT $LIMIT";
        $stmt = $this->conn->prepare($q);
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($student_name, $marks, $image, $reviews, $course_name, $review_id);
            while ($stmt->fetch()) {
                $r['review_id'] = $review_id;
                $r['student_name'] = $student_name;
                $r['student_score'] = $marks;
                $r['course_name'] = $course_name;
                $r['student_image'] = REVIEWS_IMAGE_HTTP_PATH . $image;
                $r['reviews'] = $reviews;
                $response[] = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function batch_schedule_list($course_id = '',$schedule_type='') {
        $is_active = 1;
        $LIMIT = 18;
        $cond = "";
        if ($course_id) {
            $cond .= " AND schedules.course_id=" . $course_id;
        }
        if ($schedule_type) {
            $cond .= " AND schedules.schedule_type=" . $schedule_type;
        }
        $q = "SELECT courses.name as course_name,schedules.id as schedules_id,start_date,duration,timings,days,schedule_type FROM schedules ";
        $q .= " inner join courses on courses.id=schedules.course_id WHERE courses.is_course=1 $cond and schedules.is_active=? order by schedule_type desc,courses.id asc";
        $stmt = $this->conn->prepare($q);
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($course_name, $schedules_id, $start_date, $duration, $timings, $days, $schedule_type);
            while ($stmt->fetch()) {
                $r['schedules_id'] = $schedules_id;
                $r['course_name'] = $schedule_type == 1 ? $course_name : $course_name . " Live Online";
                $r['date'] = date("d-M-y", strtotime($start_date));
                $r['duration'] = $duration;
                $r['timings'] = $timings;
                $r['days'] = $days;
                $r['type'] = $schedule_type == 1 ? "Class Room" : "Live Online";
                $response[] = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function home_event_list() {
        $is_active = 1;
        $event_sdate = date("Y-m-d", time());
        $q = "SELECT title,location,description,event_url,event_images.image as event_image,event_sdate FROM events ";
        $q .= " LEFT JOIN event_images on event_images.event_id=events.id ";
        $q .= " WHERE DATE_FORMAT(events.event_sdate, '%Y-%m-%d') >='" . $event_sdate . "' AND is_active=? order by rand() LIMIT 2";
        $stmt = $this->conn->prepare($q);
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($title, $location, $description, $event_url, $event_image, $event_sdate);
            while ($stmt->fetch()) {
                $r['title'] = $title;
                $r['image_alt'] = $title;
                $r['image'] = EVENT_IMAGE_HTTP_PATH . $event_image;
                $r['description'] = $description;
                $r['event_url'] = $event_url;
                $r['date'] = date("d-M-y", strtotime($event_sdate));
                $response[] = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function home_introduction() {
        $is_active = 1;
        $stmt = $this->conn->prepare("SELECT description,you_tube_url FROM introductions WHERE id=? LIMIT 1");
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($description, $you_tube_url);
            while ($stmt->fetch()) {
                $r['description'] = $description;
                $r['you_tube_url'] = $you_tube_url;
                $response = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function home_resource_centres() {
        $is_active = 1;
        $show_on_home = 1;
        $video_category_id = 1;
        $stmt = $this->conn->prepare("SELECT you_tube_url FROM videos WHERE is_active=? and show_on_home=? and video_category_id=? LIMIT 2");
        $stmt->bind_param("iii", $is_active, $show_on_home, $video_category_id);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($you_tube_url);
            while ($stmt->fetch()) {
                $r['you_tube_url'] = $you_tube_url;
                $response[] = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function header_events() {
        $is_active = 1;
        $event_sdate = date("Y-m-d", time());
        $q = "SELECT title,location,description,event_url,event_images.image as event_image,event_sdate,event_edate FROM events ";
        $q .= " LEFT JOIN event_images on event_images.event_id=events.id ";
        $q .= " WHERE DATE_FORMAT(events.event_sdate, '%Y-%m-%d') >='" . $event_sdate . "' AND is_active=? order by rand() LIMIT 10";
        $stmt = $this->conn->prepare($q);
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($title, $location, $description, $event_url, $event_image, $event_sdate, $event_edate);
            while ($stmt->fetch()) {
                $r['title'] = $title;
                $r['event_url'] = $event_url;
                $r['date'] = date("d-M-y", strtotime($event_sdate));
                $r['timing'] = date("h:iA", strtotime($event_sdate)) . " to " . date("h:iA", strtotime($event_edate));
                $response[] = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function associates() {
        $is_active = 1;
        $stmt = $this->conn->prepare("SELECT image,alt_tag FROM associates WHERE is_active=? order by orders asc");
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($image, $alt_tag);
            while ($stmt->fetch()) {
                $r['image'] = ASSOCIATES_IMAGE_HTTP_PATH . $image;
                $r['alt_text'] = $alt_tag;
                $response[] = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function resource_centre_list($page) {
        $page = $page ? $page : 1;
        $limit = 20;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }

        $q = "SELECT you_tube_url FROM videos WHERE is_active=1 and video_category_id=1";
        $re1 = mysqli_query($this->conn, $q);
        $num_rows = mysqli_num_rows($re1);
        $response = array();
        if ($num_rows > 0) {
            if ($num_rows / ($page * $limit) > 1) {
                $nxt_page_no = $page + 1;
            } else {
                $nxt_page_no = 0;
            }

            $q .= " limit  $offset,$limit";
            $res = mysqli_query($this->conn, $q);
            $i = 0;
            while ($array = mysqli_fetch_array($res)) {
                $r['you_tube_url'] = $array['you_tube_url'];
                $response[] = $r;
            }

            $return['list'] = $response;
            $return['page'] = $page;
            $return['next_page'] = $nxt_page_no;
            $return['total'] = $num_rows;
            return $return;
        } else {
            return "NO_RECORD_FOUND";
        }
    }

    public function event_list($page, $type) {
        $page = $page ? $page : 1;
        $limit = 20;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }

        $is_active = 1;
        $event_sdate = date("Y-m-d", time());
        $cond = "is_active=1";
        if ($type == "recent") {
            $cond .= " AND DATE_FORMAT(events.event_sdate, '%Y-%m-%d') <'" . $event_sdate . "'";
        } else {
            $cond .= " AND DATE_FORMAT(events.event_sdate, '%Y-%m-%d') >='" . $event_sdate . "'";
        }

        $q = "SELECT title,location,description,event_url,event_images.image as event_image,event_sdate,event_edate FROM events ";
        $q .= " LEFT JOIN event_images on event_images.event_id=events.id ";
        $q .= " WHERE $cond order by event_sdate ASC";
        $re1 = mysqli_query($this->conn, $q);
        $num_rows = mysqli_num_rows($re1);
        $response = array();
        if ($num_rows > 0) {
            if ($num_rows / ($page * $limit) > 1) {
                $nxt_page_no = $page + 1;
            } else {
                $nxt_page_no = 0;
            }

            $q .= " limit  $offset,$limit";
            $res = mysqli_query($this->conn, $q);
            $i = 0;
            while ($array = mysqli_fetch_array($res)) {
                $r['title'] = $array['title'];
                $r['event_url'] = $array['event_url'];
                $r['date'] = date("d-M-y", strtotime($array['event_sdate']));
                $r['timing'] = date("h:iA", strtotime($array['event_sdate'])) . " to " . date("h:iA", strtotime($array['event_edate']));
                $r['image_alt'] = $array['title'];
                $event_image = $array['event_image'];
                $r['image'] = $event_image ? EVENT_IMAGE_HTTP_PATH . $event_image : "";
                $r['description'] = $array['description'];
                $r['location'] = $array['location'];
                $response[] = $r;
            }

            $return['list'] = $response;
            $return['page'] = $page;
            $return['next_page'] = $nxt_page_no;
            $return['total'] = $num_rows;
            return $return;
        } else {
            return "NO_RECORD_FOUND";
        }
    }

    function get_submennus($id, $type) {
        $return = array();
        if ($id) {
            if ($type == 1) {
                $cond = "is_active=1 and is_header=1 and parent_id=$id";
            } else if ($type == 2) {
                $cond = "is_active=1 and is_footer=1 and parent_id=$id";
            }
            $q = "SELECT * FROM menus WHERE " . $cond . " order by orders ASC";
            $re1 = mysqli_query($this->conn, $q);
            $num_rows = mysqli_num_rows($re1);

            if ($num_rows > 0) {
                $j = 0;
                while ($array = mysqli_fetch_array($re1)) {
                    $return[$j]['title'] = $array['name'];
                    $return[$j]['slug'] = $array['slug'];
                    $return[$j]['menu_id'] = $array['id'];
                    $return[$j]['is_url'] = $array['is_page'] == 1 ? "YES" : "NO";
                    $return[$j]['sub_menu'] = $this->get_submennus($array['id'], $type);
                    $j++;
                }
            }
        }
        return $return;
    }

    function menus($type) {
        $return = array();
        if ($type == 1) {
            $q = "SELECT * FROM menus WHERE is_active=1 and is_header=1 having parent_id is NULL order by orders ASC";
            $re1 = mysqli_query($this->conn, $q);
            $num_rows = mysqli_num_rows($re1);

            if ($num_rows > 0) {
                $i = 0;
                while ($array = mysqli_fetch_array($re1)) {
                    $return[$i]['title'] = $array['name'];
                    $return[$i]['slug'] = $array['slug'];
                    $return[$i]['menu_id'] = $array['id'];
                    $return[$i]['is_url'] = $array['is_page'] == 1 ? "YES" : "NO";
                    $return[$i]['sub_menu'] = $this->get_submennus($array['id'], $type);
                    $i++;
                }
            }
            // print_r($return);exit;
            return $return;
        } else if ($type == 2) {
            $q = "SELECT * FROM menus WHERE is_active=1 and is_footer=1 and footer_top=1 order by orders ASC";
            $re1 = mysqli_query($this->conn, $q);
            $num_rows = mysqli_num_rows($re1);

            if ($num_rows > 0) {
                $i = 0;
                while ($array = mysqli_fetch_array($re1)) {
                    $return[$i]['title'] = $array['name'];
                    $return[$i]['slug'] = $array['slug'];
                    $return[$i]['menu_id'] = $array['id'];
                    $return[$i]['is_url'] = $array['is_page'] == 1 ? "YES" : "NO";
                    $return[$i]['sub_menu'] = $this->get_submennus($array['id'], $type);
                    $i++;
                }
            }
            // print_r($return);exit;
            return $return;
        }
    }

    public function socials() {
        $is_active = 1;
        $stmt = $this->conn->prepare("SELECT image,social_url,alt_tag FROM socials WHERE is_active=?");
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($image, $social_url, $alt_tag);
            while ($stmt->fetch()) {
                $r['image'] = SOCIALS_IMAGE_HTTP_PATH . $image;
                $r['social_url'] = $social_url;
                $r['alt_text'] = $alt_tag;
                $response[] = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function seo_scripts() {
        $is_active = 1;
        $stmt = $this->conn->prepare("SELECT script_body,position_type FROM seo_scripts WHERE is_active=?");
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($script_body, $position_type);
            while ($stmt->fetch()) {
                $r['script'] = $script_body;
                $r['position'] = $position_type == 1 ? "Header" : "Footer";
                $response[] = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function contact_info() {

        $stmt = $this->conn->prepare("SELECT phone_numbers,emails,availability,adress,map_iframe_src FROM contacts WHERE id=1 LIMIT 1");
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($phone_numbers, $emails, $availability, $adress, $map_iframe_src);
            while ($stmt->fetch()) {

                $r['phone_numbers'] = explode(",", $phone_numbers);
                $r['emails'] = explode(",", $emails);
                $r['address'] = $adress;
                $r['availability'] = $availability;
                $r['map_iframe_src'] = $map_iframe_src;
                $response = $r;
            }
            $stmt->close();
            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

}
?>
	 


