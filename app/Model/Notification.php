<?php
App::uses('AppModel', 'Model');

class Notification extends AppModel {
		
	public $belongsTo = array(
		'Players' => array(
			'className' => 'Players',
			'foreignKey' => 'player_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

?>
