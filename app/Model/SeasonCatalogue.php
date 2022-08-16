<?php
App::uses('AppModel', 'Model');
/**
 * SeasonCatalogue Model
 *
 * @property Catalogue $Catalogue
 * @property SeasonCatalogueArticle $SeasonCatalogueArticle
 * @property SeasonCatalogueClassification $SeasonCatalogueClassification
 */
class SeasonCatalogue extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'season_catalogue_id',
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
		'SeasonCatalogueArticle' => array(
			'className' => 'SeasonCatalogueArticle',
			'foreignKey' => 'season_catalogue_id',
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
		'SeasonCatalogueClassification' => array(
			'className' => 'SeasonCatalogueClassification',
			'foreignKey' => 'season_catalogue_id',
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
