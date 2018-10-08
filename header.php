<?php
  require __DIR__ . '/vendor/autoload.php';

  use Symfony\Component\Yaml\Yaml;
  $pp = Yaml::parseFile('meta.yml');

  $db = new \PDO('mysql:dbname=' . $pp['db']['name'] . ';host=localhost;charset=utf8mb4', $pp['db']['username'], $pp['db']['password']);
  $auth = new \Delight\Auth\Auth($db);
?>
<html lang='en-US'>
  <head>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title><?= $pp['name'] ?></title>
    <link rel='stylesheet' href='node_modules/skeleton-css/css/normalize.css' />
    <link rel='stylesheet' href='node_modules/skeleton-css/css/skeleton.css' />
    <link rel='stylesheet' href='node_modules/material-design-icons/iconfont/material-icons.css' />
    <link rel='stylesheet' href='node_modules/typeface-quicksand/index.css' />
    <link rel='stylesheet' href='node_modules/typeface-raleway/index.css' />
    <link rel='stylesheet' href='css/style.css' />
    <script src='node_modules/angular/angular.min.js'></script>
  </head>

  <body class='<?= $auth->isLoggedIn()?'':'login' ?>'>
    <div class='content'>
      <header>
        <div class='container'>
          <h1><?= $pp['name'] ?></h1>
          <?php if ($auth->isLoggedIn()) { ?>
          <nav>
            <ul>
              <li><?= $auth->getUsername() ?></li>
              <li><a href='logout.php'><i class="material-icons">exit_to_app</i></a></li>
            </ul>
          </nav>
          <?php } ?>
        </div>
      </header>
