<?php
App::uses('AppModel', 'Model');
/**
 * InvoiceDetail Model
 *
 * @property Invoice $Invoice
 * @property Article $Article
 * @property CashOrderDetail $CashOrderDetail
 */
class InvoiceDetail extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'vat_rate';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'invoice_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'invoice_line' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'article_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'invoice_id',
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
		),
		'CashOrderDetail' => array(
			'className' => 'CashOrderDetail',
			'foreignKey' => 'cash_order_detail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
