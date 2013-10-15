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

function my_htmlchars($html) {

  // évite les merdres avec les apostrophes
  $html = str_replace("’", "&apos;", $html);
  $html = str_replace("‘", "&lsquo;", $html);
  $html = str_replace("’", "&rsquo;", $html);
  $html = str_replace("“", "&ldquo;", $html);
  $html = str_replace("”", "&rdquo;", $html);
  $html = str_replace("—", "&mdash;", $html);
  $html = str_replace("–", "&ndash;", $html);
  $html = str_replace("œ", "&oelig;", $html);
  return $html;
}

function easpd_views_view_field__newsflashes__block__body ($variables) {

  // empty images will break the layout without this
  $variables['output'] = preg_replace('#<div class="logo"></div>#',
                                      '<div class="logo">&nbsp;</div>',
                                      $variables['output']);

  $variables['output'] = my_htmlchars($variables['output']);
  $variables = strip_tags_in_paragraphs($variables);
  return ajouter_read_more($variables, ' …');
}

function easpd_views_view_field__newsflashes__page__body ($variables) {

  $variables['output'] = my_htmlchars($variables['output']);
  $variables = strip_tags_in_paragraphs($variables);
  return ajouter_read_more($variables, ' …');
}

function easpd_views_view_field__last_publications__block__body ($variables) {

  // empty images will break the layout without this
  $variables['output'] = preg_replace('#<div class="logo"></div>#',
                                      '<div class="logo">&nbsp;</div>',
                                      $variables['output']);

  $variables['output'] = my_htmlchars($variables['output']);
  $variables = strip_tags_in_paragraphs($variables);
  return ajouter_read_more($variables, ' …');
}

function easpd_views_view_field__slideshow_home__block__body($variables) {

  $variables['output'] = my_htmlchars($variables['output']);
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
