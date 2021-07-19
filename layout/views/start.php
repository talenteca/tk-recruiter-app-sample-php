<script>
  var recruiterAppId = "<?= $recruiterAppId ?>";
  var recruiterAppSecret = "<?= $recruiterAppSecret ?>";
  var testRecruiterAppId = "<?= $testRecruiterAppId ?>";
  var testRecruiterAppSecret = "<?= $testRecruiterAppSecret ?>";

  var usingMyCredentials = true;

  document.addEventListener("DOMContentLoaded", function(event) { 
    if (recruiterAppId === testRecruiterAppId && recruiterAppSecret === testRecruiterAppSecret) {
      usingMyCredentials = false;
      document.getElementsByClassName("radio_test_credentials")[0].click();
      recruiterAppId = "";
      recruiterAppSecret = "";
    }
  });

  function updateCredentials() {
    if (usingMyCredentials) {
      recruiterAppId = document.getElementsByName("recruiter_app_id")[0].value;
      recruiterAppSecret = document.getElementsByName("recruiter_app_secret")[0].value;
    }
  }

  function useMyCredentials() {
    usingMyCredentials = true;
    document.getElementsByName("recruiter_app_id")[0].value = recruiterAppId;
    document.getElementsByName("recruiter_app_secret")[0].value = recruiterAppSecret;
  }

  function useTestCredentials() {
    usingMyCredentials = false;
    document.getElementsByName("recruiter_app_id")[0].value = testRecruiterAppId;
    document.getElementsByName("recruiter_app_secret")[0].value = testRecruiterAppSecret;
  }

</script>
<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter App Sample PHP</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <p class="uk-text-small">
      Welcome to the reference code for the Talenteca applications integrations for recruiters.
    </p>
    <p class="uk-text-small">
      For a demo please include your credentials and click on "Start demo"
    </p>
    <?php if (!is_null($errorMessage)) { ?>
    <div class="uk-margin uk-align-center uk-width-2-3@l uk-text-danger">
      <?= $errorMessage ?>
    </div>
    <?php } ?>
    <div class="uk-grid">
      <form class="uk-width-2-3@l" action="/?action=start-demo" method="post">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Recruiter app ID</legend>
            <input class="uk-input" name="recruiter_app_id" type="text" oninput="updateCredentials();" value="<?= $recruiterAppId ?>">
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Recruiter app secret</legend>
            <input class="uk-input" name="recruiter_app_secret" type="password" oninput="updateCredentials();" value="<?= $recruiterAppSecret ?>">
          </div>
          </div class="uk-margin">
            <label><input class="radio_my_credentials uk-radio" type="radio" name="credentials_set" checked onclick="useMyCredentials();"> Use my credentials</label>
            <label><input class="radio_test_credentials uk-radio" type="radio" name="credentials_set" onclick="useTestCredentials();"> Use test credentials</label>
          </div>
          <div class="uk-margin">
            <input class="uk-button uk-button-primary uk-align-center" type="submit" value="Start Demo">
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-container-small">
    <p>
      For requesting your credentials please write to <a href="mailto:soporte@talenteca.com">soporte@talenteca.com</a>
    </p>
    <p>
      Find more information at the <a href="https://dev.talenteca.com/api/doc/">Talenteca API Doc</a>
    </p>
  </div>
</div>
