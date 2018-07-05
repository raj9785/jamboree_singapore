<?phpclass SocialsController extends SocialAppController {    /**     * Controller name     *     * @var string     */    var $name = 'Socials';    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');    public $components = array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');    public $presetVars = array(array('field' => 'email', 'type' => 'value'), array('field' => 'firstname', 'type' => 'value'), array('field' => 'username', 'type' => 'value'), array('field' => 'mobile', 'type' => 'value'), array('field' => 'user_role_id', 'type' => 'value'), array('field' => 'status', 'type' => 'value'));    //public $presetVars = 	true;    public function beforeFilter() {        parent::beforeFilter();        $this->set('model', $this->modelClass);        $this->set('tab_open', 'cms');    }    public function index() {        $conditions = array();        $conditions = array();        $limitValue = $limit = 25;        $page = ((isset($this->params->named['page']) && $this->params->named['page'] != "") ? $this->params->named['page'] : 0);        $this->set('limitValue', $limitValue);        $this->set('limit', $limit);        $this->set('page', $page);        $this->paginate = array(            'conditions' => $conditions,            'limit' => 25,            'order' => array(                'Social.created_on' => 'DESC'            )        );        $this->set('records', $this->paginate('Social'));        $this->set('title_for_layout', 'Socials');    }    public function add() {        if ($this->request->is('post')) {            $this->request->data['Social']['created_on'] = date("Y-m-d H:i:s");            $this->request->data['Social']['is_active'] = 1;            $is_success = 1;            $upload_image_folder = SOCIALS_IMAGE_PATH;            $filename = $this->data{$this->modelClass}['image']['name'];            if (isset($this->request->data{$this->modelClass}['image']) && $this->request->data{$this->modelClass}['image']['name'] != "") {                $allowed_extensions = array('jpg', 'JPG', 'jpeg', 'png', 'gif');                $uploaded_image = $this->request->data{$this->modelClass}['image']['name'];                $imgExtension = pathinfo($uploaded_image, PATHINFO_EXTENSION);                $uploadimageArray = $this->request->data{$this->modelClass}['image'];                if (!in_array($imgExtension, $allowed_extensions)) {                    $this->data = $this->request->data;                    $is_success = 0;                    $this->Session->setFlash(__('Image extension should be of ' . implode(",", $allowed_extensions) . ' only'), 'error');                } else {                    if (isset($uploadimageArray) && $uploadimageArray['name'] != "") {                        $file_name = basename($uploadimageArray['name']);                        $imgExtension = pathinfo($file_name, PATHINFO_EXTENSION);                        $image_name = explode("." . $imgExtension, $file_name);                        $prefix = time() . "~@~";                        $file_name = base64_encode($prefix . $image_name[0]) . "." . $imgExtension;                        if (move_uploaded_file($uploadimageArray['tmp_name'], $upload_image_folder . DS . $file_name)) {                            $this->request->data['Social']['image'] = $file_name;                        }                    }                }                unset($this->request->data{$this->modelClass}['image']);            } else {                unset($this->request->data{$this->modelClass}['image']);            }            if ($is_success == 1) {                $this->request->data['Social']['image'] = $file_name;                if ($this->Social->save($this->request->data)) {                    $new_id = $this->{$this->modelClass}->id;                    $json_data = json_encode($this->request->data);                    $text_action = "received";                    $this->global_logs("socials", $new_id, 0, $text_action, $json_data);                    $this->Session->setFlash(__('Social added successfully'), 'success');                    $this->redirect(array('plugin' => 'social', 'controller' => 'socials', 'action' => 'index'));                }            } else {                $this->Session->setFlash(__('Image not uploaded'), 'error');                $this->redirect(array('plugin' => 'social', 'controller' => 'socials', 'action' => 'add'));            }        }        $this->set('title_for_layout', 'Add New Social');    }    public function edit() {        $user_id = $this->params->query['id'];        $conditions = array(            "Social.id" => $user_id,        );        if (!$user_id || $user_id == NULL) {            $this->Session->setFlash('Invalid request to edit social', 'error');            $this->redirect(array('plugin' => 'social', 'controller' => 'socials', 'action' => 'index'));        } else {// check that user exists or not            $check_user_exists = $this->Social->Find('count', array('conditions' => $conditions, 'recursive' => -1));            if ($check_user_exists == 0) {                $this->Session->setFlash('Social does not exists', 'error');                $this->redirect(array('plugin' => 'social', 'controller' => 'socials', 'action' => 'index'));            }        }        $users_data = $this->Social->find('first', array('conditions' => $conditions));        $this->set('users_data', $users_data);        if ($this->request->is('post') || $this->request->is('put')) {            $upload_image_folder = SOCIALS_IMAGE_PATH;            $filename = $this->data{$this->modelClass}['url_image']['name'];            if (isset($this->request->data{$this->modelClass}['url_image']) && $this->request->data{$this->modelClass}['url_image']['name'] != "") {                $this->request->data['Social']['image'] = $users_data['Social']['image'];                $allowed_extensions = array('jpg', 'JPG', 'jpeg', 'png', 'gif');                $uploaded_image = $this->request->data{$this->modelClass}['url_image']['name'];                $imgExtension = pathinfo($uploaded_image, PATHINFO_EXTENSION);                $uploadimageArray = $this->request->data{$this->modelClass}['url_image'];                if (!in_array($imgExtension, $allowed_extensions)) {                    $this->data = $this->request->data;                    $is_success = 0;                    $this->Session->setFlash(__('Image extension should be of ' . implode(",", $allowed_extensions) . ' only'), 'error');                } else {                    if (isset($uploadimageArray) && $uploadimageArray['name'] != "") {                        $file_name = basename($uploadimageArray['name']);                        $imgExtension = pathinfo($file_name, PATHINFO_EXTENSION);                        $image_name = explode("." . $imgExtension, $file_name);                        $prefix = time() . "~@~";                        $file_name = base64_encode($prefix . $image_name[0]) . "." . $imgExtension;                        if (move_uploaded_file($uploadimageArray['tmp_name'], $upload_image_folder . DS . $file_name)) {                            $this->request->data['Social']['image'] = $file_name;                            $image = $users_data['Social']['image'];                            if ($image) {                                if (file_exists(SOCIALS_IMAGE_PATH . $image)) {                                    @unlink(SOCIALS_IMAGE_PATH . $image);                                }                            }                        }                    }                }                unset($this->request->data{$this->modelClass}['url_image']);            } else {                $this->request->data['Social']['image'] = $users_data['Social']['image'];                unset($this->request->data{$this->modelClass}['url_image']);            }            if ($this->Social->save($this->request->data)) {                $json_data = json_encode($this->request->data);                $text_action = "updated";                $this->global_logs("socials", $user_id, 1, $text_action, $json_data);                $this->Session->setFlash(__('Social updated successfully'), 'success');                $this->redirect(array('plugin' => 'social', 'controller' => 'socials', 'action' => 'index'));            } else {                $this->Session->setFlash('Social couldn\'t be updated, try again later', 'error');            }        } else {            $this->data = $users_data;        }        $this->set('title_for_layout', 'Update Social');    }    public function status_ajax() {        if ($this->request->is('Ajax')) {            if ($this->data['id'] != null) {                $all_data = $this->{$this->modelClass}->findById($this->data['id']);                if ($all_data[$this->modelClass]['is_active'] == 1) {                    $new_value = 0;                    $data['is_active'] = 0;                    $status = 3;                    $text_action = " inactivated";                } else {                    $new_value = 1;                    $data['is_active'] = 1;                    $status = 2;                    $text_action = " activated";                }                $this->{$this->modelClass}->id = $this->data['id'];                $this->{$this->modelClass}->save($data, false);                $json_data = json_encode($data);                $this->global_logs("socials", $this->data['id'], $status, $text_action, $json_data);                echo 1;            }        }        exit;    }    public function aprove_ajax() {        if ($this->request->is('Ajax')) {            if ($this->data['id'] != null) {                $all_data = $this->{$this->modelClass}->findById($this->data['id']);                $new_value = 1;                $data['verified'] = 1;                $status = 4;                $text_action = " approved";                $this->{$this->modelClass}->id = $this->data['id'];                $this->{$this->modelClass}->save($data, false);                $json_data = json_encode($data);                $this->global_logs("socials", $this->data['id'], $status, $text_action, $json_data);                echo $new_value;            }        }        exit;    }}