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
      For a demo please include your credentials and click on "List job ads"
    </p>
    <div class="uk-grid">
    <form class="uk-width-1-2@l" action="/?action=list-job-ads" method="post">
      <fieldset class="uk-fieldset">
        <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Recruiter app ID</legend>
            <input class="uk-input" name="recruiter_app_id" type="text">
        </div>
        <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Recruiter app secret</legend>
            <input class="uk-input" name="recruiter_app_secret" type="password">
        </div>
        <div class="uk-margin">
            <input class="uk-button uk-button-primary uk-align-center" type="submit" value="List job ads">
        </div>
      </fieldset>
    </form>
    </div>
  </div>
</div>