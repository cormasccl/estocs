<?php
App::uses('AppController', 'Controller');
App::uses('InvoiceDetail', 'Model');
/**
 * InvoicesController
 *
 * @property Invoices $Invoices
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class InvoicesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'RequestHandler');
 
	public function view($page = 1) {
		$user = $this->Auth->user();
		$conditions = array('Invoice.user_id' => $user['id']);


		$requestData = $this->request->query;

		$filter_factura = '';
		$filter_fecha_desde='';
		$filter_fecha_hasta='';

		$url = SERVER.$this->request->url;
        $param = '';

        if (!empty($requestData)) {
        	$filter_factura = $requestData['data']['Invoices']['factura'];
            $filter_fecha_desde = $requestData['data']['Invoices']['fecha_desde'];
            $filter_fecha_hasta = $requestData['data']['Invoices']['fecha_hasta'];


            if (isset($filter_factura) && !empty($filter_factura)) {
				$conditions[]= array('Invoice.code' => $filter_factura);	
            }
            if (isset($filter_fecha_desde) && !empty($filter_fecha_desde)) {
            	$value = $filter_fecha_desde;
				$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

				$filter_fecha_desde = $value_format;

				$conditions[]= array('Invoice.invoicedate >=' => $value_format);				
            }
            if (isset($filter_fecha_hasta) && !empty($filter_fecha_hasta)) {
				$value = $filter_fecha_hasta;
				$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

				$filter_fecha_hasta = $value_format;

				$conditions[]= array('Invoice.invoicedate <=' => $value_format);	
            }
/*

?data%5BInvoices%5D%5Bfactura%5D=
016017617
&data%5BInvoices%5D%5Bfecha_desde%5D=
01%2F01%2F2016
&data%5BInvoices%5D%5Bfecha_hasta%5D=
31%2F12%2F2016

?data%5BInvoices%5D%5Bfactura%5D=016017617&data%5BInvoices%5D%5Bfecha_desde%5D=01%2F01%2F2016&data%5BInvoices%5D%5Bfecha_hasta%5D=31%2F12%2F2016
?data%5BInvoices%5D%5Bfactura%5D=016017617&data%5BInvoices%5D%5Bfecha_desde%5D=01%2F01%2F2016&data%5BInvoices%5D%5Bfecha_hasta%5D=31%2F12%2F2016
*/
            $param = "?data%5BInvoices%5D%5Bfactura%5D=".$filter_factura."&data%5BInvoices%5D%5Bfecha_desde%5D=".str_replace('/','%2F', $filter_fecha_desde)."&data%5BInvoices%5D%5Bfecha_hasta%5D=".str_replace('/','%2F', $filter_fecha_hasta);

           
         }

         $this->set('param',$param);

		
		/*if (!empty($this->request->data['Invoice']['factura'])) {
			$conditions[]= array('Invoice.code' => $this->request->data['Invoice']['factura']);	
		}
		if (!empty($this->request->data['Invoice']['fechadesde'])) {
			$value = $this->request->data['Invoice']['fechadesde'];
			$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

			$conditions[]= array('Invoice.invoicedate >=' => $value_format);	

		}
		if (!empty($this->request->data['Invoice']['fechahasta'])) {
			$value = $this->request->data['Invoice']['fechahasta'];
			$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

			$conditions[]= array('Invoice.invoicedate <=' => $value_format);
		}*/

		 $this->set('filter_factura',$filter_factura);
        $this->set('filter_fecha_desde',$filter_fecha_desde);
        $this->set('filter_fecha_hasta',$filter_fecha_hasta);




		$this->layout = 'customer';

		$limit = 10;

		if ($page == 1) {
            $start = 0;
        } else {
            $start = (($page - 1) * $limit);
        }

        $invoices = $this->Invoice->find('all', array('conditions'=>$conditions, 'limit'=>$limit, 'page'=>$page, 'order'=>'Invoice.invoicedate desc'));


       $invoicesTotal = $this->Invoice->find('all', array('conditions'=>$conditions));


       $numInvoices = count($this->Invoice->find('all', array('conditions'=>$conditions)));



       if ($numInvoices > $page * $limit) {
            $next = $page + 1;
            $this->set('next',$next);
        }
        $this->set('invoices', $invoices);
        $this->set('option','invoices_view');
		$this->set('title_for_layout','');



	}

	public function _view($id = null) {

		$user = $this->Auth->user();
		$conditions = array('Invoice.user_id' => $user['id']);

		
		if (!empty($this->request->data['Invoice']['factura'])) {
			$conditions[]= array('Invoice.code' => $this->request->data['Invoice']['factura']);	
		}
		if (!empty($this->request->data['Invoice']['fechadesde'])) {
			$value = $this->request->data['Invoice']['fechadesde'];
			$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

			$conditions[]= array('Invoice.invoicedate >=' => $value_format);	

		}
		if (!empty($this->request->data['Invoice']['fechahasta'])) {
			$value = $this->request->data['Invoice']['fechahasta'];
			$value_format = substr($value,6,4).'-'.substr($value,3,2).'-'.substr($value,0,2);

			$conditions[]= array('Invoice.invoicedate <=' => $value_format);
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
		       	'conditions' => $conditions,
				'limit' => 10,
		        'order' => array('Invoice.invoicedate' => 'desc')
		    );
		}
		$this->loadModel('InvoiceDetail');
		$invoices = $this->Invoice->findAllByUserId($user['id']);
		$totals   = array(); 
		$counter  = 0;
		$this->InvoiceDetail->recursive = -1;
		foreach ($invoices as $invoice) {
			$invoicesDetails = $this->InvoiceDetail->findAllByInvoiceId($invoice['Invoice']['id']);
			$sum = 0;
			foreach ($invoicesDetails as $invoiceDetail) {
				$sum += $invoiceDetail['InvoiceDetail']['price']*$invoiceDetail['InvoiceDetail']['unities'];
			}
			$totals[$counter]['invoice_id'] = $invoice['Invoice']['id'];
			$totals[$counter]['sum']        = $sum; 
			$counter++;
			//$totals[$counter]['sum'] = $invoicesDetails 
		}
		$this->set('option','invoices_view');
		$this->set('title_for_layout','');
		$this->set('totals', $totals);
		$this->set('invoices', $this->Paginator->paginate($paginate));
	}
}
