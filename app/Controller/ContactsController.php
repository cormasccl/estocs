<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Contacts Controller
 *
 * @property Contact $Contact
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ContactsController extends AppController {

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
		$this->Contact->recursive = 0;
		$this->set('contacts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contact->exists($id)) {
			throw new NotFoundException(__('Invalid contact'));
		}
		$options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
		$this->set('contact', $this->Contact->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contact->create();
			if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash(__('The contact has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.'));
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
		if (!$this->Contact->exists($id)) {
			throw new NotFoundException(__('Invalid contact'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash(__('The contact has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
			$this->request->data = $this->Contact->find('first', $options);
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
		$this->Contact->id = $id;
		if (!$this->Contact->exists()) {
			throw new NotFoundException(__('Invalid contact'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Contact->delete()) {
			$this->Session->setFlash(__('The contact has been deleted.'));
		} else {
			$this->Session->setFlash(__('The contact could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}



	public function beforeFilter() {

		$this->layout = 'mailchimp';
		parent::beforeFilter();
		$this->Auth->allowedActions = array('index','send', 'confirm','cancel','update_users');
		
	    $this->Auth->allow();
	}


	public function confirm($hash)
	{
		$user = $this->Contact->findByHash($hash);

		if (!empty($user)) {
			
			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );


			$tipologia = $user['Contact']['tipologia'];
			if (empty($tipologia)) {$tipologia = '';}
			$razon_social = $user['Contact']['razon_social'];
			if (empty($razon_social)) {$razon_social = '';}
			$nombre = $user['Contact']['nombre'];
			if (empty($nombre)) {$nombre = '';}
			$apellidos = $user['Contact']['apellidos'];
			if (empty($apellidos)) {$apellidos = '';}
			$tipo_contacto = $user['Contact']['tipo_contacto'];
			if (empty($tipo_contacto)) {$tipo_contacto = '';}
			

		    $data = array(
		      'apikey'        => MAILCHIMP_API_KEY,
		      'email_address' => $user['Contact']['email'],
		      'status'        => 'subscribed',
		      'merge_fields'      => array(
		            'TIPOLOGIA'=>$tipologia,
		    		'R_SOCIAL'=>$razon_social,
		    		'NOMBRE'=>$nombre,
		    		'APELLIDOS'=>$apellidos,
		    		'TIPO_CONT'=>$tipo_contacto)
		      );

		     $json_data = json_encode($data);
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_SECTOR_PEOPLE.'/members/');
		    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		      'Authorization: Basic '.$auth));
		    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		    curl_setopt($ch, CURLOPT_POST, true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    		$result = curl_exec($ch);

    		curl_close($ch);
      
    		$result_decoded = json_decode($result);


    		$user['Contact']['mailchimp_ok'] = true;	
    		if ($result_decoded->status == 400) {

    			if ($result_decoded->title != 'Member Exists') {
	    			$Email = new CakeEmail('rgpd');
					$Email->from(array('corma@corma.es'=>'Corma'));
					$Email->to('mbruguera@corma.es');
	            
	            	$Email->emailFormat('html');

	            
	            	$Email->subject('Error al suscribir a Mailchimp - '.$hash);

	            	$mensaje = "Ha ocurrido un error al suscribir a mailchimp el email: ".$user['Contact']['email']."<br />";
	            	$mensaje .= $result_decoded->detail;


	            	//$Email->message($mensaje);            	
		           	$Email->send($mensaje);

		           	$user['Contact']['mailchimp_ok'] = false;		
		        } else {



					$hash_mailchimp = md5(strtolower($user['Contact']['email']));
		        	$data = array(
		      		'apikey'        => MAILCHIMP_API_KEY,
		      		'status'        => 'subscribed');

    			$json_data = json_encode($data);
				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_SECTOR_PEOPLE.'/members/'.$hash_mailchimp);
			    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
			      'Authorization: Basic '.$auth));
			    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			    curl_setopt($ch, CURLOPT_POST, true);
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

				$result = curl_exec($ch);
				$result_decoded = json_decode($result);


    			curl_close($ch);



		        }	
    		} 


    		$user['Contact']['aceptado_rgpd'] = true;
    		$user['Contact']['rechazado_rgpd'] = false;
    		$user['Contact']['traspasar_oracle'] = true;
			$user['Contact']['fecha_aceptacion'] = date('Y-m-d H:i:s');
			$this->Contact->save($user);

			$this->set('resultado', 'ok');
			$this->set('idioma', $user['Contact']['idioma']);


    		

		} else {
			$this->Session->setFlash(__('Email no encontrado.'));
			$this->set('resultado', 'ko');
			$this->set('idioma','es');
		}

	}



	public function update_users($usuario, $password)
	{

		if ($usuario == USER_SEND_NET && $password == PWD_SEND_NET) {
			$usuarios = $this->Contact->find('all', array('conditions'=>array('aceptado_rgpd'=>1,'traspasar_mailchimp'=>1)));


			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );

			foreach ($usuarios as $user) {
				$user = $user['Contact'];
				$hash_mailchimp = md5(strtolower($user['email']));



				$tipologia = $user['tipologia'];
				if (empty($tipologia)) {$tipologia = '';}
				$razon_social = $user['razon_social'];
				if (empty($razon_social)) {$razon_social = '';}
				$nombre = $user['Contact']['nombre'];
				if (empty($nombre)) {$nombre = '';}
				$apellidos = $user['Contact']['apellidos'];
				if (empty($apellidos)) {$apellidos = '';}
				$tipo_contacto = $user['Contact']['tipo_contacto'];
				if (empty($tipo_contacto)) {$tipo_contacto = '';}
				


			    $data = array(
			      'apikey'        => MAILCHIMP_API_KEY,
			      'status'        => 'subscribed',
			      'merge_fields'      => array(
			            'TIPOLOGIA'=>$tipologia,
			    		'R_SOCIAL'=>$razon_social,
		    			'NOMBRE'=>$nombre,
		    			'APELLIDOS'=>$apellidos,
		    			'TIPO_CONT'=>$tipo_contacto)
			      );

			     $json_data = json_encode($data);

			     $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_SECTOR_PEOPLE.'/members/'.$hash_mailchimp);
			    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
			      'Authorization: Basic '.$auth));
			    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			    curl_setopt($ch, CURLOPT_POST, true);
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

				$result = curl_exec($ch);
				$result_decoded = json_decode($result);


				curl_close($ch);

				$user['traspasar_mailchimp'] = false;
				$this->Contact->save($user);
			}

			$this->set('result','ok');
		}  else {
			$this->set('result','error');
		}

	}



	public function cancel($hash)
	{
		$user = $this->Contact->findByHash($hash);

		if (!empty($user)) {
			$user['Contact']['rechazado_rgpd'] = true;
			$user['Contact']['aceptado_rgpd'] = false;
			$user['Contact']['traspasar_oracle'] = true;
			$user['Contact']['fecha_rechazo'] = date('Y-m-d H:i:s');

			$this->Contact->save($user);

			$this->set('resultado', 'ok');
			$this->set('idioma', $user['Contact']['idioma']);


			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );

			$hash_mailchimp = md5(strtolower($user['Contact']['email']));





			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_SECTOR_PEOPLE.'/members/'.$hash_mailchimp);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		      'Authorization: Basic '.$auth));
		    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		    curl_setopt($ch, CURLOPT_POST, false);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    
    		$result = curl_exec($ch);

    		curl_close($ch);

    		
    		$result_decoded = json_decode($result);

    		if ($result_decoded->status != 400) {

    			$data = array(
		      		'apikey'        => MAILCHIMP_API_KEY,
		      		'status'        => 'unsubscribed');

    			$json_data = json_encode($data);
				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_SECTOR_PEOPLE.'/members/'.$hash_mailchimp);
			    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
			      'Authorization: Basic '.$auth));
			    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			    curl_setopt($ch, CURLOPT_POST, true);
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

				$result = curl_exec($ch);
				$result_decoded = json_decode($result);


    			curl_close($ch);
    		}

      


		} else {
			$this->Session->setFlash(__('Email no encontrado.'));
			$this->set('resultado', 'ko');
			$this->set('idioma','es');
		}

	}



	public function send($usuario, $password)
	{


		if ($usuario == USER_SEND_NET && $password == PWD_SEND_NET) {

			
			$lista = $this->Contact->find('all',array('conditions'=>array('notificado_rgpd'=>'0')));


			foreach ($lista as $usuario) {


				
				$Email = new CakeEmail('rgpd');
				$Email->from(array('corma@corma.es'=>'Corma'));
				$Email->to($usuario['Contact']['email']);
	            
	            $Email->emailFormat('html');

	            if ($usuario['Contact']['idioma'] == 'fr') {
	            	$Email->subject('Corma - Nous aimerions continuer de vous informer');
	            	$Email->template('notifica_contact_fr', 'default');	            	
	            } else {
	            	$Email->subject('Corma - Te queremos seguir enviando información');
	            	$Email->template('notifica_contact_es', 'default');
	            }

	            
	            $Email->viewVars(array('hash' => $usuario['Contact']['hash']));
	            //$Email->readReceipt('mbruguera@corma.es');
	            $Email->returnPath('mbruguera@corma.es');

	            if ($Email->send()) {
	            	$usuario['Contact']['notificado_rgpd'] = true;
	            	$usuario['Contact']['fecha_notificacion']= date('Y-m-d H:i:s');

	            	$this->Contact->save($usuario);
	            } else {

	            	$mensajeError = $usuario['Contact']['email'].'<br />'.$Email->smtpError;

	            	$EmailError = new CakeEmail('rgpd');
	            	$EmailError->from(array('corma@corma.es'=>'Corma'));
					$EmailError->to('mbruguera@corma.es');
	            	$EmailError->emailFormat('html');
	            	$EmailError->subject('Error al enviar email '.$usuario['Contact']['razon_social']);

	            	$EmailError->message($mensajeError);
	            	$EmailError->send();


	            }			
			}

			$this->set('result','ok');
		}  else {
			$this->set('result','error');
		}

	}



}
