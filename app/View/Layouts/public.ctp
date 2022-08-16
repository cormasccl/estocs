<?php
/**
 * User: Eloi Gallés Villaplana
 * Date: 30/04/14
 * Time: 00:06
 * @file default.ctp
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?= $this->Html->charset(); ?>
  <title><?= $title_for_layout;?></title>

  <?php
  echo $this->Html->meta('icon');
  echo $this->fetch('meta');
  ?>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <?= $this->Html->css('limitless'); ?>

</head>
<body>
<?= $this->fetch('content');?>


</body>
</html>