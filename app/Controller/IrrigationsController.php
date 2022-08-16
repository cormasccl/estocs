<?php
App::uses('AppController', 'Controller');
/**
 * Irrigations Controller
 *
 * @property Irrigation $Irrigation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class IrrigationsController extends AppController {

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
		$this->Irrigation->recursive = 0;
		$this->set('irrigations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Irrigation->exists($id)) {
			throw new NotFoundException(__('Invalid irrigation'));
		}
		$options = array('conditions' => array('Irrigation.' . $this->Irrigation->primaryKey => $id));
		$this->set('irrigation', $this->Irrigation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Irrigation->create();
			if ($this->Irrigation->save($this->request->data)) {
				$this->Flash->success(__('The irrigation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The irrigation could not be saved. Please, try again.'));
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
		if (!$this->Irrigation->exists($id)) {
			throw new NotFoundException(__('Invalid irrigation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Irrigation->save($this->request->data)) {
				$this->Flash->success(__('The irrigation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The irrigation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Irrigation.' . $this->Irrigation->primaryKey => $id));
			$this->request->data = $this->Irrigation->find('first', $options);
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
		$this->Irrigation->id = $id;
		if (!$this->Irrigation->exists()) {
			throw new NotFoundException(__('Invalid irrigation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Irrigation->delete()) {
			$this->Flash->success(__('The irrigation has been deleted.'));
		} else {
			$this->Flash->error(__('The irrigation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
