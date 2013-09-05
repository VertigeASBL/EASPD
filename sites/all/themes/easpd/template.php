<?php

/* On vire les éléments du head qui ne sont pas valides w3c */
function easpd_html_head_alter (&$head_elements) {

  unset($head_elements['chrome_frame']);
  unset($head_elements['ie_image_toolbar']);
}

function easpd_preprocess_html (&$vars) {

  $vars['classes_array'][] = 'no-js';
}

/* l'attribut lang du lien vers Easy-EN doit être EN pour éviter les */
/* soucis de validation w3c. */
function easpd_block_view_locale_language_alter (&$vars) {

  $qp = qp($vars['content']);

  foreach ($qp->find('li') as $li) {
    if ($li->find('a')->attr('lang') == 'en-Easy') {
      $li->find('a')->attr('lang', 'en');
    }
  }

  $vars['content'] = $qp->top()->find('body')->innerHtml();
}

/* nettoyage pour w3c… */
function easpd_preprocess_date_display_single (&$vars) {

  unset($vars['attributes']['datatype']);
  unset($vars['attributes']['content']);
}

function ajouter_read_more ($variables, $suffix='') {

  $qp = qp(utf8_decode($variables['output']));

  $href = $qp->find('a')->attr('href');

  return $variables['output'] . "<a class='readmore' href='$href'>" . t('Read more') .  $suffix . "</a>";
}

function strip_tags_in_paragraphs ($variables) {

  $qp = qp(utf8_decode($variables['output']), 'p');

  foreach ($qp as $p) {
    $p->html(strip_tags($p->html()));
  }

  $variables['output'] = $qp->top()->find('body')->innerHtml();

  return $variables;
}

function easpd_views_view_field__newsflashes__block__body ($variables) {

  // empty images will break the layout without this
  $variables['output'] = preg_replace('#<div class="logo"></div>#',
                                      '<div class="logo">&nbsp;</div>',
                                      $variables['output']);
  // évite les merdres avec les apostrophes
  $variables['output'] = str_replace("’", "&apos;", $variables['output']);
  $variables['output'] = str_replace("“", "&ldquo;", $variables['output']);
  $variables['output'] = str_replace("”", "&rdquo;", $variables['output']);
  $variables['output'] = str_replace("—", "&mdash;", $variables['output']);
  $variables = strip_tags_in_paragraphs($variables);
  return ajouter_read_more($variables, ' …');
}

function easpd_views_view_field__newsflashes__page__body ($variables) {

  $variables = strip_tags_in_paragraphs($variables);
  return ajouter_read_more($variables, ' …');
}

function easpd_views_view_field__last_publications__block__body ($variables) {

  // empty images will break the layout without this
  $variables['output'] = preg_replace('#<div class="logo"></div>#',
                                      '<div class="logo">&nbsp;</div>',
                                      $variables['output']);
  // évite les merdres avec les apostrophes
  $variables['output'] = str_replace("’", "&apos;", $variables['output']);
  $variables['output'] = str_replace("“", "&ldquo;", $variables['output']);
  $variables['output'] = str_replace("”", "&rdquo;", $variables['output']);
  $variables['output'] = str_replace("—", "&mdash;", $variables['output']);
  $variables = strip_tags_in_paragraphs($variables);
  return ajouter_read_more($variables, ' …');
}

function easpd_views_view_field__slideshow_home__block__body($variables) {

  $variables = strip_tags_in_paragraphs($variables);
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

function easpd_foundation_breadcrumb($vars) {
  $breadcrumb = $vars['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $breadcrumbs = '<p class="element-invisible"><strong>' . t('You are here') . '</strong></p>';

    $breadcrumbs .= '<ul class="breadcrumbs">';

    foreach ($breadcrumb as $key => $value) {
      $breadcrumbs .= '<li>' . $value . '</li>';
    }

    $title = strip_tags(drupal_get_title());
    $breadcrumbs .= '<li class="current"><a href="#">' . $title. '</a></li>';
    $breadcrumbs .= '</ul>';

    return $breadcrumbs;
  }
}

/* function easpd_form_element ($variables) { */

/*   var_dump($variables); */
/*   return theme_form_element($variables); */
/* } */

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
 * Implements template_preprocess_page
 *
 */
//function easpd_preprocess_page(&$vars) {
//}

/**
 * Implements template_preprocess_node
 *
 */
function easpd_preprocess_node(&$vars) {

  // Add template suggestions based on view modes
  $vars['theme_hook_suggestions'][] = 'node__' . $vars['view_mode'];
  $vars['theme_hook_suggestions'][] = 'node__' . $vars['view_mode'] . '__' . $vars['type'];

  // group content infos to groups
  if ($vars['type'] === 'group' ) {
    $vars['group_content'] = get_group_contents($vars['nid']);
  }
}

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
