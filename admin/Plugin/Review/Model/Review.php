<?phpclass Review extends ReviewAppModel {    var $name = 'Review';    var $actsAs = array('Search.Searchable');    public $belongsTo = array(        'Course' => array("fields" => array("name", "id"))    );}?>