<?php
App::uses('AppController', 'Controller');
/**
 * Flowerings Controller
 *
 * @property Flowering $Flowering
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class FloweringsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Flowering->recursive = 0;
		$this->set('flowerings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Flowering->exists($id)) {
			throw new NotFoundException(__('Invalid flowering'));
		}
		$options = array('conditions' => array('Flowering.' . $this->Flowering->primaryKey => $id));
		$this->set('flowering', $this->Flowering->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Flowering->create();
			if ($this->Flowering->save($this->request->data)) {
				$this->Flash->success(__('The flowering has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The flowering could not be saved. Please, try again.'));
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
		if (!$this->Flowering->exists($id)) {
			throw new NotFoundException(__('Invalid flowering'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Flowering->save($this->request->data)) {
				$this->Flash->success(__('The flowering has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The flowering could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Flowering.' . $this->Flowering->primaryKey => $id));
			$this->request->data = $this->Flowering->find('first', $options);
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
		$this->Flowering->id = $id;
		if (!$this->Flowering->exists()) {
			throw new NotFoundException(__('Invalid flowering'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Flowering->delete()) {
			$this->Flash->success(__('The flowering has been deleted.'));
		} else {
			$this->Flash->error(__('The flowering could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
