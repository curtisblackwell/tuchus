<div id="status-bar">
  <span class="icon">+</span>
  <?php if (isset($new)): ?>New Member<?php else: ?>
    Member:
    <?php if (isset($first_name) && isset($last_name)): ?> <?php print $first_name.' '.$last_name ?>
    <?php else: ?> <?php print $name ?><?php endif ?>
  <?php endif ?>
</div>

<form method="post" action="member?name=<?php print $name ?>">

  <input type="hidden" name="member[original_name]" value="<?php print $original_name ?>" />

  <?php if (isset($new)): ?>
    <input type="hidden" name="member[new]" value="1" />
  <?php endif ?>

  <div id="screen">

    <?php if (isset($errors) && (sizeof($errors) > 0)): ?>
    <div class="panel topo">
      <p>Sorry an error prevented the form submission</p>
      <ul class="errors">
        <?php foreach ($errors as $field => $error): ?>
        <li><span class="field"><?php print $field ?></span> <span class="error"><?php print $error ?></span></li>
        <?php endforeach ?>
      </ul>
    </div>
    <?php endif ?>

    <div class="input-block input-text">
      <label for="member-username">Username</label>
      <input type="text" id="member-username" name="member[name]" value="<?php print $name ?>" />
    </div>  

    <div class="input-block input-text">
      <label for="member-first-name">First name</label>
      <input type="text" name="member[yaml][first_name]" class="text title" id="gaa" value="<?php print $first_name; ?>" />
    </div>

    <div class="input-block input-text">
      <label for="member-last-name">Last name</label>
      <input type="text" name="member[yaml][last_name]" id="member-last-name" value="<?php print $last_name; ?>" />
    </div>

    <div class="input-block input-text input-password">
      <label for="member-password">Password</label>
      <input type="password" name="member[yaml][password]" id="member-password" value="" placeholder="Enter to change password" />
    </div>

    <div class="input-block input-text input-password">
      <label for="member-password-confirmation">Password Confirmation</label>
      <input type="password" name="member[yaml][password_confirmation]" id="member-password-confirmation" value="" placeholder="Type it again, please" />
    </div>

    <?php if ($is_password_encrypted !== true): ?>
    <div class="input-block input-checkbox input">
      <label for="member-password-encrypted">Encrypt Password?</label>
      <input type="checkbox" name="member[yaml][password_encrypted]" id="member-password-encrypted" value="true" checked />
    </div>
    <?php else: ?>
    <input type="hidden" name="member[yaml][password_encrypted]" value="true" />
    <?php endif; ?>


    <div class="input-block input-checkbox input">
      <label class="field-label" for="member-roles">Admin</label>
      <input type="checkbox" name="member[yaml][roles]" id="member-roles" value="admin" <?php if ($roles) print "checked" ?> />
    </div>

    <div class="input-block input-textarea markitup">
      <label for="member-bio">Biography</label>
      <textarea name="member[biography]" id="member-bio"><?php print $biography; ?></textarea>
    </div>

    <div id="publish-action" class="footer-controls">
      <input type="submit" class="btn btn-submit" value="Save" id="member-submit">
    </div>

  </div>

</form>