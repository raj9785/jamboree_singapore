<?phpclass Course extends CourseAppModel {    var $name = 'Course';    var $actsAs = array('Search.Searchable');    public $validate = array();    function addData() {        $validate = array(            'name' => array(                'notEmpty' => array(                    'rule' => array('notEmpty'),                    'message' => 'Course name can\'t be empty',                    'allowEmpty' => false                ),                'isUnique' => array(                    'rule' => array('isUnique'),                    'message' => 'Course already added, please use different one',                    'on' => 'create'                )            ),        );        $this->validate = $validate;        return $this->validates();    }}?>