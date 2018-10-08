<?php
  require '../vendor/autoload.php';

  use Symfony\Component\Yaml\Yaml;
  $pp = Yaml::parseFile('../meta.yml');
?>
<html lang='en-US'>
  <head>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title><?= $pp['name'] ?></title>
    <link rel='stylesheet' href='../node_modules/skeleton-css/css/normalize.css' />
    <link rel='stylesheet' href='../node_modules/skeleton-css/css/skeleton.css' />
    <link rel='stylesheet' href='../node_modules/material-design-icons/iconfont/material-icons.css' />
    <link rel='stylesheet' href='../node_modules/typeface-quicksand/index.css' />
    <link rel='stylesheet' href='../node_modules/typeface-raleway/index.css' />
    <link rel='stylesheet' href='../css/style.css' />
    <script src='../node_modules/angular/angular.min.js'></script>
  </head>

  <body>
    <div class='content'>
      <header>
        <div class='container'>
          <h1><?= $pp['name'] ?></h1>
        </div>
      </header>
