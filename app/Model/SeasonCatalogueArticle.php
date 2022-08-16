<?php
App::uses('AppModel', 'Model');
/**
 * SeasonCatalogueArticle Model
 *
 * @property SeasonCatalogue $SeasonCatalogue
 * @property Article $Article
 * @property SeasonCatalogueClassification $SeasonCatalogueClassification
 */
class SeasonCatalogueArticle extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SeasonCatalogue' => array(
			'className' => 'SeasonCatalogue',
			'foreignKey' => 'season_catalogue_id',
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
		'SeasonCatalogueClassification' => array(
			'className' => 'SeasonCatalogueClassification',
			'foreignKey' => 'season_catalogue_classification_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
