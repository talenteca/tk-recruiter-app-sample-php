<style>
  .tk-text-code {
    font-family: 'monospace';
  }
</style>
<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter app integration demo</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <div class="uk-grid">
      <div class="uk-align-center">
        <h2 class="uk-text-danger">Error</h2>
      </div>
    </div>
    <div class="uk-text-break"><?= $error_message ?></div>
    <?php if (!is_null($error_detail)) { ?>
    <div class="uk-margin uk-text-bold">Internal error:</div>
    <div class="uk-text-meta uk-text-break tk-text-code"><?= $error_detail ?></div>
    <?php } ?>
  </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-container-small uk-flex">
    <div class="uk-width-1-1">
      <a class="uk-width-1-2 uk-button uk-button-primary uk-align-center" href="<?= $return_action ?>">Try again</a>
    </div>
    <p>
      <a class="uk-button uk-button-primary uk-align-right" href="/?action=restart">Restart demo</a>
    </p>
  </div>
</div>
