<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Demo Recruiter App integration with Talenteca</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-width-2-3 uk-container-small">
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
  <div class="uk-container uk-width-2-3 uk-align-center">
    <h3 id="demo-1">1. Sign up for a local user</h3>
    <div>
      <div class="uk-padding">
        <p>When you integrate with Talenteca you will link your current users accounts with Talenteca recruiters accounts and for that, we need a user in first place, so here we create a local user.</p>
        <p>This local user is just a demo but in your real application it will have your internal credentials, sign up and login full process.</p>
      </div>
      <div>
        <a class="uk-button uk-width-1-3@m uk-button-primary uk-align-center" href="<?= $basePath ?>/?action=demo-signup">Sign up</a>
      </div>
    </div>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-width-2-3 uk-align-center">
    <h3 id="demo-2">2. Prepare for authentication</h3>
    <div>
      <div class="uk-padding">
        <p>With a local user in place we can prepare a secure authentication request.</p>
        <p>Technically speaking, the authentication request is based on a random text secret called a challenge code. To get a new challenge code you may call Talenteca using your valid recruiter app credentials.</p>
      </div>
      <div>
        <a class="uk-button uk-width-1-3@m uk-button-primary uk-align-center" href="<?= $basePath ?>/?action=demo-prepare-auth">Prepare</a>
      </div>
    </div>
  </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-width-2-3 uk-align-center">
    <h3 id="demo-3">3. Request permission</h3>
    <div>
      <div class="uk-padding">
        <p>Using the prepared authentication request URL we can ask permission to the recruiter for using your recruiter app.</p>
        <p>For getting this permission your user will be redirected to Talenteca to explain what your recruiter app is about.</p>
      </div>
      <div>
        <a class="uk-button uk-width-1-3@m uk-button-primary uk-align-center" href="<?= $basePath ?>/?action=demo-request-permission">Request</a>
      </div>
    </div>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-width-2-3 uk-align-center">
    <h3 id="demo-4">4. Create an access token</h3>
    <div>
      <div class="uk-padding">
        <p>If the recruiter grants permission to use your app, we can request an access token.</p>
        <p>The access token is the most sensible part of the integration so it should be carefully linked to your internal user account in encrypted form and stored securely.
      </div>
      <div>
        <a class="uk-button uk-width-1-3@m uk-button-primary uk-align-center" href="<?= $basePath ?>/?action=demo-create-access-token">Create</a>
      </div>
    </div>
  </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-width-2-3 uk-align-center">
    <h3 id="demo-5">5. Load job ads list</h3>
    <div>
      <div class="uk-padding">
        <p>Using the secured access token we can try to list the recruiter job ads.</p>
        <p>If you have even further valid permissions you may create new job ads, deactivate job ads, republish job ads and a lot other actions in behalf of your users.</p>
      </div>
      <div>
        <a class="uk-button uk-width-1-3@m uk-button-primary uk-align-center" href="<?= $basePath ?>/?action=demo-list-job-ads">Load</a>
      </div>
    </div>
  </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-width-2-3 uk-align-center">
    <h3 id="demo-6">6. Create job ad</h3>
    <div>
      <div class="uk-padding">
        <p>Using the secured access token we can try to list the recruiter job ads.</p>
        <p>If you have even further valid permissions you may create new job ads, deactivate job ads, republish job ads and a lot other actions in behalf of your users.</p>
      </div>
      <div>
        <a class="uk-button uk-width-1-3@m uk-button-primary uk-align-center" href="<?= $basePath ?>/?action=demo-create-job-ad">Create</a>
      </div>
    </div>
  </div>
</div>
<div class="uk-section uk-section-muted">
  <div class="uk-container uk-width-2-3 uk-align-center">
    <h3 id="demo-7">7. Activate job ad</h3>
    <div>
      <div class="uk-padding">
        <p>Using the secured access token we can try to list the recruiter job ads.</p>
        <p>If you have even further valid permissions you may create new job ads, deactivate job ads, republish job ads and a lot other actions in behalf of your users.</p>
      </div>
      <div>
        <a class="uk-button uk-width-1-3@m uk-button-primary uk-align-center" href="<?= $basePath ?>/?action=demo-activate-job-ad">Activate</a>
      </div>
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
