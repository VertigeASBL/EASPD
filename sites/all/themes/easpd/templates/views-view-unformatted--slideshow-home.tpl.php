<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<ul data-orbit>
  <?php foreach ($rows as $id => $row): ?>
    <li><?php print $row; ?></li>
  <?php endforeach; ?>
</ul>
