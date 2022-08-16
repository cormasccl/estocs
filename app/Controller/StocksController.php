<?php
App::uses('AppController', 'Controller');
/**
 * Stocks Controller
 *
 * @property Stock $Stock
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class StocksController extends AppController {

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
	public function index($page = 1, $partner_id = null) {


        $this->layout = 'default_app';
		//$this->Stock->recursive = 0;
		//$this->set('stocks', $this->Paginator->paginate());

		$this->set('title', __("Gestión de estocs Corma"));
        $this->set('page','estocs');
        //$user = $this->Auth->user();
        //$user = $this->Session->read('userdata');

        $user = $this->Session->read('User.logged');

        

        //debug($user).die;
        $this->set('user',$user);

        if (empty($partner_id)) {
            if (empty($this->Session->read('partner'))) {
                $partner_id = $user['partner_id'];
            }
            else {
                $partner_id = $this->Session->read('partner');
            }
        }
        $this->Session->write('partner', $partner_id);
        
        $partner_id = $this->Session->read('partner');


        $limit = 10;

       
        /*$query = "SELECT Stocks.id, Articles.id, Articles.name, Products.description, coalesce(sum(Details.unities),0) 'Unities' 
        FROM `stocks` Stocks LEFT OUTER JOIN `details` Details on Details.`stock_id` = Stocks.id 
        LEFT OUTER JOIN `articles` Articles ON Articles.id = Stocks.article_id
        LEFT JOIN products Products ON Articles.product_id = Products.id WHERE Stocks.partner_id = ".$partner_id;*/

        $query = "SELECT Stocks.id, Articles.id, Articles.name, Articles.price, Products.description, Stocks.Unities, Stocks.available_unities 
        FROM `stocks` Stocks LEFT OUTER JOIN `articles` Articles ON Articles.id = Stocks.article_id
        LEFT JOIN products Products ON Articles.product_id = Products.id WHERE Articles.active = 1 and Stocks.partner_id = ".$partner_id;

        $query_count  = "SELECT count( Stocks.id) AS count  FROM `stocks` Stocks LEFT JOIN articles Articles ON Stocks.`article_id` = Articles.id LEFT JOIN products Products ON Articles.product_id = Products.id WHERE Articles.active = 1 and Stocks.partner_id =".$partner_id;


        $requestData = $this->request->query;

        $filter_stock = "S";

        $filter_name = '';


        $url = SERVER.$this->request->url;
        $param = '';

        if (!empty($requestData)) {

            $filter_name = $requestData['data']['Stocks']['filter_name'];
            $filter_stock = $requestData['data']['Stocks']['filter_stock'];
             
            

            if (isset($filter_name) && !empty($filter_name)) {
                $query .= " AND ( Articles.name LIKE '%".$filter_name."%' OR Products.description LIKE '%".$filter_name."%' ) " ;

                $query_count .= " AND ( Articles.name LIKE '%".$filter_name."%' OR Products.description LIKE '%".$filter_name."%' ) " ;
            }

            $param = "?data%5BStocks%5D%5Bfilter_name%5D=".$requestData['data']['Stocks']['filter_name']."&data%5BStocks%5D%5Bfilter_stock%5D=".$requestData['data']['Stocks']['filter_stock'];
        
        }

        
        $this->set('param',$param);

        if ($filter_stock == "S") {
            /*$query = $query." group by Stocks.id, Articles.id, Articles.name, Products.description HAVING coalesce(sum(Details.unities),0) > 0 ";  */
            $query = $query." AND Stocks.available_unities > 0 "; 
            
            /*$query_count = $query_count." and exists (select 1 from `details` Details where Details.stock_id = Stocks.id having coalesce(sum(Details.unities),0) > 0)";  */
            $query_count = $query_count." AND Stocks.available_unities > 0 ";
        }

         if ($filter_stock == "N") {
            /*$query = $query." group by Stocks.id, Articles.id, Articles.name, Products.description HAVING coalesce(sum(Details.unities),0) = 0 ";    */
            $query = $query." AND Stocks.available_unities = 0 "; 

            /*$query_count = $query_count." and exists (select 1 from `details` Details where Details.stock_id = Stocks.id having coalesce(sum(Details.unities),0) = 0)";      */

            $query_count = $query_count." AND Stocks.available_unities = 0 ";    
        }

         if ($filter_stock == "T") {
            //$query = $query." group by Stocks.id, Articles.id, Articles.name, Products.description ";
         }

         if ($page == 1) {
            $start = 0;
        } else {
             $start = (($page - 1) * $limit);
        }
        
         $query = $query." ORDER BY Articles.name LIMIT ".$start.", ".$limit;


        $this->Session->write('Stocks.filter_name',$filter_name);
        $this->Session->write('Stocks.filter_stock',$filter_stock);

        $this->set('filter_name',$filter_name);
        $this->set('filter_stock',$filter_stock);

        $numStocks = $this->Stock->query($query_count);
        if ($numStocks > $page * $limit) {
            $next = $page + 1;
            $this->set('next',$next);
        }

        $this->Session->write('Stocks.page', $page);


        $stocks = $this->Stock->query($query);
        $this->set('Stocks', $stocks);

        $this->set('partner_id', $partner_id);    


	}


    public function home($page = 1) {
        $this->layout = 'default_app';
        $this->Stock->Partner->recursive = 0;
        $partners = $this->Stock->Partner->find('all', array('order'=>array('Partner.code'=>'ASC')));
        $this->set('partners',$partners);



        $limit = 10;

        $query = "SELECT Articles.id, Articles.name, Articles.price, Articles.price_madrid, Products.description, sum(Stocks.available_unities ) available_unities
        FROM `stocks` Stocks lEFT OUTER JOIN `articles` Articles ON Articles.id = Stocks.article_id
        LEFT JOIN products Products ON Articles.product_id = Products.id WHERE 1 = 1 and Articles.active = 1 ";

        /*$query_count  = "SELECT count( Stocks.id) AS count  FROM `stocks` Stocks LEFT JOIN articles Articles ON Stocks.`article_id` = Articles.id LEFT JOIN products Products ON Articles.product_id = Products.id WHERE 1 = 1 ";*/


        $user = $this->Session->read('User.logged');

        if ($user['show_price'] == 1 && $user['show_price_madrid'] == 1 ) {
            $filter_price = 'T';
        }

        if ($user['show_price'] == 1 && $user['show_price_madrid'] == 0) {
            $filter_price = 'P';
        }

        if ($user['show_price'] == 0 && $user['show_price_madrid'] == 1) {
            $filter_price = 'M';
        }

        $requestData = $this->request->query;

        $filter_stock = "S";

        $filter_name = '';
        



        $url = SERVER.$this->request->url;
        $param = '';

        if (!empty($requestData)) {

            $filter_name = $requestData['data']['Stocks']['filter_name'];
            $filter_stock = $requestData['data']['Stocks']['filter_stock'];
            $filter_price = $requestData['data']['Stocks']['filter_price'];
             
            

            if (isset($filter_name) && !empty($filter_name)) {
                $query .= " AND ( Articles.name LIKE '%".$filter_name."%' OR Products.description LIKE '%".$filter_name."%' ) " ;

                /*$query_count .= " AND ( Articles.name LIKE '%".$filter_name."%' OR Products.description LIKE '%".$filter_name."%' ) " ;*/
            }

            $param = "?data%5BStocks%5D%5Bfilter_name%5D=".$requestData['data']['Stocks']['filter_name']."&data%5BStocks%5D%5Bfilter_stock%5D=".$requestData['data']['Stocks']['filter_stock']."&data%5BStocks%5D%5Bfilter_price%5D=".$requestData['data']['Stocks']['filter_price'];
        
        }

        
        $this->set('param',$param);




        $query .= " GROUP BY Articles.id, Articles.name, Articles.price, Articles.price_madrid, Products.description ";

        if ($filter_stock == "S") {
            $query = $query." HAVING sum(Stocks.available_unities) > 0 ";       
            
            //$query_count = $query_count." HAVING sum(Stocks.Unities) > 0 ";  
        }

         if ($filter_stock == "N") {
            $query = $query." HAVING sum(Stocks.available_unities) = 0 ";    

            //$query_count = $query_count." HAVING sum(Stocks.Unities) = 0 ";          
        }

         if ($page == 1) {
            $start = 0;
        } else {
             $start = (($page - 1) * $limit);
        }


        $datos = $this->Stock->query($query);

        $numStocks = count($datos);
        
        
        
         $query = $query." ORDER BY Articles.name LIMIT ".$start.", ".$limit;

         $this->Session->write('query',$query);
        //$this->Session->write('query_count',$query_count);

        //debug($query_count).die;



        $this->Session->write('Stocks.filter_name',$filter_name);
        $this->Session->write('Stocks.filter_stock',$filter_stock);
        $this->Session->write('Stocks.filter_price',$filter_price);

        $this->set('filter_name',$filter_name);
        $this->set('filter_stock',$filter_stock);
        $this->set('filter_price',$filter_price);


        //$numStocks = $this->Stock->query($query_count);
        if ($numStocks > $page * $limit) {
            $next = $page + 1;
            $this->set('next',$next);
        }

        $this->Session->write('Stocks.page', $page);


        $stocks = $this->Stock->query($query);
        $this->set('Stocks', $stocks);


        /*if (isset($this->request->params['named']['sort'])) {
            $sorting = $this->request->params['named']['sort'];
            $direction = $this->request->params['named']['direction'];
        } else {
            $sorting = 'Articles.name';
            $direction = 'asc';
        }


        $order = array($sorting => $direction);

        $conditions['sql'] = $query;
        $conditions['count'] = $query_count;
        $conditions['order']  = $sorting.' '.$direction;

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => $order
        );



       $this->set('Stocks', $this->Paginator->paginate($conditions));

       $this->set('sorting', $sorting);
       $this->set('direction', $direction);*/
    
    }


	public function ajaxManageStocksSearch(){


        $this->autoRender = false;


        $requestData = $this->request->data;


        $partner = $this->Session->read('partner');

        $filter_active = $this->Session->read('filter_active');


        $filter_stock = $this->Session->read('filter_stock');

        $this->Session->write('filter_stock', $this->request->data['columns'][0]['search']['value']);

        $filter_stock = $this->request->data['columns'][0]['search']['value'];

        if (empty($filter_stock)) 
            $filter_stock = "S";

        $query = array();
        
        $query['count']  = "SELECT count( Stocks.id) AS count  FROM stocks Stocks, articles Articles, products Products
            where Stocks.article_id = Articles.id and Articles.active = 1 and Articles.product_id = Products.id and
            Stocks.partner_id = ".$partner." and Stocks.active =".$filter_active;

       

        
        $query['detail'] = "SELECT Stocks.id, Articles.id, Articles.name, Products.description, coalesce(sum(Details.unities)) unities FROM stocks Stocks, details Details, articles Articles, products Products WHERE Stocks.id = Details.stock_id AND Stocks.article_id = Articles.id AND Articles.active = 1 and Articles.product_id = Products.id AND Stocks.partner_id = ".$partner." and Stocks.active =".$filter_active;

       
        $this->Session->write('query', $query);
    
        extract($this->Session->read('query'));

        $cond = "";
        if( isset($requestData['search']['value']) && !empty( $requestData['search']['value'] ) ){
            $search = $requestData['search']['value'];
            $cond.=" AND ( Articles.name LIKE '%".$search."%' OR Products.description LIKE '%".$search."%' ) " ;

            
        }
   
        $columns = array(
            0 => 'Articles.name',
            1 =>'unities'
        );

        $count = $count.$cond;
        $detail = $detail.$cond;


        if ($filter_stock == "S") {
            $count = $count." and exists (select 1 from `details` Details where Details.stock_id = Stocks.id having coalesce(sum(Details.unities),0) > 0)";
            
        }
        if ($filter_stock == "N") {
            $count = $count." and exists (select 1 from `details` Details where Details.stock_id = Stocks.id having coalesce(sum(Details.unities),0) = 0)";
            
        }


        if ($filter_stock == "S") {
            $detail = $detail." group by Stocks.id, Articles.id, Articles.name, Products.description HAVING coalesce(sum(Details.unities),0) > 0 ";
            
        }

         if ($filter_stock == "N") {
            $detail = $detail." group by Stocks.id, Articles.id, Articles.name, Products.description HAVING coalesce(sum(Details.unities),0) = 0 ";
            
        }

         if ($filter_stock == "T") {
            $detail = $detail." group by Stocks.id, Articles.id, Articles.name, Products.description ";
         }

  

        $results = $this->Stock->query($count);

        $results = $results[0];

        $totalData = isset($results[0]['count']) ? $results[0]['count'] : 0;
        
        
        $totalFiltered = $totalData;

        

        $sidx = $columns[$requestData['order'][0]['column']];
        $sord = $requestData['order'][0]['dir'];
        $start = $requestData['start'];
        $length = $requestData['length'];

        $SQL = $detail." ORDER BY $sidx $sord LIMIT $start , $length ";


        
        $results = $this->Stock->query($SQL);
        

        
        $i = 0;
        $data = array();
        foreach ( $results as $row){        

            $nestedData= [];
            $nestedData[] = "<a href='".SERVER."Details/index/".$row['Stocks']["id"]."'><p>".$row['Articles']["name"]."</p><p class='nom_botanic'>".$row['Products']['description']."</p></a>";

            

            if ($row[0]["unities"] == null ) {
                $nestedData[] = 0;
            } else {
                $nestedData[] = number_format($row[0]["unities"], 0, ',', '.');
            }
            $data[] = $nestedData;
            $i++;
        }

        //$this->Session->write('query_last', date("H:i:s"));

        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );
        echo json_encode($json_data);exit;


    }



    public function detail($filter_by = 1, $valor = null ) {

        $this->layout = 'default_app';
        $this->loadModel('Gallery');

        if ($filter_by == 1 ) {

          

            /*$sql = "SELECT Stocks.id stock_id, Details.id detail_id, Partners.code, ";
            $sql .= "Partners.name, Growings.code Creixement, Flowerings.code Floracio, ";
            $sql .= "Details.unities, Galleries.image, Galleries.quality, Galleries.image_uploaded, Details.stock_reserved ";
            $sql .= "FROM galleries Galleries, details Details, stocks Stocks, partners Partners, ";
            $sql .= "growings Growings, flowerings Flowerings ";
            $sql .= "where Stocks.article_id = ".$valor." and ";
            $sql .= "Stocks.id = Details.stock_id and ";
            $sql .= "Stocks.partner_id = Partners.id and ";
            $sql .= "Details.id = Galleries.detail_id and ";
            $sql .= "Details.growing_id = Growings.id and ";
            $sql .= "Details.flowering_id = Flowerings.id and ";
            $sql .= "Galleries.principal = 1 ";
            $sql .= "order by Partners.code, Growings.sorting, Flowerings.sorting ";*/


            $sql = "SELECT Stocks.id stock_id, Details.id detail_id, Partners.code, ";
            $sql .= "Partners.name, Growings.code Creixement, Flowerings.code Floracio, ";
            $sql .= "Details.available_unities, Galleries.image, Galleries.quality, Galleries.image_uploaded, ";
            $sql .= "Details.stock_reserved ";
            $sql .= "FROM stocks Stocks, partners Partners, growings Growings, flowerings Flowerings, ";
            $sql .= "details Details LEFT OUTER JOIN galleries Galleries ON Galleries.detail_id = Details.id ";
            $sql .= "and Galleries.principal = 1 ";
            $sql .= "WHERE Stocks.article_id = ".$valor." and ";
            $sql .= "Stocks.id = Details.stock_id and ";
            $sql .= "Stocks.partner_id = Partners.id and ";
            $sql .= "Details.growing_id = Growings.id and ";
            $sql .= "Details.flowering_id = Flowerings.id  ";
            $sql .= "order by Partners.code, Growings.sorting, Flowerings.sorting ";






        
            $datos = $this->Gallery->query($sql);

            $this->set('datos',$datos);



            $this->set('article_id', $valor);   

            $this->loadModel('Articles');

            $articles = $this->Articles->findById($valor);


            $this->loadModel('Products');
            $product = $this->Products->findById($articles['Articles']['product_id']);

            

            $this->set('titol', $articles['Articles']['name'].' - '.$product['Products']['description']); 


            if ($this->Session->read('Stocks.filter_price') == 'P') {
                $this->set('preu_article', $this->str_price($articles['Articles']['price']));
            }
            if ($this->Session->read('Stocks.filter_price') == 'M') {
                $this->set('preu_article', $this->str_price($articles['Articles']['price_madrid']));
            }
            if ($this->Session->read('Stocks.filter_price') == 'T') {
                $this->set('preu_article', $this->str_price($articles['Articles']['price'])." / ".$this->str_price($articles['Articles']['price_madrid']));
            }



        } else {



            /*$sql = "SELECT Stocks.id stock_id, Details.id detail_id, Articles.id, Articles.name, ";
            $sql .= "Products.description, Growings.code Creixement, Flowerings.code Floracio, ";
            $sql .= "Details.unities, Galleries.image, Galleries.quality, Galleries.image_uploaded ";
            $sql .= "FROM galleries Galleries, details Details, stocks Stocks, articles Articles, ";
            $sql .= "growings Growings, flowerings Flowerings, products Products ";
            $sql .= "where Stocks.partner_id = ".$valor." and ";
            $sql .= "Stocks.article_id = Articles.id and ";
            $sql .= "Articles.product_id = Products.id and ";
            $sql .= "Stocks.id = Details.stock_id and ";
            $sql .= "Details.id = Galleries.detail_id and ";
            $sql .= "Details.growing_id = Growings.id and ";
            $sql .= "Details.flowering_id = Flowerings.id and ";
            $sql .= "Galleries.principal = 1 ";
            $sql .= "order by Articles.name, Products.description, Growings.sorting, Flowerings.sorting ";


            $this->Session->write('sql',$sql);

        
            $datos = $this->Gallery->query($sql);

            $this->set('datos',$datos);*/



            $this->set('partner_id', $valor);
            $this->loadModel('Partners');
            $partners = $this->Partners->findById($valor);
            $this->set('titol', $partners['Partners']['name']); 






            $query = "SELECT Stocks.id stock_id, Details.id detail_id, Articles.id, Articles.name, ";
            $query .= "Articles.price, Articles.price_madrid, ";
            $query .= "Products.description, Growings.code Creixement, Flowerings.code Floracio, ";
            $query .= "Details.available_unities, Galleries.image, Galleries.quality, Galleries.image_uploaded, Details.stock_reserved ";
            $query .= "FROM stocks Stocks, articles Articles, growings Growings, ";
            $query .= "flowerings Flowerings, products Products, ";
            $query .= "details Details LEFT OUTER JOIN galleries Galleries ON ";
            $query .= "Galleries.detail_id = Details.id and Galleries.principal = 1 ";
            $query .= "where Stocks.partner_id = ".$valor." and ";
            $query .= "Stocks.article_id = Articles.id and ";
            $query .= "Articles.product_id = Products.id and ";
            $query .= "Stocks.id = Details.stock_id and ";
            $query .= "Details.growing_id = Growings.id and ";
            $query .= "Details.flowering_id = Flowerings.id  ";
         




            /*$query = "SELECT Stocks.id stock_id, Details.id detail_id, Articles.id, Articles.name, ";
            $query .= "Products.description, Growings.code Creixement, Flowerings.code Floracio, ";
            $query .= "Details.unities, Galleries.image, Galleries.quality, Galleries.image_uploaded, Details.stock_reserved ";
            $query .= "FROM galleries Galleries, details Details, stocks Stocks, articles Articles, ";
            $query .= "growings Growings, flowerings Flowerings, products Products ";
            $query .= "where Stocks.partner_id = ".$valor." and ";
            $query .= "Stocks.article_id = Articles.id and ";
            $query .= "Articles.product_id = Products.id and ";
            $query .= "Stocks.id = Details.stock_id and ";
            $query .= "Details.id = Galleries.detail_id and ";
            $query .= "Details.growing_id = Growings.id and ";
            $query .= "Details.flowering_id = Flowerings.id and ";
            $query .= "Galleries.principal = 1 ";*/


            //$query .= "order by Articles.name, Products.description, Growings.sorting, Flowerings.sorting ";


            $query_count = "SELECT count(1) FROM galleries Galleries, details Details, stocks Stocks, articles Articles, ";
            $query_count .= "growings Growings, flowerings Flowerings, products Products ";
            $query_count .= "where Stocks.partner_id = ".$valor." and ";
            $query_count .= "Stocks.article_id = Articles.id and ";
            $query_count .= "Articles.product_id = Products.id and ";
            $query_count .= "Stocks.id = Details.stock_id and ";
            $query_count .= "Details.id = Galleries.detail_id and ";
            $query_count .= "Details.growing_id = Growings.id and ";
            $query_count .= "Details.flowering_id = Flowerings.id and ";
            $query_count .= "Galleries.principal = 1 ";


            $requestData = $this->request->query;

            $filter_stock = "S";

            $filter_name = '';

            if (!empty($requestData)) {

                $filter_name = $requestData['data']['Stocks']['filter_name'];
                $filter_stock = $requestData['data']['Stocks']['filter_stock'];

                if (isset($filter_name) && !empty($filter_name)) {
                    $query .= " AND ( Articles.name LIKE '%".$filter_name."%' OR Products.description LIKE '%".$filter_name."%' ) " ;

                    $query_count .= " AND ( Articles.name LIKE '%".$filter_name."%' OR Products.description LIKE '%".$filter_name."%' ) " ;
                }

                
            }



            if ($filter_stock == "S") {
                $query = $query." AND coalesce(Details.available_unities,0) > 0 ";       
                
                $query_count = $query_count." AND coalesce(Details.available_unities,0) > 0 ";    
            }

             if ($filter_stock == "N") {
                $query = $query." AND coalesce(Details.available_unities,0) = 0 ";    

                $query_count = $query_count." AND coalesce(Details.available_unities,0) = 0 ";              
            }

         
        //$query .= "order by Articles.name, Products.description, Growings.sorting, Flowerings.sorting ";


        $this->Session->write('filter_name',$filter_name);
        $this->Session->write('filter_stock',$filter_stock);

        $this->set('filter_name',$filter_name);
        $this->set('filter_stock',$filter_stock);

        
        $this->set('filter_price', $this->Session->read('Stocks.filter_price'));

        $datos = $this->Gallery->query($query);

        $this->set('datos',$datos);



        /*if (isset($this->request->params['named']['sort'])) {
            $sorting = $this->request->params['named']['sort'];
            $direction = $this->request->params['named']['direction'];
        } else {
            $sorting = 'Articles.name';
            $direction = 'asc';
        }


        $order = array($sorting => $direction);

        $conditions['sql'] = $query;
        $conditions['count'] = $query_count;
        $conditions['order']  = $sorting.' '.$direction;

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => $order
        );



       $this->set('datos', $this->Paginator->paginate($conditions));

       $this->set('sorting', $sorting);
       $this->set('direction', $direction);*/




        }



       $this->set('filter_by', $filter_by);


    }

    public function ajaxManageStocksTotalSearch(){

        $this->autoRender = false;


        $requestData= $this->request->data;


        $this->Session->write('datos', $this->request->data['columns']);


        $partner = $this->Session->read('partner');

        $filter_active = $this->Session->read('filter_active');

        if (empty($filter_active)) 
            $filter_active = 1;


        $filter_stock = $this->Session->read('filter_stock');

        



        $this->Session->write('filter_stock', $this->request->data['columns'][0]['search']['value']);
        //if ($this->request->data['columns'][0]['search']['value'] == "S") {
            $filter_stock = $this->request->data['columns'][0]['search']['value'];


            if (empty($filter_stock)) 
            $filter_stock = "S";
        //}

        $query = array();
        $query['count']  = "SELECT count( Stocks.id) AS count  FROM `stocks` Stocks LEFT JOIN articles Articles ON Stocks.`article_id` = Articles.id LEFT JOIN products Products ON Articles.product_id = Products.id WHERE Articles.active = 1 and Stocks.active =".$filter_active;

        



        /*$query['detail'] = "SELECT Stocks.id, Articles.name, (select sum(Details.unities) from `details` Details where Details.stock_id = Stocks.id) unities FROM `stocks` Stocks LEFT JOIN articles Articles ON Stocks.`article_id` = Articles.id   WHERE Stocks.active =".$filter_active;*/

        /*$query['detail'] = "SELECT Stocks.id, Articles.id, Articles.name, (select coalesce(sum(Details.unities),0) from `details` Details where Details.stock_id = Stocks.id) unities FROM `stocks` Stocks LEFT JOIN articles Articles ON Stocks.`article_id` = Articles.id   WHERE Stocks.active =".$filter_active;

*/


        $query['detail'] = "SELECT Stocks.id, Articles.id, Articles.name, Products.description, coalesce(sum(Details.unities),0) unities 
        FROM `stocks` Stocks LEFT OUTER JOIN `details` Details on Details.`stock_id` = Stocks.id 
        LEFT OUTER JOIN `articles` Articles ON Articles.id = Stocks.article_id
        LEFT JOIN products Products ON Articles.product_id = Products.id WHERE Articles.active = 1 and Stocks.active = ".$filter_active;

        

        $this->Session->write('query', $query);

        
        extract($this->Session->read('query'));

        $cond = "";
        if( isset($requestData['search']['value']) && !empty( $requestData['search']['value'] ) ){
            $search = $requestData['search']['value'];
            $cond.=" AND ( Stocks.id LIKE '".$search."%' OR  Articles.name LIKE '%".$search."%'
            OR  Products.description LIKE '%".$search."%' ) AND Stocks.active =".$filter_active;
        }
   
        $columns = array(
            0 => 'Articles.name',
            1 =>'unities'
        );

        $count = $count.$cond;
        $detail = $detail.$cond;

  

        if ($filter_stock == "S") {
            $count = $count." and exists (select 1 from `details` Details where Details.stock_id = Stocks.id having coalesce(sum(Details.unities),0) > 0)";
        }
        if ($filter_stock == "N") {
            $count = $count." and exists (select 1 from `details` Details where Details.stock_id = Stocks.id having coalesce(sum(Details.unities),0) = 0)";
        }


        if ($filter_stock == "S") {
            $detail = $detail." group by Stocks.id, Articles.id, Articles.name, Products.description HAVING coalesce(sum(Details.unities),0) > 0 ";
        }

         if ($filter_stock == "N") {
            $detail = $detail." group by Stocks.id, Articles.id, Articles.name, Products.description HAVING coalesce(sum(Details.unities),0) = 0 ";
        }

         if ($filter_stock == "T") {
            $detail = $detail." group by Stocks.id, Articles.id, Articles.name, Products.description ";
         }


        $results = $this->Stock->query($count);

        $results = $results[0];

        $totalData = isset($results[0]['count']) ? $results[0]['count'] : 0;


    
        $totalFiltered = $totalData;



//$requestData = $requestData[0];

        /*$data = $requestData;

        $json_data = array(
            "draw"            => intval( $requestData ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );
        echo json_encode($json_data);exit;*/







        $sidx = $columns[$requestData['order'][0]['column']];
        $sord = $requestData['order'][0]['dir'];
        //$start = $requestData['start'];
        //$length = $requestData['length'];

        $SQL = $detail." ORDER BY $sidx $sord ";//LIMIT $start , $length ";

        $results = $this->Stock->query($SQL);

        //debug($results).die;

        //$results = $conn->execute( $SQL )->fetchAll('assoc');


        /*$data = $results;

        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );
        echo json_encode($json_data);exit;*/






        
        $i = 0;
        $data = array();
        foreach ( $results as $row){        

            $nestedData= [];
            $nestedData[] = "<a href='".SERVER."Stocks/detail/1/".$row['Articles']["id"]."'><p>".$row['Articles']["name"]."</p><p class='nom_botanic'>".$row['Products']['description']."</p></a>";

            if ($row[0]["unities"] == null ) {
                $nestedData[] = 0;
            } else {
                $nestedData[] = number_format($row[0]["unities"], 0, ',', '.');
            }
            $data[] = $nestedData;
            $i++;
        }



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
	/*public function view($id = null) {
		if (!$this->Stock->exists($id)) {
			throw new NotFoundException(__('Invalid stock'));
		}
		$options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
		$this->set('stock', $this->Stock->find('first', $options));
	}*/

/**
 * add method
 *
 * @return void
 */
	/*public function add() {
		if ($this->request->is('post')) {
			$this->Stock->create();
			if ($this->Stock->save($this->request->data)) {
				$this->Flash->success(__('The stock has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The stock could not be saved. Please, try again.'));
			}
		}
		$articles = $this->Stock->Article->find('list');
		$partners = $this->Stock->Partner->find('list');
		$this->set(compact('articles', 'partners'));
	}*/

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function edit($id = null) {
		if (!$this->Stock->exists($id)) {
			throw new NotFoundException(__('Invalid stock'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Stock->save($this->request->data)) {
				$this->Flash->success(__('The stock has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The stock could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
			$this->request->data = $this->Stock->find('first', $options);
		}
		$articles = $this->Stock->Article->find('list');
		$partners = $this->Stock->Partner->find('list');
		$this->set(compact('articles', 'partners'));
	}*/

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->Stock->id = $id;
		if (!$this->Stock->exists()) {
			throw new NotFoundException(__('Invalid stock'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Stock->delete()) {
			$this->Flash->success(__('The stock has been deleted.'));
		} else {
			$this->Flash->error(__('The stock could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
}
