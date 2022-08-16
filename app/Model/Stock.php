<?php
App::uses('AppModel', 'Model');
/**
 * Stock Model
 *
 * @property Article $Article
 * @property Partner $Partner
 * @property Detail $Detail
 */
class Stock extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

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
		'Partner' => array(
			'className' => 'Partner',
			'foreignKey' => 'partner_id',
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
		'Detail' => array(
			'className' => 'Detail',
			'foreignKey' => 'stock_id',
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


	

	/*public function paginate($conditions, $fields, $order, $limit, $page=1, $recursive=null, $extra=array())
	{

		
		$row_start = ($page-1) * $limit;
	    $query = $conditions['sql'];
	    
	    if (isset($extra['sort'])) {
	    	$field = $extra['sort'];
			$direction = $extra['direction'];
	    	$query = $query." ORDER BY $field $direction ";//" LIMIT $row_start, $limit ";
	    } else {
	    	$order_by = $conditions['order'];
			$query = $query." ORDER BY $order_by ";

	    	//$query = $query." LIMIT $row_start, $limit ";	    	
	    }

	    return $this->query($query);
	}
	 public function paginateCount($conditions=0, $recursive=0, $extra=array())
	  {

	  	$query_count = $conditions['count'];	  	

	    $r = $this->query($query_count);
	    return $r[0][0]['count'];
	  }*/

}
