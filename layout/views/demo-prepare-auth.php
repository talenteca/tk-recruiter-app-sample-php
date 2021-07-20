<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter app integration demo</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <h3>2. Prepare for authentication</h3>
    <p class="uk-text-small">
      Let's create an URL with a challenge code for starting the authentication request.
    </p>
    <p class="uk-text-small">
      A challenge code is just a random encrypted text that ensures your authenticity towards Talenteca recruiters when asking for permissions for your app.
    </p>
    <p class="uk-text-small">
      You can create a challenge code at any time, you just need your recruiter app ID and recruiter app secret, and send them as JSON to the Talenteca endpoint <span class="uk-text-primary uk-text-break">https://www.talenteca.com/api/v1/oauth/recruiter/challenge-code</span> using this structure:
    </p>
    <?php if (!is_null($errorMessage)) { ?>
    <div class="uk-margin uk-align-center uk-width-2-3@l uk-text-danger">
      <?= $errorMessage ?>
    </div>
    <?php } ?>
    <div class="uk-grid">
      <form class="uk-width-2-3@l" action="/?action=prepare-auth" method="post">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <pre class="uk-text-meta uk-text-break">
{
  app_id: [YOUR_APP_ID],
  app_secret: [YOUR_APP_SECRET]
}
            </pre>
          </div>
          <div class="uk-margin">
            <input class="uk-button uk-button-primary uk-align-center" type="submit" value="Prepare auth">
          </div>
        </fieldset>
      </form>
    </div>
    <p class="uk-text-small">
      <strong>NOTE:</strong> the code of this call is at <code class="uk-text-emphasis">getRequestAppAuthUrl()</code> and <code class="uk-text-emphasis">getChallengeCode()</code> in file <code class="uk-text-emphasis">Auth.php</code>, please give it a check.
    </p>
  </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-container-small">
    <p>
      Find more information at the <a href="https://dev.talenteca.com/api/doc/">Talenteca API Doc</a>
    </p>
  </div>
</div>