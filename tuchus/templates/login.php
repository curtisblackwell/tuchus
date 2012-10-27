<div id="login-wrapper">
  <?php if ((isset($errors) && sizeof($errors) > 0)): ?>
      <div id="form-errors">
        <?php foreach ($errors as $field => $error): ?>
          <p><?php print $error; ?></p>
        <?php endforeach ?>
      </div>
    <?php endif ?>
  <div id="login-form">
    <img src="<?php print Statamic_helper::reduce_double_slashes(Statamic::get_site_root().'/'.$app->config['theme_path']) ?>img/statamic-logo-large.png" />
    <form method="post" action="<?php print $app->urlFor('login'); ?>">
      <div class="login-row">
        <input type="text" class="text username" id="login-username" placeholder="username" name="login[username]" />
      </div>
      <div class="login-row">
        <input type="password" class="text password" id="login-password" placeholder="password" name="login[password]" />
      </div>
      <div class="submit-row">
        <input type="submit" class="btn btn-submit" id="login-submit" value="Login" />
      </div>
    </form>
  </div>
</div>