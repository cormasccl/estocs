<?php
App::uses('AppModel', 'Model');
/**
 * SeasonCatalogueClassification Model
 *
 * @property SeasonCatalogueClassification $SeasonCatalogueClassification
 * @property SeasonCatalogue $SeasonCatalogue
 * @property SeasonCatalogueArticle $SeasonCatalogueArticle
 * @property SeasonCatalogueClassification $SeasonCatalogueClassification
 */
class SeasonCatalogueClassification extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SeasonCatalogueClassification' => array(
			'className' => 'SeasonCatalogueClassification',
			'foreignKey' => 'season_catalogue_classification_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SeasonCatalogue' => array(
			'className' => 'SeasonCatalogue',
			'foreignKey' => 'season_catalogue_id',
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
		'SeasonCatalogueArticle' => array(
			'className' => 'SeasonCatalogueArticle',
			'foreignKey' => 'season_catalogue_classification_id',
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
			'foreignKey' => 'season_catalogue_classification_id',
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
