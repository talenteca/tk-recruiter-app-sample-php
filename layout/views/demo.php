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
      <!--table class="uk-table uk-table-justify uk-table-divider">
        <thead>
          <tr>
            <th class="uk-width-small">#</th>
            <th><span class="uk-margin-left">Step</span></th>
            <th><span class="uk-margin-left">Description</span></th>
            <th><span class="uk-margin-left">Action</span></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Sign up for a local user</td>
            <td>When you integrate with Talenteca you will link your current users accounts with Talenteca recruiters accounts and for that we need a user in first place, so here we create a local user.<br><br>This local user is just a demo but in your real application it will have your internal credentials, sign up and login full process.</td>
            <td><button class="uk-button uk-button-primary" type="button">Sign up</button></td>
          </tr>
          <tr>
            <td>2</td>
            <td>Prepare for authentication</td>
            <td>With a local user in place we can prepare a secure authentication request.<br><br>Technically speaking, the authentication request is based on a random text secret called a challenge code. To get a new challenge code you may call Talenteca using your valid recruiter app credentials.</td>
            <td><button class="uk-button uk-button-primary" type="button">Prepare</button></td>
          </tr>
          <tr>
            <td>3</td>
            <td>Request permission</td>
            <td>Using the prepared authentication request we can ask permission to the recruiter for using your recruiter app.<br><br>For getting this permission your user will be redirected to Talenteca to explain what your recruiter app is about.</td>
            <td><button class="uk-button uk-button-primary" type="button">Request</button></td>
          </tr>
          <tr>
            <td>4</td>
            <td>Create an access token</td>
            <td>If the recruiter grants permission to use your app, we can request an access token.<br><br>The access token is the most sensible part of the integration so it should be carefully linked to your internal user account in encrypted form and stored securely.</td>
            <td><button class="uk-button uk-button-primary" type="button">Create</button></td>
          </tr>
          <tr>
            <td>5</td>
            <td>Load job ads list</td>
            <td>Using the secured access token we can try to list the recruiter job ads</td>
            <td><button class="uk-button uk-button-primary" type="button">Load</button></td>
          </tr>
        </tbody>
      </table-->
   </div>
  </div>
</div>
<div class="uk-section uk-section-muted">
    <div class="uk-container uk-align-right">
        <h3>1. Sign up for a local user</h3>
        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
          <div class="uk-margin-top">
                <p>When you integrate with Talenteca you will link your current users accounts with Talenteca recruiters accounts and for that we need a user in first place, so here we create a local user.</p>
                <p>This local user is just a demo but in your real application it will have your internal credentials, sign up and login full process.</p>
            </div>
            <div>
                <p class="uk-margin-top uk-margin-left"><button class="uk-button uk-button-primary" type="button">Sign up</button></p>
            </div>
        </div>
    </div>
</div>
<div class="uk-section uk-section-default">
    <div class="uk-container uk-align-right">
        <h3>2. Prepare for authentication</h3>
        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
          <div class="uk-margin-top">
                <p>With a local user in place we can prepare a secure authentication request.</p>
                <p>Technically speaking, the authentication request is based on a random text secret called a challenge code. To get a new challenge code you may call Talenteca using your valid recruiter app credentials.</p>
            </div>
            <div>
                <p class="uk-margin-top uk-margin-left"><button class="uk-button uk-button-primary" type="button">Prepare</button></p>
            </div>
        </div>
    </div>
</div>
<div class="uk-section uk-section-muted">
    <div class="uk-container uk-align-right">
        <h3>3. Request permission</h3>
        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
          <div class="uk-margin-top">
                <p>Using the prepared authentication request we can ask permission to the recruiter for using your recruiter app.</p>
                <p>For getting this permission your user will be redirected to Talenteca to explain what your recruiter app is about.
            </div>
            <div>
                <p class="uk-margin-top uk-margin-left"><button class="uk-button uk-button-primary" type="button">Request</button></p>
            </div>
        </div>
    </div>
</div>
<div class="uk-section uk-section-default">
    <div class="uk-container uk-align-right">
        <h3>4. Create an access token</h3>
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
        <h3>5. Load job ads list</h3>
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
