<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
  <title><?php print Statamic::get_site_name(); ?> Login</title>
  <link rel="stylesheet" href="<?php print Statamic_helper::reduce_double_slashes(Statamic::get_site_root().'/'.$app->config['theme_path']) ?>css/tuchus.css">
</head>
<body id="login">
<?php print $_html; ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<?php print $app->config['theme_path']?>js/jquery-1.7.2.min.js')</script>
<script type="text/javascript" src="<?php print $app->config['theme_path']?>js/trailhead.min.js"></script>
</body>
</html>