<?php 
require 'app.dbupdate.php';

require 'models/about.model.php';
require 'views/about.view.php';
require 'controllers/about.controller.php';

require 'models/contact.model.php';
require 'views/contact.view.php';
require 'controllers/contact.controller.php';

require 'models/todo.model.php';
require 'views/todo.view.php';
require 'controllers/todo.controller.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="TODO notes made easy">
    <meta name="author" content="Flávio Pereira da Silva">

    <title>PHP TODO</title>

    <!-- Bootstrap core CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/app.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/index.php?section=todo&action=list_all">PHP TODO</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/index.php?section=about">About</a></li>
            <li><a href="/index.php?section=contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="container-content" id="content">
        <?php
        # --> FRONT CONTROLLER
        if (isset($_GET['section']) && $_GET['section'] == true) { // GET HANDLER
          
          $section = $_GET['section'];
          
          if ($section === 'todo') {
            $model = new TODOModel();
            $controller = new TODOController($model);
            $view = new TODOView($controller);
            
            if (isset($_GET['action']) && $_GET['action'] == true) {
              $action = $_GET['action'];
              $controller->{$action}();
            }
            
            echo $view->output();
            
          } elseif ($section === 'about') {
            $model = new AboutModel();
            $controller = new AboutController($model);
            $view = new AboutView($controller);
            echo $view->output();
            
          } elseif ($section === 'contact') {
            $model = new ContactModel();
            $controller = new ContactController($model);
            $view = new ContactView($controller);
            echo $view->output();
          }
        } elseif (isset($_POST['section']) && $_POST['section'] == true) { // POST HANDLER
          
          $section = $_POST['section'];
          
          if ($section === 'todo') {
            $model = new TODOModel();
            $controller = new TODOController($model);
            $view = new TODOView($controller);
            
            if (isset($_POST['action']) && $_POST['action'] == true) {
              $action = $_POST['action'];
              $controller->{$action}();
            }
            
            echo $view->output();
          }
        } else {
          $model = new TODOModel();
          $controller = new TODOController($model);
          $view = new TODOView($controller);
          $controller->list_all();
          echo $view->output();
        }
        # FRONT CONTROLLER <--
        ?>
      </div>
    </div><!-- /.container -->
    
    <footer class="footer">
      <div class="container">
        <p class="text-muted">
          <small>&copy;<?php echo date('Y'); ?> Fl<?php echo htmlentities('á'); ?>vio Pereira da Silva</small>
        </p>
      </div>
    </footer>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/app.js"></script>
  </body>
</html>
