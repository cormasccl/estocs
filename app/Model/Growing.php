<?php
App::uses('AppModel', 'Model');
/**
 * Growing Model
 *
 * @property ArticlePhoto $ArticlePhoto
 * @property ListsArticle $ListsArticle
 */
class Growing extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ArticlePhoto' => array(
			'className' => 'ArticlePhoto',
			'foreignKey' => 'growing_id',
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
		'Detail' => array(
			'className' => 'Detail',
			'foreignKey' => 'growing_id',
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
