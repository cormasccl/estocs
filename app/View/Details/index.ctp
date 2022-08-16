<style type="text/css">
td a { display: block; width: 100%; height: 100%; }
</style>

<?php
$change_stock = ($stock['Partner']['change_stock'] == 1);
?>

<input type="hidden" name='stock_id' id='stock_id' value="<?=$stock_id;?>">
<div class="row">
    <div class="col-md-12 col-xs-12">
        <p class="titol_article"><?php echo $stock['Article']['name'];?></p>
        <p class="titol_article nom_botanic"><?php echo $stock['Product']['description'];?></p>
    </div>
</div>


<div class="spacing"></div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive" width="100%">
            <table id="details-grid"  class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class='centre'><?=__('Calidad');?></th>
                        <th class='centre'><?=__('Estoc disponible');?></th>  
                        <th class='centre'><?=__('Imagen');?></th>                        
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($Details as $row) {

                        $stock_reserved = '';
                        if ($row['Details']['stock_reserved'] == 1) { 
                            $stock_reserved = ' ('.__('RESERVA').')';
                        }
                        echo "<tr><td class='centre'>".$row['Growings']['GrowingCode'].' - '.$row['Flowerings']['FloweringCode'].$stock_reserved."</td>";
                        echo "<td class='centre td_estoc'><a href='".SERVER."Details/edit/".$row['Details']['id']."' style='display: inline;'>".number_format($row['Details']['available_unities'], 0, ',', '.')."&nbsp;&nbsp;&nbsp;";
                        if ($change_stock) {
                            echo "<i class='fa fa-pencil' aria-hidden='true'></i>";
                        } else {
                            echo "<i class='fa fa-eye' aria-hidden='true'></i>";
                        }
                        
                        echo "</a></td>";


                        $imatge = "<a href='".SERVER."Galleries/index/".$row['Details']['id']."'>";
                        if (empty($row['Galleries']['image'])) {
                            $imatge .= "<img src='https://www.corma.es/articles/thumbs/no_foto.jpg'>"."&nbsp;&nbsp;&nbsp";
                        } else {
                            if ($row['Galleries']['image_uploaded'] == 1 ) {
                                
								$imatge .= "<img src='https://www.corma.es/articles/thumbs/".$row['Galleries']['image']."' width='80px'>"."&nbsp;&nbsp;&nbsp";
                            } else {
                                $imatge .= "<img src='".SERVER . 'uploads/'.$row['Galleries']['image']."' width='80px'>"."&nbsp;&nbsp;&nbsp";
                            }
                        }

                        $imatge  .= "<i class='fa fa-picture-o' aria-hidden='true'></i></a>";

                        echo "<td class='centre td_imatge td_accions'>".$imatge."</td></tr>";




                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="spacing"></div>
<div class="row">
    <div class="col-md-6 col-xs-6">
        <a href="<?=$url_back;?>" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?=__('Volver');?></a>
    </div>
    
    <?php if ($change_stock) { ?>
    <div class="col-md-6 col-xs-6">
        <a href="<?=SERVER?>Details/add/<?=$stock['Article']['id'].'/'.$stock_id?>" class="btn btn-primary" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('Nueva calidad');?></a>
    </div>
    <?php } ?>
</div>



<!--
<script>


$(document).ready(function() {

    var stock_id = document.getElementById('stock_id').value;
    var url_query = "<?=SERVER?>Details/ajaxManageStocksSearch/"+stock_id;



    var dataTable = $('#details-grid').DataTable( {
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "searching": false,
        "lengthChange": false,
        "bAutoWidth": false,
        "columns": [
                {   "orderDataType": "dom-text", "className": "centre", "orderData": [ 1 ]},
                {   "orderDataType": "dom-text-numeric", "className": "centre td_estoc", "type": "numeric"},
                {   "orderDataType": "dom-text", "className": "centre td_imatge td_accions"}
            ],
        "language": {
                "url": "<?=SERVER?>js/Catalan.json"
            },
        "ajax":{
            url :url_query,
            type: "post",
             /*success: function(data) {
                console.log("OK");
                console.log(data);
            },*/
             error: function(data, xhr, ajaxOptions, thrownError){
                //console.log("ERRORRR");
                //console.log(data);

                $(".details-grid-error").html("");
                $("#details-grid").append('<tbody class="details-grid-error"><tr><th colspan="3">Sin datos</th></tr></tbody>');
                $("#details-grid_processing").css("display","none");
            }
        }
    } );
} );
</script>




<input type="hidden" name='stock_id' id='stock_id' value="<?=$stock_id;?>">
<div class="row">
    <div class="col-md-12 col-xs-12">
        <p class="titol_article"><?php echo $stock['Article']['name'];?></p>
        <p class="titol_article nom_botanic"><?php echo $stock['Product']['description'];?></p>
    </div>
</div>


<div class="spacing"></div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive" width="100%">
            <table id="details-grid"  class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th><?=__('Calidad');?></th>
                        <th><?=__('Estoc físico');?></th>  
                        <th><?=__('Imagen');?></th>                        
                        
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="spacing"></div>
<div class="row">
    <div class="col-md-6 col-xs-6">
        <a href="<?=SERVER?>Stocks/index/1" class="btn btn-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <?=__('Volver');?></a>
    </div>
    
    <div class="col-md-6 col-xs-6">
        <a href="<?=SERVER?>Details/add/<?=$stock['Article']['id'].'/'.$stock_id?>" class="btn btn-primary" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('Nueva calidad');?></a>
    </div>
    
</div>

-->