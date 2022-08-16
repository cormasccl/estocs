<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Exposition $Exposition
 * @property PlantType $PlantType
 * @property Irrigation $Irrigation
 * @property ProgrammingGroup $ProgrammingGroup
 * @property Temperature $Temperature
 * @property Article $Article
 * @property ProductImage $ProductImage
 * @property Programming $Programming
 * @property FlowerColour $FlowerColour
 * @property SheetColour $SheetColour
 * @property Utilization $Utilization
 */
class Product extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'common_name';
	public $actsAs = array(
        'Translate'  => array(
            'common_name'
        )
    );
/**
 * Validation rules
 *
 * @var array
 */

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Exposition' => array(
			'className' => 'Exposition',
			'foreignKey' => 'exposition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PlantType' => array(
			'className' => 'PlantType',
			'foreignKey' => 'plant_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Irrigation' => array(
			'className' => 'Irrigation',
			'foreignKey' => 'irrigation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProgrammingGroup' => array(
			'className' => 'ProgrammingGroup',
			'foreignKey' => 'programming_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Temperature' => array(
			'className' => 'Temperature',
			'foreignKey' => 'temperature_id',
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
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ProductImage' => array(
			'className' => 'ProductImage',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Programming' => array(
			'className' => 'Programming',
			'foreignKey' => 'product_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'FlowerColour' => array(
			'className' => 'FlowerColour',
			'joinTable' => 'products_flower_colours',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'flower_colour_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'SheetColour' => array(
			'className' => 'SheetColour',
			'joinTable' => 'products_sheet_colours',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'sheet_colour_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Utilization' => array(
			'className' => 'Utilization',
			'joinTable' => 'products_utilizations',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'utilization_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Characteristic' => array(
			'className' => 'Characteristic',
			'joinTable' => 'products_characteristics',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'characteristic_id',
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
