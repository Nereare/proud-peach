<?php require __DIR__ . '/header.php'; ?>

      <main class='container row'>
        <form action="do.php" method="post">
          <div class='twelve columns'>
            <h2>Instalação de <?= $pp['name'] ?></h2>
            <p>Bem vindo ao instalador de <?= $pp['name'] ?>!</p>
            <p>A instalação é completamente automatizada, sendo necessário
              apenas preencher os campos abaixo para determinar os valores do
              usuário de administrador e os dados de banco de dados para
              inicialização do banco de registros.</p>
          </div>

          <div class='twelve columns'>
            <h3>1. Banco de Dados</h3>
            <p>Os dados solicitados nessa sessão não serão armazenados. Eles são
              apenas utilizados para instalar a versão local do banco de dados e
              criar o usuário que será de fato utilizado por essa aplicação.</p>
            <p>O usuários criado para essa instalação de <?= $pp['name'] ?>
              serão armazenados, mas esse usuário terá apenas autorização para
              acessar o banco de dados específico dessa instância.</p>
            <p>Para mais informações, leia os <a href=''>Termos de Uso</a> de <?= $pp['name'] ?>.</p>

            <!-- DB Username -->
            <label for="db_username"><i class="material-icons">person</i></label>
            <input type="text" placeholder="Usuário do BD" id="db_username" name="db_username" autofocus required />
            <!-- DB Password -->
            <label for="db_password"><i class="material-icons">lock</i></label>
            <input type="password" placeholder="Senha" id="db_password" name="db_password" required />
          </div>

          <div class="twelve columns">
            <h3>2. Usuário de Administrador</h3>
            <!-- SU Email -->
            <label for="su_email"><i class="material-icons">person</i></label>
            <input type="email" placeholder="Email" id="su_email" name="su_email" required />
            <!-- SU Password -->
            <label for="su_password"><i class="material-icons">lock</i></label>
            <input type="password" placeholder="Senha" id="su_password" name="su_password"
              pattern="[A-Za-z0-9]{6,}" title="Seis ou mais caracteres alfanuméricos apenas!"
              required />
            <!-- SU Name -->
            <label for="su_name"><i class="material-icons">label</i></label>
            <input type="text" placeholder="Nome Completo" id="su_name" name="su_name" required />
            <!-- SU License -->
            <label for="su_crm"><i class="material-icons">card_membership</i></label>
            <input type="number" placeholder="CRM" id="su_crm" name="su_crm" required />
            <!-- SU License State -->
            <label for="su_crm_state"><i class="material-icons">place</i></label>
            <select id="su_crm_state" name="su_crm_state" required>
              <option value="" selected>Selecione o estado emissor do CRM</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
            </select>
          </div>

          <div class="twelve columns">
            <h3>3. Local de Atendimento</h3>
            <!-- Place Name -->
            <label for="pl_name"><i class="material-icons">bookmark</i></label>
            <input type="text" placeholder="Nome do Local" id="pl_name" name="pl_name" required />
            <!-- Place Address 1 -->
            <label for="pl_addr1"><i class="material-icons">place</i></label>
            <input type="text" placeholder="Endereço do Local" id="pl_addr1" name="pl_addr1" required />
            <!-- Place Address 2 -->
            <label for="pl_addr2"><i class="material-icons">location_city</i></label>
            <input type="text" placeholder="Bairro, Cidade e Estado" id="pl_addr2" name="pl_addr2" required />
            <!-- Place Postal Code -->
            <label for="pl_postcode"><i class="material-icons">pin_drop</i></label>
            <input type="text" placeholder="CEP" id="pl_postcode" name="pl_postcode" required />
            <!-- Place Telephone -->
            <label for="pl_phone"><i class="material-icons">phone</i></label>
            <input type="text" placeholder="(DDD) Telefone" id="pl_phone" name="pl_phone"
              pattern="[0-9\+]{2,4}?\(\d{2,3})\) ?\d{4,5}\-\d{4}"
              title="Telefone precedido de DDD no formato '(12)1234-5678'"
              required />
            <!-- Place Email -->
            <label for="pl_email"><i class="material-icons">email</i></label>
            <input type="email" placeholder="Email" id="pl_email" name="pl_email" required />
          </div>

          <div class="twelve columns">
            <h3>4. Responsável pelo Local</h3>
            <!-- Supervisor Name -->
            <label for="sup_name"><i class="material-icons">person_pin_circle</i></label>
            <input type="text" placeholder="Nome do Responsável" id="sup_name" name="sup_name" required />
            <!-- Supervisor License -->
            <label for="sup_crm"><i class="material-icons">card_membership</i></label>
            <input type="number" placeholder="CRM do Responsável" id="sup_crm" name="sup_crm" required />
            <!-- Supervisor License State -->
            <label for="sup_crm_state"><i class="material-icons">place</i></label>
            <select id="sup_crm_state" name="sup_crm_state" required>
              <option value="" selected>Selecione o estado emissor do CRM do Supervisor</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
            </select>
            <!-- Supervisor License State -->
            <label for="sup_register_type"><i class="material-icons">info</i></label>
            <select id="sup_register_type" name="sup_register_type" required>
              <option value="" selected>Tipo de Registro (CPF/CNPJ)</option>
              <option value="CPF">Cadastro de Pessoa Física</option>
              <option value="CNPJ">Cadastro Nacional de Pessoa Jurídica</option>
            </select>
            <!-- Supervisor Register -->
            <label for="sup_register"><i class="material-icons">verified_user</i></label>
            <input type="text" placeholder="CPF/CNPJ" id="sup_register" name="sup_register"
              pattern="[0-9\.\/\-]{14,18}" title="Formate o CPF no formato XXX.XXX.XXX-XX e o CNPJ no formato XX.XXX.XXX/XXXX-XX."
              required />
          </div>

          <div class="twelve columns">
            <h3>5. Finalização</h3>
            <p>Cheque todos os dados acima por erros, não haverá uma tela de
              confirmação de dados.</p>
            <p>Se todos os dados estiverem corretos, clique em <em>Instalar</em>
              para dar início à instalação.</p>
            <p><strong>Importante!</strong> Ao clicar abaixo, você afirma
              concordar com todos os <a href=''>Termos de Uso</a> e com os
              <a href=''>Termos de Privacidade</a> desse aplicativo.</p>
            <input class="button-primary u-full-width" type="submit" value="Instalar" />
          </div>
        </form>
      </main>

<?php require __DIR__ . '/footer.php'; ?>
