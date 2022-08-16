<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Usersnewsletters Controller
 *
 * @property Usersnewsletter $Usersnewsletter
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersNewslettersController extends AppController {

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
		$this->UsersNewsletter->recursive = 0;
		$this->set('usersnewsletters', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersNewsletter->exists($id)) {
			throw new NotFoundException('Invalid usersnewsletter');
		}
		$options = array('conditions' => array('Usersnewsletter.' . $this->UsersNewsletter->primaryKey => $id));
		$this->set('UsersNewsletter', $this->UsersNewsletter->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersNewsletter->create();
			if ($this->UsersNewsletter->save($this->request->data)) {
				$this->Session->setFlash('The usersnewsletter has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The usersnewsletter could not be saved. Please, try again.');
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
		if (!$this->UsersNewsletter->exists($id)) {
			throw new NotFoundException('Invalid usersnewsletter');
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsersNewsletter->save($this->request->data)) {
				$this->Session->setFlash('The usersnewsletter has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The usersnewsletter could not be saved. Please, try again.');
			}
		} else {
			$options = array('conditions' => array('Usersnewsletter.' . $this->UsersNewsletter->primaryKey => $id));
			$this->request->data = $this->UsersNewsletter->find('first', $options);
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
		$this->UsersNewsletter->id = $id;
		if (!$this->UsersNewsletter->exists()) {
			throw new NotFoundException('Invalid usersnewsletter');
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsersNewsletter->delete()) {
			$this->Session->setFlash('The usersnewsletter has been deleted.');
		} else {
			$this->Session->setFlash('The usersnewsletter could not be deleted. Please, try again.');
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function unsubscribe()
	{
		$usuario = $this->Session->read('User.logged');



		$listaEmails = explode(';',str_replace(',',';',str_replace(' ','',$usuario['email'])));

		foreach ($listaEmails as $email) {
			//debug($email);
			$user = $this->UsersNewsletter->findByEmail($email);
			if (empty($user)) {
				
				$user['UsersNewsletter']['email']  = $email;
				$user['UsersNewsletter']['codigo_cliente']  = $usuario['code'];
				
				$user['UsersNewsletter']['razon_social']  = $usuario['name'];
				$user['UsersNewsletter']['notificado_rgpd'] = true;
				$user['UsersNewsletter']['fecha_notificacion'] = date('Y-m-d H:i:s');
				$user['UsersNewsletter']['aceptado_rgpd'] = false;
	    		$user['UsersNewsletter']['rechazado_rgpd'] = true;
	    		$user['UsersNewsletter']['traspasar_oracle'] = true;
	    		$user['UsersNewsletter']['completar_oracle'] = true;
				$user['UsersNewsletter']['fecha_rechazo'] = date('Y-m-d H:i:s');
				$user['UsersNewsletter']['hash'] = substr(md5(strtolower($email)),0,25);
				$this->UsersNewsletter->create();
				$return = $this->UsersNewsletter->save($user);
				

				$this->cancel($user['UsersNewsletter']['hash']);
				$mensaje = __('Hemos dado de baja correctamente su email.');
			} else {
				$this->cancel($user['UsersNewsletter']['hash']);
				$mensaje = __('Hemos dado de baja correctamente su email.');
			}
			
		}



		$this->Session->setFlash($mensaje, 'default', array(), 'good');

		return $this->redirect(array('controller' => 'Catalogues', 'action'=>'index'));
	}

	public function subscribe()
	{
		//$email = $this->request->data['UsersNewsletters']['email_address'];
		$cliente = $this->request->data['UsersNewsletters']['cliente'];

		$usuario = $this->Session->read('User.logged');

		$listaEmails = explode(';',str_replace(',',';',str_replace(' ','',$usuario['email'])));



		foreach ($listaEmails as $email) {
			//debug($email);
			$user = $this->UsersNewsletter->findByEmail($email);
			if (empty($user)) {

				
				$user['UsersNewsletter']['email']  = $email;
				$user['UsersNewsletter']['codigo_cliente']  = $cliente;
				
				$user['UsersNewsletter']['razon_social']  = $usuario['name'];
				$user['UsersNewsletter']['notificado_rgpd'] = true;
				$user['UsersNewsletter']['fecha_notificacion'] = date('Y-m-d H:i:s');
				$user['UsersNewsletter']['aceptado_rgpd'] = true;
	    		$user['UsersNewsletter']['rechazado_rgpd'] = false;
	    		$user['UsersNewsletter']['traspasar_oracle'] = true;
	    		$user['UsersNewsletter']['completar_oracle'] = true;
				$user['UsersNewsletter']['fecha_aceptacion'] = date('Y-m-d H:i:s');
				$user['UsersNewsletter']['hash'] = substr(md5(strtolower($email)),0,25);
				$this->UsersNewsletter->create();

				$return = $this->UsersNewsletter->save($user);

				/*debug($user);
				debug('alta');
				debug($return);*/

				$this->confirm($user['UsersNewsletter']['hash']);
				$mensaje = __('Email subscrito correctamente');
			} else {
				if ($user['UsersNewsletter']['aceptado_rgpd'] == 1) {
					$mensaje = __('Este email ya está subscrito a la newsletter.');
				} else {
					$this->confirm($user['UsersNewsletter']['hash']);
					$mensaje = __('Email subscrito correctamente');
				}
			}
		}



		$this->Session->setFlash($mensaje, 'default', array(), 'good');

		return $this->redirect(array('controller' => 'Catalogues', 'action'=>'index'));
	}

	

	public function confirm($hash)
	{
		$user = $this->UsersNewsletter->findByHash($hash);

		if (!empty($user)) {
			


			

			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );


			$agente = $user['UsersNewsletter']['agente'];
			if (empty($agente)) {$agente = '';}
			$tipologia = $user['UsersNewsletter']['tipologia'];
			if (empty($tipologia)) {$tipologia = '';}
			$razon_social = $user['UsersNewsletter']['razon_social'];
			if (empty($razon_social)) {$razon_social = '';}
			$codigo_cliente = $user['UsersNewsletter']['codigo_cliente'];
			if (empty($codigo_cliente)) {$codigo_cliente = '';}			
			$direccion = $user['UsersNewsletter']['direccion'];
			if (empty($direccion)) {$direccion = '';}
			$poblacion = $user['UsersNewsletter']['poblacion'];
			if (empty($poblacion)) {$poblacion = '';}
			$codigopostal = $user['UsersNewsletter']['codigopostal'];
			if (empty($codigopostal)) {$codigopostal = '';}
			$provincia = $user['UsersNewsletter']['provincia'];
			if (empty($provincia)) {$provincia = '';}
			$pais = $user['UsersNewsletter']['pais'];
			if (empty($pais)) {$pais = '';}
			$disponible = $user['UsersNewsletter']['disponible'];
			if (empty($disponible)) {$disponible = '';}
			$grupocomercial = $user['UsersNewsletter']['grupocomercial'];
			if (empty($grupocomercial)) {$grupocomercial = '';}
			$departamento= $user['UsersNewsletter']['departamento'];
			if (empty($departamento)) {$departamento = '';}

		    $data = array(
		      'apikey'        => MAILCHIMP_API_KEY,
		      'email_address' => $user['UsersNewsletter']['email'],
		      'status'        => 'subscribed',
		      'merge_fields'      => array(
		            'AGENTE'=>$agente,
		        	'TIPOLOGIA'=>$tipologia,
		    		'R_SOCIAL'=>$razon_social,
					'CLIENTE'=>$codigo_cliente,
					'DIRECCION'=>$direccion,
					'POBLACION'=>$poblacion,
					'CPOSTAL'=>$codigopostal,
					'PROVINCIA'=>$provincia,
					'PAIS'=>$pais,
					'DISPONIBLE'=>$disponible,
					'GRUPO'=>$grupocomercial,
					'DEPARTAM'=>$departamento)
		      );

		     $json_data = json_encode($data);
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_CUSTOMERS.'/members/');
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


    		$user['UsersNewsletter']['mailchimp_ok'] = true;	
    		if ($result_decoded->status == 400) {

    			if ($result_decoded->title != 'Member Exists') {
	    			$Email = new CakeEmail('rgpd');
					$Email->from(array('corma@corma.es'=>'Corma'));
					$Email->to('mbruguera@corma.es');
	            
	            	$Email->emailFormat('html');

	            
	            	$Email->subject('Error al suscribir a Mailchimp - '.$hash);

	            	$mensaje = "Ha ocurrido un error al suscribir a mailchimp el email: ".$user['UsersNewsletter']['email']."<br />";
	            	$mensaje .= $result_decoded->detail;


	            	//$Email->message($mensaje);            	
		           	$Email->send($mensaje);

		           	$user['UsersNewsletter']['mailchimp_ok'] = false;		
		        } else {



					$hash_mailchimp = md5(strtolower($user['UsersNewsletter']['email']));
		        	$data = array(
		      		'apikey'        => MAILCHIMP_API_KEY,
		      		'status'        => 'subscribed');

    			$json_data = json_encode($data);
				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_CUSTOMERS.'/members/'.$hash_mailchimp);
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


    		$user['UsersNewsletter']['aceptado_rgpd'] = true;
    		$user['UsersNewsletter']['rechazado_rgpd'] = false;
    		$user['UsersNewsletter']['traspasar_oracle'] = true;
			$user['UsersNewsletter']['fecha_aceptacion'] = date('Y-m-d H:i:s');
			$this->UsersNewsletter->save($user);

			$this->set('resultado', 'ok');
			$this->set('idioma', $user['UsersNewsletter']['idioma']);


    		

		} else {
			$this->Session->setFlash(__('Email no encontrado.'));
			$this->set('resultado', 'ko');
			$this->set('idioma','es');
		}

	}


	public function subscribe_users()
	{



		$limit = 0;
		$usuarios = $this->UsersNewsletter->find('all', 
								array(	'conditions'=>array('aceptado_rgpd'=>1,'mailchimp_ok'=>0),
										'limit'=>$limit));


		foreach ($usuarios as $user) {
			echo "Confirmando cliente ".$user['UsersNewsletter']['email']."<br />";

			$hash = $user['UsersNewsletter']['hash'];
			$this->confirm($hash);
}

die;

		$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );

		foreach ($usuarios as $user) {
			$user = $user['UsersNewsletter'];
			$hash_mailchimp = md5(strtolower($user['email']));

			echo "Confirmando cliente ".$user['UsersNewsletter']['email']."<br />";



			$agente = $user['agente'];
			if (empty($agente)) {$agente = '';}
			$tipologia = $user['tipologia'];
			if (empty($tipologia)) {$tipologia = '';}
			$razon_social = $user['razon_social'];
			if (empty($razon_social)) {$razon_social = '';}
			$codigo_cliente = $user['codigo_cliente'];
			if (empty($codigo_cliente)) {$codigo_cliente = '';}			
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
			$disponible = $user['disponible'];
			if (empty($disponible)) {$disponible = '';}
			$grupocomercial = $user['grupocomercial'];
			if (empty($grupocomercial)) {$grupocomercial = '';}
			$departamento= $user['departamento'];
			if (empty($departamento)) {$departamento = '';}


		    $data = array(
		      'apikey'        => MAILCHIMP_API_KEY,
		      'status'        => 'subscribed',
		      'merge_fields'      => array(
		            'AGENTE'=>$agente,
		        	'TIPOLOGIA'=>$tipologia,
		    		'R_SOCIAL'=>$razon_social,
					'CLIENTE'=>$codigo_cliente,
					'DIRECCION'=>$direccion,
					'POBLACION'=>$poblacion,
					'CPOSTAL'=>$codigopostal,
					'PROVINCIA'=>$provincia,
					'PAIS'=>$pais,
					'DISPONIBLE'=>$disponible,
					'GRUPO'=>$grupocomercial,
					'DEPARTAM'=>$departamento)
		      );

		     $json_data = json_encode($data);



		     echo MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_CUSTOMERS.'/members/'.$hash_mailchimp;

		     $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_CUSTOMERS.'/members/'.$hash_mailchimp);
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


print_r($result_decoded).die;
		}

	}

	public function update_users($usuario, $password)
	{

		if ($usuario == USER_SEND_NET && $password == PWD_SEND_NET) {
			$usuarios = $this->UsersNewsletter->find('all', array('conditions'=>array('aceptado_rgpd'=>1,'traspasar_mailchimp'=>1)));


			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );

			foreach ($usuarios as $user) {
				$user = $user['UsersNewsletter'];
				$hash_mailchimp = md5(strtolower($user['email']));



				$agente = $user['agente'];
				if (empty($agente)) {$agente = '';}
				$tipologia = $user['tipologia'];
				if (empty($tipologia)) {$tipologia = '';}
				$razon_social = $user['razon_social'];
				if (empty($razon_social)) {$razon_social = '';}
				$codigo_cliente = $user['codigo_cliente'];
				if (empty($codigo_cliente)) {$codigo_cliente = '';}			
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
				$disponible = $user['disponible'];
				if (empty($disponible)) {$disponible = '';}
				$grupocomercial = $user['grupocomercial'];
				if (empty($grupocomercial)) {$grupocomercial = '';}
				$departamento= $user['departamento'];
				if (empty($departamento)) {$departamento = '';}


			    $data = array(
			      'apikey'        => MAILCHIMP_API_KEY,
			      'status'        => 'subscribed',
			      'merge_fields'      => array(
			            'AGENTE'=>$agente,
			        	'TIPOLOGIA'=>$tipologia,
			    		'R_SOCIAL'=>$razon_social,
						'CLIENTE'=>$codigo_cliente,
						'DIRECCION'=>$direccion,
						'POBLACION'=>$poblacion,
						'CPOSTAL'=>$codigopostal,
						'PROVINCIA'=>$provincia,
						'PAIS'=>$pais,
						'DISPONIBLE'=>$disponible,
						'GRUPO'=>$grupocomercial,
						'DEPARTAM'=>$departamento)
			      );

			     $json_data = json_encode($data);

			     $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_CUSTOMERS.'/members/'.$hash_mailchimp);
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
				$this->UsersNewsletter->save($user);
			}

			$this->set('result','ok');
		}  else {
			$this->set('result','error');
		}

	}

	public function cancel($hash)
	{
		$user = $this->UsersNewsletter->findByHash($hash);

		if (!empty($user)) {
			$user['UsersNewsletter']['rechazado_rgpd'] = true;
			$user['UsersNewsletter']['aceptado_rgpd'] = false;
			$user['UsersNewsletter']['traspasar_oracle'] = true;
			$user['UsersNewsletter']['fecha_rechazo'] = date('Y-m-d H:i:s');

			$this->UsersNewsletter->save($user);

			$this->set('resultado', 'ok');
			$this->set('idioma', $user['UsersNewsletter']['idioma']);




			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );

			$hash_mailchimp = md5(strtolower($user['UsersNewsletter']['email']));





			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_CUSTOMERS.'/members/'.$hash_mailchimp);
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
			    curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.MAILCHIMP_LIST_CUSTOMERS.'/members/'.$hash_mailchimp);
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

			$lista = $this->UsersNewsletter->find('all',array('conditions'=>array('notificado_rgpd'=>'0')));


			foreach ($lista as $usuario) {

				$Email = new CakeEmail('rgpd');
				$Email->from(array('corma@corma.es'=>'Corma'));
				//$Email->to('mbruguera@gmail.com');
				$Email->to($usuario['UsersNewsletter']['email']);
	            
	            $Email->emailFormat('html');

	            if ($usuario['UsersNewsletter']['idioma'] == 'fr') {
	            	$Email->subject('Corma - Nous aimerions continuer de vous informer');
	            	$Email->template('notifica_fr', 'default');	            	
	            } else {
	            	$Email->subject('Corma - Te queremos seguir enviando información');
	            	$Email->template('notifica_es', 'default');
	            }

	            
	            $Email->viewVars(array('hash' => $usuario['UsersNewsletter']['hash']));
	            //$Email->readReceipt('mbruguera@corma.es');
	            $Email->returnPath('mbruguera@corma.es');


	            //debug($Email).die;

	            if ($Email->send()) {
	            	$usuario['UsersNewsletter']['notificado_rgpd'] = true;
	            	$usuario['UsersNewsletter']['fecha_notificacion']= date('Y-m-d H:i:s');

	            	$this->UsersNewsletter->save($usuario);
	            } else {

	            	$mensajeError = $usuario['UsersNewsletter']['email'].'<br />'.$Email->smtpError;

	            	$EmailError = new CakeEmail('rgpd');
	            	$EmailError->from(array('corma@corma.es'=>'Corma'));
					$EmailError->to('mbruguera@corma.es');
	            	$EmailError->emailFormat('html');
	            	$EmailError->subject('Error al enviar email cliente '.$usuario['UsersNewsletter']['codigo_cliente'].' - '.$usuario['UsersNewsletter']['razon_social']);

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


	public function members($id) {

		

			$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );
		  $ch = curl_init();
		  curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/'.$id.'/members?count=1000');
		  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		    'Authorization: Basic '.$auth));
		  curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		  curl_setopt($ch, CURLOPT_POST, false);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  //curl_setopt($ch, CURLOPT_POSTFIELDS, array('offset'=>15));
			$result = curl_exec($ch);
		  
		  $datos = json_decode($result);







		    

		  $this->set('datos', $datos->members);
	}


	public function lists() {

		$auth = base64_encode( 'user:'.MAILCHIMP_API_KEY );
		  $ch = curl_init();
		  curl_setopt($ch, CURLOPT_URL, MAILCHIMP_SERVER.'lists/');
		  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		    'Authorization: Basic '.$auth));
		  curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		  curl_setopt($ch, CURLOPT_POST, false);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  $result = curl_exec($ch);
		  
		  $datos = json_decode($result);

		  $this->set('datos', $datos->lists);
	}

	public function beforeFilter() {

		$this->layout = 'mailchimp';
		parent::beforeFilter();
		$this->Auth->allowedActions = array('index','send', 'confirm','cancel','lists','members','subscribe_users','update_users');
		
	    $this->Auth->allow();


	}
}
