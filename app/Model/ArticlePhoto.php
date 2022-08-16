<?php
App::uses('AppModel', 'Model');
/**
 * ArticlePhoto Model
 *
 * @property Article $Article
 * @property Growing $Growing
 * @property Flowering $Flowering
 */
class ArticlePhoto extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id',
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
		)
	);
}
