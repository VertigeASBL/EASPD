<?php
/**
 * @file
 * easpd_configuration.features.fe_block_boxes.inc
 */

/**
 * Implements hook_default_fe_block_boxes().
 */
function easpd_configuration_default_fe_block_boxes() {
  $export = array();

  $fe_block_boxes = new stdClass();
  $fe_block_boxes->info = 'JS buttons to resize the page\'s text';
  $fe_block_boxes->format = 'full_html';
  $fe_block_boxes->machine_name = 'resize_text';
  $fe_block_boxes->body = '<p><a class="changer" href="javascript:;" id="text_resize_increase"><sup>+</sup>A</a> <a class="changer" href="javascript:;" id="text_resize_reset"> A</a> <a class="changer" href="javascript:;" id="text_resize_decrease"><sup>-</sup>A</a></p>

<div id="text_resize_clear">&nbsp;</div>
';

  $export['resize_text'] = $fe_block_boxes;

  return $export;
}
