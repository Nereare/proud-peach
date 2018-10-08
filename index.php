<?php require __DIR__ . '/header.php'; ?>

      <?php if ($auth->isLoggedIn()) { ?>
      <main class='container'>
        <div class='row'>
          <div class='three columns menu'>
            <ul>
              <li><button class="u-full-width">Pacientes</button></li>
              <li><button class="u-full-width">Prontuários</button></li>
              <li><button class="u-full-width">Prescrições</button></li>
              <li><button class="u-full-width">Atestados</button></li>
            </ul>
          </div>
          <div class='nine columns' id="contents">
            <!-- Contents come here. -->
          </div>
        </div>
      </main>
      <?php } else { ?>
        <main class='container form'>
          <form method='post' action='login.php'>
            <div class='row'>
              <div class='twelve columns'>
                <!-- Username -->
                <label for='email'><i class="material-icons">person</i></label>
                <input type="email" placeholder="Email" id="email" name="email" autofocus required />
              </div>
            </div>
            <div class='row'>
              <div class='twelve columns'>
                <!-- Password -->
                <label for='password'><i class="material-icons">lock</i></label>
                <input type="password" placeholder="Senha" id="password" name="password" required />
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
