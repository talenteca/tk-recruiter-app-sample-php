<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Demo Recruiter App integration with Talenteca</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <div class="uk-grid">
      <div class="uk-align-center">
        <h2 class="uk-text-bold"><?= $message_title ?></h2>
      </div>
    </div>
    <div class="uk-text-break"><?= $message_text ?></div>
    <?php if (!is_null($message_detail)) { ?>
    <div class="uk-margin uk-text-bold">Detail:</div>
    <div class="uk-text-meta uk-text-break tk-text-code"><?= $message_detail ?></div>
    <?php } ?>
  </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-flex uk-flex-center">
    <div>
      <a class="uk-button uk-button-default" href="<?= $basePath ?>/?action=restart">Restart demo</a>
    </div>
    <div>
      <a class="uk-button uk-margin-left uk-button-primary" href="<?= $return_action ?>">Continue</a>
    </div>
  </div>
</div>
