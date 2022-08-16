<?php
App::uses('AppController', 'Controller');
App::uses('ArticlesController', 'Controller');
/**
 * SeasonCatalogues Controller
 *
 * @property SeasonCatalogue $SeasonCatalogue
 * @property PaginatorComponent $Paginator
 */
class SeasonCataloguesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index($filter = null, $pagina = null, $filterid = null) {

		$this->set('option', 'catalogo');

		$this->layout = 'customer';
		$user = $this->Auth->user();
		$this->loadModel('User');
		$this->User->recursive = 1;
		$this->loadModel('Collection');
		$this->Collection->recursive = 1;
		$coleccions = $this->Collection->find('all');

		$coleccions = Hash::extract($coleccions,'{n}.Collection');


		$this->User->SeasonCatalogue->recursive = 2;
		//$this->User->Catalogue->SeasonCatalogue->recursive = 2;
		$conditions['conditions'] = array();
		$conditions['conditions']['id'] = $user['season_catalogue_id'];
		$arraySeasonCatalogues = $this->SeasonCatalogue->find('all', $conditions);



		$this->Session->write('Config.language','esp');
		/*if (!empty($arrayCatalogues)) {
			switch ($arrayCatalogues[0]['Catalogue']['language']) {
				case 2:
					$this->Session->write('Config.language','cat');
	        		break;
				case 3:
					$this->Session->write('Config.language','fra');
	        		break;
	        	default:
	        		$this->Session->write('Config.language','esp');
			}	
		}*/
		$locale = $this->Session->read('Config.language');
		setlocale(LC_ALL, $locale);
		//Instantiation
	

		$ArticlesController = new ArticlesController;
		$ArticlesController->constructClasses();

		if (empty($filter)) {
			$filter = 'motora';
		}

		$limit = 10;
		if (empty($pagina)) 
			$pagina = 1;


	    $articleAdd      = $ArticlesController->loadArticlesSeasonCatalogue($arraySeasonCatalogues,$filter, $limit, $pagina, $filterid);


	    $this->set('actual_page', $pagina);
	    $this->set('limit', $limit);

	    $this->set('total_registers', count($articleAdd));
	    
		switch ($filter) {
			case 'motora':
				$titleName = __('Plantas motoras (PRECIOS NETOS DEFINITIVOS)');
				break;
			case 'suggestion':
				$titleName = __('Sugerencias');
				break;
			case 'collection':
				$titleName = '';				
				break;
			case 'gamma':
				$titleName = '';
				break;
			case 'discount':
				$titleName = __('Ofertas');
				break;
			default:
				$titleName = __('Artículos seleccionados');
		}
		

		if ($filter=='gamma' || $filter =='collection') {
			$total_registers = 0;
			
			$lastCount = $pagina * $limit;
			$initialCount = $lastCount - $limit + 1;

			$counter = 1;
			$newArray = array();
			$arrayArticles = array();
			$pos = 0;

			//$llistaArticles = array();
			foreach ($articleAdd as $group => $allArticles) {
				$total_registers += count($allArticles);

				$trobat = false;
				foreach($allArticles as $article) {
					if ($counter >= $initialCount && $counter <= $lastCount) {
						$newArray[] = $article;
						$trobat = true;

					}

					$counter++;
				}
				if ($trobat) {
					$arrayArticles[$group] = $newArray;
					$pos++;
				}
			}
			$articleAdd = $arrayArticles;

			$this->set('total_registers', $total_registers);
		}


		$this->set('titleName',$titleName);
		$this->pageTitle = __('Catálogo - Área Privada - '.$titleName);
		$this->set('title_for_layout',$this->pageTitle);

		$this->set('filter',$filter);
		$this->set('filterid', $filterid);

		$this->set('collections', $coleccions);
		$this->set('articles',$articleAdd);


		//$catalogue = $this->User->Catalogue->find('list');
		$this->set('seasoncatalogue', $arraySeasonCatalogues);
		$options = array('conditions' => array('User.' . $this->User->primaryKey => 1));
		$this->set('user', $user);

		if ($filter == 'collection') {
			$this->render('collection');
		} 
		if ($filter == 'gamma') {
			$this->render('gamma');
		} 
		 


		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SeasonCatalogue->exists($id)) {
			throw new NotFoundException(__('Invalid season catalogue'));
		}
		$options = array('conditions' => array('SeasonCatalogue.' . $this->SeasonCatalogue->primaryKey => $id));
		$this->set('seasonCatalogue', $this->SeasonCatalogue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SeasonCatalogue->create();
			if ($this->SeasonCatalogue->save($this->request->data)) {
				$this->Session->setFlash(__('The season catalogue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The season catalogue could not be saved. Please, try again.'));
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
		if (!$this->SeasonCatalogue->exists($id)) {
			throw new NotFoundException(__('Invalid season catalogue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SeasonCatalogue->save($this->request->data)) {
				$this->Session->setFlash(__('The season catalogue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The season catalogue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SeasonCatalogue.' . $this->SeasonCatalogue->primaryKey => $id));
			$this->request->data = $this->SeasonCatalogue->find('first', $options);
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
		$this->SeasonCatalogue->id = $id;
		if (!$this->SeasonCatalogue->exists()) {
			throw new NotFoundException(__('Invalid season catalogue'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SeasonCatalogue->delete()) {
			$this->Session->setFlash(__('The season catalogue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The season catalogue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
