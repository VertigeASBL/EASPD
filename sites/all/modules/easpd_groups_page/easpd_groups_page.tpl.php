<ul class="menu">
<?php foreach ($groups as $gid => $group): ?>
  <li>
    <h2><a href="<?php print url('node/'.$gid); ?>">
      <?php print $group->title; ?>
    </a></h2>

    <ul>
    <?php foreach ($group->og_contents as $nid => $node): ?>
      <li><a href="<?php print url('node/'.$nid); ?>">
        <?php print $node->title; ?>
      </a></li>
    <?php endforeach; ?>
    </ul>

  </li>
<?php endforeach; ?>
