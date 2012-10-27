<div id="screen">
  <div class="container">
    <div class="row">
      <div class="span8">
        <div class="panel">

        <?php $app = \Slim\Slim::getInstance();
        if (isset($app->config['dashboard_main_content'])):
          print $app->config['dashboard_main_content'];
        endif ?>

        </div>
      </div>
      <div class="span4">
        <div class="panel topo">
          <?php if (isset($app->config['dashboard_sidebar_content'])):
            print $app->config['dashboard_sidebar_content'];
          endif ?>
        </div>
      </div>
    </div>
  </div>
</div>