<?php
App::uses('AppController', 'Controller');
/**
 * Families Controller
 *
 * @property Family $Family
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class FamiliesController extends AppController {

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
		$this->Family->recursive = 0;
		$this->set('families', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Family->exists($id)) {
			throw new NotFoundException(__('Invalid family'));
		}
		$options = array('conditions' => array('Family.' . $this->Family->primaryKey => $id));
		$this->set('family', $this->Family->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Family->create();
			if ($this->Family->save($this->request->data)) {
				$this->Flash->success(__('The family has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The family could not be saved. Please, try again.'));
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
		if (!$this->Family->exists($id)) {
			throw new NotFoundException(__('Invalid family'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Family->save($this->request->data)) {
				$this->Flash->success(__('The family has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The family could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Family.' . $this->Family->primaryKey => $id));
			$this->request->data = $this->Family->find('first', $options);
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
		$this->Family->id = $id;
		if (!$this->Family->exists()) {
			throw new NotFoundException(__('Invalid family'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Family->delete()) {
			$this->Flash->success(__('The family has been deleted.'));
		} else {
			$this->Flash->error(__('The family could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
