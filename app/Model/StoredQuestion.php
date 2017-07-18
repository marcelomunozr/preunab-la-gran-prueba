<?php
App::uses('AppModel', 'Model');


class StoredQuestion extends AppModel {
   
	public $useTable = 'stored_questions';
	
	public $belongsTo = array(
		'Players' => array(
			'className' => 'Players',
			'foreignKey' => 'player_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Questions' => array(
			'className' => 'Questions',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}