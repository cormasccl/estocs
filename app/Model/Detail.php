<?php
App::uses('AppModel', 'Model');
/**
 * Detail Model
 *
 * @property Stock $Stock
 * @property Growing $Growing
 * @property Flowering $Flowering
 * @property Gallery $Gallery
 */
class Detail extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'stock_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Growing' => array(
			'className' => 'Growing',
			'foreignKey' => 'growing_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Flowering' => array(
			'className' => 'Flowering',
			'foreignKey' => 'flowering_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


	public $hasMany = array(
		'Gallery' => array(
			'className' => 'Gallery',
			'foreignKey' => 'detail_id',
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
