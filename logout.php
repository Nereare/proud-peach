<?php
  require __DIR__ . '/header.php';

  function printError($msg) {
    ?>
      <p><i class="material-icons error">error</i> <?= $msg ?></p>
      <p><a href="./">Retornar à página inicial</a></p>
    <?php
  }
?>

<main class="container">
  <?php if ($auth->isLoggedIn()) {
    $message = '';
    if (empty($_GET)) {
      $auth->logOut();
      $message = 'deste login';
    } elseif ($_GET['where'] == 'everywhere') {
      try {
        $auth->logOutEverywhere();
        $message = 'de todos os locais';
      } catch (\Delight\Auth\NotLoggedInException $e) { printError('Nenhum usuário logado.'); }
    } else {
      try {
        $auth->logOutEverywhereElse();
        $message = 'de todos os outros locais';
      } catch (\Delight\Auth\NotLoggedInException $e) { printError('Nenhum usuário logado.'); }
    }
  ?>
    <h2><i class="material-icons pass">check_circle</i> Sucesso</h2>
    <p>Logout finalizado com sucesso <?= $message ?>.</p>
    <p><a href="./">Voltar à página inicial</a></p>
  <?php } else { printError('Você já está deslogado.'); } ?>
</main>

<?php require __DIR__ . '/footer.php'; ?>
