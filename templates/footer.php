<div class="footer">
    <div class="container">
      <?php
      $impressum = get_page_by_title( 'Impressum' );
      ?>
      <div class="row">
          <div class="col-md-6">&copy; 2017 Strobl Immobilien. Alle Rechte Vorbehalten</div>
          <div class="col-md-6"><a href="<?php echo get_permalink($impressum->ID); ?>">Impressum</a> | Design and Entwicklung durch GSDH</div>
      </div>
    </div>
</div>