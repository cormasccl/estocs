<?php
App::uses('AppController', 'Controller');
/**
 * ArticleCollections Controller
 *
 * @property ArticleCollection $ArticleCollection
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ArticleCollectionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ArticleCollection->recursive = 0;
		$this->set('articleCollections', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ArticleCollection->exists($id)) {
			throw new NotFoundException(__('Invalid article collection'));
		}
		$options = array('conditions' => array('ArticleCollection.' . $this->ArticleCollection->primaryKey => $id));
		$this->set('articleCollection', $this->ArticleCollection->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ArticleCollection->create();
			if ($this->ArticleCollection->save($this->request->data)) {
				$this->Session->setFlash(__('The article collection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article collection could not be saved. Please, try again.'));
			}
		}
		$collections = $this->ArticleCollection->Collection->find('list');
		$articles = $this->ArticleCollection->Article->find('list');
		$this->set(compact('collections', 'articles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ArticleCollection->exists($id)) {
			throw new NotFoundException(__('Invalid article collection'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ArticleCollection->save($this->request->data)) {
				$this->Session->setFlash(__('The article collection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article collection could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ArticleCollection.' . $this->ArticleCollection->primaryKey => $id));
			$this->request->data = $this->ArticleCollection->find('first', $options);
		}
		$collections = $this->ArticleCollection->Collection->find('list');
		$articles = $this->ArticleCollection->Article->find('list');
		$this->set(compact('collections', 'articles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ArticleCollection->id = $id;
		if (!$this->ArticleCollection->exists()) {
			throw new NotFoundException(__('Invalid article collection'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ArticleCollection->delete()) {
			$this->Session->setFlash(__('The article collection has been deleted.'));
		} else {
			$this->Session->setFlash(__('The article collection could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ArticleCollection->recursive = 0;
		$this->set('articleCollections', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ArticleCollection->exists($id)) {
			throw new NotFoundException(__('Invalid article collection'));
		}
		$options = array('conditions' => array('ArticleCollection.' . $this->ArticleCollection->primaryKey => $id));
		$this->set('articleCollection', $this->ArticleCollection->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ArticleCollection->create();
			if ($this->ArticleCollection->save($this->request->data)) {
				$this->Session->setFlash(__('The article collection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article collection could not be saved. Please, try again.'));
			}
		}
		$collections = $this->ArticleCollection->Collection->find('list');
		$articles = $this->ArticleCollection->Article->find('list');
		$this->set(compact('collections', 'articles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ArticleCollection->exists($id)) {
			throw new NotFoundException(__('Invalid article collection'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ArticleCollection->save($this->request->data)) {
				$this->Session->setFlash(__('The article collection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article collection could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ArticleCollection.' . $this->ArticleCollection->primaryKey => $id));
			$this->request->data = $this->ArticleCollection->find('first', $options);
		}
		$collections = $this->ArticleCollection->Collection->find('list');
		$articles = $this->ArticleCollection->Article->find('list');
		$this->set(compact('collections', 'articles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ArticleCollection->id = $id;
		if (!$this->ArticleCollection->exists()) {
			throw new NotFoundException(__('Invalid article collection'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ArticleCollection->delete()) {
			$this->Session->setFlash(__('The article collection has been deleted.'));
		} else {
			$this->Session->setFlash(__('The article collection could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}



/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function lista($collection_code) {
		$collection = $this->ArticleCollection->Collection->findByCode($collection_code);

		$collection_id = $collection['Collection']['id'];

		$this->ArticleCollection->recursive = 2;
		$articles = $this->ArticleCollection->findAllByCollectionId($collection_id);
		$this->layout = 'ajax';
		$this->set('llista_articles', $articles);
	}
}
