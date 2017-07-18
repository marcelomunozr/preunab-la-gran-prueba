<?php
App::uses('AppModel', 'Model');


class Region extends AppModel {
   
   
   public $hasMany = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'region_id',
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
