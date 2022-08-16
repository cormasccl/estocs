<?php
App::uses('AppController', 'Controller');
App::uses('ArticlesController', 'Controller');
/**
 * Catalogues Controller
 *
 * @property Catalogue $Catalogue
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CataloguesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	

	
	public function index($filter = null, $pagina = null, $filterid = null) {

		$this->set('option', 'disponible');




		/*$sCustomer = '';
		if (!empty($custom)) {
			$sCustomer = ($custom == 'compra') ? 'compra' : 'nocompra';
		}
	
		$this->Session->write('Config.customer',$sCustomer);
		$sKindOfCustomer = $this->Session->read('Config.customer');

		$sSubmenu = false;
		if (!empty($sKindOfCustomer)) {
			$sSubmenu = ($sKindOfCustomer == 'nocompra') ? 'customer_nocompra' : 'customer';
		}
		$this->set('custom', $custom);
		$this->set('submenu', $sSubmenu);*/
		$this->layout = 'customer';

		$user = $this->Auth->user();



		$email = $user['email'];
		$email = str_replace(' ','',$email);
		$email = str_replace(',',';',$email);

		$arrayEmails = explode(';',$email);

		$this->loadModel('UsersNewsletter');

		

		$mostrarPopup = true;

		foreach ($arrayEmails as $emailCustomer) {
			$nw = $this->UsersNewsletter->findByEmail($emailCustomer);

			if (!empty($nw)) {				
				if ($nw['UsersNewsletter']['aceptado_rgpd'] == 1 || $nw['UsersNewsletter']['rechazado_rgpd'] == 1 ) {
					$mostrarPopup = false;
				}  
			}
		}
		if ($filter != null) {
			$mostrarPopup = false;
		}
		$this->set('mostrarPopup',$mostrarPopup);	



		if (empty($user['catalogue_id'])) {
			$user['catalogue_id'] = 0;
		}

		$this->loadModel('User');
		$this->User->recursive = 1;


		if  ($user['catalogue_id'] != 0 ) {
			$this->loadModel('Collection');
			$this->Collection->recursive = 1;
			$coleccions = $this->Collection->find('all');
			$coleccions = Hash::extract($coleccions,'{n}.Collection');

			//Busquem si hi ha una comanda oberta, sino la creem 
			$this->loadModel('CashOrder');
			$this->CashOrder->recursive = -1;
			$cashOrder = $this->CashOrder->find('first', array('conditions' => array('CashOrder.user_id' => $user['id'], 'CashOrder.status_id' => 1)));

			if (empty($cashOrder)) {
				$arrayCashOrder = array();
				$arrayCashOrder['user_id']   = $user['id'];
				$arrayCashOrder['status_id'] = 1;
				$this->CashOrder->create();
				if ($this->CashOrder->save($arrayCashOrder)) {
					$this->Session->write('cash_order_id',$this->CashOrder->getLastInsertID());
				}
			} else {
				$this->Session->write('cash_order_id',$cashOrder['CashOrder']['id']);
			}
			//----

			//Carguem el detall de la comanda actual
			$this->loadModel('CashOrderDetail');
			$cashOrderDetails = $this->CashOrderDetail->find('all', array('conditions' => array('CashOrderDetail.cash_order_id' =>$this->Session->read('cash_order_id'))));
			$cashOrderDetails = Hash::extract($cashOrderDetails,'{n}.CashOrderDetail');
			$total = array();
			$total['importTotal'] = $total['carrisTotal'] = 0;


		



			foreach($cashOrderDetails as $detail) {
				$total['importTotal'] += ($detail['real_unities']*$detail['price']);
				$total['carrisTotal'] += $detail['carris_article'];
			}
			
			foreach ($cashOrderDetails as $num => $detail) {
				$art = $this->CashOrderDetail->Article->findById($detail['article_id']);
				
				$cashOrderDetails[$num]['description'] = $art['Product']['description'];
				$cashOrderDetails[$num]['common_name'] = $art['Product']['common_name'];
				$cashOrderDetails[$num]['name']        = $art['Article']['name'];

			}
			$this->set('total', $total);
			$this->set('cashorderdetails', $cashOrderDetails);
			$this->set('cash_order', $this->Session->read('cash_order_id'));
			//---

			//Carreguem l'idioma del disponible
			$this->User->Catalogue->recursive = -1;
			$conditions['conditions'] = array();
			$conditions['conditions']['id'] = $user['catalogue_id'];
		
			$arrayCatalogues = $this->Catalogue->find('first', $conditions);

			$idiom = 'esp';
			//$arrayCatalogues = $this->Catalogue->find('all', $conditions);

			$this->Session->write('Config.language','esp');
			if (!empty($arrayCatalogues)) {
				$arrayIdioms = array(2 => 'cat',3 => 'fra');
				$idiom = (isset($arrayIdioms[$arrayCatalogues['Catalogue']['language']])) ? $arrayIdioms[$arrayCatalogues['Catalogue']['language']] : 'esp';


			}
			$this->Session->write('Config.language',$idiom);
			$locale = $this->Session->read('Config.language');
			setlocale(LC_ALL, $locale);

			$this->set('locale',$locale);
			
			//Instantiation
			

			$ArticlesController = new ArticlesController;
			$ArticlesController->constructClasses();

			if (empty($filter)) {
				$filter = 'discount';
			}

			if ($filter =='discount') {
				$this->loadModel('CatalogueArticle');
				$catalogue_id = $arrayCatalogues['Catalogue']['id'];
				$hay_ofertas = $ArticlesController->existsArticlesOferta($catalogue_id);
				if ($hay_ofertas == false) {
					$filter = 'gamma';
				}
			}




			$limit = 10;

			if ($filter == 'christmas') {
				$limit = 20;
			}
			if (empty($pagina)) 
				$pagina = 1;

			$sqlCol = "select distinct Collection.id, Collection.code, Collection.description ";
			$sqlCol .= "from catalogue_articles CatalogueArticle, article_collections ArticleCollection, ";
			$sqlCol .= "collections Collection ";
			$sqlCol .= "where CatalogueArticle.catalogue_id = ".$user['catalogue_id']." and ";
			$sqlCol .= "CatalogueArticle.article_id = ArticleCollection.article_id and ";
			$sqlCol .= "ArticleCollection.collection_id = Collection.id order by Collection.description ";

			$this->loadModel('Collection');
			$coleccions = $this->Collection->query($sqlCol);			

			$sqlClassif = "select distinct CatalogueClassification.id, CatalogueClassification.description, CatalogueClassification.orden  ";
			$sqlClassif .= "from catalogue_articles CatalogueArticle, catalogue_classifications CatalogueClassification, ";
			$sqlClassif .= "catalogue_classifications CatalogueSubClassification ";
			$sqlClassif .= "where CatalogueArticle.catalogue_id = ".$user['catalogue_id']." and ";
			$sqlClassif .= "CatalogueArticle.catalogue_classification_id = CatalogueSubClassification.id and ";
			$sqlClassif .= "CatalogueSubClassification.catalogue_classification_id = CatalogueClassification.id ";
			$sqlClassif .= "order by CatalogueClassification.orden ";

			$this->loadModel('CatalogueClassification');
			$catalogueClassification = $this->CatalogueClassification->query($sqlClassif);	

			$arrayClassif = array();

			$cont = 0;

			foreach ($catalogueClassification as $group => $classif) {
				$sqlClassif = "select distinct CatalogueClassification.id, CatalogueClassification.description, CatalogueClassification.orden  ";
				$sqlClassif .= "from catalogue_articles CatalogueArticle, catalogue_classifications CatalogueClassification ";
				$sqlClassif .= "where CatalogueArticle.catalogue_id = ".$user['catalogue_id']." and ";
				$sqlClassif .= "CatalogueArticle.catalogue_classification_id = CatalogueClassification.id and ";
				$sqlClassif .= "CatalogueClassification.catalogue_classification_id = ".$classif['CatalogueClassification']['id']." ";
				$sqlClassif .= "order by CatalogueClassification.orden ";

				$subClassif = $this->CatalogueClassification->query($sqlClassif);
				$subClassif = Hash::extract($subClassif,'{n}.CatalogueClassification');
				$catalogueClassification[$group]['SubClassificacio'] = $subClassif;
			}
			
			if ($filter == 'search') {
				$valorBusqueda = $this->request->query['s'];
				$sql  = $this->getQueryArticles($user['catalogue_id']);
				$sql .= " and (Product.description LIKE '%".$valorBusqueda."%' OR ";
				$sql .= "Product.common_name LIKE '%".$valorBusqueda."%' OR ";
				$sql .= "Article.name LIKE '%".$valorBusqueda."%') ";


				$this->loadModel('CatalogueArticle');
				$this->CatalogueArticle->recursive =2;
				$articles = $this->CatalogueArticle->query($sql);
			
			} else {
				$catalogue_id = $user['catalogue_id'];
				$articles     = $ArticlesController->loadArticlesCatalogue($catalogue_id,$filter, $limit, $pagina, $filterid);	
			}


			$catalogue_id = $arrayCatalogues['Catalogue']['id'];



			
			$articleAdd   = $ArticlesController->loadArticlesCatalogue($catalogue_id,$filter, $limit, $pagina, $filterid);

		    $this->set('actual_page', $pagina);
		    $this->set('limit', $limit);

			switch ($filter) {
				case 'motora':
					$titleName = __('Plantas motoras (PRECIOS NETOS DEFINITIVOS)');
					break;
				case 'suggestion':
					$titleName = __('Sugerencias');
					break;
				case 'novelty':
					$titleName = __('Novedades');
					break;
				case 'collection':
					$titleName = '';				
					break;
				case 'compositions':
					$titleName = __('Composiciones Corma');
					break;
				case 'christmas':
					$titleName = __('Navidad');
					break;
				case 'gamma':
					$titleName = '';
					break;
				case 'discount':
					$titleName = __('Ofertas');
					break;
				case 'search':
					$titleName = __('Resultados búsqueda');
					break;
				default:
					$titleName = __('Artículos seleccionados');
			}

			$this->set('total_registers', count($articles));

			$this->set('hay_ofertas', $ArticlesController->existsArticlesOferta($catalogue_id));
			$this->set('hay_motoras', $ArticlesController->existsArticlesMotora($catalogue_id));
			$this->set('hay_novedades', $ArticlesController->existsArticlesNovedades($catalogue_id));
			$this->set('hay_composiciones', $ArticlesController->existsArticlesComposiciones($catalogue_id));
			$this->set('hay_navidad', $ArticlesController->existsArticlesNavidad($catalogue_id));
		   
			
			if ($filter=='gamma' || $filter =='collection') {
				$total_registers = 0;
				
				$lastCount = $pagina * $limit;
				$initialCount = $lastCount - $limit + 1;

				$counter = 1;
				$newArray = array();
				$arrayArticles = array();
				$pos = 0;

				//$llistaArticles = array();
				foreach ($articles as $group => $allArticles) {
					$total_registers += count($allArticles);

					$trobat = false;

$newArray = array();

					foreach($allArticles as $article) {
						if ($counter >= $initialCount && $counter <= $lastCount) {
							
							$newArray[] = $article;
							$trobat = true;
						}
						$counter++;
					}


					if (isset($articles[$group]['parent_name'])) {
						$newArray['parent_name'] = $articles[$group]['parent_name'];

					}
					if ($trobat) {
						$arrayArticles[$group] = $newArray;
						$pos++;
					}

					//debug($arrayArticles);
				}
				$articles = $arrayArticles;
				
				$this->set('total_registers', $total_registers);
			}



			$this->set('filter',$filter);
			$this->set('filterid', $filterid);


			$this->set('collections', $coleccions);
			$this->set('catalogueClassification',$catalogueClassification);
			$this->set('articles',$articles);
			//$catalogue = $this->User->Catalogue->find('list');
			$this->set('catalogue', $arrayCatalogues);

			$this->pageTitle = __('Disponible semana').' '.$arrayCatalogues['Catalogue']['last_week'];
		

		} else {
			$titleName = "";
			$this->pageTitle = "";
			$filter = 'invoices';
		}

		$this->set('titleName',$titleName);
		
		
		$this->set('title_for_layout',$this->pageTitle);

		$options = array('conditions' => array('User.' . $this->User->primaryKey => 1));
		$this->set('user', $user);

		if ($filter == 'collection') {
			$this->render('collection');
		} 
		if ($filter == 'gamma') {
			$this->render('gamma');
		} 
		if ($filter == 'cart') {
			$this->render('cart');
		} 
		if ($filter == 'send') {
			$this->render('send');
		}
		if ($filter == 'preview') {
			$this->render('preview');
		}
		if ($filter == 'search') {
			$this->render('search');
		}
		if ($filter == 'invoices') {
			$this->redirect(array('controller' => 'CashOrders', 'action' => 'view'));
		}
	}


	public function search()
	{
		$valorBusqueda = $this->request->query['s'];
		$this->set('title_for_layout','');
		$this->layout = 'customer';
		$user = $this->Auth->user();

		$ArticlesController = new ArticlesController;
		$ArticlesController->constructClasses();

		$conditions['conditions'] = array();
		$conditions['conditions']['id'] = $user['catalogue_id'];

		$sql  = $this->getQueryArticles($user['catalogue_id']);
		$sql .= " and (Product.description LIKE '%".$valorBusqueda."%' OR ";
		$sql .= "Product.common_name LIKE '%".$valorBusqueda."%' OR ";
		$sql .= "Article.name LIKE '%".$valorBusqueda."%') ";


		$this->loadModel('CatalogueArticle');
		$this->CatalogueArticle->recursive =2;
		$articles = $this->CatalogueArticle->query($sql);
	
		$this->set('filter','search');
		$this->set('titleName',__('Resultados busqueda'));
		$this->set('articles', $articles);

		$this->loadModel('CashOrderDetail');
		$cashOrderDetails = $this->CashOrderDetail->find('all', array('conditions' => array('CashOrderDetail.cash_order_id' =>$this->Session->read('cash_order_id'))));
		$cashOrderDetails = Hash::extract($cashOrderDetails,'{n}.CashOrderDetail');
		$total = array();
		$total['importTotal'] = $total['carrisTotal'] = 0;
		foreach($cashOrderDetails as $detail) {
			$total['importTotal'] += ($detail['real_unities']*$detail['price']);
			$total['carrisTotal'] += $detail['carris_article'];
		}
		
		foreach ($cashOrderDetails as $num => $detail) {
			$art = $this->CashOrderDetail->Article->findById($detail['article_id']);
			
			$cashOrderDetails[$num]['description'] = $art['Product']['description'];
			$cashOrderDetails[$num]['common_name'] = $art['Product']['common_name'];
			$cashOrderDetails[$num]['name']        = $art['Article']['name'];

		}
		$this->set('cashorderdetails', $cashOrderDetails);
		$this->set('cash_order', $this->Session->read('cash_order_id'));

		$this->layout = 'customer';
		//$this->render('index');

	}


	private function getQueryArticles($catalogue_id)
	{

		$locale = $this->Session->read('Config.language');


		$sql = "select Article.id, Article.name, Article.ean, Article.code, Product.id, ";
		$sql .= "i18n.content as common_name, Product.description, Family.code, CatalogueArticle.price, ";
		$sql .= "CatalogueArticle.observations, CatalogueArticle.base_price, ";
		$sql .= "CatalogueArticle.per_box, CatalogueArticle.boxes_per_floor, ";
		$sql .= "CatalogueArticle.carri_floor, CatalogueArticle.show_unities, ";
		$sql .= "CatalogueArticle.show_boxes, CatalogueArticle.customer_code, ";
		$sql .= "CatalogueArticle.growing_id, CatalogueArticle.flowering_id, ";
		$sql .= "CatalogueArticle.warehouse, CatalogueArticle.novelty, ";
		$sql .= "coalesce((select photo from article_photos ArticlePhotos ";
		$sql .= "where ArticlePhotos.article_id = CatalogueArticle.article_id and ";
		$sql .= "ArticlePhotos.warehouse = CatalogueArticle.warehouse and ";
		$sql .= "coalesce(ArticlePhotos.growing_id,0) = CatalogueArticle.growing_id and ";
		$sql .= "coalesce(ArticlePhotos.flowering_id,0) = CatalogueArticle.flowering_id), ";
		$sql .= "(select photo ";
		$sql .= "from article_photos ArticlePhotos ";
		$sql .= "where ArticlePhotos.article_id = CatalogueArticle.article_id and ";
		$sql .= "ArticlePhotos.warehouse is null and ";
		$sql .= "coalesce(ArticlePhotos.growing_id,0) = CatalogueArticle.growing_id and ";
		$sql .= "coalesce(ArticlePhotos.flowering_id,0) = CatalogueArticle.flowering_id)) Photo ";
		$sql .= "from catalogue_articles CatalogueArticle, ";
		$sql .= "articles Article, ";
		$sql .= "products Product, families Family, i18n ";
		$sql .= "where CatalogueArticle.catalogue_id = ".$catalogue_id." and ";
		$sql .= "CatalogueArticle.article_id = Article.id and ";
		$sql .= "Article.product_id = Product.id and ";
		$sql .= "Product.family_id = Family.id and ";
		$sql .= "Product.id = i18n.foreign_key and ";
		$sql .= "i18n.model = 'Product' and i18n.field = 'common_name' and ";
		$sql .= "i18n.locale = '".$locale."' ";

		return $sql;
	}

}
