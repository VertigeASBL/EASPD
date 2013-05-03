<ul data-orbit
    data-options="
                  bullets:false;
                  slide_number:false;
                  navigation_arrows:false;
                 ">

<?php
foreach ($row->field_field_img as $ligne) {
  $img = $ligne['rendered']['#item'];
  $src = image_style_url($ligne['rendered']['#image_style'], $img['uri']);
?>

  <li>
    <img title="<?php print $img['title']; ?>"
           alt="<?php print $img['alt']; ?>"
           src="<?php print $src; ?>" />
  </li>

<?php } ?>
</ul>

<h3><a href="<?php print url('node/'. $row->nid); ?>">
  <?php print $row->node_title; ?>
</a></h3>