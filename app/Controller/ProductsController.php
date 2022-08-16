<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {


/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allowedActions = array('index','novedades', 'view','search','gallery');
	}
 	
/**
 * index method
 *
 * @return void
 */
	public function index($id = null, $name = null) {
		//$this->Session->write('Config.language',$language);
		$locale = $this->Session->read('Config.language');
        setlocale(LC_ALL, $locale);
        $this->set('locale',$locale);
		$this->Product->recursive= 1;
		$this->Product->locale = $locale;

		
		$this->Product->FlowerColour->locale = $this->Session->read('Config.language');
		$this->Product->SheetColour->locale = $this->Session->read('Config.language');


		$expositions                      = $this->Product->Exposition->find('list');
		$this->Product->PlantType->locale = $this->Session->read('Config.language');
		$plantTypes                       = $this->Product->PlantType->find('list');
		$irrigations                      = $this->Product->Irrigation->find('list');
		$programmingGroups                = $this->Product->ProgrammingGroup->find('list');
		$flowerColours                    = $this->Product->FlowerColour->find('list');
		$sheetColours                     = $this->Product->SheetColour->find('list');
		$this->Product->Utilization->locale = $this->Session->read('Config.language');
		$utilizations                     = $this->Product->Utilization->find('list');
		$this->Product->Characteristic->locale = $this->Session->read('Config.language');
		$characteristics				  = $this->Product->Characteristic->find('list');

		
		
		$temperatures                     = $this->Product->Temperature->find('list');

		$this->loadModel('PlantType');

		$this->PlantType->locale = $this->Session->read('Config.language');

		$this->set('plantTypes', $this->PlantType->find('all'));
		$this->set(compact('expositions', 'plantTypes', 'irrigations', 'programmingGroups', 'flowerColours', 'sheetColours', 'utilizations','characteristics', 'temperarutes'));


	
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Producto inexistente'));
		}

		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));

		$this->Product->locale = $locale;
		$ficha = $this->Product->find('all', $options);

		$this->pageTitle = ucfirst(strtolower($ficha[0]['Product']['description']));
		$this->set('title_for_layout',$this->pageTitle);
		
		$this->set('ficha', $ficha[0]);

		$this->layout='popup';
			
			
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
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
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
			throw new NotFoundException(__('Invalid product'));
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
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
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
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
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
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/*public function result() {


		$this->Product->locale = $this->Session->read('Config.language');
		$conditions[] = array('Product.published' => 1);

		if (!empty($this->request->data['exposition_id'])) {
			$conditions[]= array('Product.exposition_id' => $this->request->data['exposition_id']);	
		}
		if (!empty($this->request->data['irrigation_id'])) {
			$conditions[]= array('Product.irrigation_id' => $this->request->data['irrigation_id']);	
		}
		if (!empty($this->request->data['plant_type_id'])) {
			$conditions[]= array('Product.plant_type_id' => $this->request->data['plant_type_id']);
		}
		if (!empty($this->request->data['description'])) {
			$conditions[]= array('Product.description LIKE ' => '%'.$this->request->data['description'].'%');
		}
		if (!empty($this->request->data['common_name'])) {
			$conditions[]= array('Product.common_name LIKE' => '%'.$this->request->data['common_name'].'%');
		}
		if (!empty($this->request->data['temperature'])) {
			$conditions[]= array('Product.temperature LIKE ' => '%'.$this->request->data['temperature'].'%');
		}
		if (!empty($this->request->data['floration'])) {
			$aMonthFloration = $this->request->data['floration'];
		}
		if (!empty($this->request->data['availability'])) {
			$aMonthAvailability = $this->request->data['availability'];
		}
		
		if (!empty($this->request->data['fragrance'])) {
			$conditions[] = array('Product.fragrance' => $this->request->data['fragrance']);
		}
		$productUtilization = array();
		if (!empty($this->request->data['utilization'])) {
			$conditionOneOrMany = (count($this->request->data['utilization']) == 1) ? 'utilization_id' : 'utilization_id IN ';
			$productUtilization = $this->Product->ProductsUtilization->find('all', array('conditions' => array($conditionOneOrMany => $this->request->data['utilization'])));
			$productUtilization = Hash::extract($productUtilization,'{n}.ProductsUtilization.product_id');
		}
		$productsFlowerColour = array();
		if (!empty($this->request->data['FlowerColour'])) {
			$conditionOneOrMany = (count($this->request->data['FlowerColour']) == 1) ? 'flower_colour_id' : 'flower_colour_id IN ';
			$productsFlowerColour = $this->Product->ProductsFlowerColour->find('all', array('conditions' => array($conditionOneOrMany => $this->request->data['FlowerColour'])));
			$productsFlowerColour = Hash::extract($productsFlowerColour,'{n}.ProductsFlowerColour.product_id');
		}
		$productsSheetColour = array();
		if (!empty($this->request->data['SheetColour'])) {
			$conditionOneOrMany = (count($this->request->data['SheetColour']) == 1) ? 'sheet_colour_id' : 'sheet_colour_id IN ';
			$productsSheetColour = $this->Product->ProductsSheetColour->find('all', array('conditions' => array($conditionOneOrMany => $this->request->data['SheetColour'])));
			$productsSheetColour = Hash::extract($productsSheetColour,'{n}.ProductsSheetColour.product_id');
		}

		$products_list = $this->Product->find('list', array('conditions' => $conditions));
		$product_names = array();
		foreach($products_list as $key => $product) {
			if (empty($product)) {
				$product_names[$key] = $this->Product->find('all',
					array('fields' => 'description','conditions' => array('Product.id' => $key)));
				$product_names[$key] = ucfirst(strtolower(Hash::extract($product_names[$key],'{n}.Product.description')[0]));
			} else {
				$product_names[$key] = $product;
			}
		}
		$products = $products_list;
		
		$aProduct = array();
		foreach ($products as $key => $listProduct) {
			$aProduct[] = $key;
		}
		$products = $aProduct;
		$hasFilter = false;

		if (!empty($productUtilization)) {
			$products =  array_unique(array_intersect($productUtilization,$aProduct));
			$hasFilter = true;
		} 

		if (!empty($productsFlowerColour)) {
			$filterArray = ($hasFilter) ? $products : $aProduct;
			$products =  array_unique(array_intersect($productsFlowerColour,$filterArray));
			$hasFilter = true;
		} 

		if (!empty($productsSheetColour)) {
			$filterArray = ($hasFilter) ? $products : $aProduct;
			$products =  array_unique(array_intersect($productsSheetColour,$filterArray));
		} 
		
		if (!empty($products)) {
			$productsSearch    = (count($products) == 1) ? 'Product.id' : 'Product.id IN ';
			$products          = $this->Product->find('all', array('conditions' => array($productsSearch => $products)));	
		}
		
		if (!empty($products)) {
			if (!empty($aMonthAvailability)) {
				foreach ($products as $k => $product) {
					foreach($aMonthAvailability as $monthes) {
						if (!empty($product['Programming'])) {
							$monthsProduct = array_unique(Hash::extract($product['Programming'],'{n}.month'));
							if (!in_array($monthes, $monthsProduct)) {
								unset($products[$k]);
								break;
							}
						}
					}
				}
			}
			if (!empty($aMonthFloration)) {
				foreach ($products as $k => $product) {
					foreach($aMonthFloration as $monthes) {
						if ((!empty($product['Product']['initial_flowering'])) && (!empty($product['Product']['final_flowering']))) {
							if (($monthes < $product['Product']['initial_flowering'])||($monthes > $product['Product']['final_flowering'])) {
								unset($products[$k]);
								break;
							}
						} else if (!empty($product['Product']['initial_flowering'])) {
							if ($monthes != $product['Product']['initial_flowering']) {
								unset($products[$k]);
								break;
							}
						} else if (!empty($product['Product']['end_flowering'])) {
							if ($monthes != $product['Product']['end_flowering']) {
								unset($products[$k]);
								break;
							}
						}
						//if (!empty($product['Programming'])) {
					}
				}
			}
		}
		$this->set('products',$products);
	}*/


	public function search() {


		$mostrarResultats = false;
		if (!empty($this->request->data['mostrarResultats'])) {
			$mostrarResultats = true;
		}


		$conditionsExposition = $conditionsSheetColour = $conditionsPlantType = $conditionsIrrigation = $conditionsProgrammingGroup = $conditionsFlowerColour = $conditionsSheeetColour = $conditionsUtilization = $conditionsTemperature = $products = array();
	
		$this->Product->FlowerColour->locale = $this->Session->read('Config.language');
		$this->Product->SheetColour->locale = $this->Session->read('Config.language');
		
		$expositions                      = $this->Product->Exposition->find('list');
		$this->Product->PlantType->locale = $this->Session->read('Config.language');
		$plantTypes                       = $this->Product->PlantType->find('list');
		$irrigations                      = $this->Product->Irrigation->find('list');
		$programmingGroups                = $this->Product->ProgrammingGroup->find('list');
		$flowerColours                    = $this->Product->FlowerColour->find('list');
		$sheetColours                     = $this->Product->SheetColour->find('list');
		$this->Product->Utilization->locale = $this->Session->read('Config.language');
		$utilizations                     = $this->Product->Utilization->find('list');
		$this->Product->Characteristic->locale = $this->Session->read('Config.language');
		$characteristics                     = $this->Product->Characteristic->find('list');

		$temperatures                     = $this->Product->Temperature->find('list');

		$this->loadModel('PlantType');

		$this->PlantType->locale = $this->Session->read('Config.language');

		$this->set('plantTypes', $this->PlantType->find('all'));
		$this->set(compact('expositions', 'plantTypes', 'irrigations', 'programmingGroups', 'flowerColours', 'sheetColours', 'utilizations','characteristics', 'temperarutes'));

		$locale = $this->Session->read('Config.language');

		
        setlocale(LC_ALL, $locale);
        $this->set('locale',$locale);
		$this->Product->recursive= 1;
		$this->Product->locale = $locale;

		

		$filter = '';




		if (!empty($plantTypeId)) {
			$filter .= " and products.plant_type_id = ".$plantTypeId; 
			//$conditions[]= array('Product.plant_type_id' => $plantTypeId);
		}
		//$conditions[] = array('Product.published' => 1);

		if (!empty($this->request->data['product_selected'])) {
			$id = $this->request->data['product_selected'];
		}
		if (!empty($this->request->data['actual_page'])) {
			$pagina = $this->request->data['actual_page'];
		}

		
		if (!empty($this->request->data['exposition_id'])) {
			//$conditions[]= array('Product.exposition_id' => $this->request->data['exposition_id']);
			$filter .= " and Product.exposition_id = ".$this->request->data['exposition_id'];
		}
		if (!empty($this->request->data['irrigation_id'])) {
			//$conditions[]= array('Product.irrigation_id' => $this->request->data['irrigation_id']);
			$filter .= " and Product.irrigation_id = ".$this->request->data['irrigation_id'];	
		}
		if (!empty($this->request->data['plant_type_id'])) {
			//$conditions[]= array('Product.plant_type_id' => $this->request->data['plant_type_id']);
			$filter .= " and Product.plant_type_id = ".$this->request->data['plant_type_id'];
		}
		if (!empty($this->request->data['description'])) {
			//$conditions[]= array('Product.description LIKE ' => '%'.$this->request->data['description'].'%');
			$filter .= " and Product.description LIKE '%".$this->request->data['description']."%'";
		}
		$filter_name = '';
		if (!empty($this->request->data['common_name'])) {
			//$conditions[]= array('Product.common_name LIKE' => '%'.$this->request->data['common_name'].'%');
			$filter_name = " and Product.common_name LIKE '%".$this->request->data['common_name']."%'";
		}
		if (!empty($this->request->data['temperature'])) {
			//$conditions[]= array('Product.temperature LIKE ' => '%'.$this->request->data['temperature'].'%');
			$filter .= " and Product.temperature LIKE '%".$this->request->data['temperature']."%'";
		}

		if (!empty($this->request->data['Product']['floration'])) {
			$aMonthFloration = $this->request->data['Product']['floration'];
		}
		if (!empty($this->request->data['Product']['availability'])) {
			$aMonthAvailability = $this->request->data['Product']['availability'];
		}
		
		if (!empty($this->request->data['fragrance'])) {
			//$conditions[] = array('Product.fragrance' => $this->request->data['fragrance']);
			$filter .= " and Product.fragrance = '".$this->request->data['fragrance']."'";
		}

		$productUtilization = array();
		if (!empty($this->request->data['Product']['utilization'])) {
			$utilitzations      = $this->request->data['Product']['utilization'];

			$lista = (implode(",",$this->request->data['Product']['utilization']));

			$filter .= " and exists (select 1 from products_utilizations ";
			$filter .="where Product.id = products_utilizations.product_id ";
			$filter .= " and products_utilizations.utilization_id in (".$lista.")) ";

			$this->set('product_utilization',$utilitzations);

		}

		$productCharacteristic = array();
		if (!empty($this->request->data['Product']['characteristic'])) {
			$characteristics      = $this->request->data['Product']['characteristic'];

			$lista = (implode(",",$this->request->data['Product']['characteristic']));

			$filter .= " and exists (select 1 from products_characteristics ";
			$filter .="where Product.id = products_characteristics.product_id ";
			$filter .= " and products_characteristics.characteristic_id in (".$lista.")) ";

			$this->set('product_characteristic',$characteristics);

		}

		$productsFlowerColour = array();
		if (!empty($this->request->data['Product']['FlowerColour'])) {
			$flowercolours = $this->request->data['Product']['FlowerColour'];

			$lista = (implode(",",$this->request->data['Product']['FlowerColour']));

			$filter .= " and exists (select 1 from products_flower_colours ";
			$filter .="where Product.id = products_flower_colours.product_id ";
			$filter .= " and products_flower_colours.flower_colour_id in (".$lista."))";

			$this->set('product_flowercolours',$flowercolours);
		}
		$productsSheetColour = array();
		if (!empty($this->request->data['Product']['SheetColour'])) {
			$sheetcolours = $this->request->data['Product']['SheetColour'];

			$lista = (implode(",",$this->request->data['Product']['SheetColour']));
			$filter .= " and exists (select 1 from products_sheet_colours ";
			$filter .="where Product.id = products_sheet_colours.product_id ";
			$filter .= " and products_sheet_colours.sheet_colour_id in (".$lista.")) ";

			$this->set('product_sheetcolours',$sheetcolours);
		}
		if (!empty($aMonthAvailability)) {
			$lista = (implode(",",$aMonthAvailability));
			$filter .= " and exists (select 1 from programmings where programmings.product_id = Product.id and programmings.month in(".$lista.")) ";
		}

		if (!empty($aMonthFloration)) {
			$lista = (implode(",",$aMonthFloration));
			$filter .= " and Product.floration in(".$lista.")";
		}

		$sql = "select * from products Product";
		$sql .=" where Product.published = 1 ";
		$sql .= $filter.$filter_name;
		$sql .= " order by Product.description ";

		
		if ($mostrarResultats) {


			$this->Product->recursive = 1;

			$products = $this->Product->query($sql);	


			$limit = 10;
			$pagina = (!empty($pagina)) ? $pagina : 1;

		
			$product_list = $products;

			if (count($product_list) == 0) {
				//codigo busqueda i18n aqui
				$sql2 = '';
				if (!empty($this->request->data['common_name'])) {
					$sql2 = "SELECT foreign_key from i18n where model='Product' and content like '%".$this->request->data['common_name']."%'";
				}
				if (empty($sql2)) {
					$this->Session->setFlash(__('No hay productos con los parámetros seleccionados'), 'default', array(), 'error');
					$id = 0;
				} else {
					$sql = "select * from products Product";
					$sql .=" where Product.published = 1 ";
					$sql .= $filter." and id in(".$sql2.")";
					$sql .= " order by Product.description ";
					$products = $this->Product->query($sql);
					$product_list = $products;
					//$product_list = $this->Product->find('all',array('conditions' => array('id IN ' => $products)));
				}
			}
			
			$this->set('total_registers', count($product_list));
			$this->Session->write('total_registers', count($product_list));


			$auxProducts = array();
			$lastCount = $pagina * $limit;
			$initialCount = $lastCount - $limit + 1;

			for ($i=0; $i < count($product_list); $i++) { 
				$cont = $i + 1;
				
				if ($cont >= $initialCount && $cont <= $lastCount) {
					$auxProducts[] = $product_list[$i];
				}
			}

			$product_list = $auxProducts;



			$this->Session->write('pagina', $pagina);
			$this->Session->write('limit', $limit);


			$this->set('actual_page', $pagina);
			$this->set('limit', $limit);
			$this->set('product_list', $product_list);



			$product_name = '';
			
			if (count($product_list) != 0) {

				$this->Session->write('Product.results' , $product_list);
				

				if (empty($id) || $id == 0) {
					$id = $product_list[0]['Product']['id'];

					$product_name = $product_list[0]['Product']['description'];
				}
				$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id),'order'=>array('Product.description' => 'asc'));
				
				$this->Product->locale = $locale;

				$ficha = $this->Product->find('first', $options);

				
				$this->set('ficha', $ficha);
			}
			$this->set('title_for_layout', __('Buscador de plantas'));
			$this->set('product_selected', $id);

			

			$product_name = str_replace("'","",$product_name);

		    $entities = array(' ','', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		    $replacements = array('-','!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		    $slug_name =  str_replace($entities, $replacements, strtolower($product_name));

		    $this->Session->write('paramForm', $this->request->data);

			$this->redirect('/Products/view/'.$id.'/'.$slug_name);
			

		}

		$this->set('title_for_layout', __('Buscador de plantas'));


	}


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null, $name = null) {
		//$this->Session->write('Config.language',$language);
		$locale = $this->Session->read('Config.language');
        setlocale(LC_ALL, $locale);
        $this->set('locale',$locale);
		$this->Product->recursive= 1;
		$this->Product->locale = $locale;

		
		$this->Product->FlowerColour->locale = $this->Session->read('Config.language');
		$this->Product->SheetColour->locale = $this->Session->read('Config.language');

		$expositions                      = $this->Product->Exposition->find('list');
		$this->Product->PlantType->locale = $this->Session->read('Config.language');
		$plantTypes                       = $this->Product->PlantType->find('list');
		$irrigations                      = $this->Product->Irrigation->find('list');
		$programmingGroups                = $this->Product->ProgrammingGroup->find('list');
		$flowerColours                    = $this->Product->FlowerColour->find('list');
		$sheetColours                     = $this->Product->SheetColour->find('list');
		$this->Product->Utilization->locale = $this->Session->read('Config.language');
		$utilizations                     = $this->Product->Utilization->find('list');

		$this->Product->Characteristic->locale = $this->Session->read('Config.language');
		$characteristics                     = $this->Product->Characteristic->find('list');
		
		$temperatures                     = $this->Product->Temperature->find('list');

		$this->loadModel('PlantType');

		$this->PlantType->locale = $this->Session->read('Config.language');

		$this->set('plantTypes', $this->PlantType->find('all'));
		$this->set(compact('expositions', 'plantTypes', 'irrigations', 'programmingGroups', 'flowerColours', 'sheetColours', 'utilizations','characteristics', 'temperarutes'));


	
		if (!$this->Product->exists($id)) {
			$this->Session->setFlash(__('Producto inexistente'), 'default', array(), 'bad');
			$this->set('carga_datos','0');
			$this->set('product_list',array());
			$this->set('ficha',null);
            return;
			//throw new NotFoundException(__('Producto inexistente'));
		} else {



			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));

			$this->Product->locale = $locale;
			$ficha = $this->Product->find('all', $options);

			$this->pageTitle = ucfirst(strtolower($ficha[0]['Product']['description']));
			$this->set('title_for_layout',$this->pageTitle);
			
			$this->set('ficha', $ficha[0]);

			if (!empty($this->Session->read('Product.results'))) {
				

				$product_list = $this->Session->read('Product.results');
				$this->set('product_list', $product_list);
				$this->set('total_registers', $this->Session->read('total_registers'));

				$this->set('actual_page', $this->Session->read('pagina'));
				$this->set('limit', $this->Session->read('limit'));

				$this->request->data = $this->Session->read('paramForm');


$this->set('carga_datos','1');

				/*$this->Session->delete('paramForm');
				$this->Session->delete('Product.results');
				$this->Session->delete('pagina');
				$this->Session->delete('limit');*/


			} else {
				$this->layout='popup';
				
				$this->set('carga_datos','1');
			}
		}

	}


/**
 * list method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function lista($pagina = null, $plantTypeId = null, $id = null) {
		$locale = $this->Session->read('Config.language');
        setlocale(LC_ALL, $locale);
        $this->set('locale',$locale);
		$this->Product->recursive= 1;
		$this->Product->locale = $locale;

		$limit = 10;
		$pagina = (!empty($pagina)) ? $pagina : 1;

		if (!empty($plantTypeId)) {
			$conditions[]= array('Product.plant_type_id' => $plantTypeId);
		}
		$conditions[] = array('Product.published' => 1);


		if (!empty($this->request->data['exposition_id'])) {
			$conditions[]= array('Product.exposition_id' => $this->request->data['exposition_id']);	
		}
		if (!empty($this->request->data['irrigation_id'])) {
			$conditions[]= array('Product.irrigation_id' => $this->request->data['irrigation_id']);	
		}
		if (!empty($this->request->data['plant_type_id'])) {
			$conditions[]= array('Product.plant_type_id' => $this->request->data['plant_type_id']);
		}
		if (!empty($this->request->data['description'])) {
			$conditions[]= array('Product.description LIKE ' => '%'.$this->request->data['description'].'%');
		}
		if (!empty($this->request->data['common_name'])) {
			$conditions[]= array('Product.common_name LIKE' => '%'.$this->request->data['common_name'].'%');
		}
		if (!empty($this->request->data['temperature'])) {
			$conditions[]= array('Product.temperature LIKE ' => '%'.$this->request->data['temperature'].'%');
		}
		if (!empty($this->request->data['floration'])) {
			$aMonthFloration = $this->request->data['floration'];
		}
		if (!empty($this->request->data['availability'])) {
			$aMonthAvailability = $this->request->data['availability'];
		}
		
		if (!empty($this->request->data['fragrance'])) {
			$conditions[] = array('Product.fragrance' => $this->request->data['fragrance']);
		}

		$product_list = $this->Product->find('all',array('conditions'=>$conditions, 'order'=>'Product.description'));
		$product_list = Hash::extract($product_list,'{n}.Product');
		
		$this->pageTitle = __('Nuestra gama');
		$this->set('title_for_layout',$this->pageTitle);
		
		$auxProducts = array();
		$lastCount = $pagina * $limit;
		$initialCount = $lastCount - $limit + 1;

		for ($i=0; $i < count($product_list); $i++) { 
			$cont = $i + 1;
			
			if ($cont >= $initialCount && $cont <= $lastCount) {
				$auxProducts[] = $product_list[$i];
			}
		}

		$this->set('total_registers', count($product_list));
		$this->set('actual_page', $pagina);
		$this->set('limit', $limit);

		$product_list = $auxProducts;
		$this->set('product_list', $product_list);
		

		if (empty($id)) {
			$id = $product_list[0]['id'];
		}


		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Producto inexistente'));
		}

		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id),'order'=>array('Product.description' => 'asc'));

		$this->Product->locale = $locale;
		$ficha = $this->Product->find('first', $options);
		$this->loadModel('PlantType');
		$this->PlantType->locale = $locale;
		$planType = $this->PlantType->findByid($ficha['PlantType']['id']);
		
		//si la traduccio de plantype no existeix agafem la que té per defecte en castellà, si no la sobreescrivim
		if (!empty($planType)) {
			$ficha['PlantType'] = $planType['PlantType'];
		}

		if (empty($plantTypeId) && !(empty($id))) {
			$plantTypeId = $ficha['PlantType']['id'];
		}

		$this->set('ficha', $ficha);
		$this->set('plant_type_id', $plantTypeId);
		
	}

	/**
 * novedades method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function novedades($language = 'esp',$programmingGroupCode = null) {
		
		$this->Session->write('Config.language',$language);
		$locale = $this->Session->read('Config.language');
        setlocale(LC_ALL, $locale);

		$mesActual = date('n');

		$this->Product->recursive = 1;


		$sql = "SELECT sum(unities), products.id, products.code, products.description, products.plant_type_id, products.image ";
		$sql .= "FROM products, programming_groups, programmings ";
		$sql .= "where products.programming_group_id = programming_groups.id and ";
		$sql .= "(( programming_groups.period_start <= programming_groups.period_end and ";
		$sql .= " programming_groups.period_end >= ".$mesActual." and ";
		$sql .= " programming_groups.period_start <= ".$mesActual." ) OR ";
		$sql .= " (programming_groups.period_end < programming_groups.period_start and ";
		$sql .= " programming_groups.period_start <=".$mesActual.")) and ";
		$sql .= "programmings.product_id = products.id and ";
		$sql .= "programmings.month = ".$mesActual." and products.image is not null ";
		$sql .= "group by products.id, products.code, products.description, products.plant_type_id ";
		$sql .= "order by 1 desc limit 30";


		$product_list = $this->Product->query($sql);

		$this->Product->locale = $language;
		
		foreach ($product_list as $producto) {
			$arrayProducto[] = $producto['products'];
			# code...
		}

		$product_list = $arrayProducto;
		
		
		$this->layout='ajax';
		$this->set('product_list', $product_list);

	}




	public function gallery($code) {


		$sql = "select id from products where code ='".$code."'";

		$product = $this->Product->query($sql);	

		$product_id = $product[0]['products']['id'];


		$sql = "select * from product_images where product_id = ".$product_id;

		$imatges = $this->Product->query($sql);	

		$this->set('imatges',$imatges);

		$this->layout='';

	}


}
