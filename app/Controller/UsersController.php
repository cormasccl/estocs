<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses = array('User');
	public $components = array('Paginator', 'Session','Cookie');




/**
 * index method
 *
 * @return void
 */
	public function index() {


		$this->User->recursive = 1;
		$this->layout='ajax';
		$this->set('users', $this->Paginator->paginate());
	}


	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allowedActions = array('recovery_password','login','rebuildARO');
		$this->Auth->allow('initDB');
		$this->Auth->allow();
		$this->Auth->allow('initDB');

		//$this->Auth->allow('initDB');
	    //$this->Auth->allow('rebuildARO');
	    //$this->Auth->allow('add');
	    $this->Auth->allow('logout');
	    $this->Auth->allow('login');
	    $this->Auth->allow();


	}

	
	public function inicio($filter = null) {


		$user = $this->Auth->user();
		$this->User->recursive = 1;
		$this->User->Catalogue->recursive = 2;
		$conditions['conditions'] = array();
		$conditions['conditions']['id'] = $user['catalogue_id'];
		$arrayCatalogues = $this->User->Catalogue->find('all', $conditions);

		//Instantiation
		App::import('Controller', 'Articles');
	    $ArticlesController = new ArticlesController;

	    $articleAdd      = $ArticlesController->loadArticles($arrayCatalogues,$filter);
		if (empty($filter)) {
			$filter = 'discount';
		}
		switch ($filter) {
			case 'motora':
				$titleName = __('Plantes motores');
				break;
			case 'suggestion':
				$titleName = __('Sugerencias');
				break;
			default:
				$titleName = __('Ofertas');
				break;

		}
		$this->set('titleName',$titleName);
		$this->pageTitle = __('Disponible - Área Privada - '.$titleName);
		$this->set('title_for_layout',$this->pageTitle);

		$this->set('filter',$filter);
		$this->set('articles',$articleAdd);
		//$catalogue = $this->User->Catalogue->find('list');
		
		$this->set('catalogue', $arrayCatalogues);


		$options = array('conditions' => array('User.' . $this->User->primaryKey => 1));
		$this->set('user', $user);


/*
		$this->User->recursive = 0;
		$user = $this->Auth->user();
		//$this->set('users', $this->Paginator->paginate());
		$this->set('user', $user);*/
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout', __('Nuevo usuario'));
		$this->set('option','users_add');
		$this->layout = 'admin';

		$this->Auth->allow();
		if ($this->request->data) {
			$this->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index','admin' => true));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->User->Catalogue->recursive = -1;
		$catalogues = $this->User->Catalogue->find('all');
		$agents = $this->User->Agent->find('list');
		$partners = $this->User->Partner->find('list');
		$this->set(compact('groups', 'catalogues', 'agents', 'partners'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		//$this->layout='ajax';
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index','admin' => true));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}

		$this->layout='ajax';
		$groups = $this->User->Group->find('list');
		$lists = $this->User->List->find('list');
		$agents = $this->User->Agent->find('list');
		$partners = $this->User->Partner->find('list');
		$this->set(compact('groups', 'lists', 'agents', 'partners'));

	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index','admin' => true));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {

		setlocale(LC_ALL, 'esp');
		$this->layout = 'admin';
		$user =  $this->Auth->user();
		$this->set('user', $user);
		$this->User->recursive = 0;
		$this->set('title_for_layout', __('Gestión de usuarios'));
		$this->set('option','admin_index');
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index','admin' => true));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$lists = $this->User->List->find('list');
		$agents = $this->User->Agent->find('list');
		$this->set(compact('groups', 'lists', 'agents'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index','admin' => true));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$lists = $this->User->List->find('list');
		$agents = $this->User->Agent->find('list');
		$this->set(compact('groups', 'lists', 'agents'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index','admin' => true));
	}





	/**
 * login method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function login($origen = null) {

		/*if ($origen =='app') {
			//$this->Session->write('origen', 'app');
			$this->layout = 'default_app';
			$this->Session->write('imInApp',true);
			 $this->Session->write('imInIntranet', false);
		} else {
			$this->Session->write('imInApp',false);
		}*/
		$this->set('title_for_layout',__('Área privada de clientes'));



		//if ($this->Session->read('imInApp')) {
		$this->layout = 'default_app';
		$this->set('title_for_layout',__('Corma'));


		//}

		$locale = $this->Session->read('Config.language');
        setlocale(LC_ALL, $locale);
        $this->set('locale',$locale);


		
		//$this->set('layout_public', 'true');
		//$this->layout = 'ajax';
		$loginIn = $this->checkIfLogged();

		
		if ($this->request->is('post')) {

			//debug($this->request->data).die;

			//if ($this->Session->read('imInApp')) {
				//$this->request['data']['User']['password'] = strtoupper($this->request['data']['User']['password']);
			//}


			//debug($this->request['data']['User']['origen']).die;
            if ($loginIn[0] == false) {
                //return $this->redirect('http://81.46.212.35/corma/usuario-incorrecto/');
                //$this->Session->setFlash(__('Usuario / contraseña incorrectos'), 'default', array(), 'bad');
				
				
                if (!empty($this->request['data']['User']['origen'])) {
                	
            		$msg = __('Usuario / contraseña incorrectos');
                	$this->Session->setFlash($msg, 'default', array(), 'bad');

                	$this->redirect('/');
                } else {
                	$url = 'https://www.corma.es/intranet';
            		$msg = __('Usuario / contraseña incorrectos')."  <strong><a href='".$url."/users/recovery_password'>".__('Clique aquí para recuperar la contraseña')."</a></strong>";


                	$this->Session->setFlash($msg, 'default', array(), 'bad');
                }

				
                return;
            }
        }
		if ($loginIn[0]) {

			
			
			//$this->Cookie->write('logged', 'yes', false);
			$user = $loginIn[1];


			if ($user['group_id'] != 3) {
				$this->Session->write('Config.language', $user['language']);

				//$this->_setLanguage($user['language']);
		        $locale = $this->Session->read('Config.language');
		        setlocale(LC_ALL, $locale);
			}



			//debug($user).die;
			switch ($user['group_id']) {
        		case 1:   //ADMINISTRADOR      			
        			$this->Auth->loginRedirect = array(
			          'controller' => 'users',
			          'action' => 'index',
			          'admin' => true
			        );
        			break;
        		case 2: //COMERCIALS
        			$this->Auth->loginRedirect = array(
			          'controller' => 'Stocks',
			          'action' => 'home'
			        );
        			break;
        			
        		case 3: //CLIENTS
        			if (empty($user['season_catalogue_id'])) {
        				$this->Auth->loginRedirect = array(
				          'controller' => 'Catalogues',
				          'action' => 'index'
				        );
        			} else {
		        		$this->Auth->loginRedirect = array(
				          'controller' => 'customers',
				          'action' => 'index'
				        );
		        	}
        			break;
        		case 4: //SOCIS
        			if  (empty($user['partner_id'])) {		
	        			$this->Auth->loginRedirect = array(
				          'controller' => 'Partners',
				          'action' => 'selection'
				        );		                
		            } 
		           	else {
		           		$this->Auth->loginRedirect = array(
				          'controller' => 'Stocks',
				          'action' => 'index'
				        );
	            		
	            	}
        			break;
        	}
        	//debug($this->Auth->loginRedirect).die;
            return $this->redirect($this->Auth->loginRedirect);
		} 
	}

	
	public function admin_logout() {
		$this->Session->setFlash(__('Se ha cerrado la sesión correctamente.'), 'default', array(), 'good');
		$this->logout();
	}
	public function logout() {





		//$imInApp = $this->Session->read('imInApp');

		//debug($imInApp);

		//debug($this->Auth->logoutRedirect).die;

		//$this->Session->delete('imInApp');
		$this->Session->delete('User.logged');
		//$this->Session->delete('imInCatalog');
		
		//$this->Session->delete('imInIntranet');
		
		$this->Session->setFlash(__('Se ha cerrado la sesión correctamente.'), 'default', array(), 'good');
		$this->Auth->logout();
		$this->set('title_for_layout', __('Cierre de sesión'));

		//if ($imInApp) {
			$this->layout = 'default_app';	

			//debug($this->Auth->logout()).die;

			$this->redirect($this->Auth->logout());	
		//}
		
	}		
	public function changepassword() {
		$this->layout = 'customer';
		$this->set('option','changepassword');
		$user =  $this->Auth->user();
			$this->set('userId',$user['id']);
		$searchUser = '';
		$this->set('title_for_layout','');
		$this->set('title','');
		$this->set('titleName','');
		
		
		if (!empty($this->request->data)) {
			$oldPassword = AuthComponent::password($this->request->data['User']['old_password']);
			$id          = $this->request->data['User']['id'];
			$searchUser  = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.password' => $oldPassword)));
			$newPassword = $this->request->data['User']['password'];
			$repPassword = $this->request->data['User']['password2'];
			$canSave   = true;
			if ($newPassword != $repPassword) {
				$this->Session->setFlash(__('La contraseña no coincide'), 'default', array(), 'bad');
				$canSave = false;	
			}
			if (empty($searchUser)) {
				$this->Session->setFlash(__('La anterior contraseña no es correcta'), 'default', array(), 'bad');
				$canSave = false;
			}

			if ($canSave) {
				
				$saveData['User']             = $searchUser['User'];
				$saveData['User']['hash']     = null;   
				$saveData['User']['password'] = $newPassword;

				if ($this->User->save($saveData)) {
					$this->Session->setFlash(__('Contraseña modificada correctamente'), 'default', array(), 'good');

				} else {
					$this->Session->setFlash(__('Error al guardar la nueva contraseña.Por favor contacte con el administrador'), 'default', array(), 'bad');					
				}				
			} 			
		}
	}
	public function recovery_password($userId = null, $hashId = null) {
		
		$lang = $this->Session->read('Config.language');



		if ($userId != null) {
			$this->User->recursive = -1;
			$user = $this->User->findById($userId);	

			/*$agent_id = $user['User']['agent_id'];

			$agent =  $this->User->Agent->findById($agent_id);	

		

			switch ($agent['Agent']['language']) {
				case 'cat':
					$lang = 'cat';
					break;
				case 'fra':
					$lang = 'fra';
					break;
				case 'ale':
					$lang = 'ale';
					break;
				case 'ing':
					$lang = 'ing';
					break;
				default:
					$lang = 'esp';
					break;

			}	*/

			$catalogue_id = $user['User']['catalogue_id'];

			$catalogue =  $this->User->Catalogue->findById($catalogue_id);

			if (!empty($catalogue)) {
				$arrayIdiomas = array(2 => 'cat',3 => 'fra',4=>'ing',5=>'ale');
				$lang = (isset($arrayIdiomas[$catalogue['Catalogue']['language']])) ? $arrayIdiomas[$catalogue['Catalogue']['language']] : 'esp';

			}


					
			

        	$this->Session->write('Config.language',$lang);
			$locale = $this->Session->read('Config.language');
			setlocale(LC_ALL, $locale);

			$this->set('locale',$locale);




		}

		$this->set('title_for_layout',__('Recuperación de contraseña'));


		if ($userId != null && $hashId != null) {
			$saveData['User'] = $user['User'];
			$saveData['User']['hash'] = null;
			$this->User->save($saveData);
		
		if (count($this->request->data)>0) {

			$newPassword = $this->request->data['User']['password'];
			$repPassword = $this->request->data['User']['password2'];
			$notReturn   = false;
			
			$saveData['User']['password'] = $newPassword;

			if ($this->User->save($saveData)) {
				$this->Session->setFlash(__('Contraseña modificada correctamente.'), 'default', array(), 'good');
			} else {
				$this->Session->setFlash(__('Error al guardar la nueva contraseña.Por favor contacte con el administrador'), 'default', array(), 'bad');
			}
			
			$this->render('login');
		} else {
			if (!empty($user)) {
				$this->set('user', $user);

				$this->render('changepassworduser');	
			}
		}
			
		} else {
			if ($this->request->is('post')) {
				$this->User->recursive = -1;
				$username = $this->request->data['User']['username'];
				$user  = $this->User->findByUsername($username);
				if (!empty($user)) {
					//$saveUser                 = $user;
					$email = $user['User']['email'];


					$catalogue_id = $user['User']['catalogue_id'];

					$catalogue =  $this->User->Catalogue->findById($catalogue_id);

					if (!empty($catalogue)) {
						$arrayIdiomas = array(2 => 'cat',3 => 'fra',4=>'ing',5=>'ale');
						$lang = (isset($arrayIdiomas[$catalogue['Catalogue']['language']])) ? $arrayIdiomas[$catalogue['Catalogue']['language']] : 'esp';

					}

					
					


					

		        	$this->Session->write('Config.language',$lang);
					$locale = $this->Session->read('Config.language');
					setlocale(LC_ALL, $locale);

					$this->set('locale',$locale);



					$hash     = md5($username);
					$saveUser['User']['id']       = $user['User']['id'];
					$saveUser['User']['password'] = $user['User']['password']; 
					$saveUser['User']['hash']     = $hash;
					if ($this->User->save($saveUser, false)) {
						
					$Email = new CakeEmail('default');
				        $Email->emailFormat('html');
				        //$Email->from(array('mbruguera@corma' => 'noreply.corma@gmail.com'));
				        $Email->subject(__('Corma  - Recuperar contraseña'));

				        $email = str_replace(" ","",$email);
				        $email = str_replace(";",",",$email);

				        $Email->to(explode(",", $email));
				        $url = 'https://www.corma.es/intranet';
		        		$link = $url.'/Users/recovery_password/'.$user['User']['id'].'/'.$hash;
		        		//$link = $url.'?u='.$user['User']['id'].'&h='.$hash;
				        $contentEmail ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Corma</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
	<style type="text/css">
	td img {display: block;}
	body {font-family: "Open Sans","Helvetica","Arial";}</style>
</head>
<body>
  	<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" >
		<tr>
   			<td>
   				<img style="margin-bottom:12px" name="'.__('Corma').'"  src="https://www.corma.es/wp-content/uploads/logo_corma_120x120.jpg" border="0" id="'.__('Corma').'" alt="'.__('Corma').'"  />
   			</td>
   		</tr>
   	</table>
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"style=" border: #000 1px solid;">
  		<tr>
   			<td style="font-size: 20px; margin-bottom: 16px; margin-left: 20px; margin-top: 14px; height:30px; color:#000; padding:12px; width:100%; ">'.__('Verifica tu dirección de correo electrónico').
   			'</td>
   		</tr>
   		<tr>
 			<td style="font-size: 16px; margin-bottom: 16px; margin-left: 20px; margin-top: 14px; height:30px; color:#7A7A7A; padding-left:12px; padding-top:12px; padding-bottom:12px; padding-right:12px;">'.
  			__('Hola %s, has solicitado reestablecer tu contraseña del portal de Corma. Por favor pulsa el siguiente enlace para poder cambiar su contraseña',$user['User']['name'].' ('.$user['User']['username'].')').
  			'.</td>
   		</tr>
  		<tr>
 			<td style="font-size: 16px; margin-bottom: 16px; margin-left: 20px; margin-top: 14px; height:30px; color:#666666; padding:12px; width:100% ">
  				<a style="font-size: 14px; background:#6e6b67; color:#FFF; text-decoration:none; padding:5px; " href="'.$link.'">'.__('Cambiar mi contraseña').'</a>
 			</td>
    	</tr>
   		<tr>
 			<td style="font-size: 12px; margin-bottom: 16px; margin-left: 20px; margin-top: 14px; height:30px; color:#7A7A7A; padding-left:12px; padding-bottom:12px; padding-top:12px;">'.__('Si el botón no funciona, copia y pega este enlace en tu navegador <strong>%s</strong>',$link).'</td>
   		</tr>

	</table>
</body>
</html>';
				        if ($Email->send($contentEmail)) {
				          $this->Session->setFlash(__('Se ha enviado un correo electrónico a su cuenta con las instrucciones para cambiar su contraseña'), 'default', array(), 'info');
					} else {
				          $this->Session->setFlash(__('Ha habido algún error al enviar el correo electrónico.'), 'default', array(), 'bad');
				        }
					}
				} else {
					$this->Session->setFlash(__('El nombre de usuario proporcionado no existe en nuestra base de datos.'), 'default', array(), 'bad');
				}
			}
		}


	



	}
	public function initDB() {
	    $group = $this->User->Group;

	    // Allow admins to everything
	    $group->id = 1;
	    $this->Acl->allow($group, 'controllers');

	    
	    // allow users
	    $group->id = 2;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Users/view');
	    $this->Acl->allow($group, 'controllers/Users/inicio');
	    $this->Acl->allow($group, 'controllers/Details/ajaxManageStocksSearch');
		$this->Acl->allow($group, 'controllers/Stocks/ajaxManageStocksSearch');
		$this->Acl->allow($group, 'controllers/Stocks/home');
		$this->Acl->allow($group, 'controllers/Stocks/detail');
		$this->Acl->allow($group, 'controllers/Stocks/ajaxManageStocksTotalSearch');
		



	    
	    
	    $group->id = 3;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Articles/view');
	    $this->Acl->allow($group, 'controllers/ArticlePhotos/index');
	    $this->Acl->allow($group, 'controllers/ArticlePhotos/resize');
	    $this->Acl->allow($group, 'controllers/ArticleCollections/lista');
	    $this->Acl->allow($group, 'controllers/ArticleCollections/lista');
	    $this->Acl->allow($group, 'controllers/ArticleNovelties/index');
		$this->Acl->allow($group, 'controllers/CashOrders/view');
		$this->Acl->allow($group, 'controllers/CashOrders/send');
		$this->Acl->allow($group, 'controllers/CashOrders/savecashorder');
	    $this->Acl->allow($group, 'controllers/CashOrderDetails/view');
	    $this->Acl->allow($group, 'controllers/CashOrderDetails/saveonline');
	    $this->Acl->allow($group, 'controllers/CashOrderDetails/duplicate');
	    $this->Acl->allow($group, 'controllers/Catalogues');
	    $this->Acl->allow($group, 'controllers/Customers/index');
	    $this->Acl->allow($group, 'controllers/Invoices/view');
	    $this->Acl->allow($group, 'controllers/InvoiceDetails/saveonline');	    
	    $this->Acl->allow($group, 'controllers/Payments/view');
	    $this->Acl->allow($group, 'controllers/Petitions/add');
	    $this->Acl->allow($group, 'controllers/PlantTypes/index');
	    $this->Acl->allow($group, 'controllers/Products');
	    $this->Acl->allow($group, 'controllers/SeasonCatalogues');
	    $this->Acl->allow($group, 'controllers/Users/view');
	    $this->Acl->allow($group, 'controllers/Users/inicio');
	    $this->Acl->allow($group, 'controllers/Users/rebuildARO');
		$this->Acl->allow($group, 'controllers/Users/changepassword');
		$this->Acl->allow($group, 'controllers/Users/recovery_password');
		$this->Acl->allow($group, 'controllers/Users/checkIfLogged');
	    

	    
	    $group->id = 4;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Stocks');
		$this->Acl->allow($group, 'controllers/Stocks/index');
		$this->Acl->allow($group, 'controllers/Stocks/ajaxManageStocksSearch');
		$this->Acl->allow($group, 'controllers/Stocks/edit');
		$this->Acl->allow($group, 'controllers/Stocks/add');    
		$this->Acl->allow($group, 'controllers/Details/');
		$this->Acl->allow($group, 'controllers/Details/index');
		$this->Acl->allow($group, 'controllers/Details/ajaxManageStocksSearch');
		$this->Acl->allow($group, 'controllers/Details/add');
		$this->Acl->allow($group, 'controllers/Details/edit');
		$this->Acl->allow($group, 'controllers/Details/view');
		$this->Acl->allow($group, 'controllers/Details/delete');
		$this->Acl->allow($group, 'controllers/Galleries/');
		$this->Acl->allow($group, 'controllers/Galleries/index');
		$this->Acl->allow($group, 'controllers/Galleries/add');
		$this->Acl->allow($group, 'controllers/Galleries/delete');
		$this->Acl->allow($group, 'controllers/Galleries/principal');
		$this->Acl->allow($group, 'controllers/Partners/selection');
		$this->Acl->allow($group, 'controllers/Articles/selection');
		$this->Acl->allow($group, 'controllers/ImagesQualities/show');
		$this->Acl->allow($group, 'controllers/ImagesQualities/add');
		$this->Acl->allow($group, 'controllers/ImagesQualities/edit');


	    // allow basic users to log out
	    $this->Acl->allow($group, 'controllers/users/logout');
	    $this->Acl->allow($group, 'controllers/users/login');

	    // we add an exit to avoid an ugly "missing views" error message
	    echo "all done";
	    exit;
        //corma.site/acl_manager/acl/update_aros
	}


function rebuildARO() {



	ini_set('max_execution_time', 0);
	ini_set('max_input_time', 0);


	// Build the groups.
	$groups = $this->Group->find('all');
	$aro = new Aro();
	foreach($groups as $group) {
		$aro->create();
		$aro->save(array(
		//	'alias'=>$group['Group']['name'],
			'foreign_key' => $group['Group']['id'],
			'model'=>'Group',
			'parent_id' => null
		));
	}

	$this->User->recursive = -1;
 
	// Build the users.
	$users = $this->User->find('all');
	//debug($users).die;
	$i=0;
	foreach($users as $user) {
		$aroList[$i++]= array(
		//	'alias' => $user['User']['email'],
			'foreign_key' => $user['User']['id'],
			'model' => 'User',
			'parent_id' => $user['User']['group_id']
		);	
	}
	foreach($aroList as $data) {
		$aro->create();
		$aro->save($data);
	}
 
	echo "AROs rebuilt!";
	exit;
}
	

}
