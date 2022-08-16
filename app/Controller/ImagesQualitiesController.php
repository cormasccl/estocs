<?php
App::uses('AppController', 'Controller');
/**
 * ImagesQualities Controller
 *
 * @property ImagesQuality $ImagesQuality
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ImagesQualitiesController extends AppController {

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
		$this->ImagesQuality->recursive = 0;
		$this->set('imagesQualities', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ImagesQuality->exists($id)) {
			throw new NotFoundException(__('Invalid images quality'));
		}
		$options = array('conditions' => array('ImagesQuality.' . $this->ImagesQuality->primaryKey => $id));
		$this->set('imagesQuality', $this->ImagesQuality->find('first', $options));
	}



private function _existsQualityArticle()
    {


    	//debug($this->request->data['ImagesQuality']).die;
        $article_id = $this->request->data['ImagesQuality']['article_id'];
        $growing_id = $this->request->data['ImagesQuality']['growing_id'];
        $flowering_id = $this->request->data['ImagesQuality']['flowering_id'];

        $options = array('conditions' => array(
                                'ImagesQuality.article_id'=>$article_id, 
                                'ImagesQuality.growing_id'=>$growing_id, 
                                'ImagesQuality.flowering_id'=>$flowering_id));

        return $this->ImagesQuality->find('first', $options);
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

private function _uploadImage()
{

	$changeImg = $this->request['data']['ImagesQuality']['change_image'];
    if ($changeImg == 'S') {

        $file = $this->request['form']['select_image'];
        $nomFoto = $this->generateRandomString(15);

        //if ($user['logged']['username'] =='MANAGER') { debug($nomFoto);}

        $nombre_tmp = $file["tmp_name"];

        //if ($user['logged']['username'] =='MANAGER') { debug($file);}


        if ($file['name'] != '') {
            $name = basename($file["name"]); 

            //if ($user['logged']['username'] =='MANAGER') { debug($name);}

            $oldFile = WWW_ROOT . 'uploads/'.$name;
            
            //if ($user['logged']['username'] =='MANAGER') { debug($oldFile);}

            $extension = pathinfo($oldFile, PATHINFO_EXTENSION);

            //if ($user['logged']['username'] =='MANAGER') { debug($extension);}
            if (move_uploaded_file($nombre_tmp, $oldFile) == true) {

                $newFile = WWW_ROOT . 'uploads/'.$nomFoto.".".$extension;
                
                //if ($user['logged']['username'] =='MANAGER') { debug($newFile);}
   
                if (rename($oldFile, $newFile) == true) {
                    $this->redimensiona($newFile,$newFile,1024);
                }


                //print_r($this->request->data['Gallery']).die;
                return  $nomFoto.".".$extension;

                
            }                    
        }
    }


}

/**
 * add method
 *
 * @return void
 */
	public function add($article_id) {
		$this->layout = 'default_app';
		$this->set('title', __("Gestión de fotos de calidad Corma"));
        $this->set('page','imagesquality');


        $options = array('conditions' => array(
                        'article_id' => $article_id));
        

         $imgQuality = $this->ImagesQuality->find('all', $options);

         $this->set('imgQuality',$imgQuality);

         $this->loadModel('Articles');
        $articles = $this->Articles->findById($article_id);

        $this->set('article_name', $articles['Articles']['name']);
        $this->set('article_id',$article_id);


		if ($this->request->is('post')) {



			$imagen = $this->_uploadImage();

			//debug($imagen).die;

			$datos = $this->_existsQualityArticle();

			if ($datos) {

				$datos['ImagesQuality']['image'] = $imagen;
				$datos['ImagesQuality']['upload'] = 1;



				$this->ImagesQuality->save($datos);


			} else {
				$this->ImagesQuality->create();
				$this->request->data['ImagesQuality']['image'] = $imagen;
				$this->request->data['ImagesQuality']['upload'] = 1;


				if ($this->ImagesQuality->save($this->request->data)) {
					$this->Session->setFlash(__('The images quality has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The images quality could not be saved. Please, try again.'));
				}

			}
	
		}
		$articles = $this->ImagesQuality->Article->find('list');
		$growings = $this->_getGrowings();
		$flowerings = $this->_getFlowerings();
		$this->set(compact('articles', 'growings', 'flowerings'));
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
		$this->set('title', __("Gestión de fotos de calidad Corma"));
        $this->set('page','imagesquality');

       


		$imgQuality = $this->ImagesQuality->findById($id);

		//debug($imgQuality).die;

		$this->set('imgQuality',$imgQuality);

		$article_id = $imgQuality['ImagesQuality']['article_id'];

		$this->loadModel('Articles');
		$articles = $this->Articles->findById($article_id);

		$this->set('article_name', $articles['Articles']['name']);
		$this->set('article_id',$article_id);


      

		if ($this->request->is('post')) {

			$imagen = $this->_uploadImage();


			$imgQuality['ImagesQuality']['image'] = $imagen;
			$imgQuality['ImagesQuality']['upload'] = 1;

			$this->ImagesQuality->save($imgQuality);	


			$this->redirect(array('action' => 'show', $imgQuality['ImagesQuality']['article_id']));
	
		}
		//$articles = $this->ImagesQuality->Article->find('list');
		$growings = $this->_getGrowings();
		$flowerings = $this->_getFlowerings();
		$this->set(compact('articles', 'growings', 'flowerings'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ImagesQuality->id = $id;
		if (!$this->ImagesQuality->exists()) {
			throw new NotFoundException(__('Invalid images quality'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ImagesQuality->delete()) {
			$this->Session->setFlash(__('The images quality has been deleted.'));
		} else {
			$this->Session->setFlash(__('The images quality could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}




	public function show($article_id) {
		$this->layout = 'default_app';
		$this->set('title', __("Gestión de fotos de calidad Corma"));
        $this->set('page','imagesquality');



        //$this->loadModel('articles');
        $art = $this->ImagesQuality->Article->findById($article_id);

        $this->set('article', $art['Article']);

        //$data = $this->ImagesQuality->findByArticleId($article_id);

        $data = $this->ImagesQuality->find('all',array('conditions'=>array('ImagesQuality.Article_id'=>$article_id)));


      


		$this->set('imagesQuality', $data);


	}


	
}
