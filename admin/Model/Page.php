<?php

App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class Page extends AppModel {

    public $name = 'Page';
    public $hasMany= array(
        'Menu' => array("fields" => array("name", "id"))
    );

}
