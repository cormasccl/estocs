

<script>

function filterStock() {
        $('#stocks-grid').DataTable().column(0).search(
        $('#stock_filter').val()
    ).draw();
    }


    /*function filterGlobal () {
    $('#stocks-grid').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}

    function filterColumn ( i ) {
    $('#stocks-grid').DataTable().column( i ).search(
        $('#col'+i+'_filter').val(),
        $('#col'+i+'_regex').prop('checked'),
        $('#col'+i+'_smart').prop('checked')
    ).draw();
}*/


$(document).ready(function() {
    var dataTable = $('#stocks-grid').DataTable( {
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "bAutoWidth": false,
        "lengthChange": false,
        "paging": true,
        "bPaginate" : true,
        "serverSide": true,
        "deferRender": true,
        "info": true,
        "fixedHeader": {
            "header": true,
            "footer": true
        },
        "columns": [
                {   "orderDataType": "dom-text", "orderData": [ 0 ]} ,
                {   "orderDataType": "dom-text-numeric", "className": "dreta td_unitats", "type": "mask", "autoWidth": false, mask: "#,##0"}
            ],
        /*"aLengthMenu": [[ 5, 10, 20, -1], [ 5, 10, 20, "Tots"]],*/
        "language": {
                "url": "<?=SERVER?>js/Catalan.json"
            },
        "ajax":{
            url :"<?=SERVER?>Stocks/ajaxManageStocksSearch",
            type: "post",
            /*success: function(data) {
                console.log("OK");
                console.log(data);
            },*/
             error: function(data, xhr, ajaxOptions, thrownError){
                //console.log("ERROR");
                //console.log(data);
                $(".stocks-grid-error").html("");
                $("#stocks-grid").append('<tbody class="stocks-grid-error"><tr><th colspan="3">Sense dades</th></tr></tbody>');
                $("#stocks-grid_processing").css("display","none");
            }
        }
    } );


     $('select.column_filter').on( 'keyup click input', function () {
        filterStock();
    } );
} );
</script>

<style type="text/css">
td a { display: block; width: 100%; height: 100%; }
</style>


<?php
//echo date("H:i:s");

?>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive dataTables_wrapper form-inline dt-bootstrap no-footer">

            <div id="filter_stock" class="dataTables_filter form-group" data-column="0">
                <label><?=('Mostrar:');?>
                    <select id="stock_filter" class="column_filter form-control input-sm">
                        <option name="op_estoc" value="T"><?=('Tots els articles');?></option>
                        <option name="op_estoc" value="S" selected><?=('Articles amb estoc');?></option>
                        <option name="op_estoc" value="N"><?=('Articles sense estoc');?></option>
                    </select>
                </label>
            </div>

            <table id="stocks-grid"  class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Estoc físic</th>  
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
