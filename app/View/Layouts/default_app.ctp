<?php


$this->assign('title', $title_for_layout);

/*if (empty($user)) {
    $this->assign('partner_name','');
} else {
    $this->assign('partner_name', $user['partner']['name']);
}*/



if (empty($this->Session->read('partner_name'))) {
    $this->assign('partner_name','');
} else {
    $this->assign('partner_name',$this->Session->read('partner_name'));
}


echo $this->element('header_app');

 ?>
<body>

    

    <!--
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="logo">
                <img src="/img/logo.jpg">
            </div>
            <div class="title">
                <h2><?= $this->fetch('title') ?>
                    <?php if (!empty($user)) {
                        echo "<a href='/Pages/menu'>  <i class='fa fa-home' aria-hidden='true'></i></a>";
                    }?>

                </h2>
                <p><?= $this->fetch('partner_name') ?></p>
    
                <?php 

                if (empty($user)) {
                    echo '';
                } else {
                    if (empty($user['partner_id'])) {
                        echo '<p><a href="/Partners/selection/">  <i class="fa fa-user-circle-o" aria-hidden="true"></i> (Canviar soci)</a></p>';
                    }
                }
                ?>


             
            </div>
        </div>
    </nav>-->



    
    
    <div class="container" >

        <?php 
        echo $this->element('menu_superior_app');
        ?>

    
        <div class="page-header">

     

            <?php 
            $messageGood = $this->Session->flash('good');
            $messageBad  = $this->Session->flash('bad');
            $messageInfo = $this->Session->flash('info');
            if ($messageGood) {
                echo "<div class='alert alert-success'>";
                echo $messageGood;
                echo "</div>";
            }

            if ($messageBad) {
                echo "<div class='alert alert-danger'>";
                echo $messageBad;
                echo "</div>";
            }

            if ($messageInfo) {
                echo "<div class='alert alert-info'>";
                echo $messageInfo;
                echo "</div>";
            }
            ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>

    <div class="spacing"></div>
    <div class="spacing"></div>
    <?= $this->element('footer_app'); ?>
</body>
</html>
