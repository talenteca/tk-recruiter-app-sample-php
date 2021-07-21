<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter app integration demo</h1>
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
  <div class="uk-container uk-container-small">
    <p>
      Find more information at the <a href="https://dev.talenteca.com/api/doc/">Talenteca API Doc</a>
    </p>
  </div>
</div>
