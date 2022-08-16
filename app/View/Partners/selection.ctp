
<script language="javascript">
    function seleccionarSoci() {
        //valor = document.getElementById("SociId").value;
        valor = document.querySelector('input[name="SociId"]:checked').value;
       window.location.replace('/Pages/menu/'+valor);
    }
</script>
<style type="text/css">
td a { display: block; width: 100%; height: 100%; }
p a { display: block; width: 100%; height: 100%; }
#container {
    font-size: 18px;
    font-family: Open Sans", sans-serif;";
}
.post-item {
    border: 1px solid #ddd;
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
}
.post-item-grey {
    background-color: #f9f9f9;
}

</style>



<div class="row">
    <div class="col-md-12 col-xs-12">
        <p class="titol_article"><?=__('Selecciona un socio / almacén');?></p>
    </div>
</div>

<div class="spacing"></div>



<div id="container">

    <?php 
    $i = 0;
    foreach($partners as $partner) 
    { 
        if ($i == 0) {
            $class='post-item-grey';
            $i = 1;
        } else {
            $class='';
            $i = 0;
        }
        echo "<div class='post-item ".$class."' id='item-".$partner['Partner']['id']."'>";
        echo "<p><a href='".SERVER.'Stocks/index/1/'.$partner['Partner']['id']."'>";
        echo $partner['Partner']['code'].' - '.$partner['Partner']['name'];
        echo "</a><p>";
        echo "</div>";

    }
    ?>
</div>

<?php
    
    if (isset($next)) {
        echo "<div id='pagination'>";
        echo "  <a href='".SERVER."Partners/selection/".$next."' class='next'>".__('Siguiente página')."</a>";
        echo "</div>";
    }
    ?>




<!--
<script type="text/javascript">
  $(document).ready(function() {
    // Infinite Ajax Scroll configuration
    jQuery.ias({
      container : '.wrap', // main container where data goes to append
      item: '.item', // single items
      pagination: '.nav', // page navigation
      next: '.nav a', // next page selector
      loader: '<img src="/css/ajax-loader.gif"/>', // loading gif
      triggerPageThreshold: 3 // show load more if scroll more than this
    });
  });
</script>-->


<script type="text/javascript">
 var ias = jQuery.ias({
    container:  '#container',
    item:       '.post-item',
    pagination: '#pagination',
    next:       '#pagination a.next'
  });

  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 3}));
  ias.extension(new IASNoneLeftExtension({text: ""}));
  ias.extension(new IASPagingExtension());
  //ias.extension(new IASHistoryExtension({prev: '#pagination a.prev'}));
</script>




<!--
<div id="posts-list" class="grid_entry row masonry" >      
    <?php 
    $i = 0;

    foreach($partners as $partner){

        if ($i == 0) {
            $class='post-item-grey';
            $i = 1;
        } else {
            $class='';
            $i = 0;
        }

     ?>
    <div class="post-item <?=$class;?>">
        <?php
        $link = SERVER.'Stocks/index/1/'.$partner['Partner']['id'];
        
        

        echo "<p><a href='".SERVER.'Stocks/index/1/'.$partner['Partner']['id']."'>";
        echo $partner['Partner']['code'].' - '.$partner['Partner']['name'];
        echo "</a><p>";
        ?>
    </div>
    <?php } ?>
</div>

<?php
        echo $this->Paginator->next(__('Mostrar más socios...'));
?>
-->

<!--
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive" id="partners-list" class="grid_entry row masonry">
            <table class="table table-striped table-bordered">               

                <tbody>
                    <?php foreach ($partners as $partner): ?>
                    <tr class="odd pointer">
                        <?php
                        $link = SERVER.'Stocks/index/1/'.$partner['Partner']['id'];
                        ?>
                        <td>
                            <?php
                            echo "<a href='".SERVER.'Stocks/index/1/'.$partner['Partner']['id']."'>";
                            echo $partner['Partner']['code'].' - '.$partner['Partner']['name'];
                            echo "</a>";
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php

    $seg_pagina = $page + 1;
    $link = SERVER."Partners/selection/".$seg_pagina;
    echo "<a href ='".$link."'>Siguiente página</a>";
?>



<script>
  $(function(){
    $('.article-feed').infiniteScroll({
      path: '.pagination__next',
      append: '.article',
      status: '.scroller-status',
      hideNav: '.pagination',
    });
  });
 
</script>-->