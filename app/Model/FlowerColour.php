<?php
App::uses('AppModel', 'Model');
/**
 * FlowerColour Model
 *
 * @property Product $Product
 */
class FlowerColour extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'products_flower_colours',
			'foreignKey' => 'flower_colour_id',
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
