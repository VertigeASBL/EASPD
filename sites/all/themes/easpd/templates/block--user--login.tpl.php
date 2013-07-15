<?php

$qp = qp($content);

$qp->find('.button')
   ->removeClass('button')
   ->addClass('bouton');

$qp->top()->find('li.first > a')
   ->addClass('bouton')
   ->text(t('Join us'));

$new_member_link = '<a href="' . url('content/membership') .
  '" class="bouton">' . t('Join us') . '</a>'; 
/* $qp->top()->find('li.first > a')->html(); */

$qp->top()->remove('li.first');

$content = $qp->top()->find('body')->innerHtml();
$content .= '<div class="signup"><h3>' . t('Become a member') . '</h3>' . $new_member_link . '</div>';

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