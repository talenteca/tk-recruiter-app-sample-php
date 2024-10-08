<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Demo Recruiter App integration with Talenteca</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <h3>5. Load job ads list</h3>
    <p class="uk-text-small">
      These are the job ad IDS we found as active:
    </p>
    <?php foreach($activeJobAds as $activeJobAd): ?>
      <p>
        <?= $activeJobAd->id ?> <?= $activeJobAd->info->title ?> 
      </p>
    <?php endforeach; ?>
    <p class="uk-text-small">
      And these ones are the job ad IDS we found as inactive:
    </p>
    <?php foreach($inactiveJobAds as $inactiveJobAd): ?>
      <p>
        <?= $inactiveJobAd->id ?> <?= $inactiveJobAd->info->title ?> 
      </p>
    <?php endforeach; ?>
  </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-flex uk-flex-center">
    <div>
      <a class="uk-button uk-margin-left uk-button-primary" href="<?= $basePath ?>/?action=demo#demo-6">Continue</a>
    </div>
  </div>
</div>
<div class="uk-section uk-section-secondary">
  <div class="uk-container uk-flex uk-flex-center">
    <div class="uk-flex-wrap uk-margin-right uk-width-1-1@s uk-width-auto@m">
      <span><a class="uk-button uk-button-small uk-button-default" href="<?= $basePath ?>/?action=restart">Restart demo</a></span>
    </div>
    <div class="uk-flex-wrap uk-margin-left uk-text-small uk-margin-auto-vertical">
      <span>Find more information at the <a href="https://www.talenteca.com/api/doc/">Talenteca API Doc</a></span>
    </div>
  </div>
</div>
