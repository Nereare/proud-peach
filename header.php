<?php
  require __DIR__ . '/vendor/autoload.php';

  use Defuse\Crypto\Key;
  use Delight\Auth\Auth;
  use Symfony\Component\Yaml\Yaml;

  $pp = array_merge(
    Yaml::parseFile('meta.yml'),
    Yaml::parseFile('config.yml')
  );
  $key = null;

  $db = new PDO('mysql:dbname=' . $pp['db']['name'] . ';host=localhost;charset=utf8mb4', $pp['db']['username'], $pp['db']['password']);
  $auth = new Auth($db);
  if ($auth->isLoggedIn()) {
    // If the user is logged in, she/he may have access to the data encrypted.
    // So we get the key's safe string...
    $keystr = Yaml::parseFile('key.yml');
    // ...and parse the key.
    $key = Key::loadFromAsciiSafeString($keystr['string']);
  }
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
