<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Gallery $Gallery
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class GalleriesController extends AppController {



	public function beforeFilter()
    {
		parent::beforeFilter();
    	$this->FlashMessage = true;
    }

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
	public function index($detail_id = null) {
	

		$this->set('page','estocs');

		$this->layout = 'default_app';
		$this->set('detail_id', $detail_id);




		$this->loadModel('Details');

		//$this->Details->recursive = 1;
		//$detail = $this->Details->findById($detail_id);


		$sql  ="select Stock.id, Article.name, Flowering.code Floracio, Growing.code Creixement ";
		$sql .= "from articles Article, stocks Stock, details Detail, growings Growing, flowerings Flowering ";
		$sql .= "where Detail.id = ".$detail_id." and Detail.stock_id = Stock.id and ";
		$sql .= "Stock.article_id = Article.id and ";
		$sql .= "Detail.growing_id = Growing.id and ";
		$sql .= "Detail.flowering_id = Flowering.id";
		$detail = $this->Details->query($sql);



		
		//debug($detail[0]).die;

		$this->set('detail', $detail[0]);

		$this->Gallery->recursive = 1;
		$options = array('conditions' => array('Gallery.detail_id'  => $detail_id));


		
		$dades = $this->Gallery->find('all', $options);


		$this->set('Galleries', $dades, $this->Paginator->paginate());




		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException('Invalid gallery');
		}
		$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
		$this->set('gallery', $this->Gallery->find('first', $options));
	}


public function generateRandomString($length = 10) { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    } 

    public function redimensiona($imgOriginal, $imgThumb, $thumbWidth)
    {

      $img = imagecreatefromjpeg( $imgOriginal );

      $exif = exif_read_data($imgOriginal);

      //debug($exif).die;


      if ($img && $exif && isset($exif['Orientation']))
        {
            $ort = $exif['Orientation'];

            if ($ort == 6 || $ort == 5)
                $img = imagerotate($img, 270, null);
            if ($ort == 3 || $ort == 4)
                $img = imagerotate($img, 180, null);
            if ($ort == 8 || $ort == 7)
                $img = imagerotate($img, 90, null);

            if ($ort == 5 || $ort == 4 || $ort == 7)
                imageflip($img, IMG_FLIP_HORIZONTAL);
        }




      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, $imgThumb );
      chmod($imgThumb,0777);
    }


/**
 * add method
 *
 * @return void
 */
	public function add() {



		if ($this->request->is('post')) {


			//$user = $this->Session->read('User.logged');



			//print_r($this->request['form']).die;

			$changeImg = $this->request['data']['Gallery']['change_image'];


            if ($changeImg == 'S') {
				
				
                $file = $this->request['form']['select_image'];
                $nomFoto = $this->generateRandomString(15);

                //debug($nomFoto);

                $nombre_tmp = $file["tmp_name"];

                //debug($file['name']);


                if ($file['name'] != '') {
                    $name = basename($file["name"]); 

                    //debug($name);

                    $oldFile = WWW_ROOT . 'uploads/'.$name;
                    
                    //debug($oldFile);
					
					//die;

                    $extension = pathinfo($oldFile, PATHINFO_EXTENSION);

                    //debug($nombre_tmp);
                    if (move_uploaded_file($nombre_tmp, $oldFile) == true) {

                        $newFile = WWW_ROOT . 'uploads/'.$nomFoto.".".$extension;
                        
                        
           
                        if (rename($oldFile, $newFile) == true) {
                            $this->redimensiona($newFile,$newFile,1024);
                        }
//debug('redimensiona ok').die;

                        //print_r($this->request->data['Gallery']).die;
                        $this->request->data['Gallery']['image'] = $nomFoto.".".$extension;

                        $this->request->data['Gallery']['image_published'] = 0;
                        $this->request->data['Gallery']['image_uploaded'] = 0;
					} else {
						//debug('error').die;
                    }                    
                }
            }

            //if ($user['logged']['username'] =='MANAGER') { die();}


            $detail_id = $this->request['data']['Gallery']['detail_id'];

            //print_r($this->request['data']['Gallery']).die;



			$this->Gallery->create();

			$data = $this->Gallery->save($this->request->data);
			if ($data) {
				if ($this->FlashMessage) {
					$this->Flash->success('Imagen añadida correctamente.');


					$detail = $this->Gallery->Detail->findById($detail_id);


					$detail['Detail']['gallery_modified'] = 1;

					$this->Gallery->Detail->save($detail);


					$redirect = $this->principal($data['Gallery']['id']);

					return $redirect;
				}

				
				
				//return $this->redirect(array('action' => 'index', $detail_id));
			} else {
				if ($this->FlashMessage) {
					$this->Flash->error('The gallery could not be saved. Please, try again.');
				}
			}
		}
		$details = $this->Gallery->Detail->find('list');
		$this->set(compact('details'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException('Invalid gallery');
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Gallery->save($this->request->data)) {
				$this->Flash->success('The gallery has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error('The gallery could not be saved. Please, try again.');
			}
		} else {
			$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
			$this->request->data = $this->Gallery->find('first', $options);
		}
		$details = $this->Gallery->Detail->find('list');

		
		$this->set(compact('details'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {


		$actual = $this->Gallery->findById($id);


		$this->Gallery->id = $id;
		if (!$this->Gallery->exists()) {
			throw new NotFoundException('Invalid gallery');
		}



		$detail = $this->Gallery->Detail->findById($actual['Gallery']['detail_id']);

		$detail['Detail']['gallery_modified'] = 1;
		if ($this->Gallery->Detail->save($detail)) {

			

			//$this->request->allowMethod('post', 'delete');
			if ($this->Gallery->delete()) {
			//if ($this->Gallery->save($actual)) {
				 $this->Flash->success('Imagen borrada correctamente.');
			} else {
				$this->Flash->error('The gallery could not be deleted. Please, try again.');
			}


		}

		
		return $this->redirect(array('action' => 'index', $actual['Gallery']['detail_id']));
	}



	

	public function principal($id = null) {

		//Marquem com a principal una de les imatges. Hem de desmarcar principal la resta .

	




        $actual = $this->Gallery->findById($id);

        $detail_id = $actual['Gallery']['detail_id'];
        



        $options = array('conditions' => array('Gallery.detail_id'  => $detail_id, 'Gallery.principal' => 1));
		$dades = $this->Gallery->find('all', $options);

		
		foreach ($dades as $valor) {

			$valor['Gallery']['principal'] = 0;
			$valor['Gallery']['image_published'] = 0;
			

			$this->Gallery->save($valor);
       }


      
		$detail = $this->Gallery->Detail->findById($detail_id);

		$detail['Detail']['gallery_modified'] = 1;
		if ($this->Gallery->Detail->save($detail)) {


	 		$actual['Gallery']['principal'] = 1;
			$actual['Gallery']['image_published'] = 0;


			$return = $this->Gallery->save($actual);

		}



        return $this->redirect(['action' => 'index', $detail_id]);
    }
}
