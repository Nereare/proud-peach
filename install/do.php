<?php require __DIR__ . '/header.php'; ?>

<main class='container row'>
  <div class='twelve columns'>
    <h2>Instalação em Processo</h2>
    <p>Não feche o navegador ou essa aba durante o processo de instalação, não
      recarrege a página.</p>
    <p>O processo de instalação pode levar alguns minutos, uma vez finalizado,
      você será redirecionado.</p>
    <?php

    // First, checking for POST data.
    if (empty($_POST)) {
      die('<p><i class="material-icons error">error</i> Formulário de instalação não preenchido.</p>');
    }
    // Fetching POST data.
    // Database data:
    $install['db']['username'] = $_POST['db_username'];
    $install['db']['password'] = $_POST['db_password'];
    // Superuser data:
    $install['su']['email']    = $_POST['su_email'];
    $install['su']['password'] = $_POST['su_password'];
    $install['su']['name']     = $_POST['su_name'];
    $install['su']['crm']      = $_POST['su_crm'];
    $install['su']['state']    = $_POST['su_crm_state'];

    // Creating proud_peach user's password:
    $factory = new RandomLib\Factory;
    $generator = $factory->getHighStrengthGenerator();
    $install['pp']['password'] = $generator->generateString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    $pp['db']['password'] = $install['pp']['password'];

    try {
      // Connecting to the database:
      $db = new \PDO('mysql:host=localhost;charset=utf8mb4', $install['db']['username'], $install['db']['password']);

      // CREATE DATABASE
      $db->exec('CREATE DATABASE IF NOT EXISTS proud_peach;');
      ?><p><i class="material-icons pass">check_circle</i> Banco de dados iniciado.</p><?php
      // USE DATABASE
      $db->exec('USE proud_peach;');
      ?><p><i class="material-icons pass">check_circle</i> Banco de dados selecionado.</p><?php

      // CREATE TABLEs
      $db->exec('CREATE TABLE IF NOT EXISTS `users` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL, `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL, `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL, `status` tinyint(2) unsigned NOT NULL DEFAULT 0, `verified` tinyint(1) unsigned NOT NULL DEFAULT 0, `resettable` tinyint(1) unsigned NOT NULL DEFAULT 1, `roles_mask` int(10) unsigned NOT NULL DEFAULT 0, `registered` int(10) unsigned NOT NULL, `last_login` int(10) unsigned DEFAULT NULL, `force_logout` mediumint(7) unsigned NOT NULL DEFAULT 0, PRIMARY KEY (`id`), UNIQUE KEY `email` (`email`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
      ?><p><i class="material-icons pass">check_circle</i> Tabela <em>users</em> criada.</p><?php

      $db->exec('CREATE TABLE IF NOT EXISTS `users_confirmations` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `user_id` int(10) unsigned NOT NULL, `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL, `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL, `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL, `expires` int(10) unsigned NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `selector` (`selector`), KEY `email_expires` (`email`,`expires`), KEY `user_id` (`user_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
      ?><p><i class="material-icons pass">check_circle</i> Tabela <em>users_confirmations</em> criada.</p><?php

      $db->exec('CREATE TABLE IF NOT EXISTS `users_remembered` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, `user` int(10) unsigned NOT NULL, `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL, `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL, `expires` int(10) unsigned NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `selector` (`selector`), KEY `user` (`user`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
      ?><p><i class="material-icons pass">check_circle</i> Tabela <em>users_remembered</em> criada.</p><?php

      $db->exec('CREATE TABLE IF NOT EXISTS `users_resets` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, `user` int(10) unsigned NOT NULL, `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL, `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL, `expires` int(10) unsigned NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `selector` (`selector`), KEY `user_expires` (`user`,`expires`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
      ?><p><i class="material-icons pass">check_circle</i> Tabela <em>users_resets</em> criada.</p><?php

      $db->exec('CREATE TABLE IF NOT EXISTS `users_throttling` (`bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL, `tokens` float unsigned NOT NULL, `replenished_at` int(10) unsigned NOT NULL, `expires_at` int(10) unsigned NOT NULL, PRIMARY KEY (`bucket`), KEY `expires_at` (`expires_at`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
      ?><p><i class="material-icons pass">check_circle</i> Tabela <em>users_throttling</em> criada.</p><?php

      $db->exec('CREATE TABLE IF NOT EXISTS `profiles` (`id` int(10) unsigned NOT NULL, `crm` int(8) unsigned NOT NULL DEFAULT 0, `state` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `crm` (`crm`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
      ?><p><i class="material-icons pass">check_circle</i> Tabela <em>profiles</em> criada.</p><?php

      // CREATE USER and GRANT
      $db->exec('CREATE USER "proud_peach"@"localhost" IDENTIFIED BY "' . $install['pp']['password'] . '"');
      ?><p><i class="material-icons pass">check_circle</i> Usuário criado.</p><?php
      $db->exec('GRANT ALL ON proud_peach.* TO "proud_peach"@"localhost"');
      ?><p><i class="material-icons pass">check_circle</i> Autorizações concedidas.</p><?php

      // Creating superuser:
      $auth = new \Delight\Auth\Auth($db);
      $install['su']['id'] = $auth->register($install['su']['email'], $install['su']['password'], $install['su']['name']);
      ?><p><i class="material-icons pass">check_circle</i> Superusuário criado para <?= $install['su']['name'] ?> (<?= $install['su']['email'] ?>).</p><?php
      $db->exec('INSERT INTO `profiles`(id, crm, state) VALUES (' . $install['su']['id'] . ', ' . $install['su']['crm'] . ', "' . $install['su']['state'] . '");');
      ?><p><i class="material-icons pass">check_circle</i> Dados médicos do superusuário (CRM/<?= $install['su']['state'] ?> <?= $install['su']['crm'] ?>) inseridos.</p><?php

      // Writing Yaml file:
      $meta = Symfony\Component\Yaml\Yaml::dump($pp);
      file_put_contents('../meta.yml', $meta);
      ?>
      <p><i class="material-icons pass">check_circle</i> Metadados salvos.</p>
      <p><i class="material-icons pass">thumb_up</i> Instalação concluída!</p>

      <h2>Aviso</h2>
      <p>Agora que a instalação finalizou com sucesso, <strong>delete a pasta de
        instalação</strong>, uma vez que ela é uma fonte de vulnerabilidade após
        a instalação ser concluída.</p>
      <p>Esperamos que você aproveite o programa!</p>
      <p><a href="../">Retornar à página inicial</a></p>
      <?php
    } catch (PDOException $e) {
      ?><p><i class="material-icons error">error</i> Houve um erro com a instalação: <?= $e->getMessage() ?></p><?php
    }
    ?>
  </div>
</main>

<?php require __DIR__ . '/footer.php'; ?>
