<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter app integration demo</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <div>
      <p class="uk-text-default">
        Welcome to the recruiter app integration demo for "<?= $recruiter_app_info->app_name ?>".
      </p>
      <p>
      </p>
      <p class="uk-text-default">
        Please follow these steps to run the demo:
      </p>
   </div>
  </div>
</div>
<div class="uk-section uk-section-muted">
    <div class="uk-container uk-align-right">
        <h3 id="demo-1">1. Sign up for a local user</h3>
        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
          <div class="uk-margin-top">
                <p>When you integrate with Talenteca you will link your current users accounts with Talenteca recruiters accounts and for that, we need a user in first place, so here we create a local user.</p>
                <p>This local user is just a demo but in your real application it will have your internal credentials, sign up and login full process.</p>
            </div>
            <div>
                <p class="uk-margin-top uk-margin-left"><a class="uk-button uk-button-primary" href="/?action=demo-signup">Sign up</a></p>
            </div>
        </div>
    </div>
</div>
<div class="uk-section uk-section-default">
    <div class="uk-container uk-align-right">
        <h3 id="demo-2">2. Prepare for authentication</h3>
        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
          <div class="uk-margin-top">
                <p>With a local user in place we can prepare a secure authentication request.</p>
                <p>Technically speaking, the authentication request is based on a random text secret called a challenge code. To get a new challenge code you may call Talenteca using your valid recruiter app credentials.</p>
            </div>
            <div>
                <p class="uk-margin-top uk-margin-left"><a class="uk-button uk-button-primary" href="/?action=demo-prepare-auth">Prepare</a></p>
            </div>
        </div>
    </div>
</div>
<div class="uk-section uk-section-muted">
    <div class="uk-container uk-align-right">
        <h3 id="demo-3">3. Request permission</h3>
        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
          <div class="uk-margin-top">
                <p>Using the prepared authentication request URL we can ask permission to the recruiter for using your recruiter app.</p>
                <p>For getting this permission your user will be redirected to Talenteca to explain what your recruiter app is about.
            </div>
            <div>
                <p class="uk-margin-top uk-margin-left"><a class="uk-button uk-button-primary" href="/?action=demo-request-permission">Request</a></p>
            </div>
        </div>
    </div>
</div>
<div class="uk-section uk-section-default">
    <div class="uk-container uk-align-right">
        <h3 id="demo-4">4. Create an access token</h3>
        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
            <div class="uk-margin-top">
                <p>If the recruiter grants permission to use your app, we can request an access token.</p>
                <p>The access token is the most sensible part of the integration so it should be carefully linked to your internal user account in encrypted form and stored securely.
            </div>
            <div>
                <p class="uk-margin-top uk-margin-left"><button class="uk-button uk-button-primary" type="button">Create</button></p>
            </div>
        </div>
    </div>
</div>
<div class="uk-section uk-section-muted">
    <div class="uk-container uk-align-right">
        <h3 id="demo-5">5. Load job ads list</h3>
        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
            <div class="uk-margin-top">
              <p>Using the secured access token we can try to list the recruiter job ads.</p>
              <p>If you have even further valid permissions you may create new job ads, deactivate job ads, republish job ads and a lot other actions in behalf of your users.</p>
            </div>
            <div>
                <p class="uk-margin-top uk-margin-left"><button class="uk-button uk-button-primary" type="button">Load</button></p>
            </div>
        </div>
    </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-container-small">
    <p>
      <a class="uk-button uk-button-primary uk-align-right" href="/?action=restart">Restart demo</a>
    </p>
    <p>
      Find more information at the <a href="https://dev.talenteca.com/api/doc/">Talenteca API Doc</a>
    </p>
  </div>
</div>
