<?php
  $current_user = Statamic_Auth::get_current_user();
  $name = $current_user->get_name();
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
  <title>Statamic Control Panel</title>
  <link rel="stylesheet" href="<?php print Statamic_helper::reduce_double_slashes(Statamic::get_site_root().'/'.$app->config['theme_path']) ?>css/tuchus.css">
  <script type="text/javascript" src="<?php print Statamic_helper::reduce_double_slashes(Statamic::get_site_root().'/'.$app->config['theme_path'])?>js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="<?php print Statamic_helper::reduce_double_slashes(Statamic::get_site_root().'/'.$app->config['theme_path'])?>js/underscore.min.js"></script>
  <?php print CP_helper::run_hook('add_to_control_panel_head') ?>
</head>
<body id="<?php print $route; ?>">
  <div id="wrap">
    <div id="main">
      <div id="control-bar" class="clearfix">
        <ul class="item-count-<?php print CP_helper::nav_count() ?>">
          <?php if (CP_Helper::show_page('dashboard', false)): ?><li id="item-dashboard"><a href="<?php print $app->urlFor("home"); ?>"><span class="icon">1</span><span class="title">Dashboard</span></a></li><?php endif ?>
          <?php if (CP_Helper::show_page('pages')): ?><li id="item-pages"><a href="<?php print $app->urlFor("pages"); ?>"><span class="icon">l</span><span class="title">Pages</span></a></li><?php endif ?>
          <?php if (CP_Helper::show_page('members')): ?><li id="item-members"><a href="<?php print $app->urlFor("members"); ?>"><span class="icon">,</span><span class="title">Members</span></a></li><?php endif ?>
          <?php if (CP_Helper::show_page('account')): ?><li id="item-account"><a href="<?php print $app->urlFor("member")."?name={$name}"; ?>"><span class="icon">.</span><span class="title">Account</span></a></li><?php endif ?>
          <?php if (CP_Helper::show_page('system')): ?><li id="item-system"><a href="<?php print $app->urlFor("system"); ?>"><span class="icon">@</span><span class="title">System</span></a></li><?php endif ?>
          <?php if (CP_Helper::show_page('help')): ?><li id="item-help"><a href="http://statamic.com/docs" target="_blank"><span class="icon">K</span><span class="title">Help</span></a></li><?php endif ?>
          <?php if (CP_Helper::show_page('view_site')): ?><li id="item-view-site"><a href="<?php print $app->config['_site_root']; ?>"><span class="icon">M</span><span class="title">View Site</span></a></li><?php endif ?>
          <?php if (CP_Helper::show_page('logout')): ?><li id="item-logout"><a href="<?php print $app->urlFor("logout"); ?>"><span class="icon">V</span><span class="title">Logout</span></a></li><?php endif ?>
        </ul>
      </div>
      <?php print $_html; ?>
  </div>
</div>
<div id="footer">
  &copy; <?php print date("Y")?> <a href="http://statamic.com">Statamic</a> v<?php print STATAMIC_VERSION ?>
  <span id="version-check">
  <?php if( Statamic_helper::is_valid($app->config['_license_key'])): ?>

    <?php if (isset($app->config['latest_version']) && $app->config['latest_version'] <> '' && STATAMIC_VERSION < $app->config['latest_version']): ?>
      <a href="https://store.statamic.com/account">update available: v<?php print $app->config['latest_version']; ?></a>
    <?php else: ?>
      up to date
    <?php endif ?>
  <?php else: ?>
    <a href="http://store.statamic.com">You are using an UNLICENSED copy of Statamic. Please purchase and enter a valid license. Thanks!</a>
  <?php endif ?>
  </span>
</div>
<script type="text/javascript" src="<?php print Statamic_helper::reduce_double_slashes(Statamic::get_site_root().'/'.$app->config['theme_path'])?>js/trailhead.min.js"></script>
<?php print CP_helper::run_hook('add_to_control_panel_foot') ?>
</body>
</html>