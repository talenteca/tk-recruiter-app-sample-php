<div class="uk-section uk-section-primary">
  <div class="uk-container uk-container-small">
    <h1>Talenteca Recruiter app integration demo</h1>
  </div>
</div>
<div class="uk-section uk-section-default">
  <div class="uk-container uk-container-small">
    <h3>6. Create job ad</h3>
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
      <form class="uk-width-2-3@l" action="<?= $basePath ?>/?action=create-job-ad" method="post">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Job ad title</legend>
            <input class="uk-input" name="title" type="text">
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Salary (free text)</legend>
            <input class="uk-input" name="salary" type="text">
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Custom company name (optional)</legend>
            <input class="uk-input" name="custom_company_name" type="text">
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Category</legend>
            <select class="uk-select" name="category">
              <option value="" selected="selected" disabled="disabled"> -Seleccionar - </option>
              <option value="Arquitectura">Arquitectura</option>
              <option value="Arte / Diseño / Creativo">Arte / Diseño / Creativo</option>
              <option value="Administrativo / Secretarial">Administrativo / Secretarial</option>
              <option value="Atención al cliente">Atención al cliente (incluye meseros, recepcionistas, etc)</option>
              <option value="Comercial / Ventas">Comercial / Ventas</option>
              <option value="Contabilidad / Finanzas">Contabilidad / Finanzas</option>
              <option value="Construcción">Construcción</option>
              <option value="Dirección de empresas">Dirección de empresas</option>
              <option value="Educación">Educación</option>
              <option value="Estatal / Ministerios">Estatal / Ministerios</option>
              <option value="Legal">Legal</option>
              <option value="Logística / Transporte">Logística / Transporte</option>
              <option value="Manufactura / Operaciones">Manufactura / Operaciones</option>
              <option value="Marketing / RRPP / Comunicación">Marketing / RRPP / Comunicación</option>
              <option value="Minas / Petroleo">Minas / Petroleo</option>
              <option value="Recursos naturales">Recursos naturales</option>
              <option value="Medicina / Salud">Medicina / Salud</option>
              <option value="ONGs">ONGs</option>
              <option value="Recursos humanos">Recursos humanos</option>
              <option value="Turismo / Hotelería">Turismo / Hotelería</option>
              <option value="Tecnología / Internet">Tecnología / Internet</option>
            </select>
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Industry</legend>
            <select class="uk-select" name="industry">
              <option value="" selected="selected" disabled="disabled"> -Seleccionar - </option>
              <option value="Automotriz">Automotriz</option>
              <option value="Gestión Educativa">Gestión Educativa</option>
              <option value="Hospitalidad">Hospitalidad</option>
            </select>
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Education</legend>
            <select class="uk-select" name="desired_candidate_education_level">
              <option value="" selected="selected" disabled="disabled"> - Seleccionar - </option>
              <option value="Básica">Básica</option>
              <option value="Media Superior">Media Superior</option>
              <option value="Superior - trunco">Superior - trunco</option>
              <option value="Superior - cursando">Superior - cursando</option>
              <option value="Superior - titulado">Superior - titulado</option>
              <option value="Maestría">Maestría</option>
              <option value="Doctorado">Doctorado</option>
            </select>
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Experience</legend>
            <select class="uk-select" name="desired_candidate_experience_level">
              <option value="" selected="selected" disabled="disabled"> - Seleccionar - </option>
              <option value="Practicantes">Practicantes</option>
              <option value="Nivel Inicial">Nivel Inicial</option>
              <option value="Nivel Medio">Nivel Medio</option>
              <option value="Nivel Experto">Nivel Experto</option>
              <option value="Nivel Gerencial">Nivel Gerencial</option>
              <option value="Nivel Alto Directivo">Nivel Alto Directivo</option>
            </select>
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Country</legend>
            <select class="uk-select" name="country_code">
              <option value="" selected="selected" disabled="disabled"> - Seleccionar - </option>
              <option value="mx">México</option>
              <option value="ec">Ecuador</option>
              <option value="es">España</option>
            </select>
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Postal code</legend>
            <input class="uk-input" name="postal_code" type="text">
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Position</legend>
            <input class="uk-input" name="position" type="text">
          </div>
          <div class="uk-margin">
            <legend class="uk-legend uk-text-small uk-text-bold">Description</legend>
            <textarea class="uk-textarea" name="description"></textarea>
          </div>
          <div class="uk-margin">
            <input class="uk-button uk-button-primary uk-align-center" type="submit" value="Create job ad">
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
