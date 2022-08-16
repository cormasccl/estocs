<?php
App::uses('AppController', 'Controller');
/**
 * Petitions Controller
 *
 * @property Petition $Petition
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PetitionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allowedActions = array('add');

	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Petition->recursive = 0;
		$this->set('petitions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Petition->exists($id)) {
			throw new NotFoundException(__('Invalid petition'));
		}
		$options = array('conditions' => array('Petition.' . $this->Petition->primaryKey => $id));
		$this->set('petition', $this->Petition->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout='default';
		$this->set('title_for_layout', __('Nueva solicitud de usuario web'));
		if ($this->request->is('post')) {
			$this->Petition->create();
			if ($this->Petition->save($this->request->data)) {
				$msg = __('Su solicitud se ha registrado correctamente. Su comercial revisará los datos introducidos, en caso de ser correctos recibirá un correo electrónico con un usuario de acceso.');
				$this->Session->setFlash($msg, 'default', array(), 'good');
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Ha ocurrido un error al registrar su petición.'), 'default', array(), 'bad');
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Petition->exists($id)) {
			throw new NotFoundException(__('Invalid petition'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Petition->save($this->request->data)) {
				$this->Session->setFlash(__('The petition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The petition could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Petition.' . $this->Petition->primaryKey => $id));
			$this->request->data = $this->Petition->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Petition->id = $id;
		if (!$this->Petition->exists()) {
			throw new NotFoundException(__('Invalid petition'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Petition->delete()) {
			$this->Session->setFlash(__('The petition has been deleted.'));
		} else {
			$this->Session->setFlash(__('The petition could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Petition->recursive = 0;
		$this->set('petitions', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Petition->exists($id)) {
			throw new NotFoundException(__('Invalid petition'));
		}
		$options = array('conditions' => array('Petition.' . $this->Petition->primaryKey => $id));
		$this->set('petition', $this->Petition->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Petition->create();
			if ($this->Petition->save($this->request->data)) {
				$this->Session->setFlash(__('The petition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The petition could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Petition->exists($id)) {
			throw new NotFoundException(__('Invalid petition'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Petition->save($this->request->data)) {
				$this->Session->setFlash(__('The petition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The petition could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Petition.' . $this->Petition->primaryKey => $id));
			$this->request->data = $this->Petition->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Petition->id = $id;
		if (!$this->Petition->exists()) {
			throw new NotFoundException(__('Invalid petition'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Petition->delete()) {
			$this->Session->setFlash(__('The petition has been deleted.'));
		} else {
			$this->Session->setFlash(__('The petition could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
