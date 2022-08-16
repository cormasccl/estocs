<?php
App::uses('AppController', 'Controller');
/**
 * CatalogueArticles Controller
 *
 * @property CatalogueArticle $CatalogueArticle
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CatalogueArticlesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

}
