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
        $stmt = $this->conn->prepare("SELECT image,image_url,alt_text FROM banners WHERE is_active=? order by orders DESC");
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
        $response = array();
        $stmt = $this->conn->prepare("SELECT name,id FROM courses WHERE is_active=1 and is_course=1 order by id ASC");
        $courses = array();
        if ($stmt->execute()) {

            $stmt->bind_result($name, $id);
            while ($stmt->fetch()) {
                $courses[$id] = $name;
                $response[$name] = array();
            }
            $stmt->close();
        }
        if (!empty($courses)) {
            $LIMIT = 15;


            foreach ($courses as $course_id => $cname) {
                $cid = $course_id;
                $stmt = $this->conn->prepare("SELECT name,marks FROM scores WHERE is_active=1 and course_id=? order by pass_year desc,marks desc,name ASC LIMIT $LIMIT");
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
        $LIMIT = 21;
        $q = "SELECT student_name,marks,image,reviews,courses.name as course_name,reviews.id as review_id FROM reviews ";
        $q .= " inner join courses on courses.id=reviews.course_id WHERE courses.is_course=1 and reviews.is_active=? order by is_top_highlighted desc,reviews.marks desc LIMIT $LIMIT";
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

    public function batch_schedule_list($course_id = '', $schedule_type = '') {
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
        $q .= " WHERE DATE_FORMAT(events.event_sdate, '%Y-%m-%d') >='" . $event_sdate . "' AND is_active=? group by events.id order by rand()  LIMIT 1";
        $stmt = $this->conn->prepare($q);
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($title, $location, $description, $event_url, $event_image, $event_sdate);
            while ($stmt->fetch()) {
                $r['title'] = $title;
                $r['image_alt'] = $title;
                $r['image'] = EVENT_IMAGE_HTTP_PATH . $event_image;
                $r['description'] = strlen(strip_tags($description)) > 70 ? substr(strip_tags($description), 0, 70) . "..." : strip_tags($description);
                $r['event_url'] = $event_url;
                $r['date'] = date("F d, Y (l)", strtotime($event_sdate));
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
        $q .= " WHERE DATE_FORMAT(events.event_sdate, '%Y-%m-%d') >='" . $event_sdate . "' AND is_active=? group by events.id order by rand() LIMIT 10";
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

    public function event_list($page, $type, $eventyear = '') {
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
            if ($eventyear) {
                $cond .= " AND DATE_FORMAT(events.event_sdate, '%Y') ='" . $eventyear . "'";
            }
        } else {
            $cond .= " AND DATE_FORMAT(events.event_sdate, '%Y-%m-%d') >='" . $event_sdate . "'";
        }
        //echo $cond;exit;

        $q = "SELECT title,location,description,event_url,event_images.image as event_image,event_sdate,event_edate,events.id as event_id FROM events ";
        $q .= " LEFT JOIN event_images on event_images.event_id=events.id ";
        $q .= " WHERE $cond group by events.id order by event_sdate DESC";
        $re1 = mysqli_query($this->conn, $q);
        $num_rows = mysqli_num_rows($re1);
        $response = array();
        if ($num_rows > 0) {
            if ($num_rows / ($page * $limit) > 1) {
                $nxt_page_no = $page + 1;
            } else {
                $nxt_page_no = 0;
            }
            if ($type == "recent") {
                $q .= " limit  $offset,$limit";
            }
            $res = mysqli_query($this->conn, $q);
            $i = 0;
            while ($array = mysqli_fetch_array($res)) {
                $r['title'] = $array['title'];

                $r['date'] = date("d-M-y", strtotime($array['event_sdate']));
                if ($type != "recent") {
                    $r['event_url'] = $array['event_url'];
                    $r['day_name'] = date("l", strtotime($array['event_sdate']));
                    $r['timing'] = date("h:iA", strtotime($array['event_sdate'])) . " to " . date("h:iA", strtotime($array['event_edate']));
                }
                $r['image_alt'] = $array['title'];
                $event_image = $array['event_image'];
                $r['image'] = $event_image ? EVENT_IMAGE_HTTP_PATH . $event_image : "";
                $r['description'] = $array['description'];
                $r['location'] = $array['location'];
                $event_id = $array['event_id'];
                $q2 = "SELECT image FROM event_images WHERE event_id='$event_id' order by id ASC";
                $re2 = mysqli_query($this->conn, $q2);
                $total_images = mysqli_num_rows($re2);
                $r['total_images'] = $total_images;
                $img_arr = array();
                if ($total_images > 0) {
                    while ($array2 = mysqli_fetch_array($re2)) {
                        if ($array2['image']) {
                            $img_arr[] = $array2['image'] ? EVENT_IMAGE_HTTP_PATH . $array2['image'] : "";
                        }
                    }
                }
                $r['img_list'] = $img_arr;



                $response[] = $r;
            }

            $return['list'] = $response;
            if ($type == "recent") {
                $return['page'] = $page;
                $return['next_page'] = $nxt_page_no;
                $return['total'] = $num_rows;
            }
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

    public function home_statistics() {

        $stmt = $this->conn->prepare("SELECT lower_value,upper_value FROM home_statistics");
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($lower_value, $upper_value);
            while ($stmt->fetch()) {
                $r['upper_text'] = $upper_value;
                $r['lower_text'] = $lower_value;
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

    public function blog_list($page, $search_text = '') {
        $page = $page ? $page : 1;
        $limit = 20;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }
        $cond = "is_active=1";
        if ($search_text) {
            $cond .= " AND (heading LIKE '%" . $search_text . "%' OR blog_body LIKE '%" . $search_text . "%')";
        }

        $q = "SELECT * FROM blogs ";
        $q .= " WHERE $cond order by id DESC";
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
                $r['heading'] = $array['heading'];
                $r['description'] =  strlen(strip_tags($array['blog_body'])) > 500 ? substr(strip_tags($array['blog_body']), 0, 500) . "..." : strip_tags($array['blog_body']);
                $bt_image = $array['image'];
                $r['image'] = $bt_image ? BLOG_IMAGE_HTTP_PATH . $bt_image : "";
                $r['image_alt'] = $array['alt_tag'];
                $r['slug'] = $array['slug'];
                $r['date'] = date("d-m-Y h:i A");
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

    public function blog_detail($slug) {
        $is_active = 1;
        $stmt = $this->conn->prepare("SELECT heading,blog_body,image,alt_tag,meta_keywords,meta_description FROM blogs WHERE slug=? and is_active=?");
        $stmt->bind_param("si", $slug, $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($heading, $blog_body, $image, $alt_tag, $meta_keywords, $meta_description);
            while ($stmt->fetch()) {
                $r['heading'] = $heading;
                $r['description'] = $blog_body;
                $r['image'] = $image ? BLOG_IMAGE_HTTP_PATH . $image : "";
                $r['image_alt'] = $alt_tag;
                $r['meta_title'] = $heading;
                $r['meta_keywords'] = $meta_keywords;
                $r['meta_description'] = $meta_description;
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

    public function career_list($page) {
        $page = $page ? $page : 1;
        $limit = 20;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }
        $cond = "is_active=1";


        $q = "SELECT * FROM careers ";
        $q .= " WHERE $cond order by id DESC";
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
                $r['location'] = $array['location'];
                $r['job_functional_area'] = $array['job_functional_area'];
                $r['description'] = $array['description'];
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

    public function score_list($page, $course_id, $pass_year = '') {
        //echo "sss";exit;
        $page = $page ? $page : 1;
        $limit = 20;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }
        $cond = "is_active=1";
        $cond .= " AND course_id=$course_id";
        if ($pass_year) {
            //$cond .= " AND pass_year='" . $pass_year . "'";
        }


        $q = "SELECT * FROM scores ";
        $q .= " WHERE $cond order by pass_year DESC,marks DESC";
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
                $r['name'] = $array['name'];
                $bt_image = $array['image'];
                $r['image'] = $bt_image ? STUDENTS_IMAGE_HTTP_PATH . $bt_image : "";
                $r['image_alt'] = $array['name'];
                $r['marks'] = $array['marks'];
                $r['pass_year'] = $array['pass_year'];
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

    public function admission_counselling_list($page, $course_id, $pass_year = '') {
        $page = $page ? $page : 1;
        $limit = 20;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }
        $cond = "is_active=1";
        $cond .= " AND admission_counselling_course_id=$course_id";
        if ($pass_year) {
            $cond .= " AND result_year='" . $pass_year . "'";
        }


        $q = "SELECT * FROM admission_counselling_results ";
        $q .= " WHERE $cond order by result_year DESC";
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
                $r['name'] = $array['student_name'];
                $bt_image = $array['image'];
                $r['image'] = $bt_image ? STUDENTS_IMAGE_HTTP_PATH . $bt_image : "";
                $r['image_alt'] = $array['student_name'];
                $r['university_name'] = $array['university_name'];
                $r['pass_year'] = $array['result_year'];
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

    public function review_list($page, $course_id) {
        $page = $page ? $page : 1;
        $limit = 20;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }
        $cond = "is_active=1";
        $cond .= " AND course_id=$course_id";



        $q = "SELECT * FROM reviews ";
        $q .= " WHERE $cond order by marks DESC";
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
                $r['name'] = $array['student_name'];
                $bt_image = $array['image'];
                $r['image'] = $bt_image ? REVIEWS_IMAGE_HTTP_PATH . $bt_image : "";
                $r['image_alt'] = $array['student_name'];

                if ($course_id == 6) {
                    $r['university_name'] = $array['university_name'];
                } else {
                    $r['score'] = $array['marks'];
                }
                $r['reviews'] = $array['reviews'];
                $response[] = $r;
            }

            //video list//
            $v = array();
            $q = "SELECT video_reviews.you_tube_url FROM video_reviews";
            $q .= " WHERE course_id=$course_id AND is_active=1 order by rand() LIMIT 3";
            $re1 = mysqli_query($this->conn, $q);
            $num_rows = mysqli_num_rows($re1);
            if ($num_rows > 0) {
                while ($array = mysqli_fetch_array($re1)) {
                    $v[] = $array['you_tube_url'];
                }
            }
            $return['videos'] = $v;
            $return['list'] = $response;
            $return['page'] = $page;
            $return['next_page'] = $nxt_page_no;
            $return['total'] = $num_rows;
            return $return;
        } else {
            return "NO_RECORD_FOUND";
        }
    }

    public function page($slug) {
        $r = array();
        $stmt = $this->conn->prepare("SELECT title,content,meta_keywords,meta_description,image,only_meta,meta_title,has_sub_points,id,sample_test_url,is_scheduler_avail,is_prep_video,course_id,is_reviews,is_score_list,is_why_choose_avail,is_enq_form,is_program_detail,sub_points_heading,video_list_title FROM pages WHERE slug=?");
        $stmt->bind_param("s", $slug);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($title, $content, $meta_keywords, $meta_description, $image, $only_meta, $meta_title, $has_sub_points, $id, $sample_test_url, $is_scheduler_avail, $is_prep_video, $course_id, $is_reviews, $is_score_list, $is_why_choose_avail, $is_enq_form, $is_program_detail, $sub_points_heading, $video_list_title);
            while ($stmt->fetch()) {
                $only_meta_val = $only_meta;
                if ($only_meta == 1) {
                    $r['meta_title'] = $meta_title;
                    $r['meta_keywords'] = $meta_keywords;
                    $r['meta_description'] = $meta_description;
                    $sb_pts = 0;
                    $page_id = $id;
                } else {
                    $r['heading'] = $title;
                    $r['content'] = $content;
                    $r['banner_image'] = $image ? BANNER_IMAGE_HTTP_PATH . $image : "";
                    $r['image_alt'] = $meta_title ? $meta_title : $title;
                    $r['meta_title'] = $meta_title;
                    $r['meta_keywords'] = $meta_keywords;
                    $r['meta_description'] = $meta_description;
                    $r['sample_test_url'] = $sample_test_url;

                    /////
                    $sb_pts = $has_sub_points;
                    $page_id = $id;
                    $is_video = $is_prep_video;
                    $c_id = $course_id;
                    $is_rv = $is_reviews;
                    $isscorelist = $is_score_list;
                    $is_program = $is_program_detail;


                    $r['is_why_choose_jamboree_avail'] = $is_why_choose_avail;
                    $r['is_enquiry_form_avail'] = $is_enq_form;
                    $r['sub_prep_points_heading'] = $sub_points_heading;
                    $r['video_list_title'] = $video_list_title;
                }
            }
            $stmt->close();

            if (@$only_meta_val != 1 && !empty($r)) {
                if ($c_id) {
                    $qs = "SELECT id FROM schedules ";
                    $qs .= " WHERE course_id=$c_id AND is_active=1";
                    $rqs = mysqli_query($this->conn, $qs);

                    if (mysqli_num_rows($rqs) > 0) {
                        $is_scheduler_avail = $is_scheduler_avail;
                    } else {
                        $is_scheduler_avail = 0;
                    }
                    $r['is_scheduler_available'] = $is_scheduler_avail;
                }

                //get FAQ//
                $faqs = array();
                $is_active = 1;
                $menu_slug = $slug;
                $stmtfaq = $this->conn->prepare("SELECT question,answer FROM faqs WHERE menu_slug=? AND is_active=?");
                $stmtfaq->bind_param("si", $menu_slug, $is_active);
                if ($stmtfaq->execute()) {
                    $stmtfaq->bind_result($question, $answer);
                    while ($stmtfaq->fetch()) {
                        $f['question'] = $question;
                        $f['answer'] = $answer;
                        $faqs[] = $f;
                    }
                }

                $r['faqs'] = $faqs;
                $stmtfaq->close();
                $sub_windows = array();
                if (@$sb_pts == 1) {
                    $h = array();
                    $q = "SELECT page_tab_headings.heading,pages.slug,pages.title,pages.id FROM page_tab_headings inner join pages on pages.id=page_tab_headings.page_id";
                    $q .= " WHERE page_tab_headings.parent_page_id=$page_id order by pages.orders ASC";
                    $re1 = mysqli_query($this->conn, $q);
                    $num_rows = mysqli_num_rows($re1);
                    if ($num_rows > 0) {
                        while ($array = mysqli_fetch_array($re1)) {
                            $h['slug'] = $array['slug'];
                            $h['main_heading'] = $array['title'];
                            $h['sub_heading'] = $array['heading'];
                            $pg_id = $array['id'];

                            $q2 = "SELECT page_tabs.text_point FROM page_tabs ";
                            $q2 .= " WHERE page_tabs.page_id=$pg_id order by id ASC";
                            $re12 = mysqli_query($this->conn, $q2);
                            $sub_pts = array();
                            if (mysqli_num_rows($re12) > 0) {
                                $p = array();
                                while ($array2 = mysqli_fetch_array($re12)) {
                                    $p[] = $array2['text_point'];
                                }
                            }
                            $h['points'] = $p;


                            $sub_windows[] = $h;
                        }
                    }
                }
                $r['sub_prep_points'] = $sub_windows;
                $v = array();
                if (@$is_video == 1) {
                    $q = "SELECT videos.you_tube_url FROM videos";
                    $q .= " WHERE course_id=$c_id AND video_category_id=3 AND is_active=1 order by rand() LIMIT 3";
                    $re1 = mysqli_query($this->conn, $q);
                    $num_rows = mysqli_num_rows($re1);
                    if ($num_rows > 0) {
                        while ($array = mysqli_fetch_array($re1)) {
                            $v[] = $array['you_tube_url'];
                        }
                    }
                }
                $r['videos'] = $v;
                $rv = array();
                if (@$is_rv == 1) {

                    $pg_ids = array(
                        "1" => "1",
                        "6" => "6",
                        "11" => "11",
                        "15" => "15",
                        "17" => "17",
                    );
                    if (in_array($page_id, $pg_ids)) {
                        $limit = 18;
                    } else {
                        $limit = 3;
                    }
                    //$page_id
                    $cond = "is_active=1";
                    $cond .= " AND course_id=$course_id";
                    $q = "SELECT * FROM reviews ";
                    $q .= " WHERE $cond order by is_top_highlighted DESC,marks DESC";
                    $re1 = mysqli_query($this->conn, $q);
                    if (mysqli_num_rows($re1) > 0) {
                        $q .= " limit $limit";
                        $res = mysqli_query($this->conn, $q);
                        $i = 0;
                        while ($array = mysqli_fetch_array($res)) {
                            $bt_image = $array['image'];
                            if ($bt_image) {
                                $rsv['name'] = $array['student_name'];

                                $rsv['image'] = $bt_image ? REVIEWS_IMAGE_HTTP_PATH . $bt_image : "";
                                $rsv['image_alt'] = $array['student_name'];

                                if ($course_id == 6) {
                                    $rsv['university_name'] = $array['university_name'];
                                } else {
                                    $rsv['score'] = $array['marks'];
                                }
                                $rsv['reviews'] = $array['reviews'];
                                $rv[] = $rsv;
                            }
                        }
                    }
                }
                $r['reviews'] = $rv;
                $scoreArr = array();
                if (@$isscorelist == 1) {

                    $cond = "is_active=1";
                    $cond .= " AND course_id=$course_id";

                    $q = "SELECT * FROM scores ";
                    $q .= " WHERE $cond order by marks DESC,name ASC";
                    $re1 = mysqli_query($this->conn, $q);
                    if (mysqli_num_rows($re1) > 0) {
                        $q .= " limit  20";
                        $res = mysqli_query($this->conn, $q);
                        $i = 0;

                        while ($array = mysqli_fetch_array($res)) {
                            $bt_image = $array['image'];
                            if ($bt_image) {
                                $rc['name'] = $array['name'];

                                $rc['image'] = $bt_image ? STUDENTS_IMAGE_HTTP_PATH . $bt_image : "";
                                $rc['image_alt'] = $array['name'];
                                $rc['marks'] = $array['marks'];
                                $rc['pass_year'] = $array['pass_year'];
                                $scoreArr[] = $rc;
                            }
                        }
                    }
                }
                $r['score_list'] = $scoreArr;
                $pgArr = array();
                if (@$is_program == 1) {

                    $cond = "is_active=1";
                    $cond .= " AND page_id=$page_id";

                    $q = "SELECT * FROM page_program_details ";
                    $q .= " WHERE $cond order by id ASC";
                    $re1 = mysqli_query($this->conn, $q);
                    if (mysqli_num_rows($re1) > 0) {
                        $res = mysqli_query($this->conn, $q);
                        while ($array = mysqli_fetch_array($res)) {
                            $bt_image = $array['image'];
                            if ($bt_image) {
                                $rp['image'] = $bt_image ? PAGE_ICON_HTTP_PATH . $bt_image : "";
                                $rp['image_alt'] = $array['alt_text'];
                                $rp['description'] = $array['heading_text'];
                                $pgArr[] = $rp;
                            }
                        }
                    }
                }
                $r['program_details'] = $pgArr;
            }
            $response = $r;

            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function videos_list($page, $course_id) {
        $page = $page ? $page : 1;
        $limit = 20;
        if ($page > 1) {
            $offset = $limit * $page - $limit;
        } else {
            $offset = 0;
        }
        $cond = "is_active=1 AND video_category_id=3 ";
        $cond .= " AND course_id=$course_id";



        $q = "SELECT you_tube_url FROM videos ";
        $q .= " WHERE $cond order by id DESC";
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
                $r['url'] = $array['you_tube_url'];
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

    public function get_resource_cat_list() {
        $is_active = 1;
        $stmt = $this->conn->prepare("SELECT id,name FROM deadline_categories WHERE is_active=? order by id ASC");
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($id, $name);
            while ($stmt->fetch()) {
                $r['id'] = $id;
                $r['name'] = $name;
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

    public function student_downloads($course_cat_id = '') {

        $response = array();
        $is_active = 1;
        $q1 = "SELECT id,name FROM download_categories WHERE is_active=$is_active order by id ASC";

        $i = 0;
        $re = mysqli_query($this->conn, $q1);
        if (mysqli_num_rows($re) > 0) {

            $response = array();
            while ($arr1 = mysqli_fetch_array($re)) {
                $response[$i]['cat_name'] = $arr1['name'];
                $cond = "is_active=1";
                if ($course_cat_id) {
                    $cond .= " AND deadline_category_id=$course_cat_id";
                }
                $cond .= " AND download_category_id=" . $arr1['id'];

                $q = "SELECT * FROM downloads ";
                $q .= " WHERE $cond order by id DESC";
                $re1 = mysqli_query($this->conn, $q);

                if (mysqli_num_rows($re1) > 0) {

                    while ($array = mysqli_fetch_array($re1)) {
                        $r = array();
                        $r['title'] = $array['title'];
                        $bt_image = $array['image'];
                        if ($bt_image) {
                            $r['url'] = $bt_image ? DOCS_HTTP_PATH . $bt_image : "";
                        } else {
                            $r['url'] = $array['you_tube_url'];
                        }
                        $response[$i]['downloads'][] = $r;
                    }
                } else {
                    $response[$i]['downloads'] = array();
                }

                $i++;
            }

            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function admissions_procedures($course_cat_id = '') {
        $course_cat_id = $course_cat_id ? $course_cat_id : 1;
        $is_active = 1;
        $stmt = "SELECT title,content FROM admission_procedures WHERE is_active=$is_active AND deadline_category_id=$course_cat_id";
        $re1 = mysqli_query($this->conn, $stmt);
        if (mysqli_num_rows($re1) > 0) {
            $response = array();
            while ($array1 = mysqli_fetch_array($re1)) {
                $r['title'] = $array1['title'];
                $r['content'] = $array1['content'];
                $faqs = array();
                $menu_slug = "Admissions-Procedures";
                $is_active = 1;
                $q = "SELECT question,answer FROM faqs WHERE menu_slug='$menu_slug' AND is_active=1 AND deadline_category_id='$course_cat_id'";
                $re = mysqli_query($this->conn, $q);
                if (mysqli_num_rows($re) > 0) {
                    while ($array = mysqli_fetch_array($re)) {
                        $f['question'] = $array['question'];
                        $f['answer'] = $array['answer'];
                        $faqs[] = $f;
                    }
                }


                $r['faqs'] = $faqs;

                $response[] = $r;
            }

            if (!empty($response)) {
                return $response;
            } else {
                return "NO_RECORD_FOUND";
            }
        } else {
            return "BAD_REQUEST";
        }
    }

    public function university_deadlines($course_cat_id = '') {
        $course_cat_id = $course_cat_id ? $course_cat_id : 1;
        $is_active = 1;
        $stmt = $this->conn->prepare("SELECT title,content FROM university_deadlines WHERE is_active=? AND deadline_category_id=?");
        $stmt->bind_param("ii", $is_active, $course_cat_id);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($title, $content);
            while ($stmt->fetch()) {
                $r['title'] = $title;
                $r['iframe_url'] = $content;
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

    public function recent_blog_list() {

        $limit = 5;
        $cond = "is_active=1";
        $q = "SELECT * FROM blogs ";
        $q .= " WHERE $cond order by id DESC";
        $q .= " limit $limit";
        $re1 = mysqli_query($this->conn, $q);
        $num_rows = mysqli_num_rows($re1);
        $response = array();
        if ($num_rows > 0) {
            while ($array = mysqli_fetch_array($re1)) {
                $r['heading'] = $array['heading'];
                $bt_image = $array['image'];
                $r['image'] = $bt_image ? BLOG_IMAGE_HTTP_PATH . $bt_image : "";
                $r['image_alt'] = $array['alt_tag'];
                $r['slug'] = $array['slug'];
                $r['date'] = date("d-m-Y h:i A");
                $response[] = $r;
            }
            return $response;
        } else {
            return "NO_RECORD_FOUND";
        }
    }

    public function career_functional_areas() {
        $is_active = 1;
        $stmt = $this->conn->prepare("SELECT id,name FROM career_categories WHERE is_active=? order by name ASC");
        $stmt->bind_param("i", $is_active);
        if ($stmt->execute()) {
            $response = array();
            $stmt->bind_result($id, $name);
            while ($stmt->fetch()) {
                $r['id'] = $id;
                $r['name'] = $name;
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

    function post_resume($name, $email, $mobile, $ctc, $career_category_id, $location) {

        $upload_folder = DOCS_PATH;
        $uploadImgArray = @$_FILES['resume'];
        $file_name = '';
        if (isset($uploadImgArray) && $uploadImgArray['name'] != "") {
            $file_name = basename($uploadImgArray['name']);
            $imgExtension = pathinfo($file_name, PATHINFO_EXTENSION);
            $image_name = explode("." . $imgExtension, $file_name);
            $prefix = "Resume-" . time();
            $file_name = $prefix . $image_name[0] . "." . $imgExtension;
            if (move_uploaded_file($uploadImgArray['tmp_name'], $upload_folder . $file_name)) {
                $created_on = date("Y-m-d H:i:s");
                $q2 = "INSERT INTO resumes (name, email,mobile,ctc,career_category_id,location,resume,created_on)";
                $q2 .= "values ('$name','$email','$mobile','$ctc ','$career_category_id','$location','$file_name','$created_on')";

                mysqli_query($this->conn, $q2);
                return 'SUCCESS';
            } else {
                return 'ERROR';
            }
        } else {
            return 'NO_FILE';
        }
    }

    public function webinars() {
        $q = "SELECT iframe_path FROM webinars WHERE id=1";
        $re1 = mysqli_query($this->conn, $q);
        if (mysqli_num_rows($re1)) {
            $response = array();
            $array = mysqli_fetch_assoc($re1);
            $r['iframe_url'] = $array['iframe_path'];
            $response = $r;

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
	 


