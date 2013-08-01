<div id="node-<?php print $node->nid; ?>" class="node-gallery">
  <h3><?php print $node->title; ?></h3>
  <?php
  $imgcount = count($node->field_img['und']);

  for ($i = 0; $i < $imgcount; $i++) {

    $image     = $node->field_img['und'][$i];
    $image_uri = $image['uri'];
    // url
    $masthead_raw = image_style_url('thumbnail', $image_uri);
    ?>
    <a href="<?php print file_create_url($image_uri); ?>"
        rel="lightbox[<?php print $node->nid; ?>]">

      <img alt="$image['alt']" class="image<?php print ($i + 1);?>"
            src="<?php print $masthead_raw; ?>" />
    </a>

  <?php } ?>
</div>
