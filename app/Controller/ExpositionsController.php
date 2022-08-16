<?php
App::uses('AppController', 'Controller');
/**
 * Expositions Controller
 *
 * @property Exposition $Exposition
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ExpositionsController extends AppController {

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
		$this->Exposition->recursive = 0;
		$this->set('expositions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Exposition->exists($id)) {
			throw new NotFoundException(__('Invalid exposition'));
		}
		$options = array('conditions' => array('Exposition.' . $this->Exposition->primaryKey => $id));
		$this->set('exposition', $this->Exposition->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Exposition->create();
			if ($this->Exposition->save($this->request->data)) {
				$this->Flash->success(__('The exposition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The exposition could not be saved. Please, try again.'));
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
		if (!$this->Exposition->exists($id)) {
			throw new NotFoundException(__('Invalid exposition'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Exposition->save($this->request->data)) {
				$this->Flash->success(__('The exposition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The exposition could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Exposition.' . $this->Exposition->primaryKey => $id));
			$this->request->data = $this->Exposition->find('first', $options);
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
		$this->Exposition->id = $id;
		if (!$this->Exposition->exists()) {
			throw new NotFoundException(__('Invalid exposition'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Exposition->delete()) {
			$this->Flash->success(__('The exposition has been deleted.'));
		} else {
			$this->Flash->error(__('The exposition could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
