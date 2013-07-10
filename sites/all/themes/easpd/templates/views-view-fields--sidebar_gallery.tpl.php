<div id="sidebar-gallery"
   data-slideWidth="217px"
   data-auto="0"
   data-pagination="false"
   data-loop="true"
>
<ul class="carousel">

<?php
foreach ($row->field_field_img as $ligne) {
  $img = $ligne['rendered']['#item'];
  $src = image_style_url($ligne['rendered']['#image_style'], $img['uri']);
?>

  <li class="slide">
    <img title="<?php print $img['title']; ?>"
           alt="<?php print $img['alt']; ?>"
           src="<?php print $src; ?>"
           height="142" width="223" />
  </li>

<?php } ?>
</ul>
</div>

<h3><a href="<?php print url('node/'. $row->nid); ?>">
  <?php print $row->node_title; ?>
</a></h3>