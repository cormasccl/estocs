


<style type="text/css">
td a { display: block; width: 100%; height: 100%; }
</style>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#articulo"><?php echo __('Agrupar por artículo');?></a></li>
  <li><a data-toggle="tab" href="#socio"><?php echo __('Agrupar por socio');?></a></li>
</ul>

<div class="tab-content">

	<!-- MOSTRAR POR ARTÍCULO -->
	<div id="articulo" class="tab-pane fade in active">
		<br />
		<div class="row">
		    <div class="col-md-12">
		        <!--<div class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">-->

                <div class="table table-striped table-stocks">

                    
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <?php
                            echo $this->Form->create('Stocks', array('type'=>'get','class'=>'navbar-form navbar-left'));
                            ?>
                                <div class="form-group">
                                    <!--<label for="StocksFilterName"></label>-->

                                    <!--<a id="btnEAN"><i class="fa fa-barcode"></i></a>-->

                                    <input name="data[Stocks][filter_name]" placeholder="<?=__('Buscar');?>..." class="form-control form-stocks" type="text" id="StocksFilterName" value="<?=$filter_name;?>">
                                    
                                </div>


                                
                                
                                <div class="form-group">
                                    <!--<label for="StocksFilterStock"></label>-->
                                    <select name="data[Stocks][filter_stock]" class="form-control form-stocks" id="StocksFilterStock">

                                    <?php
                                        if ($filter_stock == "T") {$selected = "selected";} else {$selected = "";}
                                        echo "<option value='T' ".$selected.">".__('Todos los artículos')."</option>";

                                        if ($filter_stock == "S") {$selected = "selected";} else {$selected = "";}
                                        echo "<option value='S' ".$selected.">".__('Artículos con estoc')."</option>";

                                        if ($filter_stock == "N") {$selected = "selected";} else {$selected = "";}
                                        echo "<option value='N' ".$selected.">".__('Artículos sin estoc')."</option>";                
                                    ?>
                                    
                                    </select>
                                </div>
                                <div class="form-group">
                                    <!--<label for="StocksFilterPrice"></label>-->
                                    <select name="data[Stocks][filter_price]" class="form-control form-stocks" id="StocksFilterPrice">
                                        <?php
                                        if ($filter_price == "T") {$selected = "selected";} else {$selected = "";}
                                        echo "<option value='T' ".$selected.">".__('Todos los precios')."</option>";

                                        if ($filter_price == "P") {$selected = "selected";} else {$selected = "";}
                                        echo "<option value='P' ".$selected.">".__('Precios Premiá')."</option>";

                                        if ($filter_price == "M") {$selected = "selected";} else {$selected = "";}
                                        echo "<option value='M' ".$selected.">".__('Precios Madrid')."</option>";                
                                    ?>
                                    </select>
                                     
                                </div>
                                <button type="submit" class="btn btn-default"><?=__('Buscar');?></button>
                                &nbsp;
                                <button type="button" id="btnEAN" style ="float:right" class ="btn btn-default"><i class="fa fa-barcode fa-lg"></i>  Lectura EAN</button>
                                    
                                
                                <?php 
                                
                                    echo $this->Form->end();
                                ?>

                                

                        </div>

                        <div id="interactive" class="viewport"></div>
                    </nav>



		            <table id="stocks-grid"  class="display table table-striped table-bordered">
		                <thead>
		                    <tr>
		                        <th><?=__('Artículo');?></th>
                                <th class='td_preus'><?=__('Precio');?></th>
                                <th class='td_unitats'><?=__('Estoc disp.');?></th>  
		                    </tr>
		                </thead> 

                        <tbody>
                        <?php

                            $i = 0;

                            foreach ($Stocks as $row) {

                                if ($i == 0) {
                                    $class='post-item-grey';
                                    $i = 1;
                                } else {
                                    $class='';
                                    $i = 0;
                                }

                                echo "<tr class='post ".$class."' id='item-".$row['Articles']['id']."'>";
                                echo "<td>";
                                echo "<a href='".SERVER."Stocks/detail/1/".$row['Articles']["id"]."'>";
                                echo "<p>".$row['Articles']["name"]."</p><p class='nom_botanic'>".$row['Products']['description']."</p></a>";
                                echo "</td>";


                                if ($filter_price == 'T') {
                                    echo "<td style='padding:0px'><table class='table table_precios'><tr style='border-bottom: 1px solid #ddd;'>";
                                    $str_price = $row['Articles']['price'];
                                    $str_price = str_replace(".",",",$str_price).' €';
                                    echo "<td class='dreta td_preus'>".$str_price."</td></tr><tr>";

                                    $str_price = $row['Articles']['price_madrid'];
                                    $str_price = str_replace(".",",",$str_price).' €';
                                    echo "<td class='dreta td_preus'>".$str_price."</td>";
                                    echo "</tr></table></td>";
                                }

                                if ($filter_price == 'P') {
                                   $str_price = $row['Articles']['price'];
                                    $str_price = str_replace(".",",",$str_price).' €';
                                    echo "<td class='dreta td_preus'>".$str_price."</td>";
                                }

                                if ($filter_price == 'M') {
                                   $str_price = $row['Articles']['price_madrid'];
                                    $str_price = str_replace(".",",",$str_price).' €';
                                    echo "<td class='dreta td_preus'>".$str_price."</td>";
                                }
                                


                                
                                if ($row[0]["available_unities"] == null ) {
                                    echo "<td class='dreta td_unitats'>0</td>";
                                } else {
                                    echo "<td class='dreta td_unitats'>".number_format($row[0]["available_unities"], 0, ',', '.')."</td>";
                                }
                                
                                echo "</tr>";



                                
                                /*echo "<tr>";
                                echo "<td><a href='".SERVER."Stocks/detail/1/".$row['Articles']["id"]."'><p>".$row['Articles']["name"]."</p><p class='nom_botanic'>".$row['Products']['description']."</p></a></td>";

                                if ($row[0]["Unities"] == null ) {
                                    echo "<td class='dreta td_unitats'>0</td>";
                                } else {
                                    echo "<td class='dreta td_unitats'>".number_format($row[0]["Unities"], 0, ',', '.')."</td>";
                                }
                                echo "</tr>";*/

                            }
                        ?>


                        </tbody>

		            </table>
		        </div>
		    </div>
		</div>


	</div>
	<!-- FIN MOSTRAR POR ARTÍCULO -->




<?php
    
    if (isset($next)) {
        echo "<div id='pagination'>";
        $url = SERVER."Stocks/home/".$next;
        

        echo "  <a href='".$url.$param."' class='next'>".__('Siguiente página')."</a>";
        //echo "  <a href='".SERVER."Stocks/index/".$next."' class='next'>".__('Siguiente página')."</a>";
        echo "</div>";


    }
    ?>


<script type="text/javascript">
 var ias = jQuery.ias({
    container:  '#stocks-grid',
    item:       '.post',
    pagination: '#pagination',
    next:       '#pagination a.next'
  });

  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 1000, text: "Carrega mes dades"}));
  ias.extension(new IASNoneLeftExtension({text: ""}));
  ias.extension(new IASPagingExtension());
  //ias.extension(new IASHistoryExtension({prev: '#pagination a.prev'}));
</script>


    <!-- Incluir la biblioteca image-diff -->
    <script src="https://cdn.jsdelivr.net/gh/serratus/quaggaJS/dist/quagga.min.js"></script>

    <script>
        var _scannerIsRunning = false;


        function startScanner() {

            console.log('startScanner');


            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    constraints: {
                        width: 640,
                        height: 480,
                        facingMode: "environment"
                    }
                },
                locator: {
                    patchSize: "medium",
                    halfSample: true
                },
                numOfWorkers: 4,
                locate: true,
                decoder : {
                    readers: ["ean_reader"]
                }
            }, function() {
                Quagga.start();
                // Establecer bandera en se está ejecutando
                 _scannerIsRunning = true;



                 console.log('start');

                 var div = document.getElementById('interactive');
                div.style.display = null;
            });

            Quagga.onDetected(function(result) {
                var code = result.codeResult.code;

                
                //document.querySelector("#StocksFilterName").innerHTML = code;

                document.getElementById("StocksFilterName").value = code;
                stopScanner();
            });
            

        }

    function stopScanner() {

        console.log('stopScanner');
        Quagga.stop();
        
        _scannerIsRunning = false;
        var div = document.getElementById('interactive');
        div.style.display = 'none';
    }
    // Iniciar / detener el escáner
        document.getElementById("btnEAN").addEventListener("click", function () {            
            if (_scannerIsRunning) {
                stopScanner();
            } else {
                startScanner();
            }
        }, false);             
    </script>



	<!-- MOSTRAR POR SOCIO -->
	<div id="socio" class="tab-pane fade">
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">

                    <table id="partners-grid"  class="display table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?=__('Nombre');?></th>                              
                            </tr>
                        </thead>  
                        <tbody>
                            <?php
                            foreach ($partners as $valor) { 
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo "<a href='".SERVER.'Stocks/detail/2/'.$valor['Partner']['id']."'>";
                                        echo $valor['Partner']['code'].' - '.$valor['Partner']['name'];
                                        echo "</a>";
                                        ?>
                                    </td>                       
                                </tr>
                                <?php
                            }

                            ?>
                        </tbody>                  
                    </table>

	</div>
	<!-- FIN MOSTRAR POR SOCIO -->

</div>


