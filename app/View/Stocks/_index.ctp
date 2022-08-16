
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <?php
        echo $this->Form->create('Stocks', array('type'=>'get','class'=>'navbar-form navbar-left'));
        ?>

        
       
            <div class="form-group">
                <label for="StocksFilterName"></label>
                <input name="data[Stocks][filter_name]" placeholder="<?=__('Buscar');?>..." class="form-control" type="text" id="StocksFilterName" value="<?=$filter_name;?>">
            
                <label for="StocksFilterStock"></label>
                <select name="data[Stocks][filter_stock]" class="form-control" id="StocksFilterStock">
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
            <button type="submit" class="btn btn-default"><?=__('Buscar');?></button>
            <?php 
            
                echo $this->Form->end();
            ?>
                
        

    </div>
</nav>




<!--<<div id="container">-->

    <table  id="container" class='table table-striped table-bordered table-stocks'>
        <thead>
        <?php 
        echo "<th>".__('Artículo')."</th><th class='dreta td_preus'>".__('Precio')."</th><th class='dreta td_unitats'>".__('Estoc físico')."</th>";
        ?>
      
    </thead>

    <?php 
    $i = 0;
    foreach($Stocks as $row) 
    { 

       if ($i == 0) {
            $class='post-item-grey';
            $i = 1;
        } else {
            $class='';
            $i = 0;
        }



        /*echo "<div class='post-item ".$class."' id='item-".$row['Stocks']['id']."'>";
        
        echo "<div class='stock_detail'>";
        echo "<a href='".SERVER."Details/index/".$row['Stocks']["id"]."'>";
        echo "<p>".$row['Articles']["name"]."</p><p class='nom_botanic'>".$row['Products']['description']."</p></a>";
        echo "</div>";


        echo "<div class='stock_unities'>";
        if ($row['Stocks']["Unities"] == null ) {
            echo "<p class='dreta td_unitats'>0</p>";
        } else {
            echo "<p class='dreta td_unitats'>".number_format($row['Stocks']["Unities"], 0, ',', '.')."</p>";
        }
        echo "</div>";*/


        echo "<tr class='post ".$class."' id='item-".$row['Stocks']['id']."'>";
        echo "<td>";
        echo "<a href='".SERVER."Details/index/".$row['Stocks']["id"]."'>";
        echo "<p>".$row['Articles']["name"]."</p><p class='nom_botanic'>".$row['Products']['description']."</p></a>";
        echo "</td>";
        
        $str_price = str_replace(".", ",", $row['Articles']['price'])." €";
        echo "<td class='dreta td_unitats'>".$str_price."</td>";

        if ($row['Stocks']["Unities"] == null ) {
            echo "<td class='dreta td_unitats'>0</td>";
        } else {
            echo "<td class='dreta td_unitats'>".number_format($row['Stocks']["Unities"], 0, ',', '.')."</td>";
        }
        
        echo "</tr>";





        //echo "</div>";

    }
    ?>
</table>

<?php
    
    if (isset($next)) {
        echo "<div id='pagination'>";
        $url = SERVER."Stocks/index/".$next;
        if (isset($partner_id)) {
            $url .= "/".$partner_id;
        }

        echo "  <a href='".$url.$param."' class='next'>".__('Siguiente página')."</a>";
        //echo "  <a href='".SERVER."Stocks/index/".$next."' class='next'>".__('Siguiente página')."</a>";
        echo "</div>";


    }
    ?>


<script type="text/javascript">
 var ias = jQuery.ias({
    container:  '#container',
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




<!--

<table class='table table-striped table-bordered table-stocks'>
    <thead>
        <?php 
        echo "<th>".__('Artículo')."</th><th class='dreta td_unitats'>".__('Estoc físico')."</th>";
        ?>
      
    </thead>



    <?php

    echo "<tbody>";

    foreach ($Stocks as $row) {
        
        echo "<tr>";
        echo "<td><a href='".SERVER."Details/index/".$row['Stocks']["id"]."'><p>".$row['Articles']["name"]."</p><p class='nom_botanic'>".$row['Products']['description']."</p></a></td>";

        if ($row[0]["Unities"] == null ) {
            echo "<td class='dreta td_unitats'>0</td>";
        } else {
            echo "<td class='dreta td_unitats'>".number_format($row[0]["Unities"], 0, ',', '.')."</td>";
        }
        echo "</tr>";

    }
    echo "</tbody>";
    echo "</table>";

    ?>


-->