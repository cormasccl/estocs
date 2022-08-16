<?php
App::uses('AppController', 'Controller');

App::import('Controller', 'Galleries'); // mention at top

/**
 * Details Controller
 *
 * @property Detail $Detail
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class DetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index($stock_id = null) {


        $this->layout = 'default_app';
		
		$this->set('page','estocs');		

		$this->set('stock_id', $stock_id);

		$this->Detail->Stock->recursive = 0;




		$stock = $this->Detail->Stock->findById($stock_id);



        $this->loadModel('Products');
        $product =  $this->Products->findById($stock['Article']['product_id']);

        $stock['Product'] = $product['Products'];

        $this->set('stock', $stock);
		

        $query = "SELECT Details.id, Flowerings.code as FloweringCode, Flowerings.name as FloweringName, 
            Growings.code as GrowingCode, Growings.name as GrowingName, 
            Galleries.image_published, Galleries.image_uploaded, Galleries.image, Details.unities, 
            Details.observations, Details.reserved_unities, Details.available_unities , Details.stock_reserved 
            FROM details Details LEFT JOIN galleries Galleries ON Details.id = Galleries.detail_id AND Galleries.principal  = 1,
            flowerings Flowerings, growings Growings
            WHERE Details.flowering_id = Flowerings.id AND 
            Details.growing_id = Growings.id AND 
            Details.stock_id = ".$stock_id." and 1=1 ";

        $details = $this->Detail->query($query);

        /*$options = array('conditions' => array('Detail.stock_id'  => $stock_id));

       
        $this->Detail->recursive = 1;
        $this->Detail->Stock->recursive = 0;

        $details = $this->Detail->find('all', $options);*/

		$this->set('Details', $details);

        $param = '';
        if (!empty($this->Session->read('Stocks.filter_name'))) {
            $param = "?data%5BStocks%5D%5Bfilter_name%5D=".$this->Session->read('Stocks.filter_name')."&data%5BStocks%5D%5Bfilter_stock%5D=".$this->Session->read('Stocks.filter_stock');
            
        }
        $page = 1;
        /*if (!empty($this->Session->read('Stocks.page'))) {
            $page = $this->Session->read('Stocks.page');
        }*/
        $url_back = SERVER.'Stocks/index/'.$page.'/'.$this->Session->read('partner').$param;

        $this->set('url_back',$url_back);


	}



	public function ajaxManageStocksSearch($stock_id){




        $this->autoRender = false;


        $requestData= $this->request->data;


        $query = array();
        $query['count']  = "SELECT count( Details.id) AS count  FROM `details` Details LEFT JOIN flowerings Flowerings ON Details.`flowering_id` = Flowerings.id LEFT JOIN growings Growings ON Details.`growing_id` = Growings.id WHERE Details.stock_id = ".$stock_id." and 1=1 ";

        /*$query['detail'] = "SELECT Details.id, Flowerings.`code` as FloweringCode,Flowerings.`name` as FloweringName, Growings.`code` as GrowingCode, Growings.`name` as GrowingName, Galleries.image_published, Galleries.image, Details.unities, Details.observations, Details.reserved_unities, Details.available_unities FROM `details` Details LEFT JOIN flowerings Flowerings ON Details.`flowering_id` = Flowerings.id LEFT JOIN growings Growings ON Details.`growing_id` = Growings.id LEFT JOIN v_galleries Galleries ON Details.`id` =Galleries.`detail_id` AND Galleries.`principal`  = 1 WHERE Details.stock_id = ".$stock_id." and 1=1 ";*/

        $query['detail'] = "SELECT Details.id, Flowerings.code as FloweringCode, Flowerings.name as FloweringName, 
            Growings.code as GrowingCode, Growings.name as GrowingName, 
            Galleries.image_published, Galleries.image_uploaded, Galleries.image, Details.unities, 
            Details.observations, Details.reserved_unities, Details.available_unities , Details.stock_reserved 
            FROM details Details LEFT JOIN galleries Galleries ON Details.id = Galleries.detail_id AND Galleries.principal  = 1,
            flowerings Flowerings, growings Growings
            WHERE Details.flowering_id = Flowerings.id AND 
            Details.growing_id = Growings.id AND 
            Details.stock_id = ".$stock_id." and 1=1 ";

        $this->Session->write('query', $query);
    
        extract($this->Session->read('query'));

        $cond = "";
        if( isset($requestData['search']['value']) && !empty( $requestData['search']['value'])) {
            $search = $requestData['search']['value'];
            $cond.=" AND ( Flowerings.code LIKE '".$search."%' OR  Growings.code LIKE '".$search."%'
            ) AND Details.stock_id = ".$stock_id;
        }
   
        $columns = array(
            0 => 'id',
            1 => 'FloweringCode',
            2 => 'FloweringName',
            3 => 'GrowingCode',
            4 => 'GrowingName',
            5 => 'image_published',
            6 => 'image',
            7 => 'unities',
            8 => 'reserved_unities',
            9 => 'available_unities'
        );

        $count = $count.$cond;
        $detail = $detail.$cond;

        //$conn = ConnectionManager::get('default');


        //$results = $conn->execute($count)->fetchAll('assoc');

        $results = $this->Detail->query($count);

   


        $results = $results[0];

        $totalData = isset($results[0]['count']) ? $results[0]['count'] : 0;
        $totalFiltered = $totalData;

        $sidx = $columns[$requestData['order'][0]['column']];
        $sord = $requestData['order'][0]['dir'];
        $start = $requestData['start'];
        $length = $requestData['length'];

        $SQL = $detail." ORDER BY $sidx $sord LIMIT $start , $length ";

        //$results = $conn->execute( $SQL )->fetchAll('assoc');

        $results = $this->Detail->query($SQL);
        

       



        
        $i = 0;
        $data = array();
        foreach ( $results as $row){


            
        	$stock_reserved = '';

            if ($row['Details']['stock_reserved'] == 1) { 
                $stock_reserved = ' ('.__('RESERVA').')';
            }

            $nestedData= [];
            $nestedData[] = $row['Growings']['GrowingCode'].' - '.$row['Flowerings']['FloweringCode'].$stock_reserved;//.' - '.$row['GrowingName'];
            
            $nestedData[] = "<a href='".SERVER."Details/edit/".$row['Details']['id']."' style='display: inline;'>".number_format($row['Details']['unities'], 0, ',', '.')."&nbsp;&nbsp;&nbsp;<i class='fa fa-pencil' aria-hidden='true'></i></a>";


            
            /*$nestedData[] = $row['Details']['unities'];
            $nestedData[] = $row['Details']['reserved_unities'];
            $nestedData[] = $row['Details']['available_unities'];*/


            $imatge = "<a href='".SERVER."Galleries/index/".$row['Details']['id']."'>";
            if (empty($row['Galleries']['image'])) {
                $imatge .= "<img src='https://www.corma.es/intranet/img/articles/thumbs/no_foto.jpg'>"."&nbsp;&nbsp;&nbsp";
            } else {
                if ($row['Galleries']['image_uploaded'] == 1 ) {
                    $imatge .= "<img src='https://www.corma.es/intranet/img/articles/thumbs/".$row['Galleries']['image']."' width='80px'>"."&nbsp;&nbsp;&nbsp";
                } else {
                    $imatge .= "<img src='".SERVER . 'uploads/'.$row['Galleries']['image']."' width='80px'>"."&nbsp;&nbsp;&nbsp";
                }
            }

            $imatge  .= "<i class='fa fa-picture-o' aria-hidden='true'></i></a>";

            
            /*$icons = "<a href='".SERVER."Galleries/index/".$row['Details']['id']."' alt='Galeria imatges' title='Galeria imatges'><i class='fa fa-picture-o' aria-hidden='true'></i></a><br />";*/

           
           /*$icons = "<a href='".SERVER."Details/edit/".$row['Details']['id']."' alt='Modificar estoc' title='Modificar estoc'><i class='fa fa-pencil' aria-hidden='true'></i></a><br />";*/

           /*$icons .= "<br /><a href='".SERVER."Details/delete/".$row['Details']['id']."' alt='Esborrar' title='Esborrar' onclick='return confirm(\"Estas segur?\");' ><i class='fa fa-trash-o' aria-hidden='true'></i></a>";*/


           $nestedData[] = $imatge;

            
            $data[] = $nestedData;
            $i++;



        }
//print_r($data).die;
        
        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );
        echo json_encode($json_data);exit;
    }




/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Detail->exists($id)) {
			throw new NotFoundException('Invalid detail');
		}
		$options = array('conditions' => array('Detail.' . $this->Detail->primaryKey => $id));
		$this->set('detail', $this->Detail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($article_id, $stock_id) {

        $this->set('page','estocs');
        $this->layout = 'default_app';
		if ($this->request->is('post')) {
			$this->Detail->create();

            $this->request->data['Detail']['unities_published'] = 0;
            $this->request->data['Detail']['available_unities'] = $this->request->data['Detail']['unities'];
            $this->request->data['Detail']['gallery_modified'] = 1;

            if (empty($this->request->data['Detail']['reserved_unities'])) {
                $this->request->data['Detail']['reserved_unities'] = 0;
            }

            $this->request->data['Detail']['stock_reserved'] = 0;

            
            $stock_id = $this->request->data['Detail']['stock_id'];

            if ($this->_existsQualityStock() ) {
                $this->Flash->error('Ya existe esta calidad por este artículo.');


            } else {

                $growing_id = $this->request->data['Detail']['growing_id'];
                $flowering_id = $this->request->data['Detail']['flowering_id'];

                $this->loadModel('ImagesQuality');

                $options = array('conditions' => array(
                        'article_id' => $article_id,
                        'growing_id' => $growing_id,
                        'flowering_id' => $flowering_id));
        

                $imgQuality = $this->ImagesQuality->find('first', $options);





                

    			if ($this->Detail->save($this->request->data)) {


                    $detail_id = $this->Detail->getLastInsertId();



                    $this->request->data['Gallery']['change_image'] = $this->request->data['Detail']['change_image'];

                    $this->request->data['Gallery']['detail_id'] = $detail_id;


                    if ($this->request->data['Detail']['change_image'] =='S') {
                        $this->request->data['Gallery']['quality'] = 0;
                    } else {
                        $this->request->data['Gallery']['quality'] = 1;


                        $valor = $this->ImagesQuality->findById($this->request->data['Detail']['imatgeQualitat']);


                        $this->request->data['Gallery']['image'] = $valor['ImagesQuality']['image'];
                        $this->request->data['Gallery']['image_uploaded'] = 1;
                        //debug($this->request->data['Detail']['image']).die;
                    }

                    
                    


                    $this->request->data['Gallery']['principal'] = 1;


                    $ctrGall = new GalleriesController;

                    $ctrGall->request = $this->request;

                    $ctrGall->Flash = $this->Flash;
                    $ctrGall->response = $this->response;
                    $ctrGall->FlashMessage =false;
                    $retorn = $ctrGall->add();


                    //debug($retorn).die;



    

                    //$this->loadModel('Galleries');


                    //$this->Galleries->add();



                    

                    /*if (!empty($imgQuality)) {
                        
                        $galleries = array('detail_id'=> $detail_id,
                                    'image'=>$imgQuality['ImagesQuality']['image'],
                                    'quality'=>1,
                                    'image_published'=>1,
                                    'image_uploaded' =>1);
                        $this->Galleries->create();
                        
                        if ($this->Galleries->save($galleries)) {
                        }
                    }*/



    				$this->Flash->success('Calidad añadida correctamente.');
    				return $this->redirect(array('action' => 'index', $stock_id));
    			} else {
    				$this->Flash->error('The detail could not be saved. Please, try again.');
    			}
            }
		}

        /*$sql = "select ImagesQuality.id, ImagesQuality.image, ImagesQuality.growing_id, ";
        $sql .="ImagesQuality.flowering_id from images_quality ImagesQuality, growings Growing "*/

        $this->loadModel('ImagesQuality');


        $sql = "select ImagesQuality.*, Growing.code, Flowering.code ";
        $sql .= "from images_quality ImagesQuality, growings Growing, flowerings Flowering ";
        $sql .= "where ImagesQuality.growing_id = Growing.id and ";
        $sql .= "    ImagesQuality.flowering_id = Flowering.id and ";
        $sql .= "    ImagesQuality.article_id = ".$article_id." and ";
        $sql .= "    not exists (select 1 from details Detail, stocks Stock ";
        $sql .= "                where Detail.stock_id = Stock.id and ";
        $sql .= "                    Stock.id = ".$stock_id." and ";
        $sql .= "                    Detail.growing_id = ImagesQuality.growing_id and ";
        $sql .= "                    Detail.flowering_id = ImagesQuality.flowering_id)";

        $imgQuality = $this->ImagesQuality->query($sql);

        /*$options = array('conditions' => array(
                        'article_id' => $article_id));
        

        $imgQuality = $this->ImagesQuality->find('all', $options);


        $options = array('conditions'=>array(
                        'Stock.article_id'=>$article_id));
        $this->Detail->recursive = 0;
        $details = $this->Detail->find('all', $options);

        

        debug($details);*/


        $this->set('imgQuality',$imgQuality);


        $this->loadModel('Articles');
        $articles = $this->Articles->findById($article_id);

        $this->set('article_name', $articles['Articles']['name']);
        $this->set('stock_id', $stock_id);



		$stocks = $this->Detail->Stock->find('list');
        /*$this->Detail->Growing->recursive = -1;
		$growings = $this->Detail->Growing->find('all', array('order'=>'Growing.sorting'));
        $this->Detail->Flowering->recursive = -1;
		$flowerings = $this->Detail->Flowering->find('all', array('order'=>'Flowering.sorting'));*/
        $growings = $this->_getGrowings();
        $flowerings = $this->_getFlowerings();
		$this->set(compact('stocks', 'growings', 'flowerings'));
	}


    private function _existsQualityStock()
    {
        $stock_id = $this->request->data['Detail']['stock_id'];
        $growing_id = $this->request->data['Detail']['growing_id'];
        $flowering_id = $this->request->data['Detail']['flowering_id'];
        $stock_reserved = $this->request->data['Detail']['stock_reserved'];

        $options = array('conditions' => array(
                                'Detail.stock_id'=>$stock_id, 
                                'Detail.growing_id'=>$growing_id, 
                                'Detail.flowering_id'=>$flowering_id,
                                'Detail.stock_reserved'=>$stock_reserved));

        return $this->Detail->find('first', $options);
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {


        $this->layout = 'default_app';
        $this->set('page','estocs');

        $this->Detail->recursive = 2;
        if (!$this->Detail->exists($id)) {
            throw new NotFoundException('Invalid detail');
        }
        if ($this->request->is(array('post', 'put'))) {


            $stock_id = $this->request->data['Detail']['stock_id'];


            $this->request->data['Detail']['available_unities'] = $this->request->data['Detail']['unities'] - $this->request->data['Detail']['reserved_unities'];



            //print_r($details).die;
            //if ($this->request->data['Detail']['unities'] != $Details['unities']) {
                $this->request->data['Detail']['unities_published'] = 0;
            //}


            if ($this->Detail->save($this->request->data)) {
                $this->Flash->success('Calidad actualizada correctamente.');
                return $this->redirect(array('action' => 'index', $stock_id));
            } else {
                $this->Flash->error('The detail could not be saved. Please, try again.');
            }
        } else {
            $options = array('conditions' => array('Detail.' . $this->Detail->primaryKey => $id));
            $this->request->data = $this->Detail->find('first', $options);
        }




        $growings = $this->_getGrowings();
        $flowerings = $this->_getFlowerings();
        
       
         $this->set(compact('growings', 'flowerings'));

       
	}


    /*public function _getGrowings()
    {
        $growings = $this->Detail->Growing->find('list',  array('order'=>'Growing.sorting'));       


        $this->Detail->Growing->recursive = -1;

        foreach ($growings as $key => $value) {

            $code = $this->Detail->Growing->findById($key);
            if ($code['Growing']['code'] != 'CP') {
                $return[$key] = $code['Growing']['code'].' - '.$value;
                //$growings[$key] = $code['Growing']['code'].' - '.$value;
            }
        }


        
        return $return;
    }

    public function _getFlowerings()
    {
        $flowerings = $this->Detail->Flowering->find('list', array('order'=>'Flowering.sorting'));       

        $this->Detail->Flowering->recursive = -1;

        foreach ($flowerings as $key => $value) {
            $code = $this->Detail->Flowering->findById($key);
            //debug($code);
            $flowerings[$key] = $code['Flowering']['code'].' - '.$value;
        }

        return $flowerings;
    }*/

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {



         $detail = $this->Detail->findById($id);


        
		$this->Detail->id = $id;
		if (!$this->Detail->exists()) {
			throw new NotFoundException('Invalid detail');
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->Detail->delete()) {
			 $this->Flash->success("Calidad borrada correctamente");
		} else {
			$this->Flash->error('The detail could not be deleted. Please, try again.');
		}
		return $this->redirect(array('action' => 'index', $detail['Detail']['stock_id']));
	}
}
