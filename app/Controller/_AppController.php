<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
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


        if ( !$this->request->is('ssl') )
        {
            $this->redirect( str_replace('http://', 'https://', Router::url('', true )) );
        }



        $this->response->disableCache();

        //detectem l'idioma que hi hagi per defecte de wordpress

        $imInCatalog = (stristr($_SERVER['REQUEST_URI'], 'Catalogues') === FALSE) ? false : true;

        //$imInApp = (stristr($_SERVER['REQUEST_URI'], 'app') === FALSE) ? false : true;



        if (stristr($_SERVER['REQUEST_URI'], 'app') || stristr($_SERVER['REQUEST_URI'], 'Stocks') || stristr($_SERVER['REQUEST_URI'], 'Galleries') || stristr($_SERVER['REQUEST_URI'], 'Details') || stristr($_SERVER['REQUEST_URI'], 'Partners')) {
            $imInApp = true;
        } else {
            $imInApp = false;
        }



        $user = $this->Session->read('User.logged');

        if (empty($user)) { 
            $imInIntranet = false;
        } else {
            if (stristr($_SERVER['REQUEST_URI'], 'products') || stristr($_SERVER['REQUEST_URI'], 'users'))  {
                if (stristr($_SERVER['REQUEST_URI'],'changepassword')) {
                    $imInIntranet = TRUE;
                } else {
                    $imInIntranet = FALSE;
                }
            } else {
                $imInIntranet = TRUE;
            }
        }


        /*if ($this->Session->read('imInApp')) {
            $imInIntranet = false;
        }*/

        $this->Session->write('imInApp', $imInApp);

        $this->Session->write('imInIntranet', $imInIntranet);


        $this->Session->write('imInCatalog', $imInCatalog);



        $user = $this->Auth->user();
        $this->set('user',$user);
        
	    if (!empty($_COOKIE['_icl_current_language']) && empty($user)) {

            $languageWP = $_COOKIE['_icl_current_language'];


            if ($languageWP == 'es') {
                Configure::write('Config.language','esp');
                $this->Session->write('Config.language', 'esp');
            }
                //$this->_setLanguage('esp');

            if ($languageWP == 'ca')  {
                Configure::write('Config.language','cat');
                $this->Session->write('Config.language', 'cat');
            }
                //$this->_setLanguage('cat');

            if ($languageWP == 'fr') {
                Configure::write('Config.language','fra');
                $this->Session->write('Config.language', 'fra');
            }
                //$this->_setLanguage('fra');

        }
        //permet afegir usuaris

        //$urlActual = ($_SERVER['HTTP_HOST'] == 'corma.site') ? '' : 'http://'.$_SERVER['HTTP_HOST'].'/corma/intranet';
        
        if ($_SERVER['HTTP_HOST'] == 'cormaweb.site') {
            $urlActual = '/intranet';
        } else {
            $urlActual = ($_SERVER['HTTP_HOST'] == '81.46.212.35') ? '/corma/intranet' : '/intranet';
        }

        $requestUri = $_SERVER['REQUEST_URI'];
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


    
        if ($imInApp) {
            $this->Auth->logoutRedirect = array(
              'controller' => 'users',
              'action' => 'login','app'
            );

            $this->Auth->loginAction = array(
                'controller' => 'users',
                'action' => 'login',
                'app'
            );

        } else {
            $this->Auth->logoutRedirect = array(
              'controller' => 'users',
              'action' => 'login'
            );

            $this->Auth->loginAction = array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => false,
                'plugin' => false
            );
        }



       
        //Configure AuthComponent
        // $this->Auth->loginAction = array(
        //   'controller' => 'users',
        //   'action' => 'login'
        // );
        $this->set('catalogue_id', $user['catalogue_id']);  
        $this->set('season_catalogue_id', $user['season_catalogue_id']);
        
        $this->set(compact('page', 'subpage', 'title_for_layout'));

    



    }

    public function str_price($price) {
        $price = str_replace(".", ",", $price);

        return $price." €";
    }
}
