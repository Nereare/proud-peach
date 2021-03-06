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
  <?php if ($auth->isLoggedIn()) { ?>
    <h2><i class="material-icons">warning</i> Aviso</h2>
    <p>Você já está logado como <?= $auth->getUsername() ?>.</p>
    <p>Deseja <a href="logout.php">sair desse login</a>?</p>
    <p>Deseja <a href="./">voltar à página inicial</a>?</p>
  <?php } elseif (empty($_POST)) { ?>
    <h2><i class="material-icons error">error</i> Erro</h2>
    <p>Formulário de instalação não preenchido.</p>
    <p><a href="./">Voltar à página inicial</a></p>
  <?php } else {
    try {
    $auth->login($_POST['email'], $_POST['password']);
  ?>
    <h2><i class="material-icons pass">check_circle</i> Sucesso</h2>
    <p>Login realizado com sucesso.</p>
    <p><a href="./">Voltar à página inicial</a></p>
  <?php
    }
    catch (\Delight\Auth\InvalidEmailException $e) { printError('Email não cadastrado.'); }
    catch (\Delight\Auth\InvalidPasswordException $e) { printError('Senha errada.'); }
    catch (\Delight\Auth\EmailNotVerifiedException $e) { printError('Email não verificado.'); }
    catch (\Delight\Auth\TooManyRequestsException $e) { printError('Número de requisições excedido.'); }
  ?>
  <?php } ?>
</main>

<?php require __DIR__ . '/footer.php'; ?>
