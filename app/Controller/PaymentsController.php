<?php
App::uses('AppController', 'Controller');
/**
 * Payments Controller
 *
 * @property Payment $Payment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PaymentsController extends AppController {

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
		$this->Payment->recursive = 0;
		$this->set('payments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		$user = $this->Auth->user();
		$conditions = array('Payment.user_id' => $user['id']);

		if (!empty($this->request->data['Payment']['numdoc'])) {
			$conditions[]= array('Payment.numdoc' => $this->request->data['Payment']['numdoc']);	
		}
		if (!empty($this->request->data['Payment']['factura'])) {
			$conditions[]= array('Invoice.code' => $this->request->data['Payment']['factura']);	
		}

		//$fechadesde = $this->request->data['Payment']['fechadesde'];
		//$fechahasta = $this->request->data['Payment']['fechahasta'];


		if (!empty($this->request->data['Payment']['fechadesde'])) {
			$value = $this->request->data['Payment']['fechadesde'];
			$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

			$conditions[]= array('Payment.payement_date >=' => $value_format);	

			//$this->request->data['Payment']['fechadesde'] = date('d/m/Y', strtotime($this->request->data['Payment']['fechadesde']));

		}
		if (!empty($this->request->data['Payment']['fechahasta'])) {
			$value = $this->request->data['Payment']['fechahasta'];
			$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

			$conditions[]= array('Payment.payement_date <=' => $value_format);	

			//$this->request->data['Payment']['fechahasta'] = date('d/m/Y', strtotime($this->request->data['Payment']['fechahasta']));
		}
		if (!empty($this->request->data['Payment']['status'])) {
			$conditions[]= array('Payment.status_description' => $this->request->data['Payment']['status']);	
		}


		$this->layout = 'customer';
		$paginate = array();
		if (!empty($id)) {
			$paginate = array(
				 'limit' => 10,
				 'recursive'=>1,
		        'conditions' => array('id' => $id)
		    );
		} else {
			
			$this->Paginator->settings = array(
		       	'conditions' => $conditions,
				'limit' => 10,
				'recursive'=>1,
		        'order' => array('Payment.payement_date' => 'desc')
		    );
		}


		//$this->set('fechadesde',$fechadesde);
		//$this->set('fechahasta',$fechahasta);
		
		
		$this->set('option','payments_view');
		$this->set('title_for_layout','');
		$this->set('payments', $this->Paginator->paginate($paginate));

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Payment->create();
			if ($this->Payment->save($this->request->data)) {
				$this->Session->setFlash(__('The payment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment could not be saved. Please, try again.'));
			}
		}
		$users = $this->Payment->User->find('list');
		$invoices = $this->Payment->Invoice->find('list');
		$this->set(compact('users', 'invoices'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Payment->exists($id)) {
			throw new NotFoundException(__('Invalid payment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Payment->save($this->request->data)) {
				$this->Session->setFlash(__('The payment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Payment.' . $this->Payment->primaryKey => $id));
			$this->request->data = $this->Payment->find('first', $options);
		}
		$users = $this->Payment->User->find('list');
		$invoices = $this->Payment->Invoice->find('list');
		$this->set(compact('users', 'invoices'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Payment->id = $id;
		if (!$this->Payment->exists()) {
			throw new NotFoundException(__('Invalid payment'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Payment->delete()) {
			$this->Session->setFlash(__('The payment has been deleted.'));
		} else {
			$this->Session->setFlash(__('The payment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
