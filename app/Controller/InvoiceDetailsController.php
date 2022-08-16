<?php
App::uses('AppController', 'Controller');
/**
 * InvoiceDetails Controller
 *
 * @property InvoiceDetail $InvoiceDetail
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class InvoiceDetailsController extends AppController {
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function view($id) {
		$this->layout='ajax';
		$this->InvoiceDetail->recursive = 0;
		$invoiceDetails = $this->InvoiceDetail->findAllByInvoiceId($id);
		foreach ($invoiceDetails as $num => $detail) {
			$art = $this->InvoiceDetail->Article->findById($detail['Article']['id']);
			$invoiceDetails[$num]['description'] = $art['Product']['description'];
			$invoiceDetails[$num]['common_name'] = $art['Product']['common_name'];
			$invoiceDetails[$num]['name']        = $art['Article']['name'];

		}
		$this->set('invoicedetails', $invoiceDetails);
	}
}