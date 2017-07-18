<?php
App::uses('AppModel', 'Model');
class Award extends AppModel {
    public $hasMany = array(
        'AwardUser' => array(
            'className' => 'AwardUser',
            'foreignKey' => 'award_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}

?>
