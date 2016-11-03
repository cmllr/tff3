<hr>
<h3>Teile diesen Artikel, wenn er dir gefallen hat</h3>
<a class="button" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($this->view['MY_LOCATION']) ?>">Facebook</a> 
<a class="button" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($this->view['PAGETITLE']) ?>&url=<?php echo urlencode($this->view['MY_LOCATION']) ?>&via=trancefish">Twitter</a> 
<a class="button" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($this->view['MY_LOCATION']) ?>">Google+</a> 
<a class="button" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($this->view['MY_LOCATION']) ?>&title=<?php echo urlencode($this->view['PAGETITLE']) ?>&">LinkedIn</a>
<?php if ($this->view['IS_MOBILE']) :?>
<a target="_blank" href="whatsapp://send?text=<?php echo urlencode($this->view['PAGETITLE']) ?>%20<?php echo urlencode($this->view['MY_LOCATION']) ?>" class="button">WhatsApp</a>
<?php endif; ?>
<hr>