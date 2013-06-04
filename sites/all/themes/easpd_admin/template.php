<?php

function easpd_admin_preprocess_node (&$vars) {

  // Remove submitted info
  $vars['display_submitted'] = FALSE;

  // Add template suggestions based on view modes
  $vars['theme_hook_suggestions'][] = 'node__' . $vars['view_mode'];
  $vars['theme_hook_suggestions'][] = 'node__' . $vars['view_mode'] . '__' . $vars['type'];

}
