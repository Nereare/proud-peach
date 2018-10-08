<?php require __DIR__ . '/header.php'; ?>

      <?php if ($auth->isLoggedIn()) { ?>
      <main class='container'>
      </main>
      <?php } else { ?>
      <main class='container form'>
        <form method='session.php' action='post'>
          <div class='row'>
            <div class='twelve columns'>
              <!-- Username -->
              <label for='email'><i class="material-icons">person</i></label>
              <input type="email" placeholder="Email" id="email" autofocus required />
            </div>
          </div>
          <div class='row'>
            <div class='twelve columns'>
              <!-- Password -->
              <label for='password'><i class="material-icons">lock</i></label>
              <input type="password" placeholder="Senha" id="password" required />
            </div>
          </div>
          <div class='row'>
            <div class='twelve columns'>
              <!-- Submit -->
              <input class="button-primary u-full-width" type="submit" value="Login" />
            </div>
          </div>
        </form>
      </main>
    <?php } ?>

<?php require __DIR__ . '/footer.php'; ?>
