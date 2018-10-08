<?php require __DIR__ . '/header.php'; ?>

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
    } catch (\Delight\Auth\InvalidEmailException $e) {
        die('<p><i class="material-icons error">error</i> Email não cadastrado.</p>');
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        die('<p><i class="material-icons error">error</i> Senha errada.</p>');
    } catch (\Delight\Auth\EmailNotVerifiedException $e) {
        die('<p><i class="material-icons error">error</i> Email não verificado.</p>');
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        die('<p><i class="material-icons error">error</i> Número de requisições excedido.</p>');
    }
  ?>
  <?php } ?>
</main>

<?php require __DIR__ . '/footer.php'; ?>
