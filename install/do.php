<?php
  require __DIR__ . '/header.php';

  use Defuse\Crypto\Key;
  use Delight\Auth\Auth;
  use RandomLib\Factory;
  use Symfony\Component\Yaml\Yaml;
?>

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

    // Creating proud_peach database user's password:
    $factory = new Factory;
    $generator = $factory->getHighStrengthGenerator();
    $install['pp']['password'] = $generator->generateString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    $pp2['db']['name']     = 'proud_peach';
    $pp2['db']['username'] = 'proud_peach';
    $pp2['db']['password'] = $install['pp']['password'];

    // Registering Location data:
    $pp2['location']['name']                = $_POST['pl_name'];
    $pp2['location']['address']['address']  = $_POST['pl_addr1'];
    $pp2['location']['address']['city']     = $_POST['pl_addr2'];
    $pp2['location']['address']['postcode'] = $_POST['pl_postcode'];
    $pp2['location']['phone']               = $_POST['pl_phone'];
    $pp2['location']['email']               = $_POST['pl_email'];

    // Registering Supervisor data:
    $pp2['supervisor']['name']               = $_POST['sup_name'];
    $pp2['supervisor']['crm']['crm']         = $_POST['sup_crm'];
    $pp2['supervisor']['crm']['state']       = $_POST['sup_crm_state'];
    $pp2['supervisor']['register']['type']   = $_POST['sup_register_type'];
    $pp2['supervisor']['register']['number'] = $_POST['sup_register'];

    try {
      // Connecting to the database:
      $db = new PDO('mysql:host=localhost;charset=utf8mb4', $install['db']['username'], $install['db']['password']);

      // Create Database and use it:
      $db->exec(file_get_contents('../database/database.sql'));
      ?><p><i class="material-icons pass">check_circle</i> Banco de dados criado e selecionado.</p><?php

      // Create PHP Auth tables:
      $db->exec(file_get_contents('../vendor/delight-im/auth/Database/MySQL.sql'));
      ?><p><i class="material-icons pass">check_circle</i> Tabelas de usuários criada.</p><?php

      // Create PHP Auth extra tables:
      $db->exec(file_get_contents('../database/extra.sql'));
      ?><p><i class="material-icons pass">check_circle</i> Tabelas extras de usuários criada.</p><?php

      // Create Proud Peach's tables:
      $db->exec(file_get_contents('../database/tables.sql'));
      ?><p><i class="material-icons pass">check_circle</i> Banco de dados criado e selecionado.</p><?php

      // Create ICD-10 tables:
      $db->exec(file_get_contents('../database/icd10.sql'));
      $db->exec(file_get_contents('../database/icd10_a.sql'));
      $db->exec(file_get_contents('../database/icd10_b.sql'));
      $db->exec(file_get_contents('../database/icd10_c.sql'));
      $db->exec(file_get_contents('../database/icd10_d.sql'));
      $db->exec(file_get_contents('../database/icd10_e.sql'));
      $db->exec(file_get_contents('../database/icd10_f.sql'));
      $db->exec(file_get_contents('../database/icd10_g.sql'));
      $db->exec(file_get_contents('../database/icd10_h.sql'));
      $db->exec(file_get_contents('../database/icd10_i.sql'));
      $db->exec(file_get_contents('../database/icd10_j.sql'));
      $db->exec(file_get_contents('../database/icd10_k.sql'));
      $db->exec(file_get_contents('../database/icd10_l.sql'));
      $db->exec(file_get_contents('../database/icd10_m.sql'));
      $db->exec(file_get_contents('../database/icd10_n.sql'));
      $db->exec(file_get_contents('../database/icd10_o.sql'));
      $db->exec(file_get_contents('../database/icd10_p.sql'));
      $db->exec(file_get_contents('../database/icd10_q.sql'));
      $db->exec(file_get_contents('../database/icd10_r.sql'));
      $db->exec(file_get_contents('../database/icd10_s.sql'));
      $db->exec(file_get_contents('../database/icd10_t.sql'));
      $db->exec(file_get_contents('../database/icd10_u.sql'));
      $db->exec(file_get_contents('../database/icd10_v.sql'));
      $db->exec(file_get_contents('../database/icd10_w.sql'));
      $db->exec(file_get_contents('../database/icd10_y.sql'));
      $db->exec(file_get_contents('../database/icd10_x.sql'));
      $db->exec(file_get_contents('../database/icd10_z.sql'));
      ?><p><i class="material-icons pass">check_circle</i> Tabela de CID 10 criada.</p><?php

      // CREATE USER and GRANT
      $db->exec('CREATE USER "proud_peach"@"localhost" IDENTIFIED BY "' . $install['pp']['password'] . '"');
      ?><p><i class="material-icons pass">check_circle</i> Usuário criado.</p><?php
      $db->exec('GRANT ALL ON proud_peach.* TO "proud_peach"@"localhost"');
      ?><p><i class="material-icons pass">check_circle</i> Autorizações concedidas.</p><?php

      // Creating superuser:
      $auth = new Auth($db);
      $install['su']['id'] = $auth->register($install['su']['email'], $install['su']['password'], $install['su']['name']);
      ?><p><i class="material-icons pass">check_circle</i> Superusuário criado para <?= $install['su']['name'] ?> (<?= $install['su']['email'] ?>).</p><?php
      $db->exec('INSERT INTO `profiles`(id, crm, state) VALUES (' . $install['su']['id'] . ', ' . $install['su']['crm'] . ', "' . $install['su']['state'] . '");');
      ?><p><i class="material-icons pass">check_circle</i> Dados médicos do superusuário (CRM/<?= $install['su']['state'] ?> <?= $install['su']['crm'] ?>) inseridos.</p><?php

      // Creating proud_peach encryption key:
      $key = Key::createNewRandomKey();
      $key_string['string'] = $key->saveToAsciiSafeString();
      $meta = Yaml::dump($key_string);
      file_put_contents('../key.yml', $meta);
      ?><p><i class="material-icons pass">check_circle</i> Dados de segurança salvos.</p><?php

      // Writing Config file:
      $meta = Yaml::dump($pp2);
      file_put_contents('../config.yml', $meta);
      ?>
      <p><i class="material-icons pass">check_circle</i> Metadados do banco de dados salvos.</p>
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
