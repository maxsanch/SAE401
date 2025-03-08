<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="styles/styleheader.css">
  <link href="<?= $styles ?>" rel="stylesheet">
  <link rel="stylesheet" media="(width < 640px)" href="<?= $styles_telephone ?>">
  <link rel="stylesheet" media="(width < 640px)" href="styles/telephone/header_tel.css">
  <?= $librairie ?>
</head>

<body>

  <header>
    <?= $header ?>
  </header>
  <div class="panier">
    <?= $globalPanier ?>
  </div>
  <div class="cache_fond">
  </div>
  <main>
    <?= $contenu ?>
    <div class="boutonlangues">
      <div class="languechoose" id="francais">
        <img src="../img/france.png" alt="francais">
      </div>
      <div class="languechoose" id="anglais">
      <img src="../img/angleterre.png" alt="Anglais">
      </div>
    </div>
  </main>
  <footer>
    <?= $footer ?>
  </footer>
  <script src="js/scriptGlobal.js"></script>
  <script src="js/header.js"></script>
  <?= $script ?>
</body>

</html>