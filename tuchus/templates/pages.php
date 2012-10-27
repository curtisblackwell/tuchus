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

  <span class="icon">n</span> Site Pages
</div>

<div id="screen">
  
  <?php if ($are_fieldsets):?>
    <a href="#" class="btn add-page-btn" data-path="/" data-title="None">New Top Level Page</a>
  <?php endif ?>

  <?php $fieldset = 'page' ?>

  <ul id="page-tree">
    <?php foreach ($pages as $page):?>
    <li class="page">
      <div class="page-wrapper">
        <div class="page-primary">
      <?php 
      $base = $page['slug'];

      if ($page['type'] == 'file'): ?>
        <a href="<?php print $app->urlFor('publish')."?path={$page['url']}"; ?>"><span class="page-title"><?php print (isset($page['title']) && $page['title'] <> '') ? $page['title'] : Statamic_Helper::prettify($page['slug']) ?></span></a>
      <?php elseif ($page['type'] == 'home'): ?>
        <a href="<?php print $app->urlFor('publish')."?path={$page['url']}"; ?>"><span class="page-title"><?php print isset($page['title']) ? $page['title'] : 'Home' ?></span></a>
      <?php else: 
        $folder = dirname($page['file_path']);
        ?>
        <a href="<?php print $app->urlFor('publish')."?path={$page['file_path']}"; ?>"><span class="page-title"><?php print (isset($page['title']) && $page['title'] <> '') ? $page['title'] : Statamic_Helper::prettify($page['slug']) ?></span></a>
      <?php endif ?>

      <?php if (isset($page['has_entries']) && $page['has_entries']): ?>
        <div class="control-entries">
          <span class="icon">n</span>
          <a href="<?php print $app->urlFor('entries')."?path={$base}"; ?>">
            <span class="iphone">List</span>
            <span class="web">List Entries</span>
          </a>
          <em>or</em><a href="<?php print $app->urlFor('publish')."?path={$base}&new=true"; ?>">
            <span class="iphone">Add</span>
            <span class="web">Create Entry</span>
          </a>
        </div>
      <?php endif ?>
    </div>
        <div class="page-extras">
          
          <?php if ($page['type'] == 'file'): ?>
            <div class="page-view"><a href="<?php print $page['url'] ?>" class="tip" title="View Page"><span class="icon">M</span></a></div>
          <?php elseif ($page['type'] == 'home'): ?>
            <div class="page-view"><a href="<?php print Statamic::get_site_root(); ?>" class="tip" title="View Page"><span class="icon">M</span></a></div>
          <?php else: 
            $folder = dirname($page['file_path']);
          ?>
            <div class="page-view"><a href="<?php print $page['url'] ?>" class="tip" title="View Page"><span class="icon">M</span></a></div>
            <div class="page-add">
              <a href="#" data-path="<?php print $folder; ?>" data-title="<?php print $page['title']?>" class="tip add-page-btn" title="New Child Page"><span class="icon">j</span></a>
            </div>
          <?php endif ?>

          <div class="slug-preview">
          <?php if ($page['type'] == 'home'): ?>
            /        
          <?php else: print isset($page['url']) ? $page['url'] : $base; endif; ?>
        </div>
        </div>
      </div>
      <?php if (isset($page['children']) && (sizeof($page['children'])> 0)): ?>
        <?php display_folder($app, $page['children'], $page['slug']) ?>
      <?php endif ?>
    </li>
    <?php endforeach ?>
  </ul>
</div>


<?php function display_folder($app, $folder, $base="") {  ?>
<ul class="subpages">
<?php foreach ($folder as $page):?>
<li class="page">
  <div class="page-wrapper">
    <div class="page-primary">

    <!-- PAGE TITLE -->
      <?php if ($page['type'] == 'file'): ?>
        <a href="<?php print $app->urlFor('publish')."?path={$base}/{$page['slug']}"; ?>"><span class="page-title"><?php print isset($page['title']) ? $page['title'] : Statamic_Helper::prettify($page['slug']) ?></span></a>
      <?php else: ?>
        <a href="<?php print $app->urlFor('publish')."?path={$page['file_path']}"; ?>"><span class="page-title"><?php print isset($page['title']) ? $page['title'] : Statamic_Helper::prettify($page['slug']) ?></span></a>

      <?php endif ?>

    <!-- ENTRIES -->
    <?php if (isset($page['has_entries']) && $page['has_entries']): ?>
      <div class="control-entries">
          <span class="icon">n</span>
          <a href="<?php print $app->urlFor('entries')."?path={$base}/{$page['slug']}"; ?>">
            <span class="iphone">List</span>
            <span class="web">List Entries</span>
          </a>
          <em>or</em><a href="<?php print $app->urlFor('publish')."?path={$base}/{$page['slug']}&new=true"; ?>">
            <span class="iphone">Add</span>
            <span class="web">Create Entry</span>
          </a>
        </div>
    <?php endif ?>
    </div>

    <!-- SLUG & VIEW PAGE LINK -->
    <div class="page-extras">
      <div class="page-view"><a href="<?php print $page['url']?>" class="tip" title="View Page"><span class="icon">M</span></a></div>
      <?php if ($page['type'] != 'file'): ?>
      <div class="page-add"><a href="#" data-path="<?php print $page['file_path']?>" data-title="<?php print $page['title']?>" class="tip add-page-btn" title="New Child Page"><span class="icon">j</span></a></div>
      <?php endif; ?>
      <div class="slug-preview"><?php print isset($page['url']) ? $page['url'] : $base.' /'.$page['slug'] ?></div>
    </div>

  </div>
  <?php if (isset($page['children']) && (sizeof($page['children'])> 0)) {
    display_folder($app, $page['children'], $base."/".$page['slug']);
  } ?>

</li>
<?php endforeach ?>
</ul>
<?php } #end function ?>

<div id="modal-placement"></div>

<script type="text/html" id="fieldset-selector">

<?php if ($are_fieldsets):?>

<div class="modal" id="fieldset-modal" tabindex="1">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Select New Page Type</h3>
  </div>
  <div class="modal-body">
  <ul>
    <?php foreach ($fieldsets as $fieldset): ?>
      <li><a href="<?php print $app->urlFor('publish')?>?path=<%= path %>&new=true&fieldset=<?php print $fieldset ?>&type=none"><?php print Statamic_Helper::prettify($fieldset) ?></a></li>
    <?php endforeach; ?>
  </ul>
  <div class="modal-footer">
    Parent: <em><%= parent %></em>
  </div>
</div>

<?php endif ?>


</script>

<script type="text/javascript">
  var selector = _.template($("#fieldset-selector").text());
  $(".add-page-btn").click(function(){
    var html = selector({
      'path': $(this).attr('data-path'),
      'parent': $(this).attr('data-title')
    });
  $("#modal-placement").html(html);
  $('#fieldset-modal').modal();
});
</script>