<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES"><!--<![endif]-->

<head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
    <title>        
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>



    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?=SERVER;?>css/dataTables.bootstrap.min.css"/> 
    <link rel="stylesheet" href="<?=SERVER;?>css/style_app.css">

    <link rel="stylesheet" href="<?=SERVER;?>css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="<?=SERVER;?>font-awesome/css/font-awesome.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="apple-touch-icon" href="<?=SERVER;?>img/logo.jpg" />

    <link rel="apple-touch-icon" sizes="57×57" href="<?=SERVER;?>img/touch-icon-iphone.jpg" />
    <link rel="apple-touch-icon" sizes="114×114" href="<?=SERVER;?>img/touch-icon-ipad.jpg" />


    <link rel="pingback" href="https://www.corma.es/xmlrpc.php">



    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>


    
    <?php
    echo $this->Html->script('jquery-1.12.4');
    echo $this->Html->script('callbacks');
    echo $this->Html->script('spinner');
    echo $this->Html->script('trigger');
    echo $this->Html->script('paging');
    echo $this->Html->script('noneleft');
    echo $this->Html->script('jquery-ias');
    ?>



    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript" src="<?=SERVER;?>js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=SERVER;?>js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="https:////code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript" src="<?=SERVER;?>js/jquery.fancybox.min.js"></script>
    

</head>