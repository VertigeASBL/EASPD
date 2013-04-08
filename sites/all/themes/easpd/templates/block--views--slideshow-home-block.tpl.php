<div id="slider-container">
<?php
$qp = htmlqp($content, 'li');
print '<ul data-orbit>';
foreach ($qp as $li) {  
  print $li->html();
}
print '</ul>';
?>
</div>