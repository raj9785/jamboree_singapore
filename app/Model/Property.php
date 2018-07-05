<?php

class Property extends AppModel {

    var $name = 'Property';
    public $actsAs = array('Containable', 'Search.Searchable');
    public $hasMany = array(
        'PropertyArea',
        'PropertyParking',
        'PropertyCharge',
        'PropertyAmenity',
        'PropertyFurnishing',
        'PropertyWaterSource',
        'PropertyOverlooking',
        'PropertyImage',
        'PropertyParking'
    );
    public $belongsTo = array(
        'City'=>array('fields'=>array("id","name","latitude","longitude","city_slug")),
        'Locality'=>array('fields'=>array("id","name","latitude","longitude","slug")),
        'Facing'=>array('fields'=>array("id","name")),
        'Flooring'=>array('fields'=>array("id","name")),
        'PowerBackup'=>array('fields'=>array("id","name")),
        'AgeProperty'=>array('fields'=>array("id","name")),
        'Ownership'=>array('fields'=>array("id","name")),
        'BhkType'=>array('fields'=>array("id","name","bhk_numbers")),
        
    );

}

?>

