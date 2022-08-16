<?php

//$pathname = "/data/www/html/corma/intranet/app/webroot/img/articles";
$pathname = "articles";

  header('Content-Type: text/plain');

  /**
  * Changes permissions on files and directories within $dir and dives recursively
  * into found subdirectories.
  */
  function chmod_r($dir, $dirPermissions, $filePermissions) {
      $dp = opendir($dir);
       while($file = readdir($dp)) {
         if (($file == ".") || ($file == ".."))
            continue;

        $fullPath = $dir."/".$file;

         if(
         	is_dir($fullPath)) {
            echo('DIR:' . $fullPath . "\n");

            chmod($fullPath, $dirPermissions);
            chmod_r($fullPath, $dirPermissions, $filePermissions);
         } else 
         {
			$permisosActuals = substr(decoct(fileperms($fullPath)),3);

			if ($permisosActuals<>'777') {
				echo "CHOWN ROOT - ";				
				chown($fullPath, 'root');
				$stat = stat($fullPath);
				print_r(posix_getpwuid($stat['uid']));

				echo('FILE:' . $fullPath . " - ");
        		echo ('PERMISOS: '. substr(decoct(fileperms($fullPath)),3)." - ");
        		if (chmod($fullPath, $filePermissions)) {
        			echo "OK\n";
        		} else {
        			echo "PROPIETARI ".posix_getpwuid(fileowner($fullPath))." - ";
        			echo "KO\n";
        		}

			}
          
         }

       }
     closedir($dp);
  }

  chmod_r($pathname, 0777, 0777);
?>
