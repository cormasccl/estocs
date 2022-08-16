<?php
App::uses('AppController', 'Controller');
/**
 * Temperatures Controller
 *
 * @property Temperature $Temperature
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class TemperaturesController extends AppController {

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
		$this->Temperature->recursive = 0;
		$this->set('temperatures', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Temperature->exists($id)) {
			throw new NotFoundException(__('Invalid temperature'));
		}
		$options = array('conditions' => array('Temperature.' . $this->Temperature->primaryKey => $id));
		$this->set('temperature', $this->Temperature->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Temperature->create();
			if ($this->Temperature->save($this->request->data)) {
				$this->Flash->success(__('The temperature has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The temperature could not be saved. Please, try again.'));
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
		if (!$this->Temperature->exists($id)) {
			throw new NotFoundException(__('Invalid temperature'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Temperature->save($this->request->data)) {
				$this->Flash->success(__('The temperature has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The temperature could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Temperature.' . $this->Temperature->primaryKey => $id));
			$this->request->data = $this->Temperature->find('first', $options);
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
		$this->Temperature->id = $id;
		if (!$this->Temperature->exists()) {
			throw new NotFoundException(__('Invalid temperature'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Temperature->delete()) {
			$this->Flash->success(__('The temperature has been deleted.'));
		} else {
			$this->Flash->error(__('The temperature could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
