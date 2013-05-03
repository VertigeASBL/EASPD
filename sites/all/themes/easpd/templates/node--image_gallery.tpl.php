<div id="node-<?php print $node->nid; ?>" class="node-gallery">
  <?php
  $imgcount = count($node->field_img['und']);
  for ($i = 0; $i < $imgcount; $i++) {
    $image_uri = $node->field_img['und'][$i]['uri'];
  // url
    $masthead_raw = image_style_url('thumbnail', $image_uri);
    ?>
    <a href="<?php print file_create_url($node->field_img['und'][$i]['uri']); ?>" rel="lightbox[<?php print $node->nid; ?>]">
      <img class="image<?php print ($i + 1);?>" src="<?php print $masthead_raw; ?>" />
    </a>
  <?php } ?>
</div>