<?php
App::uses('AppModel', 'Model');
/**
 * CashOrder Model
 *
 * @property User $User
 * @property Status $Status
 * @property CashOrderDetail $CashOrderDetail
 */
class CashOrder extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'observations';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CashOrderDetail' => array(
			'className' => 'CashOrderDetail',
			'foreignKey' => 'cash_order_id',
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
