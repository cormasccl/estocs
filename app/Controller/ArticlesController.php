<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Article $Article
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ArticlesController extends AppController {

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
		$this->layout='ajax';
		$this->Product->recursive = 0;
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Article->recursive = 2;
		$article = $this->Article->findById($id);


		$this->layout='ajax';
		$this->set('article', $article);
	}

/**
 * novedades method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function novedades($language = 'cat')
	{
		$this->Session->write('Config.language',$language);
		$locale = $this->Session->read('Config.language');
        setlocale(LC_ALL, $locale);


        $conditions = array('novelty'=>1);

        $conditions = array(
		    array(
		        'novelty ='=>1
		    ),
		    'AND' => array(
		           'NOT' => array('Article.image' => null)
		    )
		);
		
        $this->Article->locale = $language;

        $this->Article->recursive = 2;
        $novedades = $this->Article->find('all',array('conditions'=>$conditions));
        $this->layout='ajax';

       $this->set('novedades', $novedades);
	}


public function loadArticlesCatalogue($catalogue_id, $filter = null, $limit = 10, $page = 1, $filterid = null) {


//debug($user).die;


	$this->loadModel('CatalogueArticle');
	$this->CatalogueArticle->recursive =2;

	$locale = $this->Session->read('Config.language');

	$select = "select Article.id, Article.name, Article.ean, Article.code, Product.id, ";
	$select .= "i18n.content as common_name, Product.description, Family.code, CatalogueArticle.price, ";
	$select .= "CatalogueArticle.observations, CatalogueArticle.base_price, ";
	$select .= "CatalogueArticle.per_box, CatalogueArticle.boxes_per_floor, ";
	$select .= "CatalogueArticle.carri_floor, CatalogueArticle.show_unities, ";
	$select .= "CatalogueArticle.show_boxes, CatalogueArticle.customer_code, ";
	$select .= "CatalogueArticle.growing_id, CatalogueArticle.flowering_id, ";
	$select .= "CatalogueArticle.warehouse, CatalogueArticle.novelty, ";
	$select .= "coalesce((select min(photo) from article_photos ArticlePhotos ";
	$select .= "where ArticlePhotos.article_id = CatalogueArticle.article_id and ";
	$select .= "ArticlePhotos.warehouse = CatalogueArticle.warehouse and ";
	$select .= "coalesce(ArticlePhotos.growing_id,0) = CatalogueArticle.growing_id and ";
	$select .= "coalesce(ArticlePhotos.flowering_id,0) = CatalogueArticle.flowering_id), ";
	$select .= "(select min(photo) ";
	$select .= "from article_photos ArticlePhotos ";
	$select .= "where ArticlePhotos.article_id = CatalogueArticle.article_id and ";
	$select .= "ArticlePhotos.warehouse is null and ";
	$select .= "coalesce(ArticlePhotos.growing_id,0) = CatalogueArticle.growing_id and ";
	$select .= "coalesce(ArticlePhotos.flowering_id,0) = CatalogueArticle.flowering_id)) Photo ";
	$from = "from catalogue_articles CatalogueArticle, ";
	$from .= "articles Article, ";
	$from .= "products Product, families Family, i18n  ";
	$where = "where CatalogueArticle.catalogue_id = ".$catalogue_id." and ";
	$where .= "CatalogueArticle.article_id = Article.id and ";
	$where .= "Article.product_id = Product.id and ";
	$where .= "Product.family_id = Family.id and ";
	$where .= "Product.id = i18n.foreign_key and ";
	$where .= "i18n.model = 'Product' and i18n.field = 'common_name' and ";
	$where .= "i18n.locale = '".$locale."' ";




	if ($filter == 'discount' || $filter =='suggestion' || $filter == 'motora' || $filter == 'compositions' || $filter == 'novelty' || $filter =='christmas') {
		//Ofertas

		$sql = $select.$from.$where;
		$sql .= " and CatalogueArticle.".$filter." = 1 ";
		$articles = $this->CatalogueArticle->query($sql);
		return $articles;
	}

	if ($filter == 'collection') {
		$sqlCol = "select distinct Collection.id, Collection.code, Collection.description ";
		$sqlCol .= "from catalogue_articles CatalogueArticle, article_collections ArticleCollection, ";
		$sqlCol .= "collections Collection ";
		$sqlCol .= "where CatalogueArticle.catalogue_id = ".$catalogue_id." and ";
		$sqlCol .= "CatalogueArticle.article_id = ArticleCollection.article_id and ";

		if (!empty($filterid)) {
			$sqlCol .= "Collection.id = ".$filterid." and ";
		}

		$sqlCol .= "ArticleCollection.collection_id = Collection.id order by Collection.description ";

		$this->loadModel('Collection');
		$collections = $this->Collection->query($sqlCol);

//debug($collections);


		foreach ($collections as $col) {
			$sql2 = $select.$from.", article_collections ArticleCollection, collections Collection ";
			$sql2 .= $where." and Article.id = ArticleCollection.article_id and ";
			$sql2 .= "ArticleCollection.collection_id = ".$col['Collection']['id']." and ";
			$sql2 .= "ArticleCollection.collection_id = Collection.id ";			
			$sql2 .= "order by Collection.description ";

			$articlesCol = $this->CatalogueArticle->query($sql2);

			//debug($sql2);

			//print_r($col['Collection']['description'].'<br>');
			//print_r(' - '.$articlesCol[0]['Article']['name'].'<br>');

			$articles[$col['Collection']['description']] = $articlesCol;

		}
		//debug($articles);
		return $articles;
	}



	if ($filter == 'gamma') {

		$sqlClassif = "select distinct CatalogueClassification.id, CatalogueClassification.description, CatalogueClassification.orden,  ";
		$sqlClassif .= "CatalogueSubClassification.id, CatalogueSubClassification.description, CatalogueSubClassification.orden  ";
		$sqlClassif .= "from catalogue_articles CatalogueArticle, catalogue_classifications CatalogueClassification, ";
		$sqlClassif .= "catalogue_classifications CatalogueSubClassification ";
		$sqlClassif .= "where CatalogueArticle.catalogue_id = ".$catalogue_id." and ";
		$sqlClassif .= "CatalogueArticle.catalogue_classification_id = CatalogueSubClassification.id and ";
		$sqlClassif .= "CatalogueSubClassification.catalogue_classification_id = CatalogueClassification.id ";

		if (!empty($filterid)) {
			$sqlClassif .= "and (CatalogueClassification.id = ".$filterid." or CatalogueSubClassification.id = ".$filterid.") ";
		}

		$sqlClassif .= "order by CatalogueClassification.orden, CatalogueSubClassification.orden ";

		$this->loadModel('CatalogueClassification');
		$catalogueClassification = $this->CatalogueClassification->query($sqlClassif);	

		foreach ($catalogueClassification as  $k =>$clasif) {
			
			//debug($clasif);
			$sql2 = $select.$from.$where." and CatalogueArticle.catalogue_classification_id = ".$clasif['CatalogueSubClassification']['id'];

			$articlesClasif = $this->CatalogueArticle->query($sql2);
			
			//$articles['CatalogueClassification']['parent_name'] = $clasif['CatalogueClassification']['description'];
			
			$articlesClasif['parent_name'] = $clasif['CatalogueClassification']['description'];
			$articles[$clasif['CatalogueSubClassification']['description']] = $articlesClasif;
		}
		return $articles;

	}


	if ($filter == 'cart') {
		$cash_order_id = $this->Session->read('cash_order_id');

		$sql2 = $select.$from.$where." and exists (select 1 from cash_order_details CashOrderDetails ";
		$sql2 .= "where CashOrderDetails.cash_order_id = ".$cash_order_id." and ";
		$sql2 .= "CashOrderDetails.article_id = CatalogueArticle.article_id ) ";
		$articles = $this->CatalogueArticle->query($sql2);
		return $articles;

	}

}

public function existsArticlesOferta($catalogue_id) {

	$sql = "select count(1) num from catalogue_articles where catalogue_id = ".$catalogue_id." and discount=1 ";
	$this->loadModel('CatalogueArticle');
	$articles = $this->CatalogueArticle->query($sql);

	

	if ($articles[0][0]['num'] > 0) 
		return true;
	else
		return false;

}

public function existsArticlesMotora($catalogue_id) {

	$sql = "select count(1) num from catalogue_articles where catalogue_id = ".$catalogue_id." and motora=1 ";

	$articles = $this->CatalogueArticle->query($sql);

	

	if ($articles[0][0]['num'] > 0) 
		return true;
	else
		return false;

}

public function existsArticlesNovedades($catalogue_id) {

	$sql = "select count(1) num from catalogue_articles where catalogue_id = ".$catalogue_id." and novelty=1 ";

	$articles = $this->CatalogueArticle->query($sql);

	

	if ($articles[0][0]['num'] > 0) 
		return true;
	else
		return false;

}


public function existsArticlesComposiciones($catalogue_id) {

	$sql = "select count(1) num from catalogue_articles where catalogue_id = ".$catalogue_id." and compositions =1 ";

	$articles = $this->CatalogueArticle->query($sql);

	

	if ($articles[0][0]['num'] > 0) 
		return true;
	else
		return false;

}

public function existsArticlesNavidad($catalogue_id) {

	$sql = "select count(1) num from catalogue_articles where catalogue_id = ".$catalogue_id." and christmas =1 ";

	$articles = $this->CatalogueArticle->query($sql);

	

	if ($articles[0][0]['num'] > 0) 
		return true;
	else
		return false;

}



/**
 * loadArticlesCatalogue method
 *
 * @throws NotFoundException
 * @param array $arrayCatalogues
 * @param string $filter
 * @return void
 */
public function old_loadArticlesCatalogue( $arrayCatalogues, $filter = null, $limit = 10, $page = 1, $filterid = null) 
{
		$this->loadModel('Article');
		$this->loadModel('CatalogueClassification');
		$this->loadModel('Flowering');
		$this->loadModel('Catalogue');
		$this->loadModel('Growing');
		$this->loadModel('Collection');
		$this->loadModel('Product');
		$this->loadModel('ArticlePhotos');
		$this->loadModel('ArticleCollection');

		$articles = array();
		$stringSearch = false;
		$renderPage   = false;
		switch ($filter) {
			case 'motora':
				$stringSearch = 'motora';
				break;
			case 'suggestion':
				$stringSearch = 'suggestion';
				break;
			case 'novelty':
				$stringSearch ='novelty';
				break;
			case 'collection': 
				$stringSearch = 'ArticleCollection';
				break;
			case 'gamma':
				$stringSearch = 'catalogue_classification_id'; //mai estara buit, sempre treiem tot a gamma
				break;
			case 'cart':
				$stringSearch = 'catalogue_classification_id';
				break;
			case 'search':
				$stringSearch = 'search';
				break;
			default:
				$stringSearch = 'discount';
		}

		$this->Article->recursive = -1;
		$this->CatalogueClassification->recursive = -1;
		$this->Flowering->recursive = -1;
		$this->Catalogue->recursive = -1;
		$this->Growing->recursive = -1;
		$this->Product->recursive = -1;
		$this->Collection->recursive = -1;
		$this->ArticleCollection->recursive = -1;
		$numArticles  = 1;

		foreach ($arrayCatalogues as $catalogues) {
			if ($stringSearch == 'search') {
				//debug($catalogues).die;
			} else {
				
			}
			foreach($catalogues['CatalogueClassification'] as $catalogClassification) {
				if (!empty($catalogClassification['catalogue_classification_id'])) {
					//debug(count($catalogClassification['CatalogueArticle'])).die;
					foreach($catalogClassification['CatalogueArticle'] as $catalogArticle) {
						$catalogArticle['ArticleCollection'] = $this->ArticleCollection->findByArticleId($catalogArticle['article_id']);
						//debug($catalogArticle['ArticleCollection']);
						
						if ($catalogArticle[$stringSearch]) {							
							$article['CatalogueArticle'] = $catalogArticle;
							$article['Article']          = array();
							
							$hasFlowering = false;
							$hasGrowing   = false;
							$hasArticle   = false;
							
							if (!empty($catalogArticle['article_id'])) {
								$article['Article'] = $this->Article->findById($catalogArticle['article_id'])['Article'];
								$hasArticle = true;
							}

							if (!empty($article['Article'])) {
								$this->Product->locale = $this->Session->read('Config.language');
								$product = $this->Product->findById($article['Article']['product_id']);
								$article['Product'] = $product;
							} else {
								unset($article['Article']);
							}

							if (!empty($catalogArticle['catalogue_classification_id'])) {
								$article['CatalogueClassification'] = $this->CatalogueClassification->findById($catalogArticle['catalogue_classification_id'])['CatalogueClassification'];
								$parentId = $this->CatalogueClassification->findById($article['CatalogueClassification']['catalogue_classification_id']);
								$article['CatalogueClassification']['parent_name'] = $parentId['CatalogueClassification']['description'];
							}

							if (!empty($catalogArticle['flowering_id'])) {
								$article['Flowering'] = $this->Flowering->findById($catalogArticle['flowering_id'])['Flowering'];
								$hasFlowering = true;
							}
							if (!empty($catalogArticle['catalogue_id'])) {
								$article['Catalogue'] = $this->Catalogue->findById($catalogArticle['catalogue_id'])['Catalogue'];
							}
							if (!empty($catalogArticle['growing_id'])) {
								$article['Growing'] = $this->Growing->findById($catalogArticle['growing_id'])['Growing'];
								$hasGrowing = true;
							}

							//if (!empty($catalogArticle['collection_id'])) {
							//	$article['Collection'] = $this->Collection->findById($catalogArticle['collection_id'])['Collection'];
							//}
							//$photo = 'http://www.corma.es/disponible/images/articles/thumbs/sinfoto.png';
							$photo = 'sinfoto.png';
							if ($hasFlowering && $hasGrowing && $hasArticle) {
								$conditions = array('conditions' => array(
									'ArticlePhotos.article_id' => $catalogArticle['article_id'],
									'ArticlePhotos.growing_id' => $catalogArticle['growing_id'],
									'ArticlePhotos.flowering_id' => $catalogArticle['flowering_id'],
									array('OR' => array(
										'ArticlePhotos.warehouse' => $catalogArticle['warehouse'],
										'ArticlePhotos.warehouse' => null,
										)
									))
								);
								$photoSearch = $this->ArticlePhotos->find('all',$conditions);
								if (!empty($photoSearch)) {
									//$photo = 'http://81.46.212.35/corma/intranet/img/articles/thumbs/'.$photoSearch[0]['ArticlePhotos']['photo'];	
									//$photo = 'http://www.corma.es/disponible/images/articles/thumbs/'.$photoSearch[0]['ArticlePhotos']['photo'];	
									$photo = $photoSearch[0]['ArticlePhotos']['photo'];
								}
							}
							$article['Photo'] = $photo;
							if (!empty($catalogArticle['growing_id'])) {
								$article['Growing'] = $this->Growing->findById($catalogArticle['growing_id'])['Growing'];
							}


							$agafarArticle = true;

							if (!empty($filterid)) {
								if ($filter == 'collection') {
									
									if ($article['CatalogueArticle']['ArticleCollection']['Collection']['id'] != $filterid) {
										$agafarArticle = false;
									}
								}
								if ($filter == 'gamma') {
									if ($article['CatalogueClassification']['id'] == $filterid || $article['CatalogueClassification']['catalogue_classification_id'] == $filterid) {
										$agafarArticle = true;
									} else {
										$agafarArticle = false;
									}		 
									
								}
							}
								
							if ($agafarArticle) {
								$articles[] = $article;
								$numArticles++;
							}
						}
					}
					
				}
			}
		}

		


		if ($filter == 'collection') {

			$orderGroup = array();

			foreach ($articles as $article) {
				$orderGroup[$article['CatalogueArticle']['ArticleCollection']['Collection']['description']][] = $article;
				//$orderGroup[$article['Collection']['description']][] = $article;
			}
			$articles = $orderGroup;

		}

		if ($filter == 'gamma') {

			$orderGroup = array();

			foreach ($articles as $article) {
				$article['parent_name']                                           = $article['CatalogueClassification']['parent_name'];
				$orderGroup[$article['CatalogueClassification']['description']][] = $article;
			}

			$articles = $orderGroup;
			


		}
		return $articles;
}



/**
 * loadArticlesSeasonCatalogue method
 *
 * @throws NotFoundException
 * @param array $arrayCatalogues
 * @param string $filter
 * @return void
 */
public function loadArticlesSeasonCatalogue( $arraySeasonCatalogues, $filter = null, $limit = 10, $page = 1, $filterid = null) 
{
		$this->loadModel('Article');
		$this->loadModel('SeasonCatalogueClassification');
		$this->loadModel('Flowering');
		$this->loadModel('SeasonCatalogue');
		$this->loadModel('Growing');
		$this->loadModel('Collection');
		$this->loadModel('Product');
		$this->loadModel('ArticlePhotos');
		$this->loadModel('ArticleCollection');

		$articles = array();
		$stringSearch = false;
		$renderPage   = false;
		switch ($filter) {
			case 'motora':
				$stringSearch = 'motora';
				break;
			case 'collection': 
				$stringSearch = 'ArticleCollection';
				break;
			case 'gamma':
				$stringSearch = 'season_catalogue_classification_id'; //mai estara buit, sempre treiem tot a gamma
				break;
			case 'cart':
				$stringSearch = 'season_catalogue_classification_id';
				break;
			default:
				$stringSearch = 'motora';
		}

		$this->Article->recursive = 1;
		$this->SeasonCatalogueClassification->recursive = -1;
		$this->Flowering->recursive = -1;
		$this->SeasonCatalogue->recursive = -1;
		$this->Growing->recursive = -1;
		$this->Product->recursive = 1;
		$this->Collection->recursive = -1;
		$this->ArticleCollection->recursive = 1;
		$numArticles  = 1;



		foreach ($arraySeasonCatalogues as $seasoncatalogues) {
			foreach($seasoncatalogues['SeasonCatalogueClassification'] as $seasoncatalogClassification) {
				if (!empty($seasoncatalogClassification['season_catalogue_classification_id'])) {

					//debug(count($seasoncatalogClassification['CatalogueArticle'])).die;
					foreach($seasoncatalogClassification['SeasonCatalogueArticle'] as $catalogArticle) {

						$catalogArticle['ArticleCollection'] = $this->ArticleCollection->findByArticleId($catalogArticle['article_id']);
						//debug($catalogArticle['ArticleCollection']['Collection']).die;


						if ($catalogArticle[$stringSearch]) {


							
							$article['SeasonCatalogueArticle'] = $catalogArticle;
							$article['Article']          = array();
							
							$hasFlowering = false;
							$hasGrowing   = false;
							$hasArticle   = false;
							
							if (!empty($catalogArticle['article_id'])) {
								$article['Article'] = $this->Article->findById($catalogArticle['article_id'])['Article'];
								$hasArticle = true;
							}

							if (!empty($article['Article'])) {
								$this->Product->locale = $this->Session->read('Config.language');
								$product = $this->Product->findById($article['Article']['product_id']);
								$article['Product'] = $product;
							} else {
								unset($article['Article']);
							}

							if (!empty($catalogArticle['season_catalogue_classification_id'])) {
								$article['SeasonCatalogueClassification'] = $this->SeasonCatalogueClassification->findById($catalogArticle['season_catalogue_classification_id'])['SeasonCatalogueClassification'];
								$parentId = $this->SeasonCatalogueClassification->findById($article['SeasonCatalogueClassification']['season_catalogue_classification_id']);
								$article['SeasonCatalogueClassification']['parent_name'] = $parentId['SeasonCatalogueClassification']['description'];
							}

							if (!empty($catalogArticle['flowering_id'])) {
								$article['Flowering'] = $this->Flowering->findById($catalogArticle['flowering_id'])['Flowering'];
								$hasFlowering = true;
							}
							if (!empty($catalogArticle['season_catalogue_id'])) {
								$article['SeasonCatalogue'] = $this->SeasonCatalogue->findById($catalogArticle['season_catalogue_id'])['SeasonCatalogue'];
							}
							if (!empty($catalogArticle['growing_id'])) {
								$article['Growing'] = $this->Growing->findById($catalogArticle['growing_id'])['Growing'];
								$hasGrowing = true;
							}

							/*if (!empty($catalogArticle['collection_id'])) {
								$article['Collection'] = $this->Collection->findById($catalogArticle['collection_id'])['Collection'];
							}*/
							$photo = 'https://www.corma.es/disponible/images/articles/thumbs/sinfoto.png';
							if ($hasFlowering && $hasGrowing && $hasArticle) {
								$conditions = array('conditions' => array(
									'ArticlePhotos.article_id' => $catalogArticle['article_id'],
									'ArticlePhotos.growing_id' => $catalogArticle['growing_id'],
									'ArticlePhotos.flowering_id' => $catalogArticle['flowering_id'],
									array('OR' => array(
										'ArticlePhotos.warehouse' => $catalogArticle['warehouse'],
										'ArticlePhotos.warehouse' => null,
										)
									))
								);
								$photoSearch = $this->ArticlePhotos->find('all',$conditions);
								if (!empty($photoSearch)) {
									//$photo = 'http://www.corma.es/disponible/images/articles/thumbs/'.$photoSearch[0]['ArticlePhotos']['photo'];
									$photo = $photoSearch[0]['ArticlePhotos']['photo'];	
								}
							}
							$article['Photo'] = $photo;
							if (!empty($catalogArticle['growing_id'])) {
								$article['Growing'] = $this->Growing->findById($catalogArticle['growing_id'])['Growing'];
							}


							$agafarArticle = true;

							if (!empty($filterid)) {
								if ($filter == 'collection') {
									
									if ($article['SeasonCatalogueArticle']['ArticleCollection']['Collection']['id'] != $filterid) {
										$agafarArticle = false;
									}
								}
								if ($filter == 'gamma') {
									if ($article['SeasonCatalogueClassification']['id'] == $filterid || $article['SeasonCatalogueClassification']['season_catalogue_classification_id'] == $filterid) {
										$agafarArticle = true;
									} else {
										$agafarArticle = false;
									}		 
									
								}
							}
								
							if ($agafarArticle) {
								$articles[] = $article;
								$numArticles++;
							}
						}
					}
					
				}
			}
		}

		if ($filter == 'collection') {

			$orderGroup = array();

			foreach ($articles as $article) {
				$orderGroup[$article['SeasonCatalogueArticle']['ArticleCollection']['Collection']['description']][] = $article;
				//$orderGroup[$article['Collection']['description']][] = $article;
			}
			$articles = $orderGroup;

		}

		if ($filter == 'gamma') {

			$orderGroup = array();

			foreach ($articles as $article) {
				$article['parent_name']                                           = $article['SeasonCatalogueClassification']['parent_name'];
				$orderGroup[$article['SeasonCatalogueClassification']['description']][] = $article;
			}

			$articles = $orderGroup;
			


		}
		return $articles;
}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash('The product has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The product could not be saved. Please, try again.');
			}
		}
		$expositions = $this->Product->Exposition->find('list');
		$plantTypes = $this->Product->PlantType->find('list');
		$irrigations = $this->Product->Irrigation->find('list');
		$programmingGroups = $this->Product->ProgrammingGroup->find('list');
		$flowerColours = $this->Product->FlowerColour->find('list');
		$sheetColours = $this->Product->SheetColour->find('list');
		$utilizations = $this->Product->Utilization->find('list');
		$temperatures = $this->Product->Temperature->find('list');
		$this->set(compact('expositions', 'plantTypes', 'irrigations', 'programmingGroups', 'flowerColours', 'sheetColours', 'utilizations', 'temperarutes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException('Invalid product');
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash('The product has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The product could not be saved. Please, try again.');
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$expositions = $this->Product->Exposition->find('list');
		$plantTypes = $this->Product->PlantType->find('list');
		$irrigations = $this->Product->Irrigation->find('list');
		$programmingGroups = $this->Product->ProgrammingGroup->find('list');
		$flowerColours = $this->Product->FlowerColour->find('list');
		$sheetColours = $this->Product->SheetColour->find('list');
		$utilizations = $this->Product->Utilization->find('list');
		$temperatures = $this->Product->Temperature->find('list');
		$this->set(compact('expositions', 'plantTypes', 'irrigations', 'programmingGroups', 'flowerColours', 'sheetColours', 'utilizations', 'temperarutes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException('Invalid product');
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash('The product has been deleted.');
		} else {
			$this->Session->setFlash('The product could not be deleted. Please, try again.');
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException('Invalid product');
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash('The product has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The product could not be saved. Please, try again.');
			}
		}
		$expositions = $this->Product->Exposition->find('list');
		$plantTypes = $this->Product->PlantType->find('list');
		$irrigations = $this->Product->Irrigation->find('list');
		$programmingGroups = $this->Product->ProgrammingGroup->find('list');
		$flowerColours = $this->Product->FlowerColour->find('list');
		$sheetColours = $this->Product->SheetColour->find('list');
		$utilizations = $this->Product->Utilization->find('list');
		$temperatures = $this->Product->Temperature->find('list');
		$this->set(compact('expositions', 'plantTypes', 'irrigations', 'programmingGroups', 'flowerColours', 'sheetColours', 'utilizations', 'temperarutes'));
	}




	public function search() {
		$this->layout='ajax';
		$expositions = $this->Product->Exposition->find('list');
		$plantTypes = $this->Product->PlantType->find('list');
		$irrigations = $this->Product->Irrigation->find('list');
		$programmingGroups = $this->Product->ProgrammingGroup->find('list');
		$flowerColours = $this->Product->FlowerColour->find('list');
		$sheetColours = $this->Product->SheetColour->find('list');
		$utilizations = $this->Product->Utilization->find('list');
		$temperatures = $this->Product->Temperature->find('list');
		$this->set(compact('expositions', 'plantTypes', 'irrigations', 'programmingGroups', 'flowerColours', 'sheetColours', 'utilizations', 'temperarutes'));

	}

	/**
 * list method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function lista($plantTypeId = null, $id = null) {
		/*if (!$this->Product->PlantType->exists($plantTypeId)) {
			throw new NotFoundException(__('Seleccione un tipo de planta'));
		}*/
		$this->Product->recursive=1;

		if (!empty($plantTypeId)) {
			$product_list = $this->Product->find('all',array('conditions'=>array('plant_type_id'=>$plantTypeId)));	
		} else {
			$product_list = $this->Product->find('all');
		}

		$product_list = Hash::extract($product_list,'{n}.Product');
		
		$this->layout='ajax';
		$this->set('product_list', $product_list);

		if (empty($id)) {
			$id = $product_list[0]['id'];
		}


		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Producto inexistente'));
		}

		


		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id),'order'=>array('Product.description' => 'asc'));


		$ficha = $this->Product->find('first', $options);
		

		if (empty($plantTypeId) && !(empty($id))) {
			$plantTypeId = $ficha['PlantType']['id'];
		}



		$this->set('ficha', $ficha);
		$this->set('plant_type_id', $plantTypeId);
		
	}

	public function selection($page = 1) 
	{

		$this->layout = 'default_app';
		$this->set('title', __("Gestión de fotos de calidad Corma"));
        $this->set('page','imagesquality');

        $user = $this->Session->read('User.logged');
        $this->set('user',$user);

        $limit = 10;

        $query = "SELECT article_id, article_name, article_price, product_id, product_description, unities_stock 
        FROM v_articles_stocks Articles WHERE 1 = 1 ";


        $query_count  = "SELECT count(1) AS count  FROM v_articles_stocks WHERE 1 = 1 ";

        $requestData = $this->request->query;

        $filter_stock = "S";

        $filter_name = '';


        $url = SERVER.$this->request->url;
        $param = '';

        if (!empty($requestData)) {

            $filter_name = $requestData['data']['Articles']['filter_name'];
            $filter_stock = $requestData['data']['Articles']['filter_stock'];
             
            

            if (isset($filter_name) && !empty($filter_name)) {
                $query .= " AND ( article_name LIKE '%".$filter_name."%' OR product_description LIKE '%".$filter_name."%' ) " ;

                $query_count .= " AND ( article_name LIKE '%".$filter_name."%' OR product_description LIKE '%".$filter_name."%' ) " ;
            }

            $param = "?data%5BArticles%5D%5Bfilter_name%5D=".$requestData['data']['Articles']['filter_name']."&data%5BArticles%5D%5Bfilter_stock%5D=".$requestData['data']['Articles']['filter_stock'];
        
        }


        $this->set('param',$param);

        if ($filter_stock == "S") {
            $query = $query." AND unities_stock > 0 "; 
            
            $query_count = $query_count." AND unities_stock > 0 ";

            
        }

         if ($filter_stock == "N") {
            /*$query = $query." group by Stocks.id, Articles.id, Articles.name, Products.description HAVING coalesce(sum(Details.unities),0) = 0 ";    */
            $query = $query." AND unities_stock = 0 "; 

            /*$query_count = $query_count." and exists (select 1 from `details` Details where Details.stock_id = Stocks.id having coalesce(sum(Details.unities),0) = 0)";      */

            $query_count = $query_count." AND unities_stock = 0 "; 

            
        }

         if ($filter_stock == "T") {
            //$query = $query." group by Stocks.id, Articles.id, Articles.name, Products.description ";
         }

         if ($page == 1) {
            $start = 0;
        } else {
             $start = (($page - 1) * $limit);
        }
        
         $query = $query." ORDER BY article_name LIMIT ".$start.", ".$limit;


        //debug($query).die;


        $this->Session->write('Articles.filter_name',$filter_name);
        $this->Session->write('Articles.filter_stock',$filter_stock);

        $this->set('filter_name',$filter_name);
        $this->set('filter_stock',$filter_stock);

        $numStocks = $this->Article->query($query_count);
        if ($numStocks > $page * $limit) {
            $next = $page + 1;
            $this->set('next',$next);
        }

        $this->Session->write('Articles.page', $page);


        $articles = $this->Article->query($query);

        $this->set('Articles', $articles);
		
	}




	/**
 * novedades method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	/*public function novedades($programmingGroupCode = null) {
		
		

		


		$conditions = array(
		    array(
		        //array('programming_groups_id'=>$ProgrammingGroup[0]['id'])
		        array('ProgrammingGroup.period_end >='=>9,
		        	'ProgrammingGroup.period_start <='=> 9)
		    ),
		    'AND' => array(
		        array(
		           'NOT' => array(
		  	          array('Product.image' => null)
		            )
		        )
		    )
		);

		$limit = 10;

		$product_min_max = $this->Product->find('all',
				array(
					'fields' => array('min(Product.id) as product_min', 'max(Product.id) as product_max'),
					'conditions'=>$conditions,
					'recursive' => 0));	
		
		$minim = $product_min_max[0][0]['product_min'];
		$maxim = $product_min_max[0][0]['product_max'];

		$numeroAleatori = rand($minim, $maxim);


		$this->Product->recursive = 1;


		$conditions = array(
		    array(
		        //array('programming_groups_id'=>$ProgrammingGroup[0]['id'])
		        'ProgrammingGroup.period_end >='=>9,
		        'ProgrammingGroup.period_start <='=> 9,
		        'Product.id >='=>$numeroAleatori
		    ),
		    'AND' => array(
		           'NOT' => array('Product.image' => null)
		    )
		);
		
		$product_list = $this->Product->find('all',array('conditions'=>$conditions,'limit'=>$limit));	
		$product_list = Hash::extract($product_list,'{n}.Product');
		
		$this->layout='ajax';
		$this->set('product_list', $product_list);

		//$this->set('ProgrammingGroup', $ProgrammingGroup[0]);


	}*/

}
