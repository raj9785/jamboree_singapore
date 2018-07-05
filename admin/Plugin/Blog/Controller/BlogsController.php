<?phpclass BlogsController extends BlogAppController {    /**     * Controller name     *     * @var string     */    var $name = 'Blogs';    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');    public $components = array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');    public $presetVars = array(array('field' => 'email', 'type' => 'value'), array('field' => 'firstname', 'type' => 'value'), array('field' => 'username', 'type' => 'value'), array('field' => 'mobile', 'type' => 'value'), array('field' => 'user_role_id', 'type' => 'value'), array('field' => 'status', 'type' => 'value'));    //public $presetVars = 	true;    public function beforeFilter() {        parent::beforeFilter();        $this->set('model', $this->modelClass);        $this->set('tab_open', 'blogs');          }    public function index() {        $conditions = array();        $conditions = array();        $limitValue = $limit = 25;        $page = ((isset($this->params->named['page']) && $this->params->named['page'] != "") ? $this->params->named['page'] : 0);        $this->set('limitValue', $limitValue);        $this->set('limit', $limit);        $this->set('page', $page);        if ($this->request->is('get') && !isset($this->request->data['recordsPerPage'])) {            if (!empty($this->request->query)) {                                                               if (isset($this->request->query['is_active']) && $this->request->query['is_active'] != "") {                    array_push($conditions, array('Blog.is_active' => $this->request->query['is_active']));                    $this->set("is_active", $this->request->query['is_active']);                }                if (isset($this->request->query['heading']) && $this->request->query['heading'] != "") {                    array_push($conditions, array('Blog.heading LIKE' => "%" . $this->request->query['heading'] . "%"));                    $this->set("heading", $this->request->query['heading']);                }                if (@$this->request->query['from_date'] and @ $this->request->query['to_date']) {                    array_push($conditions, array('(DATE_FORMAT(Blog.created_on, "%Y-%m-%d") >= ? AND DATE_FORMAT(Blog.created_on, "%Y-%m-%d") <= ?)' => array($this->request->query['from_date'], $this->request->query['to_date'])));                } else                if (@$this->request->query['from_date']) {                    array_push($conditions, array('DATE_FORMAT(Blog.created_on, "%Y-%m-%d") >= ' => $this->request->query['from_date']));                } else                if (@$this->request->query['to_date']) {                    array_push($conditions, array('DATE_FORMAT(Blog.created_on, "%Y-%m-%d") <= ' => $this->request->query['to_date']));                }                $this->set("from_date", @$this->request->query['from_date']);                $this->set("to_date", @$this->request->query['to_date']);            }        }        $this->paginate = array(            'conditions' => $conditions,            'limit' => 25,            'order' => array(                'Blog.created_on' => 'DESC'            )        );        $this->set('records', $this->paginate('Blog'));        $this->set('title_for_layout', 'Blogs');    }    public function add() {        if ($this->request->is('post')) {            $this->request->data['Blog']['created_on'] = date("Y-m-d H:i:s");            $this->request->data['Blog']['is_verified'] = 1;            $this->request->data['Blog']['is_active'] = 1;            $this->request->data['Blog']['heading'] = $this->data['Blog']['heading'];                        $this->request->data['Blog']['slug'] = $this->gen_slug($this->data['Blog']['heading'], "Blog", "");            $this->request->data['Blog']['blog_body'] = $this->data['Blog']['blog_body'];            $is_success = 1;            $upload_image_folder = BLOG_IMAGE_PATH;            $filename = $this->data{$this->modelClass}['image']['name'];            if (isset($this->request->data{$this->modelClass}['image']) && $this->request->data{$this->modelClass}['image']['name'] != "") {                $allowed_extensions = array('jpg', 'JPG', 'jpeg', 'png', 'gif');                $uploaded_image = $this->request->data{$this->modelClass}['image']['name'];                $imgExtension = pathinfo($uploaded_image, PATHINFO_EXTENSION);                if (!in_array($imgExtension, $allowed_extensions)) {                    $this->data = $this->request->data;                    $is_success = 0;                    $this->Session->setFlash(__('Driver Image extension should be of ' . implode(",", $allowed_extensions) . ' only'), 'error');                }                $uploadimageArray = $this->request->data{$this->modelClass}['image'];                unset($this->request->data{$this->modelClass}['image']);            } else {                unset($this->request->data{$this->modelClass}['image']);            }            if ($is_success == 1) {                if ($this->Blog->save($this->request->data)) {                    $new_id = $this->{$this->modelClass}->id;                    $json_data = json_encode($this->request->data);                    $text_action = "received";                    $this->global_logs("blogs", $new_id, 0, $text_action, $json_data);                    if (isset($uploadimageArray) && $uploadimageArray['name'] != "") {                        $file_name = basename($uploadimageArray['name']);                        $imgExtension = pathinfo($file_name, PATHINFO_EXTENSION);                        $image_name = explode("." . $imgExtension, $file_name);                        $prefix = time() . "~@~";                        $file_name = base64_encode($prefix . $image_name[0]) . "." . $imgExtension;                        if (move_uploaded_file($uploadimageArray['tmp_name'], $upload_image_folder . DS . $file_name)) {                            $this->{$this->modelClass}->updateAll(array('Blog.image' => "'" . $file_name . "'"), array('Blog.id' => $new_id));                            $this->upload_img($file_name, "S");                        }                    }                    $this->Session->setFlash(__('Blog shared successfully'), 'success');                    $this->redirect(array('plugin' => 'blog', 'controller' => 'blogs', 'action' => 'index'));                }            } else {                $this->Session->setFlash(__('Please upload image'), 'error');            }        }        $this->set('title_for_layout', 'Post New Blogs');    }    public function edit() {        $user_id = $this->params->query['id'];        $conditions = array(            "Blog.id" => $user_id,        );        if (!$user_id || $user_id == NULL) {            $this->Session->setFlash('Invalid request to edit Bloh', 'error');            $this->redirect(array('plugin' => 'blog', 'controller' => 'blogs', 'action' => 'index'));        } else {// check that user exists or not            $check_user_exists = $this->Blog->Find('count', array('conditions' => $conditions, 'recursive' => -1));            if ($check_user_exists == 0) {                $this->Session->setFlash('Blog does not exists', 'error');                $this->redirect(array('plugin' => 'blog', 'controller' => 'blogs', 'action' => 'index'));            }        }        $users_data = $this->Blog->find('first', array('conditions' => $conditions));        $this->set('users_data', $users_data);        if ($this->request->is('post') || $this->request->is('put')) {            $this->request->data['Blog']['modified_on'] = date("Y-m-d H:i:s");            $this->request->data['Blog']['slug'] = $this->gen_slug($this->data['Blog']['heading'], "Blog", $user_id);            $is_success = 1;            $upload_image_folder = BLOG_IMAGE_PATH;            $filename = $this->data{$this->modelClass}['image']['name'];            if (isset($this->request->data{$this->modelClass}['image']) && $this->request->data{$this->modelClass}['image']['name'] != "") {                $allowed_extensions = array('jpg', 'JPG', 'jpeg', 'png', 'gif');                $uploaded_image = $this->request->data{$this->modelClass}['image']['name'];                $imgExtension = pathinfo($uploaded_image, PATHINFO_EXTENSION);                if (!in_array($imgExtension, $allowed_extensions)) {                    $this->data = $this->request->data;                    $is_success = 0;                    $this->Session->setFlash(__('Image extension should be of ' . implode(",", $allowed_extensions) . ' only'), 'error');                }                $uploadimageArray = $this->request->data{$this->modelClass}['image'];                unset($this->request->data{$this->modelClass}['image']);            } else {                unset($this->request->data{$this->modelClass}['image']);            }            if ($is_success == 1) {                if ($this->Blog->save($this->request->data)) {                    $json_data = json_encode($this->request->data);                    $text_action = "updated";                    $this->global_logs("blogs", $user_id, 1, $text_action, $json_data);                    if (isset($uploadimageArray) && $uploadimageArray['name'] != "") {                        $file_name = basename($uploadimageArray['name']);                        $imgExtension = pathinfo($file_name, PATHINFO_EXTENSION);                        $image_name = explode("." . $imgExtension, $file_name);                        $prefix = time() . rand(0, 99) . "~@~";                        $file_name = base64_encode($prefix . $image_name[0]) . "." . $imgExtension;                        if (move_uploaded_file($uploadimageArray['tmp_name'], $upload_image_folder . DS . $file_name)) {                            $this->{$this->modelClass}->updateAll(array('Blog.image' => "'" . $file_name . "'"), array('Blog.id' => $user_id));                            $this->upload_img($file_name, "S");                            $image = $users_data['Blog']['image'];                            if ($image) {                                if (file_exists(BLOG_IMAGE_PATH . $image)) {                                    @unlink(BLOG_IMAGE_PATH . $image);                                    @unlink(BLOG_MID_IMAGE_PATH . $image);                                }                            }                        }                    }                    $this->Session->setFlash(__('Blog updated successfully'), 'success');                    $this->redirect(array('plugin' => 'blog', 'controller' => 'blogs', 'action' => 'index'));                } else {                    $this->Session->setFlash('Blog couldn\'t be updated, try again later', 'error');                }            } else {                $this->Session->setFlash('Blog couldn\'t be updated, try again later', 'error');            }        } else {            $this->data = $users_data;        }        $this->set('title_for_layout', 'Update Blog');    }    public function status_ajax() {        if ($this->request->is('Ajax')) {            if ($this->data['id'] != null) {                $all_data = $this->{$this->modelClass}->findById($this->data['id']);                if ($all_data[$this->modelClass]['is_active'] == 1) {                    $new_value = 0;                    $data['is_active'] = 0;                    $status = 3;                    $text_action = " inactivated";                } else {                    $new_value = 1;                    $data['is_active'] = 1;                    $status = 2;                    $text_action = " activated";                }                $this->{$this->modelClass}->id = $this->data['id'];                $this->{$this->modelClass}->save($data, false);                $json_data = json_encode($data);                $this->global_logs("blogs", $this->data['id'], $status, $text_action, $json_data);                echo 1;            }        }        exit;    }    public function aprove_ajax() {        if ($this->request->is('Ajax')) {            if ($this->data['id'] != null) {                $all_data = $this->{$this->modelClass}->findById($this->data['id']);                $new_value = 1;                $data['verified'] = 1;                $status = 4;                $text_action = " approved";                $this->{$this->modelClass}->id = $this->data['id'];                $this->{$this->modelClass}->save($data, false);                $json_data = json_encode($data);                $this->global_logs("blogs", $this->data['id'], $status, $text_action, $json_data);                echo $new_value;            }        }        exit;    }    function blog_details($id) {        $this->loadModel('Log');        $dtls = $this->Log->find('all', array('fields' => array('id', 'action_type', 'table_id', 'text_action', 'created', 'action_taken_by_name'), 'conditions' => array('table_name' => 'blogs', 'table_id' => $id), 'order' => array(                'Log.id' => 'DESC'        )));        $this->set("dtls", $dtls);    }    function upload_img($filename, $type) {        if (file_exists(BLOG_IMAGE_PATH . $filename)) {            copy(BLOG_IMAGE_PATH . $filename, BLOG_LARGE_IMAGE_PATH . '/' . $filename);//            if ($type == "L") {//                copy(BLOG_IMAGE_PATH . $filename, BLOG_LARGE_IMAGE_PATH . '/' . $filename);//            } else {//                copy(BLOG_IMAGE_PATH . $filename, BLOG_MID_IMAGE_PATH . '/' . $filename);//            }            //unlink(BLOG_IMAGE_PATH . $filename);            if ($this->Upload->result) {                return $this->Upload->result;            } else {                return 0;            }        } else {            return 0;        }    }    function upload_images($filename) {        if (file_exists(BLOG_IMAGE_PATH . $filename)) {            list($w, $h, $type, $attr) = getimagesize(BLOG_IMAGE_PATH . $filename);            $scale2 = 530 / $w;            $scale3 = 530 / $w;            $scale4 = 900 / $w;            if ($w > 900) {                $this->resizeImage(BLOG_LARGE_IMAGE_PATH . '/' . $filename, BLOG_IMAGE_PATH . $filename, $w, $h, 0, 0, $scale4);            } else {                copy(BLOG_IMAGE_PATH . $filename, BLOG_LARGE_IMAGE_PATH . '/' . $filename);            }            if ($w > 530) {                $this->resizeImage(BLOG_MID_IMAGE_PATH . '/' . $filename, BLOG_IMAGE_PATH . $filename, $w, $h, 0, 0, $scale3);            } else {                copy(BLOG_IMAGE_PATH . $filename, BLOG_MID_IMAGE_PATH . '/' . $filename);            }            if ($w > 530) {                $this->resizeImage(BLOG_SMALL_IMAGE_PATH . '/' . $filename, BLOG_IMAGE_PATH . $filename, $w, $h, 0, 0, $scale2);            } else {                copy(BLOG_IMAGE_PATH . $filename, BLOG_SMALL_IMAGE_PATH . '/' . $filename);            }//pr($this->Upload);            if ($this->Upload->result) {                return $this->Upload->result;            } else {                return 0;            }        } else {            return 0;        }    }}