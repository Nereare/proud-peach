</div>

<footer>
  <div class='container row'>
    <div class='four columns'>
      <h2><?= $pp['name'] ?></h2>
      <p>Versão <?= $pp['version'] ?></p>
      <p>Criado com &#10084; por <a href='<?= $pp['author']['link'] ?>'><?= $pp['author']['name'] ?></a>.</p>
    </div>
    <div class='eight columns'>
      <ul>
        <li>
          <a href='https://github.com/Nereare/proud-peach/fork'>
            <img alt='Faça sua versão no GitHub'
              src='https://img.shields.io/github/forks/Nereare/proud-peach.svg?style=social&label=Fork' />
          </a>
        </li>
        <li>
          <a href='https://github.com/Nereare/proud-peach'>
            <img alt='Dê uma estrela no GitHub'
              src='https://img.shields.io/github/stars/Nereare/proud-peach.svg?style=social&label=Stars' />
          </a>
        </li>
        <li>
          <a href='https://github.com/Nereare/proud-peach'>
            <img alt='Watch no GitHub'
              src='https://img.shields.io/github/watchers/Nereare/proud-peach.svg?style=social&label=Watch' />
          </a>
        </li>
        <li>
          <a href='https://github.com/Nereare'>
            <img alt='Siga no GitHub'
              src='https://img.shields.io/github/followers/Nereare.svg?style=social&label=Follow' />
          </a>
        </li>
      </ul>
      <p><?= $pp['name'] ?> está disponível sob a <a href='<?= $pp['license']['link'] ?>'><?= $pp['license']['name'] ?></a>.</p>
    </div>
  </div>
</footer>
</body>
</html>
