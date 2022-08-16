<?php
App::uses('AppController', 'Controller');
/**
 * CashOrderDetails Controller
 *
 * @property CashOrderDetail $CashOrderDetail
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CashOrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'RequestHandler');
 
	public function send()
	{

		
		$numPedido = $this->request->data['cash_order'];


		$arraySave = array();
		$arraySave['CashOrder']['observations'] = $this->request->data['observaciones'];
		$arraySave['CashOrder']['status_id'] = 2;
		$arraySave['CashOrder']['deliver_date'] = date('Y-m-d H:i:s');
		
		$arraySave['CashOrder']['id'] = $numPedido;
		
		
		if ($this->CashOrder->save($arraySave)) {
			$this->Session->setFlash(__('Se ha finalizado correctamente el pedido y se ha enviado a su comercial. Le adjuntamos copia en pdf del pedido.'), 'default', array(), 'send_ok');
		} else {
			$this->Session->setFlash(__('Ha ocurrido un error al finalizar el pedido. Contacte con su comercial'), 'default', array(), 'send_error');
		}
		//Se ha finalizado correctamente el pedido y se ha enviado a su comercial. Le adjuntamos copia en pdf del pedido número %p
		//La comanda s'ha finalitzat correctament, s'ha enviat al seu comercial. Li adjuntem una còpia en format PDF de la comanda número %p
		//La commande %p a bien été enregistrée et envoyée à votre interlocuteur CORMA

		$this->set('title_for_layout', __('Finalización de pedido'));
		$this->set('option','cash_order_sent');
		$this->layout = 'customer';



		/*$this->layout = 'customer';
		$user = $this->Auth->user();
		$this->loadModel('User');
		$this->User->recursive = 1;
		$this->User->Catalogue->recursive = 2;
		$conditions['conditions'] = array();
		$conditions['conditions']['id'] = $user['catalogue_id'];
		$this->loadModel('Catalogue');
		$arrayCatalogues = $this->Catalogue->find('all', $conditions);

		$this->set('catalogue', $arrayCatalogues);
		$options = array('conditions' => array('User.' . $this->User->primaryKey => 1));
		$this->set('user', $user);
		
		$this->CashOrder->CashOrderDetail->recursive = 2;
		$cashOrderDetails = $this->CashOrder->CashOrderDetail->find('all', array('conditions' => array('CashOrderDetail.cash_order_id' =>$this->Session->read('cash_order_id'))));
		
		$total = array();
		$total['importTotal'] = $total['carrisTotal'] = 0;
		foreach($cashOrderDetails as $detail) {
			$total['importTotal'] += ($detail['CashOrderDetail']['real_unities']*$detail['CashOrderDetail']['price']);
			$total['carrisTotal'] += $detail['CashOrderDetail']['carris_article'];
		}
		$this->set('total', $total);
		$this->set('cashorderdetails', $cashOrderDetails);
		$this->set('option', 'cash_order_send');
		$this->set('cash_order', $this->Session->read('cash_order_id'));*/

	}
	public function savecashorder() {
		$this->layout = 'ajax';
		$this->autoRender = false;
		$valors = json_decode($this->request->data, true);
		debug($valors);
		$num_pedido   = $valors['num'];
		$observations = $valors['observations'];

		$arraySave = array();
		$arraySave['CashOrder']['observations'] = $observations;
		$arraySave['CashOrder']['status_id'] = 2;
		$arraySave['CashOrder']['deliver_date'] = date('Y-m-d H:i:s');
		
		$arraySave['CashOrder']['id'] = $num_pedido;
		
		debug($arraySave);

		if ($this->CashOrder->save($arraySave)) {
			return json_encode('ok');
		} else {
			return json_encode($this->CashOrder->validationErrors);
		}
	}
	public function view($id = null) {


		$user = $this->Auth->user();
		$conditions   = array();
		$conditions['CashOrder.user_id'] = $user['id'];

		
		if (!empty($this->request->data['CashOrder']['pedido'])) {
			$conditions['CashOrder.id_order'] = $this->request->data['CashOrder']['pedido'];
		}

		if (!empty($this->request->data['CashOrder']['fechadesde'])) {
			$value = $this->request->data['CashOrder']['fechadesde'];
			$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

			$conditions[]= array('CashOrder.deliver_date >=' => $value_format);	


			//$this->request->data['CashOrder']['fechadesde'] = date('d/m/Y', strtotime(str_replace("/","-",$this->request->data['CashOrder']['fechadesde'])));
			//$this->request->data['CashOrder']['fechadesde'] = $this->i8_formatUKDateMySQL($this->request->data['CashOrder']['fechadesde']);
		}
		if (!empty($this->request->data['CashOrder']['fechahasta'])) {
			$value = $this->request->data['CashOrder']['fechahasta'];
			$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

			$conditions[]= array('CashOrder.deliver_date <=' => $value_format);	

			//$this->request->data['CashOrder']['fechahasta'] = date('d-m-Y', strtotime($this->request->data['CashOrder']['fechahasta']));
		}
		$this->layout = 'customer';
		$paginate = array();
		if (!empty($id)) {
			$paginate = array(
				 'limit' => 10,
		        'conditions' => array('id' => $id)
		    );
		} else {
			
			$this->Paginator->settings = array(
				//'fields' => array('CashOrder.deliver_date','CashOrder.id_order','Status.name','CashOrder.observations'),//,'sum(CashOrderDetail.real_unities*CashOrderDetail.price) importe'),
		       	//'group'=>array('CashOrder.deliver_date','CashOrder.id_order','Status.name','CashOrder.observations'),
		       	'conditions' => $conditions,
				'limit' => 10,
		        'order' => array('CashOrder.deliver_date' => 'desc')
		    );
		}
		



		$this->set('title_for_layout','');
		
		$this->set('option','cash_order_view');
		$this->set('catalogue_id', $user['catalogue_id']);
		$this->set('cashorders', $this->Paginator->paginate($paginate));
	}


	function i8_formatUKDateMySQL($date) {
$d = str_replace(" ","",$date);
$d = explode('/', $date);

$d = $d[2].'-'.$d[1].'-'.$d[0];

return $d;
}
}
