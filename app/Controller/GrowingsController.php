<?php
App::uses('AppController', 'Controller');
/**
 * Growings Controller
 *
 * @property Growing $Growing
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class GrowingsController extends AppController {

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
		$this->Growing->recursive = 0;
		$this->set('growings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Growing->exists($id)) {
			throw new NotFoundException(__('Invalid growing'));
		}
		$options = array('conditions' => array('Growing.' . $this->Growing->primaryKey => $id));
		$this->set('growing', $this->Growing->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Growing->create();
			if ($this->Growing->save($this->request->data)) {
				$this->Flash->success(__('The growing has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The growing could not be saved. Please, try again.'));
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
		if (!$this->Growing->exists($id)) {
			throw new NotFoundException(__('Invalid growing'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Growing->save($this->request->data)) {
				$this->Flash->success(__('The growing has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The growing could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Growing.' . $this->Growing->primaryKey => $id));
			$this->request->data = $this->Growing->find('first', $options);
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
		$this->Growing->id = $id;
		if (!$this->Growing->exists()) {
			throw new NotFoundException(__('Invalid growing'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Growing->delete()) {
			$this->Flash->success(__('The growing has been deleted.'));
		} else {
			$this->Flash->error(__('The growing could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
