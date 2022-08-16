<?php
App::uses('AppController', 'Controller');
/**
 * PlantTypes Controller
 *
 * @property PlantType $PlantType
 * @property PaginatorComponent $Paginator
 */
class PlantTypesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PlantType->recursive = 0;
		$this->layout='ajax';
		$this->PlantType->locale = $this->Session->read('Config.language');
		$this->set('plantTypes', $this->PlantType->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PlantType->exists($id)) {
			throw new NotFoundException(__('Invalid plant type'));
		}
		$options = array('conditions' => array('PlantType.' . $this->PlantType->primaryKey => $id));
		$this->set('plantType', $this->PlantType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PlantType->create();
			if ($this->PlantType->save($this->request->data)) {
				$this->Session->setFlash(__('The plant type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plant type could not be saved. Please, try again.'));
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
		if (!$this->PlantType->exists($id)) {
			throw new NotFoundException(__('Invalid plant type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PlantType->save($this->request->data)) {
				$this->Session->setFlash(__('The plant type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plant type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PlantType.' . $this->PlantType->primaryKey => $id));
			$this->request->data = $this->PlantType->find('first', $options);
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
		$this->PlantType->id = $id;
		if (!$this->PlantType->exists()) {
			throw new NotFoundException(__('Invalid plant type'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PlantType->delete()) {
			$this->Session->setFlash(__('The plant type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The plant type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->PlantType->recursive = 0;
		$this->set('plantTypes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->PlantType->exists($id)) {
			throw new NotFoundException(__('Invalid plant type'));
		}
		$options = array('conditions' => array('PlantType.' . $this->PlantType->primaryKey => $id));
		$this->set('plantType', $this->PlantType->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PlantType->create();
			if ($this->PlantType->save($this->request->data)) {
				$this->Session->setFlash(__('The plant type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plant type could not be saved. Please, try again.'));
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
		if (!$this->PlantType->exists($id)) {
			throw new NotFoundException(__('Invalid plant type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PlantType->save($this->request->data)) {
				$this->Session->setFlash(__('The plant type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plant type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PlantType.' . $this->PlantType->primaryKey => $id));
			$this->request->data = $this->PlantType->find('first', $options);
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
		$this->PlantType->id = $id;
		if (!$this->PlantType->exists()) {
			throw new NotFoundException(__('Invalid plant type'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PlantType->delete()) {
			$this->Session->setFlash(__('The plant type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The plant type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
