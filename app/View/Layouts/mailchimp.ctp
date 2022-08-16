<?php

$urlWordpress = 'https://'.$_SERVER['HTTP_HOST'];

$urlWordpress .= ($_SERVER['HTTP_HOST'] == '81.46.196.226') ? '/corma/' : '/';

if ($urlWordpress == 'http://cormaweb/') { $urlWordpress = 'https://www.corma.es/';}
?>

<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $title_for_layout;?></title>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?=$urlWordpress;?>intranet/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=$urlWordpress;?>intranet/assets/font-awesome/4.5.0/css/font-awesome.min.css" />

</head>

<body>
<div class="container">
<div class="header clearfix">
    <img src="https://www.corma.es/logo.png">
</div>
<div class="page-header">
<?php echo $this->fetch('content'); ?>
</div>

</div>
</body></html>