<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
  <title><?php print Statamic::get_site_name(); ?> Login</title>
  <link rel="stylesheet" href="<?php print $app->config['theme_path'] ?>css/tuchus.css">
</head>
<body id="login">

<div id="login-wrapper">
  <div id="disabled-control-panel" class="center">
    <h1 class="push-down">The control panel is currently offline.</h1>
  </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<?php print $app->config['theme_path']?>js/jquery-1.7.2.min.js')</script>
<script type="text/javascript" src="<?php print $app->config['theme_path']?>js/trailhead.min.js"></script>
</body>
</html>