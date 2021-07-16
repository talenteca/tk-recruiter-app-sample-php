<h2>Talenteca Recruiter App Sample</h2>
<p>
  Welcome to the reference code of the integration to Talenteca applications for recruiters.
</p>
<p>
  For a demo please click <a href="/?action=demo">here</a>
</p>
<h3>How it works</h3>
<p>
  The steps to perform a request to Talenteca in behalf of the recruiters is:    
</p>
<ol>
  <li>Request your own recruiter app ID and secret to Talenteca</li>
  <li>Obtain a challenge code</li>
  <li>Request authorization to the recruiter</li>
  <li>Get the access token</li>
  <li>Make calls to Talenteca using the access token</li>
</ol>
<h3>1. Request your own recruiter app ID and secret to Talenteca</h3>
<p>
  This sample code has a reference app ID and secret for tests only, for
  real connections and data you need to request your own production app ID and
  secret.
</p>
<p>
  Please send an email to support@talenteca.com requesting your new recruiter
  app credentials for further steps and requirements.
</p>
<p>
  <strong>NOTE:</strong> You need to do this once per application.
</p>
<h3>2. Obtain a challenge code</h3>
<p>
  Once you have your app ID and secret you can request a new challenge code,
  for this, please send a post message to:
</p>
<code>http://www.talenteca.com/api/v1/oauth/recruiter/challenge-code</code>
<p>with the body similar to:</p>
<pre>
{
  "app_id" : "MY_APP_ID",
  "app_secret" : "MY_APP_SECRET"
}
</pre>
<p>
  Please find a reference in the code at RecruiterApp::getChallengeCode()
  on how to do it.
</p>
<p>
  <strong>NOTE: </strong> This is only necessary once per new recruiter you
  want to connect and authorize
</p>
<h3>3. Request authorization to the recruiter</h3>
<p>
  Using the new challenge code you can request authorization to the recruiter
  for using your app, for this, redirect the recruiter to
</p>
<code>http://www.talenteca.com/auth/recruiter-app?recruiter_app_id=MY_APP_ID&challenge_code=NEW_CHALLENGE_CODE&redirect=$MY_CALLBACK_PAGE</code>
<p>
  For recruiter_app_id use your assigned app ID.
</p>
<p>
  For challenge_code use the challenge code obtained in the previous step.
</p>
<p>
  For redirect use the page that will receive the result of the authorization (only registered domains are valid)
</p>
<p>
  Please find a reference in the code at RecruiterApp::getRequestAppAuthUrl()
  on how to do this.
</p>
<h3>4. Get the access token</h3>
<p>
  Once the recruiter authorize your application you can get the access token sending a
  post message to:
</p>
<code>https://www.talenteca.com/api/v1/oauth/recruiter/access-token</code>
<p>
  with the body similar to:
</p>
<pre>
{
  "app_id" : "MY_APP_ID",
  "app_secret" : "MY_APP_SECRET",
  "challenge_code" : "CHALLENGE_CODE"
}
</pre>
<p>
  Please go to RecruiterApp::getAccessToken() for a reference.
</p>
<p>
  Once you get the access token, please stored encrypted and safely associated to your
  recruiter user.
</p>
<p>
  <strong>NOTE:</strong> This is only necessary one per recruiter you want to connect
  using your app
</p>
<p>
  <strong>IMPORTANT:</strong> If you compromise or leak one or more access
  tokens or receive an attack, please inform Talenteca immediatly to
  support@talenteca.com for regenerating new tokens, the access tokens are very
  sensible and should be stored and kept safe.
</p>
<h3>5. Make calls to Talenteca using the access token</h3>
<p>
  With the access token you can make calls to Talenteca in behalf of your
  recruiter users, simple include the access token per recruiter as the header
  Bearer in each request.
</p>
<p>
  Visit RecruiterApp::listRecruiterJobAds() as a reference.
</p>
<p>
  <strong>For more possible calls please visit <a href="/?action=reference">API reference</a>
</p>
<p>
  For questions and support please write to support@talenteca.com
</p>
