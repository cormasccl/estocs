<?php
App::uses('AppController', 'Controller');
/**
 * CashOrderDetails Controller
 *
 * @property CashOrderDetail $CashOrderDetail
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CashOrderDetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'RequestHandler');
 
	public function saveonline() {
		$this->layout = 'ajax';
		$this->autoRender = false;
		
		$this->loadModel('CashOrderDetail');
		$this->CashOrderDetail->create();
		$valors = json_decode($this->request->data, true);

		$valueUnit = 1;
		switch ($valors['unitat']) {
			case 'P':
				$valueUnit = 3;
				break;
			case 'C':
				$valueUnit = 2;
				break;
			case 'K':
				$valueUnit = 4;
				break;
		}
		//$valor = 'aaa';

		$arraySave = array();
		$arraySave['CashOrderDetail']['units'] = $valors['cantidad'];
		$arraySave['CashOrderDetail']['price'] = $valors['preu'];
		$arraySave['CashOrderDetail']['cash_order_id'] = $valors['sesion'];
		$arraySave['CashOrderDetail']['services_unit_id'] = $valueUnit;
		$arraySave['CashOrderDetail']['article_id'] = $valors['article'];
		$arraySave['CashOrderDetail']['observations'] = $valors['observations'];
		$arraySave['CashOrderDetail']['real_unities'] = $valors['real_unities'];
		$arraySave['CashOrderDetail']['carris_article'] = $valors['carris_article'];


 		$this->CashOrderDetail->recursive = -1;
		$oldCashOrder = $this->CashOrderDetail->find('first',array('conditions' => array('cash_order_id' => $arraySave['CashOrderDetail']['cash_order_id'],'article_id' => $arraySave['CashOrderDetail']['article_id'])));
		if (!empty($oldCashOrder)) {
			$arraySave['CashOrderDetail']['id'] = $oldCashOrder['CashOrderDetail']['id'];

			if ($arraySave['CashOrderDetail']['units'] == 0 || $arraySave['CashOrderDetail']['units'] == '') {
				$this->CashOrderDetail->id = $arraySave['CashOrderDetail']['id'];
				if ($this->CashOrderDetail->delete()) {
					return json_encode('ok');
				} 
			} 
		}
		if ($arraySave['CashOrderDetail']['units'] > 0) {
			if ($this->CashOrderDetail->save($arraySave)) {
				return json_encode('ok');
			} else {
				return json_encode($this->CashOrderDetail->validationErrors);
			}
		}
	}
	public function view($cash_order_id) {
		$this->layout='ajax';
		$this->CashOrderDetail->recursive = 0;
		$cashOrderDetails = $this->CashOrderDetail->findAllByCashOrderId($cash_order_id);
		foreach ($cashOrderDetails as $num => $detail) {
			$art = $this->CashOrderDetail->Article->findById($detail['Article']['id']);
			$cashOrderDetails[$num]['description'] = $art['Product']['description'];
			$cashOrderDetails[$num]['common_name'] = $art['Product']['common_name'];
			$cashOrderDetails[$num]['name']        = $art['Article']['name'];

		}
		$this->set('cashorder_id', $cash_order_id);
		$this->set('cashorderdetails', $cashOrderDetails);
	}

	public function duplicate($cash_order_id, $cash_order_source_id, $catalogue_id) {

		$this->loadModel('CatalogueArticles');
		$this->loadModel('CashOrderDetail');
		
		$this->CashOrderDetail->recursive = 0;
		$cashOrderDetailsSource = $this->CashOrderDetail->findAllByCashOrderId($cash_order_source_id);



		$this->CatalogueArticles->recursive = 0;

		//debug($cashOrderDetailsSource);

		foreach ($cashOrderDetailsSource as $num => $detail_source) {

			$article_id = $detail_source['Article']['id'];

			$conditions = array('article_id'=>$article_id, 'catalogue_id'=>$catalogue_id);

			
			$detail = $this->CatalogueArticles->find('all',array('conditions'=>$conditions));

			if (!empty($detail)) {


				$detailExists = $this->CashOrderDetail->find('all',array('conditions'=>array('article_id'=>$article_id, 'cash_order_id'=>$cash_order_id)));

				if (!empty($detailExists)) {
					foreach ($detailExists as $det) {
						$this->CashOrderDetail->delete($det['CashOrderDetail']['id']);
					}
					
				}

				//debug($detail_source['CashOrderDetail']);
				//debug($detail[0]['CatalogueArticles']);

				$arraySave = array();
				$arraySave['CashOrderDetail']['units'] = $detail_source['CashOrderDetail']['units'];
				$arraySave['CashOrderDetail']['price'] = $detail[0]['CatalogueArticles']['price'];
				$arraySave['CashOrderDetail']['cash_order_id'] = $cash_order_id;
				$arraySave['CashOrderDetail']['services_unit_id'] = $detail_source['CashOrderDetail']['services_unit_id'];
				$arraySave['CashOrderDetail']['article_id'] = $detail_source['CashOrderDetail']['article_id'];
				$arraySave['CashOrderDetail']['observations'] = $detail_source['CashOrderDetail']['observations'];
				$arraySave['CashOrderDetail']['real_unities'] = $detail_source['CashOrderDetail']['real_unities'];
				$arraySave['CashOrderDetail']['carris_article'] = $detail_source['CashOrderDetail']['carris_article'];


				$this->CashOrderDetail->create();
				$this->CashOrderDetail->save($arraySave);

				

			}


		}

		//return $this->redirect(array('controller' => 'Catalogues', 'action' => 'index', 'cart'));

		return $this->redirect(array('controller' => 'CashOrderDetails', 'action' => 'summary', $cash_order_id, $cash_order_source_id));
	}

	function summary($cash_order_id, $cash_order_source_id) {


		$this->loadModel('CashOrderDetail');

		$this->CashOrderDetail->recursive = 0;
		$cashOrderDetailsSource = $this->CashOrderDetail->findAllByCashOrderId($cash_order_source_id);

		$articlesAfegits =array();
		 $articlesNoAfegits = array();

		foreach ($cashOrderDetailsSource as $num => $detail_source) {

			$result = $this->CashOrderDetail->find('all',array('conditions'=>array('cash_order_id'=>$cash_order_id, 'article_id'=>$detail_source['Article']['id'])));

			if (empty($result)) {
				$articlesNoAfegits[] = $detail_source['Article'];
			}
			else {
				$articlesAfegits[] = $detail_source['Article'];
			}


		}

		$this->set('articlesAfegits', $articlesAfegits);
		$this->set('articlesNoAfegits', $articlesNoAfegits);

		$this->layout = 'customer';
		$this->set('title_for_layout','');
		$this->set('title','');
		$this->set('titleName','');


	}
}
