<?php
App::uses('AppModel', 'Model');
class AwardUser extends AppModel {
        
    public $useTable = 'awards_users';
    public $belongsTo = array(
        'Players' => array(
            'className' => 'Players',
            'foreignKey' => 'player_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Award' => array(
            'className' => 'Award',
            'foreignKey' => 'award_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}

?>
