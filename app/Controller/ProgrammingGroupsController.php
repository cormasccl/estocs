<?php
App::uses('AppController', 'Controller');
/**
 * ProgrammingGroups Controller
 *
 * @property ProgrammingGroup $ProgrammingGroup
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ProgrammingGroupsController extends AppController {

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
		$this->ProgrammingGroup->recursive = 0;
		$this->set('programmingGroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProgrammingGroup->exists($id)) {
			throw new NotFoundException(__('Invalid programming group'));
		}
		$options = array('conditions' => array('ProgrammingGroup.' . $this->ProgrammingGroup->primaryKey => $id));
		$this->set('programmingGroup', $this->ProgrammingGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProgrammingGroup->create();
			if ($this->ProgrammingGroup->save($this->request->data)) {
				$this->Flash->success(__('The programming group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The programming group could not be saved. Please, try again.'));
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
		if (!$this->ProgrammingGroup->exists($id)) {
			throw new NotFoundException(__('Invalid programming group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProgrammingGroup->save($this->request->data)) {
				$this->Flash->success(__('The programming group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The programming group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProgrammingGroup.' . $this->ProgrammingGroup->primaryKey => $id));
			$this->request->data = $this->ProgrammingGroup->find('first', $options);
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
		$this->ProgrammingGroup->id = $id;
		if (!$this->ProgrammingGroup->exists()) {
			throw new NotFoundException(__('Invalid programming group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ProgrammingGroup->delete()) {
			$this->Flash->success(__('The programming group has been deleted.'));
		} else {
			$this->Flash->error(__('The programming group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
