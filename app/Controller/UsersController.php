<?php

class UsersController extends AppController {

    public $name = 'Users';

    public function beforeFilter() {

        parent::beforeFilter();
        $this->set('model', $this->modelClass);
//$this->Cookie->httpOnly = true;
        $this->Auth->allow('index');
    }

    //buy =1,rent==2//

    public function index() {
        
    }

}
