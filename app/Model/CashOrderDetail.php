<?php
App::uses('AppModel', 'Model');
/**
 * CashOrderDetail Model
 *
 * @property CashOrder $CashOrder
 * @property ServicesUnit $ServicesUnit
 * @property Article $Article
 * @property InvoiceDetail $InvoiceDetail
 */
class CashOrderDetail extends AppModel {

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
		'CashOrder' => array(
			'className' => 'CashOrder',
			'foreignKey' => 'cash_order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ServicesUnit' => array(
			'className' => 'ServicesUnit',
			'foreignKey' => 'services_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id',
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
		'InvoiceDetail' => array(
			'className' => 'InvoiceDetail',
			'foreignKey' => 'cash_order_detail_id',
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
