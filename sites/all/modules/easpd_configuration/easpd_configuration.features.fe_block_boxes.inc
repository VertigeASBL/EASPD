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
  $fe_block_boxes->info = 'Facebook\'s anti-privacy like box';
  $fe_block_boxes->format = 'full_html';
  $fe_block_boxes->machine_name = 'fb_like_box';
  $fe_block_boxes->body = '<div class="fb-like-box" data-href="https://www.facebook.com/easpdbrux" data-width="338" data-show-faces="true" data-stream="false" data-show-border="true" data-header="true"></div>';

  $export['fb_like_box'] = $fe_block_boxes;

  $fe_block_boxes = new stdClass();
  $fe_block_boxes->info = 'JS buttons to resize the page\'s text';
  $fe_block_boxes->format = 'filtered_html';
  $fe_block_boxes->machine_name = 'resize_text';
  $fe_block_boxes->body = '<a class="changer" href="javascript:;" id="text_resize_increase"><sup>+</sup>A</a> <a class="changer" href="javascript:;" id="text_resize_reset"> A</a> <a class="changer" href="javascript:;" id="text_resize_decrease"><sup>-</sup>A</a>
';

  $export['resize_text'] = $fe_block_boxes;

  $fe_block_boxes = new stdClass();
  $fe_block_boxes->info = 'Social Links';
  $fe_block_boxes->format = 'filtered_html';
  $fe_block_boxes->machine_name = 'social_links';
  $fe_block_boxes->body = '<p><a href="https://www.youtube.com/user/EASPD" target="_blank"><img alt="" src="/sites/default/files/sites/default/files/youtube-img.png" style="height:76px; width:375px" /></a></p>

<p><a href="https://www.facebook.com/easpdbrux" target="_blank"><img alt="" src="/sites/default/files/sites/default/files/facebook-img.png" style="height:85px; width:375px" /></a></p>

<p><a href="http://employmentforall.eu/" target="_blank"><img alt="" src="/sites/default/files/sites/default/files/jobs4all-img.png" style="height:55px; width:375px" /></a></p>
';

  $export['social_links'] = $fe_block_boxes;

  return $export;
}
