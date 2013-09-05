<table class="white-bg" bgcolor="#FFFFFF">
  <tr>
    <td>
      <table>
        <tr>
          <td><h2 class="bloc-bleu">title</h2></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <h3>
        <span class="date">
        <?php print format_date(render($node->changed), 'custom', 'd-m-Y'); ?>&nbsp;|&nbsp;</span><?php print render($node->title); ?>
      </h3>
    </td>
  </tr>
  <tr>
   <td>
      <?php
      hide($content['field_image']);
      print render($content);
      // drupal met tout le contenu dans une triple div, il faut nettoyer
      // derrière lui…
      /* $qp = qp(utf8_decode(render($content)), 'div > div > div'); */
      /* print $qp->innerHtml(); */
      ?>
    </td>
  </tr>
</table>
<table><tr><td style="heigth: 10px"></td></tr></table>
