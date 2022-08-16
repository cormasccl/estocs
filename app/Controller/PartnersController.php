<?php
App::uses('AppController', 'Controller');
/**
 * Partners Controller
 *
 * @property Partner $Partner
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class PartnersController extends AppController {

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
		
		$this->Partner->recursive = 0;
		 $user = $this->Session->read('userdata');
        $this->set('user',$user);
        $this->layout = 'admin';
		$this->set('option','partners');
		$this->set('title_for_layout','Almacenes');
		//$this->set('partners', $this->Paginator->paginate());
		$this->Partner->recursive = 0;
        $partners = $this->Partner->find('all',array('order' => array('Partner.code')));
        $this->set('partners',$partners);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Partner->exists($id)) {
			throw new NotFoundException(__('Invalid partner'));
		}
		$options = array('conditions' => array('Partner.' . $this->Partner->primaryKey => $id));
		$this->set('partner', $this->Partner->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'admin';
		$this->set('title_for_layout', __("Nuevo almacén"));
		$this->set('option','partners');
		if ($this->request->is('post')) {
			$this->Partner->create();
			if ($this->Partner->save($this->request->data)) {
				$this->Flash->success(__('Soci creat correctament.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The partner could not be saved. Please, try again.'));
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
		$this->layout = 'admin';
		$this->set('option','partners');
		if (!$this->Partner->exists($id)) {
			throw new NotFoundException(__('Invalid partner'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Partner->save($this->request->data)) {
				$this->Flash->success(__('Soci actualitzat.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The partner could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Partner.' . $this->Partner->primaryKey => $id));
			$this->request->data = $this->Partner->find('first', $options);
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
		$this->Partner->id = $id;
		if (!$this->Partner->exists()) {
			throw new NotFoundException(__('Invalid partner'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Partner->delete()) {
			$this->Flash->success(__('Soci esborrat correctament.'));
		} else {
			$this->Flash->error(__('The partner could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function selection($page = 1)
    {


    	$this->layout = 'default_app';

    	
    	$this->Paginator->settings = array(
	        'order' => array('Partner.code' => 'ASC'),
	        'limit' => 10
	    );

    	$limit = 10;

    	$numSocis = $this->Partner->find('count');

    	if ($numSocis > $page * $limit) {
    		$next = $page + 1;
    		$this->set('next',$next);
    	}

        //$partners = $this->paginate($this->Partners);
        $this->Partner->recursive = 0;
        $partners = $this->Partner->find('all',array('order' => array('Partner.code'), 'limit'=>$limit, 'page'=>$page));
        
        $this->set('title', "Selecció de soci");

        $this->set('page','partners');

        //$user = $this->request->session()->read('userdata');
        //$this->set('user',$user);
        $this->set('option','partners');
        $this->set('page', $page);

        $this->set(compact('partners'));
        $this->set('_serialize', ['partners']);
    }
}
