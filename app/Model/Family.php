<?php
App::uses('AppModel', 'Model');
/**
 * Family Model
 *
 * @property Product $Product
 */
class Family extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'code';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'family_id',
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
