<?php

class User extends AppModel {

    var $name = 'User';
    public $actsAs = array('Containable', 'Search.Searchable');
    // var $actsAs 		= 	array('Tree');

    

}

?>