<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter app integration demo</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <h3>1. Sign up for a local user</h3>
    <p class="uk-text-small">
      Let's create a local user to link it to Talenteca.
    </p>
    <p class="uk-text-small">
      Remember this is just a fake sample account to demonstrate how to integrate with Talenteca. For your real application you don't need to redo your currents users account registration and login, just use it.
    </p>
    <?php if (!is_null($errorMessage)) { ?>
    <div class="uk-margin uk-align-center uk-width-2-3@l uk-text-danger">
      <?= $errorMessage ?>
    </div>
    <?php } ?>
    <div class="uk-grid">
      <form class="uk-width-2-3@l" action="/?action=signup" method="post">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">User email</legend>
            <input class="uk-input" name="user_email" type="text">
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">User fullname</legend>
            <input class="uk-input" name="user_fullname" type="text">
          </div>
          <div class="uk-margin">
            <input class="uk-button uk-button-primary uk-align-center" type="submit" value="Signup">
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
