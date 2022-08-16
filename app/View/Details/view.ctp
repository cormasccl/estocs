


<?php




$imatge = $Details->image;

$imatgeActual =  "https://www.corma.es/articles/".$imatge;

$article = $Details['stock']['article']['id'];
$nomArticle = $Details['stock']['article']['name'];
$stock_id = $Details['stock']['id'];
$stock_detail_id = $Details['id'];
$unitats = $Details['unities'];
$observations = $Details['observations'];

//debug($user);
//debug($Details);
?>

<form method="post" enctype="multipart/form-data">
  
    <div class="col-md-4">
        <div class="form-group">
            <img id="imatge" name="imatge" src="<?=$imatgeActual;?>" width="100%">              

            <span class="btn btn-file">
                <span id="imgSeleccio">Clica aqui per canviar la imatge ... </span>
                <input type="file" id="inputImatge" name="inputImatge" class="btn btn-default" onchange='openFile(event)'  accept="image/*" capture="capture"> 
                <label id="imageSize" name="imageSize"></label>
            </span>

        </div>
    </div>


    <div class="col-md-8">
        <div class="form-group">
          <label for="inputArticle">Article</label>
          <input type="text" class="form-control" id="inputArticle" name="inputArticle" value="<?=$nomArticle;?>" disabled >
          <input type="hidden" id="article-id" name="article-id" value="<?=$article;?>">
        </div>




        <input type="hidden" id="inputStockId" name="inputStockId" value="<?=$stock_id;?>">
        <input type="hidden" id="inputStockId" name="inputStockDetailId" value="<?=$stock_detail_id;?>">
        <input type="hidden" id="inputImatge" name="inputImatge" value="<?=$imatge;?>">
        <input type="hidden" id="inputCanviImatge" name="inputCanviImatge" value="N">


        <div class="form-group">
            <label for="inputCreixement">Creixement</label>

            <?php

            if (isset($stock_detail_id)) {
            echo "<input type='hidden' name='inputCreixement' id='inputCreixement' value='".$Details['growing_id']."'>";
            echo "<input type='text' class='form-control' disabled value='".$Details['growing']['code']." - ".$Details['growing']['name']."'>";
            } else {

            echo "<select class='form-control' id='inputCreixement' name='inputCreixement'>";

            foreach ($growings as $valor) {
                echo "<option  value=".$valor['id'].">".$valor['code']." - ".utf8_encode($valor['name'])."</option>";
            }
            echo "</select>";
            }
            ?>
        </div>
            <div class="form-group">
              <label for="inputFloracio">Floració</label>
              <?php 
              if (isset($stock_detail_id)) {
                echo "<input type='hidden' name='inputFloracio' id='inputFloracio' value='".$Details['flowering_id']."'>";
                echo "<input type='text' class='form-control' disabled value='".$Details['flowering']['code']." - ".$Details['flowering']['name']."'>";
              } else {

                echo "<select class='form-control' id='inputFloracio' name='inputFloracio'>";

                foreach ($flowerings as $valor) {
                    echo "<option value=".$valor['id'].">".$valor['code']." - ".utf8_encode($valor['name'])."</option>";
                }
                echo "</select>";
              }
                ?>
              
            </div> 
            <div class="form-group">
              <label for="inputUnitats">Unitats</label>
              <input type="number" class="form-control" id="inputUnitats" name="inputUnitats" value="<?=$unitats;?>" required>
            </div>

            <div class="form-group">
              <label for="inputObservations">Observacions</label>
              <textarea class="form-control" rows="3" id="inputObservations" name="inputObservations"><?=$observations;?></textarea>
              
            </div>

            <!--<input id="inputSoci" type="hidden" name="inputSoci" value='"<?=$detall['soci'];?>"'>-->
            <button type="submit" class="btn btn-default" name="sendFoto">Envia</button>
            </div>
            
        </form>




