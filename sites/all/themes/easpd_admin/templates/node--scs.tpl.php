<div class="white-bg">
<h2 class="bloc-bleu">title</h2>
<h3>
  <span class="date">
    <?php print format_date(render($node->changed), 'custom', 'd-m-Y'); ?>&nbsp;|&nbsp;</span><?php print render($node->title); ?>
</h3>

<?php
hide($content['field_image']);
// drupal met tout le contenu dans une triple div, il faut nettoyer
// derrière lui…
$qp = qp(utf8_decode(render($content)), 'div > div > div');
print $qp->innerHtml();
?>
</div>