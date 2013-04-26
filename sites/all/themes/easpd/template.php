<?php

function ajouter_read_more ($variables, $suffix='') {

  $qp = qp($variables['output']);

  $href = $qp->find('a')->attr('href');
  
  $qp->top()
    ->find('p')
    ->append("<a class='readmore' href='$href'>" . t('Read more') .  $suffix . "</a>");

  return $qp->top()->find('body')->innerHtml();
}

function easpd_views_view_field__newsflashes__block__body ($variables) {

  return ajouter_read_more($variables, ' …');
}

function easpd_views_view_field__last_publications__block__body ($variables) {

  return ajouter_read_more($variables, ' …');
}

function easpd_views_view_field__slideshow_home__block__body($variables) {

  return ajouter_read_more($variables);
}

function easpd_links__locale_block($variables) {

  global $language, $element;
  $output = "";
  $languages = language_list();

  foreach ($variables['links'] as $link_lang => $link) {

    // si langue en cours, le li aura la classe "active"
    $active = ($link_lang == $language->language);
    $class = $active ? ' class="active"' : '';

    // si aucune pas de traduction, le li aura la class "disabled"
    if (array_key_exists('href', $link)) {
      $href = $link['href'];
    } else {
      $href = '';
      $class = ' class="disabled"';
    }

    $options = array(
                     'attributes' => $link['attributes'],
                     'language'   => $languages[$link_lang],
                     );

    $output .= '<li' . $class . '>' . l($link_lang, $href, $options) . '</li>';
  }

  return '<ul>' . $output . '</ul>';
}

function easpd_menu_tree($variables) {

  $qp = qp($variables['tree']);

  foreach ($qp->find('a.active') as $active_link) {
    $active_link->parent()->addClass('active');
  }

  // on doit décoder l'utf8 parce que Drupal ré-encode par la suite 
  return '<ul class="menu">' . utf8_decode($qp->top()->find('body')->innerHtml()) . '</ul>';
}

function easpd_text_resize_block() {
  drupal_add_css(drupal_get_path('module', 'text_resize') . '/text_resize.css');
  drupal_add_library('system', 'jquery.cookie');
  drupal_add_js("var text_resize_scope = " . drupal_json_encode(variable_get('text_resize_scope', 'main')) . ";
    var text_resize_minimum = " . drupal_json_encode(variable_get('text_resize_minimum', '12')) . ";
    var text_resize_maximum = " . drupal_json_encode(variable_get('text_resize_maximum', '25')) . ";
    var text_resize_line_height_allow = " . drupal_json_encode(variable_get('text_resize_line_height_allow', FALSE)) . ";
    var text_resize_line_height_min = " . drupal_json_encode(variable_get('text_resize_line_height_min', 16)) . ";
    var text_resize_line_height_max = " . drupal_json_encode(variable_get('text_resize_line_height_max', 36)) . ";", 'inline');
  drupal_add_js(drupal_get_path('module', 'text_resize') . '/text_resize.js', 'file');
  if (variable_get('text_resize_reset_button', FALSE) == TRUE) {
    $output = t('<a href="javascript:;" class="changer" id="text_resize_increase"><sup>+</sup>A</a> <a href="javascript:;" class="changer" id="text_resize_reset">A</a> <a href="javascript:;" class="changer" id="text_resize_decrease"><sup>-</sup>A</a><div id="text_resize_clear"></div>');
  }
  else {
    $output = t('<a href="javascript:;" class="changer" id="text_resize_decrease"><sup>-</sup>A</a> <a href="javascript:;" class="changer" id="text_resize_increase"><sup>+</sup>A</a><div id="text_resize_clear"></div>');
  }
  return $output;
}

/**
 * Implements theme_links() targeting the main menu specifically
 * Outputs Foundation Nav bar http://foundation.zurb.com/docs/navigation.php
 * 
 */
//function easpd_links__system_main_menu($vars) {
//  // Get all the main menu links
//  $menu_links = menu_tree_output(menu_tree_all_data('main-menu'));
//  
//  // Initialize some variables to prevent errors
//  $output = '';
//  $sub_menu = '';
//
//  foreach ($menu_links as $key => $link) {
//    // Add special class needed for Foundation dropdown menu to work
//    !empty($link['#below']) ? $link['#attributes']['class'][] = 'has-flyout' : '';
//
//    // Render top level and make sure we have an actual link
//    if (!empty($link['#href'])) {
//      $output .= '<li' . drupal_attributes($link['#attributes']) . '>' . l($link['#title'], $link['#href']);
//      // Get sub navigation links if they exist
//      foreach ($link['#below'] as $key => $sub_link) {
//        if (!empty($sub_link['#href'])) {
//          $sub_menu .= '<li>' . l($sub_link['#title'], $sub_link['#href']) . '</li>';
//        }
//        
//      }
//      $output .= !empty($link['#below']) ? '<a href="#" class="flyout-toggle"><span> </span></a><ul class="flyout">' . $sub_menu . '</ul>' : '';
//      
//      // Reset dropdown to prevent duplicates
//      unset($sub_menu);
//      $sub_menu = '';
//      
//      $output .=  '</li>';
//    }
//  }
//  return '<ul class="nav-bar">' . $output . '</ul>';
//}

/**
 * Implements template_preprocess_html().
 * 
 */
//function easpd_preprocess_html(&$vars) {
//  // Add conditional CSS for IE. To use uncomment below and add IE css file
//  drupal_add_css(path_to_theme() . '/css/ie.css', array('weight' => CSS_THEME, 'browsers' => array('!IE' => FALSE), 'preprocess' => FALSE));
//  
//  // Need legacy support for IE downgrade to Foundation 2 or use JS file below
//  // drupal_add_js('http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js', 'external'); 
//}

/**
 * Implements template_preprocess_page
 *
 */
//function easpd_preprocess_page(&$vars) {
//}

/**
 * Implements template_preprocess_node
 *
 */
//function easpd_preprocess_node(&$vars) {
//}

/**
 * Implements hook_preprocess_block()
 */
//function easpd_preprocess_block(&$vars) {
//  // Add wrapping div with global class to all block content sections.
//  $vars['content_attributes_array']['class'][] = 'block-content';
//  
//  // Convenience variable for classes based on block ID
//  $block_id = $vars['block']->module . '-' . $vars['block']->delta;
//  
//  // Add classes based on a specific block
//  switch ($block_id) {
//    // System Navigation block
//    case 'system-navigation':
//      // Custom class for entire block
//      $vars['classes_array'][] = 'system-nav';
//      // Custom class for block title
//      $vars['title_attributes_array']['class'][] = 'system-nav-title';
//      // Wrapping div with custom class for block content
//      $vars['content_attributes_array']['class'] = 'system-nav-content';
//      break;
//    
//    // User Login block
//    case 'user-login':
//      // Hide title
//      $vars['title_attributes_array']['class'][] = 'element-invisible';
//      break;
//
//    // Example of adding Foundation classes
//    case 'block-foo': // Target the block ID
//      // Set grid column or mobile classes or anything else you want.
//      $vars['classes_array'][] = 'six columns';
//      break;
//  }
//
//  // Add template suggestions for blocks from specific modules.
//  switch($vars['elements']['#block']->module) {
//    case 'menu':
//      $vars['theme_hook_suggestions'][] = 'block__nav';
//    break;
//  }
//}

//function easpd_preprocess_views_view(&$vars) {
//}

/**
 * Implements template_preprocess_panels_pane().
 *
 */
//function easpd_preprocess_panels_pane(&$vars) {
//}

/**
 * Implements template_preprocess_views_views_fields().
 *
 */
//function easpd_preprocess_views_view_fields(&$vars) {
//}

/**
 * Status messages in reveal modal
 *
 */
//function easpd_status_messages($vars) {
//  $display = $vars['display'];
//  $output = ''; 
//
//  $status_heading = array(
//    'status' => t('Status message'), 
//    'error' => t('Error message'), 
//    'warning' => t('Warning message'),
//  );  
//  foreach (drupal_get_messages($display) as $type => $messages) {
//    $output .= "<div class=\"messages $type\">\n";
//    if (!empty($status_heading[$type])) {
//      $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
//    }   
//    if (count($messages) > 1) {
//      $output .= " <ul>\n";
//      foreach ($messages as $message) {
//        $output .= '  <li>' . $message . "</li>\n";
//      }   
//      $output .= " </ul>\n";
//    }   
//    else {
//      $output .= $messages[0];
//    }   
//    $output .= "</div>\n";
//  }
//  if ($output != '') {
//    drupal_add_js("jQuery(document).ready(function() { jQuery('#status-messages').reveal(); 
//            });", array('type' => 'inline', 'scope' => 'footer'));
//    $output = '<div id="status-messages" class="reveal-modal expand" >'. $output;
//    $output .= '<a class="close-reveal-modal">&#215;</a>';
//    $output .= "</div>\n";
//  }
//  return $output;
//}

/**
 * Implements theme_form_element_label()
 * Use foundation tooltips
 */
//function easpd_form_element_label($vars) {
//  if (!empty($vars['element']['#title'])) {
//    $vars['element']['#title'] = '<span class="secondary label">' . $vars['element']['#title'] . '</span>';
//  }
//  if (!empty($vars['element']['#description'])) {
//    $vars['element']['#description'] = ' <span class="has-tip tip-top radius" data-width="250" title="' . $vars['element']['#description'] . '">' . t('More information?') . '</span>';
//  }
//  return theme_form_element_label($vars);
//}

/**
 * Implements hook_preprocess_button().
 */
//function easpd_preprocess_button(&$vars) {
//  $vars['element']['#attributes']['class'][] = 'button';
//  if (isset($vars['element']['#parents'][0]) && $vars['element']['#parents'][0] == 'submit') {
//    $vars['element']['#attributes']['class'][] = 'secondary';
//  }
//}

/**
 * Implements hook_form_alter()
 * Example of using foundation sexy buttons
 */
//function easpd_form_alter(&$form, &$form_state, $form_id) {
//  // Sexy submit buttons
//  if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
//    $form['actions']['submit']['#attributes'] = array('class' => array('primary', 'button', 'radius'));
//  }
//}

// Sexy preview buttons
//function easpd_form_comment_form_alter(&$form, &$form_state) {
//  $form['actions']['preview']['#attributes']['class'][] = array('class' => array('secondary', 'button', 'radius'));
//}
