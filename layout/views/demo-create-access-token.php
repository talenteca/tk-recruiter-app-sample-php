<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter app integration demo</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <h3>4. Create an access token</h3>
    <p class="uk-text-small">
      Now that we have the Talenteca permission approved, we can try to get the access token related to that challenge code request linked to our local user session.
    </p>
    <p class="uk-text-small">
      An access token is a random secured text that can be used for making calls to Talenteca in behalf of your users.
    </p>
    <p class="uk-text-small">
      <strong class="uk-text-danger">IMPORTANT:</strong> the access token is the most sensible piece of data of this flow, so it should be kept encrypted, secret and safe.
    </p>
    <p class="uk-text-small">
      For creating an access token you need an approved challenge code and the linked Talenteca recruiter ID with your recruiter app credentials to send them as JSON to the Talenteca endpoint <span class="uk-text-primary uk-text-break">https://www.talenteca.com/api/v1/oauth/recruiter/access-token</span> using this structure:
    </p>
    <?php if (!is_null($errorMessage)) { ?>
    <div class="uk-margin uk-align-center uk-width-2-3@l uk-text-danger">
      <?= $errorMessage ?>
    </div>
    <?php } ?>
    <div class="uk-grid">
      <form class="uk-width-2-3@l" action="<?= $basePath ?>/?action=create-access-token" method="post">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <pre class="uk-text-meta uk-text-break">
{
  app_id: [YOUR_APP_ID],
  app_secret: [YOUR_APP_SECRET]
  challenge_code: [APPROVED_CHALLENGE_CODE],
  recruiter_id: [APPROVED_TALENTECA_RECRUITER_ID]
}
            </pre>
          </div>
          <div class="uk-margin">
            <input class="uk-button uk-button-primary uk-align-center" type="submit" value="Create access token">
          </div>
        </fieldset>
      </form>
    </div>
    <p class="uk-text-small">
      <strong>NOTE:</strong> the code of this call is at <code class="uk-text-emphasis">createAccessToken()</code> and in the file <code class="uk-text-emphasis">Auth.php</code>, please give it a check.
    </p>
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
