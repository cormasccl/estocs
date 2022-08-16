<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Providers Controller
 *
 * @property Provider $Provider
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProvidersController extends AppController {

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
		$this->Provider->recursive = 0;
		$this->set('providers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Provider->exists($id)) {
			throw new NotFoundException(__('Invalid provider'));
		}
		$options = array('conditions' => array('Provider.' . $this->Provider->primaryKey => $id));
		$this->set('provider', $this->Provider->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Provider->create();
			if ($this->Provider->save($this->request->data)) {
				$this->Session->setFlash(__('The provider has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The provider could not be saved. Please, try again.'));
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
		if (!$this->Provider->exists($id)) {
			throw new NotFoundException(__('Invalid provider'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Provider->save($this->request->data)) {
				$this->Session->setFlash(__('The provider has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The provider could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Provider.' . $this->Provider->primaryKey => $id));
			$this->request->data = $this->Provider->find('first', $options);
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
		$this->Provider->id = $id;
		if (!$this->Provider->exists()) {
			throw new NotFoundException(__('Invalid provider'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Provider->delete()) {
			$this->Session->setFlash(__('The provider has been deleted.'));
		} else {
			$this->Session->setFlash(__('The provider could not be deleted. Please, try again.'));
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
		$user = $this->Provider->findByHash($hash);

		if (!empty($user)) {
			


			
			

			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );


			$tipologia = $user['Provider']['tipologia'];
			if (empty($tipologia)) {$tipologia = '';}
			$razon_social = $user['Provider']['razon_social'];
			if (empty($razon_social)) {$razon_social = '';}
			$codigo_proveedor = $user['Provider']['codigo_proveedor'];
			if (empty($codigo_proveedor)) {$codigo_proveedor = '';}			
			$direccion = $user['Provider']['direccion'];
			if (empty($direccion)) {$direccion = '';}
			$poblacion = $user['Provider']['poblacion'];
			if (empty($poblacion)) {$poblacion = '';}
			$codigopostal = $user['Provider']['codigopostal'];
			if (empty($codigopostal)) {$codigopostal = '';}
			$provincia = $user['Provider']['provincia'];
			if (empty($provincia)) {$provincia = '';}
			$pais = $user['Provider']['pais'];
			if (empty($pais)) {$pais = '';}
			

		    $data = array(
		      'apikey'        => MAILCHIMP_API_KEY,
		      'email_address' => $user['Provider']['email'],
		      'status'        => 'subscribed',
		      'merge_fields'      => array(
		            'TIPOLOGIA'=>$tipologia,
		    		'R_SOCIAL'=>$razon_social,
					'PROVEEDOR'=>$codigo_proveedor,
					'DIRECCION'=>$direccion,
					'POBLACION'=>$poblacion,
					'CPOSTAL'=>$codigopostal,
					'PROVINCIA'=>$provincia,
					'PAIS'=>$pais)
		      );

		     $json_data = json_encode($data);
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_PROVIDERS.'/members/');
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


    		$user['Provider']['mailchimp_ok'] = true;	
    		if ($result_decoded->status == 400) {

    			if ($result_decoded->title != 'Member Exists') {
	    			$Email = new CakeEmail('rgpd');
					$Email->from(array('corma@corma.es'=>'Corma'));
					$Email->to('mbruguera@corma.es');
	            
	            	$Email->emailFormat('html');

	            
	            	$Email->subject('Error al suscribir a Mailchimp - '.$hash);

	            	$mensaje = "Ha ocurrido un error al suscribir a mailchimp el email: ".$user['Provider']['email']."<br />";
	            	$mensaje .= $result_decoded->detail;


	            	//$Email->message($mensaje);            	
		           	$Email->send($mensaje);

		           	$user['Provider']['mailchimp_ok'] = false;		
		        } else {



					$hash_mailchimp = md5(strtolower($user['Provider']['email']));
		        	$data = array(
		      		'apikey'        => MAILCHIMP_API_KEY,
		      		'status'        => 'subscribed');

    			$json_data = json_encode($data);
				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_PROVIDERS.'/members/'.$hash_mailchimp);
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


    		$user['Provider']['aceptado_rgpd'] = true;
    		$user['Provider']['rechazado_rgpd'] = false;
    		$user['Provider']['traspasar_oracle'] = true;
			$user['Provider']['fecha_aceptacion'] = date('Y-m-d H:i:s');
			$this->Provider->save($user);

			$this->set('resultado', 'ok');
			$this->set('idioma', $user['Provider']['idioma']);


    		

		} else {
			$this->Session->setFlash(__('Email no encontrado.'));
			$this->set('resultado', 'ko');
			$this->set('idioma','es');
		}

	}


	public function update_users($usuario, $password)
	{

		if ($usuario == USER_SEND_NET && $password == PWD_SEND_NET) {
			$usuarios = $this->Provider->find('all', array('conditions'=>array('aceptado_rgpd'=>1,'traspasar_mailchimp'=>1)));


			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );

			foreach ($usuarios as $user) {
				$user = $user['Provider'];
				$hash_mailchimp = md5(strtolower($user['email']));



				$tipologia = $user['tipologia'];
				if (empty($tipologia)) {$tipologia = '';}
				$razon_social = $user['razon_social'];
				if (empty($razon_social)) {$razon_social = '';}
				$codigo_proveedor = $user['codigo_proveedor'];
				if (empty($codigo_proveedor)) {$codigo_proveedor = '';}			
				$direccion = $user['direccion'];
				if (empty($direccion)) {$direccion = '';}
				$poblacion = $user['poblacion'];
				if (empty($poblacion)) {$poblacion = '';}
				$codigopostal = $user['codigopostal'];
				if (empty($codigopostal)) {$codigopostal = '';}
				$provincia = $user['provincia'];
				if (empty($provincia)) {$provincia = '';}
				$pais = $user['pais'];
				if (empty($pais)) {$pais = '';}
				


			    $data = array(
			      'apikey'        => MAILCHIMP_API_KEY,
			      'status'        => 'subscribed',
			      'merge_fields'      => array(
			            'TIPOLOGIA'=>$tipologia,
			    		'R_SOCIAL'=>$razon_social,
						'PROVEEDOR'=>$codigo_proveedor,
						'DIRECCION'=>$direccion,
						'POBLACION'=>$poblacion,
						'CPOSTAL'=>$codigopostal,
						'PROVINCIA'=>$provincia,
						'PAIS'=>$pais)
			      );

			     $json_data = json_encode($data);

			     $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_PROVIDERS.'/members/'.$hash_mailchimp);
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
				$this->Provider->save($user);
			}

			$this->set('result','ok');
		}  else {
			$this->set('result','error');
		}

	}



	public function cancel($hash)
	{
		$user = $this->Provider->findByHash($hash);

		if (!empty($user)) {
			$user['Provider']['rechazado_rgpd'] = true;
			$user['Provider']['aceptado_rgpd'] = false;
			$user['Provider']['traspasar_oracle'] = true;
			$user['Provider']['fecha_rechazo'] = date('Y-m-d H:i:s');

			$this->Provider->save($user);

			$this->set('resultado', 'ok');
			$this->set('idioma', $user['Provider']['idioma']);


			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );

			$hash_mailchimp = md5(strtolower($user['Provider']['email']));





			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_PROVIDERS.'/members/'.$hash_mailchimp);
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
			    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_PROVIDERS.'/members/'.$hash_mailchimp);
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

			
			$lista = $this->Provider->find('all',array('conditions'=>array('notificado_rgpd'=>'0')));


			foreach ($lista as $usuario) {


				
				$Email = new CakeEmail('rgpd');
				$Email->from(array('corma@corma.es'=>'Corma'));
				$Email->to($usuario['Provider']['email']);
	            
	            $Email->emailFormat('html');

	            if ($usuario['Provider']['idioma'] == 'fr') {
	            	$Email->subject('Corma - Nous aimerions continuer de vous informer');
	            	$Email->template('notifica_prov_fr', 'default');	            	
	            } else {
	            	$Email->subject('Corma - Te queremos seguir enviando información');
	            	$Email->template('notifica_prov_es', 'default');
	            }

	            
	            $Email->viewVars(array('hash' => $usuario['Provider']['hash']));
	            //$Email->readReceipt('mbruguera@corma.es');
	            $Email->returnPath('mbruguera@corma.es');

	            if ($Email->send()) {
	            	$usuario['Provider']['notificado_rgpd'] = true;
	            	$usuario['Provider']['fecha_notificacion']= date('Y-m-d H:i:s');

	            	$this->Provider->save($usuario);
	            } else {

	            	$mensajeError = $usuario['Provider']['email'].'<br />'.$Email->smtpError;

	            	$EmailError = new CakeEmail('rgpd');
	            	$EmailError->from(array('corma@corma.es'=>'Corma'));
					$EmailError->to('mbruguera@corma.es');
	            	$EmailError->emailFormat('html');
	            	$EmailError->subject('Error al enviar email proveedor '.$usuario['Provider']['codigo_proveedor'].' - '.$usuario['Provider']['razon_social']);

	            	$EmailError->message($mensajeError);
	            	$EmailError->send();


	            }			
			}

			$this->set('result','ok');
		}  else {
			$this->set('result','error');
		}

		$this->update_users($usuario, $password);
	}
}
