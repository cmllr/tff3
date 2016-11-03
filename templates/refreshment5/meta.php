<meta charset="utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta name="robots" content="index,follow">
<meta property="fb:pages" content="18852779145"/>

<link rel="stylesheet" href="<?php echo $this->view['TPL_FRONT'] ?>style<?= TFF_MINIFY ? '.min' : '' ?>.css"/>
<!-- Integration von Social-Media //-->
<!-- Twitter //-->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@trancefish"/>
<meta name="twitter:title" content="<?php echo $this->view['PAGETITLE'] ?>"/>
<meta name="twitter:description" content="<?php echo $this->view['DESCRIPTION'] ?>"/>
<meta name="twitter:image" content="<?php echo $this->view['OGIMAGE'] ?>"/>
<meta name="twitter:url" content="<?php echo $this->view['MY_LOCATION'] ?>"/>
<!-- Facebook //-->
<meta property="og:url" content="<?php echo $this->view['MY_LOCATION'] ?>"/>
<meta property="og:title" content="<?php echo $this->view['PAGETITLE'] ?>"/>
<meta property="og:description" content="<?php echo $this->view['DESCRIPTION'] ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:image" content="<?php echo $this->view['OGIMAGE'] ?>"/>
<meta property="og:locale" content="de_DE"/>
<meta property="og:site_name" content="DJ Marc Shake, professional DJ services and Coding"/>
<!-- Google //-->
<link rel="publisher" href="https://plus.google.com/107640530526730845845"/>
<meta name="google-site-verification" content="IIZuxWqJY1NKOJAmir-rSqfk30-pXeExU6neGcv28No"/>
<!-- Bing //-->
<meta name="msvalidate.01" content="6AF308B00BB3BF9FEC23D93DD5BD671E"/>
<?php if ($this->view['MY_LOCATION']) : ?>
    <link rel="canonical" href="<?php echo $this->view['MY_LOCATION'] ?>"/>
<?php endif; ?>
<link rel="icon" href="<?php echo $this->view['PAGEROOT'] ?>favicon.png" type="image/png"/>
<title><?php echo $this->view['PAGETITLE'] ?></title>

<?php if ($this->view['DESCRIPTION']) : ?>
    <meta name="description" content="<?php echo $this->view['DESCRIPTION'] ?>"/>

<?php else: ?>
    <meta name="description" content="Webseite über Musikproduktion, Renoise, DJ-Zeugs und Filme"/>

<?php endif; ?>
<link rel="alternate" type="application/rss+xml" href="//feeds.feedburner.com/MarcShakesWeblog" title="RSS"/>
<?php if ($this->view['KEYWORDS']) : ?>
    <meta name="keywords" content="<?php echo $this->view['KEYWORDS'] ?>"/>
<?php endif; ?>
