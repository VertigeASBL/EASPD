<?php

/**
 * @file
 * Default theme implementation to format the simplenews newsletter body.
 *
 * Copy this file in your theme directory to create a custom themed body.
 * Rename it to override it. Available templates:
 *   simplenews-newsletter-body--[tid].tpl.php
 *   simplenews-newsletter-body--[view mode].tpl.php
 *   simplenews-newsletter-body--[tid]--[view mode].tpl.php
 * See README.txt for more details.
 *
 * Available variables:
 * - $build: Array as expected by render()
 * - $build['#node']: The $node object
 * - $title: Node title
 * - $language: Language code
 * - $view_mode: Active view mode
 * - $simplenews_theme: Contains the path to the configured mail theme.
 * - $simplenews_subscriber: The subscriber for which the newsletter is built.
 *   Note that depending on the used caching strategy, the generated body might
 *   be used for multiple subscribers. If you created personalized newsletters
 *   and can't use tokens for that, make sure to disable caching or write a
 *   custom caching strategy implemention.
 *
 * @see template_preprocess_simplenews_newsletter_body()
 */
?>
<!-- HEADER -->
<table bgcolor="#ECF2F9" cellpadding="0" cellspacing="0" class="head-wrap">
  <tr height="4">
    <td class="body-top"></td>
    <td class="body-top"></td>
    <td class="body-top"></td>
  </tr>
	<tr>
		<td class="fond-jaune-pale"></td>
		<td class="header container" >				
    <img src="<?php print base_path() . 'sites/all/themes/easpd/images/newsletter_header.png'; ?>" />
		</td>
		<td class="fond-jaune"></td>
	</tr>
</table>

<table bgcolor="#ECF2F9" cellpadding="0" cellspacing="0" class="head-wrap jaune-fonce">
	<tr>
		<td style="min-width: 10px;"></td>
		<td class="title container" >						
      <h1 style="margin-bottom: 0;"><?php print $title; ?></h1>
		</td>
		<td style="min-width: 10px;"></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table bgcolor="#ECF2F9" cellspacing="0" cellpadding="0" class="body-wrap">
	<tr>
    <td style="min-width: 10px;"></td>
		<td class="container">

			<table>
				<tr>
		 			<td class="container">

           <?php print render($build); ?>												
						
					</td>
				</tr>
			</table>
									
		</td>
    <td style="min-width: 10px;"></td>
	</tr>
</table><!-- /BODY -->
