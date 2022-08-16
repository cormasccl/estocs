<?php

//debug($articlePhotos);


foreach ($articlePhotos as $res) {
	echo 'CHMOD '.WWW_ROOT.'img/articles/'.$res['photo'];

	$dir = new Folder(WWW_ROOT.'img/articles/', 0777, true);



	$file = new File(WWW_ROOT.'img/articles/'.$res['photo'], true, 0777);


                      

debug( $file->info());

debug($file->perms());
	//$dir->chmod($res['photo'], 0777);
}

?>