<?php
App::uses('AppModel', 'Model');
/**
 * Catalogue Model
 *
 * @property ListsClassification $ListsClassification
 * @property User $User
 */
class Catalogue extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'listname';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CatalogueClassification' => array(
			'className' => 'CatalogueClassification',
			'foreignKey' => 'catalogue_id',
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
		'CatalogueArticles' => array(
			'className' => 'CatalogueArticle',
			'foreignKey' => 'catalogue_id',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'catalogue_id',
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
