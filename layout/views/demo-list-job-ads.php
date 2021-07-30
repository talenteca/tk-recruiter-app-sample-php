<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter app integration demo</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <h3>5. Load job ads list</h3>
    <p class="uk-text-small">
      Now we we have everything ready to make our first call to Talenteca.
    </p>
    <p class="uk-text-small">
      We just need to use the user linked access token to call this URL:
    </p>
    <p>
      <div class="uk-text-meta uk-text-break tk-text-code">https//www.talenteca.com/api/v1/recruiter/job-ad/list</div>
    </p>
    <div class="uk-grid">
      <form class="uk-width-2-3@l" action="/?action=list-job-ads" method="post">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <input class="uk-button uk-button-primary uk-align-center" type="submit" value="Load job ads list">
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
<div class="uk-section uk-section-secondary">
  <div class="uk-container uk-flex uk-flex-center">
    <div class="uk-flex-wrap uk-margin-right uk-width-1-1@s uk-width-auto@m">
      <span><a class="uk-button uk-button-small uk-button-default" href="/?action=restart">Restart demo</a></span>
    </div>
    <div class="uk-flex-wrap uk-margin-left uk-text-small uk-margin-auto-vertical">
      <span>Find more information at the <a href="https://www.talenteca.com/api/doc/">Talenteca API Doc</a></span>
    </div>
  </div>
</div>
