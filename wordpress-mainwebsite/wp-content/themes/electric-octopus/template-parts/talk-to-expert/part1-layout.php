<section class="form-panel">
  <h2 id="step-title">Interested In</h2>
  <div class="progress" aria-hidden> 
    <div class="progress-lines">
      <span id="pl1" data-step="0"></span>
      <span id="pl2" data-step="1"></span>
      <span id="pl3" data-step="2"></span>
    </div>
  </div>
  <form id="leadForm" novalidate>
    <?php
      get_template_part('template-parts/talk-to-expert/form/step-1');
      get_template_part('template-parts/talk-to-expert/form/step-2');
      get_template_part('template-parts/talk-to-expert/form/step-3');
      get_template_part('template-parts/talk-to-expert/form/actions');
    ?>
  </form>
</section>

<?php 
// Load countries-states data for JavaScript
$countries_states = require get_template_directory() . '/inc/countries-states.php';
?>
<script>
  window.countryStateMap = <?php echo json_encode($countries_states); ?>;
</script>
