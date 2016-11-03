<?php include 'header.php'?>
<form method="post" action="<?php echo $this->view['PAGEROOT']?>seo/check/">
    <input type="text" name="url" value="" />
    <input type="submit" name="SEO Checkup" />
</form>
<?php if ($this->view['report']): ?>
<?php foreach ($this->view['report'] as $cat => $category): ?>
<h2>Bereich:<?php $cat?></h2>
<ul>
    <?php foreach ($category['good'] as $r => $info): ?>
    <li style="color:green"><?php echo  $info?></li>
    <?php endforeach; ?>

</ul>
<?php endforeach; ?>
<?php endif; ?>
<?php include 'footer.php '?>
