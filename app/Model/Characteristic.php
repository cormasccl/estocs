<?php
App::uses('AppModel', 'Model');
/**
 * Characteristic Model
 *
 */
class Characteristic extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';
	public $actsAs = array(
        'Translate'  => array(
            'description'
        )
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'products_characteristics',
			'foreignKey' => 'characteristic_id',
			'associationForeignKey' => 'product_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
