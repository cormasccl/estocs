<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * ArticlePhotos Controller
 *
 * @property ArticlePhoto $ArticlePhoto
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ArticlePhotosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Image');


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ArticlePhoto->recursive = -1;
		$this->set('articlePhotos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ArticlePhoto->exists($id)) {
			throw new NotFoundException(__('Invalid article photo'));
		}
		$options = array('conditions' => array('ArticlePhoto.' . $this->ArticlePhoto->primaryKey => $id));
		$this->set('articlePhoto', $this->ArticlePhoto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ArticlePhoto->create();
			if ($this->ArticlePhoto->save($this->request->data)) {
				$this->Session->setFlash(__('The article photo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article photo could not be saved. Please, try again.'));
			}
		}
		$articles = $this->ArticlePhoto->Article->find('list');
		$growings = $this->ArticlePhoto->Growing->find('list');
		$flowerings = $this->ArticlePhoto->Flowering->find('list');
		$this->set(compact('articles', 'growings', 'flowerings'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ArticlePhoto->exists($id)) {
			throw new NotFoundException(__('Invalid article photo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ArticlePhoto->save($this->request->data)) {
				$this->Session->setFlash(__('The article photo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article photo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ArticlePhoto.' . $this->ArticlePhoto->primaryKey => $id));
			$this->request->data = $this->ArticlePhoto->find('first', $options);
		}
		$articles = $this->ArticlePhoto->Article->find('list');
		$growings = $this->ArticlePhoto->Growing->find('list');
		$flowerings = $this->ArticlePhoto->Flowering->find('list');
		$this->set(compact('articles', 'growings', 'flowerings'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ArticlePhoto->id = $id;
		if (!$this->ArticlePhoto->exists()) {
			throw new NotFoundException(__('Invalid article photo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ArticlePhoto->delete()) {
			$this->Session->setFlash(__('The article photo has been deleted.'));
		} else {
			$this->Session->setFlash(__('The article photo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * resize method
	 *
	 * @return void
	 */
	public function resize() {

		$this->ArticlePhoto->recursive = -1;

		$options = array('conditions' => array('resized' => 0));

$fotos = $this->ArticlePhoto->find('first', $options);

foreach ($fotos as $res) {
	$input_file = WWW_ROOT.'img/articles/'.$res['photo'];
	$output_file = WWW_ROOT.'img/articles/thumbs/'.$res['photo'];

	$this->Image->resize_image( $input_file , 100 , 100 , $output_file );

}

	
		$this->set('articlePhotos', $fotos);

	}


}
