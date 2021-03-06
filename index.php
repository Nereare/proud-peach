<?php require __DIR__ . '/header.php'; ?>

      <?php if ($auth->isLoggedIn()) { ?>
      <main class='container' ng-app='proud_peach'>
        <div class='row'>
          <div class='three columns menu'>
            <ul>
              <li><button class="u-full-width"><a href='#!'>Início</a></button></li>
              <li><button class="u-full-width"><a href='#!/patients'>Pacientes</a></button></li>
              <li><button class="u-full-width"><a href='#!/records'>Prontuários</a></button></li>
              <li><button class="u-full-width"><a href='#!/prescriptions'>Prescrições</a></button></li>
              <li><button class="u-full-width"><a href='#!/leaves'>Atestados</a></button></li>
            </ul>
          </div>
          <div class='nine columns' ng-controller='mainCtrl'>
            <!-- Contents come here. -->
            <div ng-view></div>
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

          <div class='row'>
            <div class='twelve columns'>
              <p>Esse site usa cookies para seu funcionamento, ao continuar utilizando <?= $pp['name'] ?> você concorda com o uso de seus cookies.</p>
              <p><a href='https://cookiesandyou.com/' target='_blank'>Saiba mais.</a></p>
            </div>
          </div>
        </main>
      <?php } ?>

<?php require __DIR__ . '/footer.php'; ?>
