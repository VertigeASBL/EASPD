<?php

/**
 * @file
 * Default theme implementation to format the simplenews newsletter footer.
 *
 * Copy this file in your theme directory to create a custom themed footer.
 * Rename it to simplenews-newsletter-footer--[tid].tpl.php to override it for a
 * newsletter using the newsletter term's id.
 *
 * @todo Update the available variables.
 * Available variables:
 * - $build: Array as expected by render()
 * - $build['#node']: The $node object
 * - $language: language code
 * - $key: email key [node|test]
 * - $format: newsletter format [plain|html]
 * - $unsubscribe_text: unsubscribe text
 * - $test_message: test message warning message
 * - $simplenews_theme: path to the configured simplenews theme
 *
 * Available tokens:
 * - [simplenews-subscriber:unsubscribe-url]: unsubscribe url to be used as link
 *
 * Other available tokens can be found on the node edit form when token.module
 * is installed.
 *
 * @see template_preprocess_simplenews_newsletter_footer()
 */
?>

<?php if (!$opt_out_hidden): ?>
  <?php if ($format == 'html'): ?>

    <!-- FOOTER -->

    <table bgcolor="#ECF2F9" class="footer-wrap disclaimer">
      <tr>
        <td></td>
        <td class="container">
          <table>
            <tr>
              <td>
                <img src="<?php print base_path() . 'sites/all/themes/easpd/images/euro_flag.png'; ?>" />
              </td>
              <td>
                <p><?php print t('With support from the European Union Progress Programme.<br/>The information contained in this publication does not necessarily reflect the position or opinion of the European Commission.');?></p>
              </td>
            </tr>
          </table>
        </td>
        <td></td>
      </tr>
    </table>

    <table bgcolor="#ECF2F9" class="footer-wrap contact-info">
      <tr>
        <td></td>
        <td class="container">
          <table>
            <tr>
              <td>
                <p class="left">&copy; EASPD 2013 - All Rights reserved <br>
                  <a href="<?php url('content/contact-us', array('absolute' => TRUE)); ?>">
                    contact
                  </a>
                </p>
              </td>
              <td>
                <p class="right">EASPD<br>
                  Oudergemselaan / Avenue d&rsquo;Auderghem 63<br>
                  1040 Brussels - Belgium
                </p>
              </td>
            </tr>
          </table>
        </td>
        <td></td>
      </tr>
    </table>

    <table bgcolor="#ECF2F9" class="footer-wrap">
      <tr>
        <td></td>
        <td class="container">
          <table>
            <tr>
              <td>
                <a href="https://www.youtube.com/user/EASPD">
                  <img src="<?php print base_path() . 'sites/all/themes/easpd/images/youtube_img.png'; ?>" />
                </a>
              </td>
              <td>
                <a href="https://www.facebook.com/easpdbrux">
                  <img src="<?php print base_path() . 'sites/all/themes/easpd/images/facebook_img.png'; ?>" />
                </a>
              </td>
              <td>
                <a href="http://employmentforall.eu/">
                  <img src="<?php print base_path() . 'sites/all/themes/easpd/images/jobs4all_img.png'; ?>" />
                </a>                
              </td>
            </tr>
          </table>
        </td>
        <td></td>
      </tr>
    </table>

    <table bgcolor="#ECF2F9" class="footer-wrap">
    	<tr>
    		<td></td>
    		<td class="container">
    			
    				<!-- content -->
    				<div class="content">
    				<table>
    				<tr>
    					<td align="center">
    						<p>
                  <p class="newsletter-footer">
                    <a href="[simplenews-subscriber:unsubscribe-url]">
                      <?php print $unsubscribe_text ?>
                    </a>
                  </p>
    						</p>
    					</td>
    				</tr>
    			</table>
    				</div><!-- /content -->
    				
    		</td>
    		<td></td>
    	</tr>
    </table><!-- /FOOTER -->
    
  <?php else: ?>
-- <?php print $unsubscribe_text ?>: [simplenews-subscriber:unsubscribe-url]
  <?php endif ?>
<?php endif; ?>

<?php if ($key == 'test'): ?>
- - - <?php print $test_message ?> - - -
<?php endif ?>
