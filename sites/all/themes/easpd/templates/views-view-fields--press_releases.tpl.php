<?php

$href = url('node/' . $row->nid);
$date = format_date($row->node_created, 'custom', 'd-m-Y');

?>

<h3><a href="<?php print $href; ?>">
  <?php print $date; ?>
</a></h3>

<?php print $row->field_body[0]['rendered']['#markup']; ?>
