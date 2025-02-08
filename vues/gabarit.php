<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link href="<?= $styles ?>" rel="stylesheet">
</head>
<body>
  <header>
    <div><a href="index.php"><h1><?= $header ?></h1></a></div>
    <div class="menu"><?= $menu ?></div>
  </header>
  <main>
    <?= $contenu ?>
  </main>
  <footer>
    <?= $footer ?>
  </footer>  
</body>
</html>