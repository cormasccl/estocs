<?php
App::uses('AppModel', 'Model');
/**
 * PlantType Model
 *
 * @property Product $Product
 */
class PlantType extends AppModel {

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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'plant_type_id',
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
