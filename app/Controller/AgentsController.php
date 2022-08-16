<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AgentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


	public function index($option = null) {
		$this->layout = 'agent';
		$this->set('user', $this->Auth->user());
		$this->set('title_for_layout','');
		$this->set('option', 'index');
	}


}