<div id="status-bar">

  <?php if ($flash['success']): ?>
  <div id="flash-msg" class="success">
    <span class="icon">8</span>
    <span class="msg"><?php print $flash['success']; ?></p>
  </div>
  <?php endif ?>

  <?php if ($flash['error']): ?>
  <div id="flash-msg" class="error">
    <span class="icon">c</span>
    <span class="msg"><?php print $flash['error']; ?></p>
  </div>
  <?php endif ?>

  <span class="icon">n</span>
  <?php if (isset($new)): ?>New <?php else: ?>Editing<?php endif ?>
  <?php if ($type == 'none' && $original_slug != 'page'):?>Page: <?php print $full_slug; ?>
  <?php elseif ($type == 'none'): ?> Page: <?php print $full_slug; ?>
  <?php else: ?>Entry <em>in</em> <span class="slug"><?php print $full_slug; ?></span><?php endif ?>
  
  </span>
</div>

<div id="screen">

  <form enctype="multipart/form-data" method="post" action="publish?path=<?php print $path ?>">

    <?php print CP_helper::run_hook('add_to_publish_form') ?>

    <input type="hidden" name="page[full_slug]" value="<?php print $full_slug; ?>">
    <input type="hidden" name="page[type]" value="<?php print $type ?>" />
    <input type="hidden" name="page[folder]" value="<?php print $folder ?>" />
    <input type="hidden" name="page[original_slug]" value="<?php print $original_slug ?>" />
    <input type="hidden" name="page[original_datestamp]" value="<?php print $original_datestamp ?>" />
    <input type="hidden" name="page[original_timestamp]" value="<?php print $original_timestamp ?>" />
    <input type="hidden" name="page[original_numeric]" value="<?php print $original_numeric ?>" />

    <?php if (isset($new)): ?>
      <input type="hidden" name="page[new]" value="1" />
    <?php endif ?>

    <?php if (isset($fieldset)): ?>
      <?php if (is_array($fieldset)):?>
        <?php foreach($fieldset as $key => $set): ?>
          <input type="hidden" name="page[fieldset][<?php print $key ?>]" value="<?php print $set; ?>" />
        <?php endforeach; ?>
      <?php else: ?>
        <input type="hidden" name="page[fieldset]" value="<?php print $fieldset; ?>" />
      <?php endif; ?>
    <?php endif ?>

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

      <div class="input-block input-text required">
        <label for="publish-title">Title</label>
        <input name="page[yaml][title]" class="text text-large" tabindex="<?php print tabindex(); ?>" placeholder="Enter a title..." id="publish-title" value="<?php print htmlspecialchars($title); ?>" />
      </div>

      <?php if ($slug != '/'): ?>
      <div class="input-block input-text required">
        <label for="publish-slug">Slug</label>
        <input type="text" id="publish-slug" tabindex="<?php print tabindex(); ?>" class="text<?php if (isset($new)): ?> auto-slug <?php endif ?>" name="page[meta][slug]" value="<?php print $slug ?>" />
      </div>
      <?php else: ?>
        <input type="hidden" id="publish-slug" tabindex="<?php print tabindex(); ?>" name="page[meta][slug]" value="<?php print $slug ?>" />
      <?php endif ?>


      <?php if ($type == 'date'): ?>
      <div class="input-block input-date date required" data-date="<?php print date("Y-m-d", $datestamp) ?>" data-date-format="yyyy-mm-dd">
        <label>Publish Date</label>
        <span class="icon">P</span>
        <input name="page[meta][publish-date]" tabindex="<?php print tabindex(); ?>" type="text" id="publish-date"  value="<?php print date("Y-m-d", $datestamp) ?>" />
      </div>

      <?php if (Statamic::get_entry_timestamps()) { ?>
      <div class="input-block input-time time required" data-date="<?php print date("h:i a", $timestamp) ?>" data-date-format="h:i a">
        <label>Publish Time</label>
        <span class="icon">N</span>
        <input name="page[meta][publish-time]" tabindex="<?php print tabindex(); ?>" type="text" id="publish-time" class="timepicker" value="<?php print date("h:i a", $timestamp) ?>" />
      </div>
      <?php } ?>

      <?php elseif ($type == 'number'): ?>
      <div class="input-block input-text input-number" id="publish-order-number">
        <label for="publish-order-number">Order Number</label>
        <input name="page[meta][publish-numeric]" type="text" class="text date input-4char"  tabindex="<?php print tabindex(); ?>"maxlength="4" id="publish-order-number" value="<?php print $numeric; ?>" />
      </div>
      <?php endif ?>

      <?php 
      if (isset($fields) && count($fields) > 0):
        foreach ($fields as $key => $value):
          
          if ($key === 'content')
            continue;

          $fieldtype = isset($value['type']) ? $value['type'] : 'text';

          $val = "";
          if (isset($$key)) {
            $val = $$key;
          } else if (isset($value['default'])) {
            $val = $value['default'];
          }

          # special rule for Status
          if ($fieldtype == 'status' && isset($status)) {
            $val = $status;
          }

          if ( ! isset($value['display'])) {
            $value['display'] = Statamic_helper::prettify($key);
          }

        ?>

          <div class="input-block input-<?php print $fieldtype?> <?php if ( isset($value['required']) && $value['required'] === TRUE) print ' required'?>">
            <?php ## FIELDTYPE API ## ?>
            <label><?php print $value['display']; ?></label>
            <?php if (isset($value['instructions'])):?><div class="instructions"><?php print $value['instructions'] ?></div><?php endif ?>
            <?php print Fieldtype::render_fieldtype($fieldtype, $key, $value, $val, tabindex());?>
          </div>
      
        <?php endforeach ?>
      <?php endif ?>

      <?php
        # CONTENT FIELD SETTINGS
        $label = 'Content';
        $fieldtype = 'markitup';
        $fieldname = 'content';
        $field_config = array();
        $val = $content_raw;
        $instructions = '';
        $required = '';

        if (isset($fields) && isset($fields['content'])) {
          $field_config = $fields['content'];
          $label = isset($field_config['display']) ? $field_config['display'] : "Content";
          $fieldtype = $field_config['type'];
          $required = isset($field_config['required']) && $field_config['required'] === true ? 'required' : '';
          $instructions = isset($value['instructions']) ? "<div class='instructions'>{$value['instructions']}</div>" : '';
        }

      ?>

      <div class="input-block input-<?php print $fieldtype?> <?php print $required ?>">
        <?php ## FIELDTYPE API ## ?>
        <label><?php print $label; ?></label>
        <?php print $instructions ?>
        <?php print Fieldtype::render_fieldtype($fieldtype, $fieldname, $field_config, $val, tabindex(), '');?>
      </div>

      <div id="publish-action" class="footer-controls">
        <input type="submit" class="btn btn-submit" value="Save &amp; Publish" id="publish-submit">
      </div>

  </form>
</div>

<?php 

function tabindex() {
  static $count = 1;
  return $count++;
}

?>