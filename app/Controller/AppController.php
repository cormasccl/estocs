<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
		public $components = array(
        'DebugKit.Toolbar',
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'username', 'password' => 'password'
                    )
                ),
            )
        ),
        'Session',
        'Flash'
    );
    public $helpers = array(
        'Session',
        'Html',// => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form',// => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator',// => array('className' => 'BoostCake.BoostCakePaginator')
    );

    public $uses = array('Group');


    private function _setLanguage($lang = 'esp') {
        if ($this->Session->read('Config.language') != Configure::read('Config.language')) {
            $lang = $this->Session->read('Config.language');
        }
        $sLanguage = (!empty($lang)) ? $lang : 'esp';
        $this->Session->write('Config.language', $sLanguage);
        Configure::write('Config.language',$lang);
        //$this->Cookie->write('lang', $lang, false, '20 days');

    }

    public function checkIfLogged() {
        $loginIn = false;
        $user    = array();

        if ($this->Auth->login()) {
            
            $loginIn = true;
            $user =  $this->Auth->user();
            $this->Session->write('User.logged', $user);
        }
        if ($this->Session->check('User.logged')) {
            $loginIn = true;
            $user = $this->Session->read('User.logged');
        }
        return array($loginIn, $user);
    }


    public function checkIfApp() {
       if ($this->Session->check('origen')) {
            return true;
        }
    }

    
    public function beforeFilter() {


        if ($_SERVER['HTTP_HOST'] != 'cormaweb.site') {

        if ( !$this->request->is('ssl') )
        {
            $this->redirect( str_replace('http://', 'https://', Router::url('', true )) );
        }
    }



        $this->response->disableCache();

        //detectem l'idioma que hi hagi per defecte de wordpress

       
	   


        $user = $this->Session->read('User.logged');

       


        $user = $this->Auth->user();
        $this->set('user',$user);


        /*if (empty($user)) {
            $idiomaWordpress = true;
        } else {
            if ($imInIntranet) {
                $idiomaWordpress = false;
            } else {
                 $idiomaWordpress = true;
            }
        }


        
	    if (!empty($_COOKIE['_icl_current_language']) && $idiomaWordpress) {
            $languageWP = $_COOKIE['_icl_current_language'];



            switch ($languageWP) {
                case 'es':
                    $idiomaCake = 'esp';
                    break;
                case 'ca':
                    $idiomaCake = 'cat';
                    break;
                case 'fr':
                    $idiomaCake = 'fra';
                    break;
                case 'de':
                    $idiomaCake = 'ale';
                    break;
                case 'en':
                    $idiomaCake = 'ing';
                    break;
                default:
                    $idiomaCake = 'esp';
                    break;
            }
            Configure::write('Config.language',$idiomaCake);
            $this->Session->write('Config.language', $idiomaCake);

        }*/


        Configure::write('Config.language','cat');
        $this->Session->write('Config.language', 'cat');
        

/*
        /intranet/users/login
/intranet/Products/search
*/
        //permet afegir usuaris

        //$urlActual = ($_SERVER['HTTP_HOST'] == 'corma.site') ? '' : 'http://'.$_SERVER['HTTP_HOST'].'/corma/intranet';
        
        if ($_SERVER['HTTP_HOST'] == 'cormaweb.site') {
            $urlActual = '/app';
        } else {
            $urlActual = ($_SERVER['HTTP_HOST'] == '81.46.212.35') ? '/corma/' : '';
        }

        $requestUri = $_SERVER['REQUEST_URI'];
		//$requestUri = '/';
        //debug($requestUri).die;
        $this->set('urlActual', $urlActual);
        $this->set('requestUri', $requestUri);
        
      
        
        
        $this->_setLanguage(Configure::read('Config.language'));
        //$this->Cookie->write('lang', $this->params['language'], false, '20 days');
        $locale = $this->Session->read('Config.language');
        setlocale(LC_ALL, $locale);
        // if ($locale && file_exists(APP.'View'.DS.$this->viewPath.DS.$locale)) {
        //     $this->viewPath = $this->viewPath. DS . $locale;
        // }
        $this->set('locale',$locale);


    
		$this->Auth->logoutRedirect = array(
		  'controller' => 'users',
		  'action' => 'login'
		);

		$this->Auth->loginAction = array(
			'controller' => 'users',
			'action' => 'login'
		);

        


		$this->set('catalogue_id', $user['catalogue_id']);  
        $this->set('season_catalogue_id', $user['season_catalogue_id']);
        
        //$this->set(compact('page', 'subpage', 'title_for_layout'));

    



    }

    public function str_price($price) {
        $price = str_replace(".", ",", $price);

        return $price." €";
    }


    public function _getGrowings()
    {
        $this->loadModel('Growing');
        $growings = $this->Growing->find('list',  array('order'=>'Growing.sorting'));       
            $user =  $this->Auth->user();

        $this->Growing->recursive = -1;

        foreach ($growings as $key => $value) {

            $code = $this->Growing->findById($key);
            if ($code['Growing']['code'] != 'CP' /*or $user['user_quality'] == 1*/) {
                $return[$key] = $code['Growing']['code'].' - '.$value;
                //$growings[$key] = $code['Growing']['code'].' - '.$value;
            }
        }


        
        return $return;
    }

    public function _getFlowerings()
    {
        $this->loadModel('Flowering');
        $flowerings = $this->Flowering->find('list', array('order'=>'Flowering.sorting'));       

        $this->Flowering->recursive = -1;

        foreach ($flowerings as $key => $value) {
            $code = $this->Flowering->findById($key);
            //debug($code);
            $flowerings[$key] = $code['Flowering']['code'].' - '.$value;
        }

        return $flowerings;
    }

}
