<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="styles/styleheader.css">
  <link href="<?= $styles ?>" rel="stylesheet">
  <link rel="stylesheet" media="screen(max-width: 620px)" href="<?= $styles_telephone ?>">
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
  </main>
  <footer>
    <?= $footer ?>
  </footer>
  <script src="js/scriptGlobal.js"></script>
  <?= $script ?>
</body>
</html>