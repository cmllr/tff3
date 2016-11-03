<meta charset="utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta name="robots" content="index,follow">

<link rel="stylesheet" href="<?php echo $this->view['TPL_FRONT'] ?>style<?= TFF_MINIFY ? '.min' : '' ?>.css"/>
<!-- Integration von Social-Media //-->
<?php if ($this->view['MY_LOCATION']) : ?>
    <link rel="canonical" href="<?php echo $this->view['MY_LOCATION'] ?>"/>
<?php endif; ?>
<link rel="icon" href="<?php echo $this->view['PAGEROOT'] ?>favicon.png" type="image/png"/>
<title><?php echo $this->view['PAGETITLE'] ?></title>

<?php if ($this->view['DESCRIPTION']) : ?>
    <meta name="description" content="<?php echo $this->view['DESCRIPTION'] ?>"/>

<?php else: ?>

<?php endif; ?>
<?php if ($this->view['KEYWORDS']) : ?>
    <meta name="keywords" content="<?php echo $this->view['KEYWORDS'] ?>"/>
<?php endif; ?>
