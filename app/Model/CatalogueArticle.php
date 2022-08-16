<?php
App::uses('AppModel', 'Model');
/**
 * CatalogueArticle Model
 *
 * @property Catalogue $Catalogue
 * @property Growing $Growing
 * @property Flowering $Flowering
 * @property Collection $Collection
 * @property Article $Article
 * @property CatalogueClassification $CatalogueClassification
 */
class CatalogueArticle extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'catalogue_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'article_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'catalogue_classification_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Catalogue' => array(
			'className' => 'Catalogue',
			'foreignKey' => 'catalogue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Growing' => array(
			'className' => 'Growing',
			'foreignKey' => 'growing_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Flowering' => array(
			'className' => 'Flowering',
			'foreignKey' => 'flowering_id',
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
		'CatalogueClassification' => array(
			'className' => 'CatalogueClassification',
			'foreignKey' => 'catalogue_classification_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}