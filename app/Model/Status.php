<?php
App::uses('AppModel', 'Model');
/**
 * Status Model
 *
 * @property VComande $VComande
 * @property CashOrder $CashOrder
 * @property VComandesOberte $VComandesOberte
 */
class Status extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CashOrder' => array(
			'className' => 'CashOrder',
			'foreignKey' => 'status_id',
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
