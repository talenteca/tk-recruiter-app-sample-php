<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter app integration demo</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <h3>3. Request permission</h3>
    <p class="uk-text-small">
      Now we just need to redirect your local user session to Talenteca permission page.
    </p>
    <p class="uk-text-small">
      This is the link we are going to use:
    </p>
    <p>
      <div class="uk-text-meta uk-text-break tk-text-code"><?= $recruiter_app_auth_url ?></div>
    </p>
    <?php if (!is_null($errorMessage)) { ?>
    <div class="uk-margin uk-align-center uk-width-2-3@l uk-text-danger">
      <?= $errorMessage ?>
    </div>
    <?php } ?>
    <div class="uk-grid">
      <form class="uk-width-2-3@l" action="<?= $basePath ?>/?action=request-permission" method="post">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <a class="uk-button uk-button-primary uk-align-center" href="<?= $recruiter_app_auth_url ?>">Request permission</a>
          </div>
        </fieldset>
      </form>
    </div>
    <p class="uk-text-small">
      <strong class="uk-text-danger">IMPORTANT:</strong> Do not pass the user ID or any other extra sensible data in the redirect parameters of this URL, keep all the sensible data linked to the challenge code generated in an internal database.
    </p>
  </div>
</div>
<div class="uk-section uk-section-secondary">
  <div class="uk-container uk-flex uk-flex-center">
    <div class="uk-flex-wrap uk-margin-right uk-width-1-1@s uk-width-auto@m">
      <span><a class="uk-button uk-button-small uk-button-default" href="/?action=restart">Restart demo</a></span>
    </div>
    <div class="uk-flex-wrap uk-margin-left uk-text-small uk-margin-auto-vertical">
      <span>Find more information at the <a href="https://dev.talenteca.com/api/doc/">Talenteca API Doc</a></span>
    </div>
  </div>
</div>

