<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<div class="slideshow-home" 
    data-width="672px"
    data-auto="0"
    data-loop="true"
>
<ul class="carousel">
  <?php foreach ($rows as $id => $row): ?>
    <li class="slide"><?php print $row; ?></li>
  <?php endforeach; ?>
</ul>
</div>