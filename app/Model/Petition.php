<?php
App::uses('AppModel', 'Model');
/**
 * Petition Model
 *
 */
class Petition extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'allowEmpty' => false,
				'required' => true
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'company_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'nif' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'customer' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'bill' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'amount_bill' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		
	);

	public function beforeSave($options = array()) {

		if (empty($this->data['Petition']['id'])) {
			$this->data['Petition']['initial_password'] = substr(MD5(rand(5, 100)), 0, 8);
		}

        return true;
    }

}
