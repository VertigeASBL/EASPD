<?php
/**
 * @file
 * easpd_configuration.context.inc
 */

/**
 * Implements hook_context_default_contexts().
 */
function easpd_configuration_context_default_contexts() {
  $export = array();

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'events_context';
  $context->description = '';
  $context->tag = '';
  $context->conditions = array(
    'views' => array(
      'values' => array(
        'events' => 'events',
      ),
    ),
  );
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'views-events_calendar-block_1' => array(
          'module' => 'views',
          'delta' => 'events_calendar-block_1',
          'region' => 'sidebar_first',
          'weight' => '-10',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;
  $export['events_context'] = $context;

  return $export;
}
