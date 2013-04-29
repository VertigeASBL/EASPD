<?php

$qp = qp($content);

// ajouter l'année au lien au-dessus du minical
/* $href = $qp->top()->find('.view-header h3 a')->attr('href'); */
/* preg_match('/[0-9]{4}/', $href, $matches); */
/* $year = $matches[0]; */
/* $month = $qp->top()->find('.view-header h3 a')->text(); */

/* $month = $qp->top()->find('.view-header h3 a') */
/*   ->text($month . ' ' . $year); */

// changer les pagers
$qp->top()->find('.date-prev a')->html(theme_image(array(
   'path' => "sites/all/themes/easpd/images/pager_prev.png",
   'alt' => t('previous month'),
   'attributes' => array(),
 )
));
$qp->top()->find('.date-next a')->html(theme_image(array(
   'path' => "sites/all/themes/easpd/images/pager_next.png",
   'alt' => t('next month'),
   'attributes' => array(),
 )
));

$content = $qp->top()->find('body')->innerHtml();

?>


<?php // afficher le bloc comme d'habitude… Le but serait de le faire
      // avec une fonction, mais je ne sais pas comment faire, alors je
      // recopie block.tpl.php ici :
?>
<?php if ($block->delta != 'main'):  ?>
  <div class="<?php print $classes; ?>"<?php print $attributes; ?>>
<?php endif; ?>
    
  <?php print render($title_prefix); ?>
  <?php if ($block->subject): ?>
    <h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
  <?php endif;?>
  <?php print render($title_suffix); ?>
  
  <?php !empty($content_attributes) ? print '<div ' .  $content_attributes . '>' : ''; ?>
    <?php print $content ?>
  <?php !empty($content_attributes) ? print '</div>' : ''; ?>

<?php $block->delta != 'main' ? print '</div>' : ''; ?>