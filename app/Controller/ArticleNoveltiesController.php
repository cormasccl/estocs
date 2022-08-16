<?php
App::uses('AppController', 'Controller');
/**
 * ArticleNovelties Controller
 *
 * @property ArticleNovelty $ArticleNovelty
 * @property PaginatorComponent $Paginator
 */
class ArticleNoveltiesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');



function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allowedActions = array('index');
}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$locale = $this->Session->read('Config.language');
        setlocale(LC_ALL, $locale);
        $this->set('locale',$locale);
		$this->loadModel('Article');
		$this->Article->recursive = 1;
		$this->loadModel('Product');
		$this->Product->recursive = 1;
		$this->Product->locale = $locale;

		$this->ArticleNovelty->recursive = 0;
		$options = array('conditions' => array('ArticleNovelty.active'=>'1'),'contain' => array('Product','Article.Article'));
		
		$novedades = $this->ArticleNovelty->find('all', $options);


		foreach ($novedades as $id => $row) {
			$arrayNovedades[] = $row['ArticleNovelty'];

			$article = $this->Article->findById($row['ArticleNovelty']['article_id']);
			$product = $this->Product->findById($article['Article']['product_id']);
			$article['Product'] = $product;
			$arrayNovedades[$id]['Article'] = $article;
		}

		$this->set('title_for_layout', __('Novedades'));

		$this->set('articleNovelty', $arrayNovedades);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ArticleNovelty->exists($id)) {
			throw new NotFoundException(__('Invalid article novelty'));
		}
		$options = array('conditions' => array('ArticleNovelty.' . $this->ArticleNovelty->primaryKey => $id));
		$this->set('articleNovelty', $this->ArticleNovelty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ArticleNovelty->create();
			if ($this->ArticleNovelty->save($this->request->data)) {
				$this->Session->setFlash(__('The article novelty has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article novelty could not be saved. Please, try again.'));
			}
		}
		$articles = $this->ArticleNovelty->Article->find('list');
		$this->set(compact('articles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ArticleNovelty->exists($id)) {
			throw new NotFoundException(__('Invalid article novelty'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ArticleNovelty->save($this->request->data)) {
				$this->Session->setFlash(__('The article novelty has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article novelty could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ArticleNovelty.' . $this->ArticleNovelty->primaryKey => $id));
			$this->request->data = $this->ArticleNovelty->find('first', $options);
		}
		$articles = $this->ArticleNovelty->Article->find('list');
		$this->set(compact('articles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ArticleNovelty->id = $id;
		if (!$this->ArticleNovelty->exists()) {
			throw new NotFoundException(__('Invalid article novelty'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ArticleNovelty->delete()) {
			$this->Session->setFlash(__('The article novelty has been deleted.'));
		} else {
			$this->Session->setFlash(__('The article novelty could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ArticleNovelty->recursive = 0;
		$this->set('articleNovelties', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ArticleNovelty->exists($id)) {
			throw new NotFoundException(__('Invalid article novelty'));
		}
		$options = array('conditions' => array('ArticleNovelty.' . $this->ArticleNovelty->primaryKey => $id));
		$this->set('articleNovelty', $this->ArticleNovelty->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ArticleNovelty->create();
			if ($this->ArticleNovelty->save($this->request->data)) {
				$this->Session->setFlash(__('The article novelty has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article novelty could not be saved. Please, try again.'));
			}
		}
		$articles = $this->ArticleNovelty->Article->find('list');
		$this->set(compact('articles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->ArticleNovelty->exists($id)) {
			throw new NotFoundException(__('Invalid article novelty'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ArticleNovelty->save($this->request->data)) {
				$this->Session->setFlash(__('The article novelty has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article novelty could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ArticleNovelty.' . $this->ArticleNovelty->primaryKey => $id));
			$this->request->data = $this->ArticleNovelty->find('first', $options);
		}
		$articles = $this->ArticleNovelty->Article->find('list');
		$this->set(compact('articles'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ArticleNovelty->id = $id;
		if (!$this->ArticleNovelty->exists()) {
			throw new NotFoundException(__('Invalid article novelty'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ArticleNovelty->delete()) {
			$this->Session->setFlash(__('The article novelty has been deleted.'));
		} else {
			$this->Session->setFlash(__('The article novelty could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
