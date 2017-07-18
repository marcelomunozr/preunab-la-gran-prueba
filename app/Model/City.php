<?php
App::uses('AppModel', 'Model');

class City extends AppModel {
    
	public $belongsTo = array(
		'Region' => array(
			'className' => 'Region',
			'foreignKey' => 'region_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}

?>
