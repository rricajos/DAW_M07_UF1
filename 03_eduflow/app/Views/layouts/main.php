<?php
// eduflow/app/Views/layouts/main.php
use App\Core\Session;
$auth = Session::user();
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title><?= isset($title) ? htmlspecialchars($title) . ' · ' : '' ?>eduFlow</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="public/css/style.css" rel="stylesheet">
</head>

<body class="has-ambient-bg">
  <?php require __DIR__ . '/../partials/header.php'; ?>
  <main class="container">
    <?= $content ?? '' ?>
  </main>
  <script src="public/js/main.js"></script>
  <script>
    (function () {
      const bg = document.querySelector('.has-ambient-bg');
      if (!bg) return;
      const layer = bg.querySelector('::before'); // no se puede acceder directo a pseudo
      // truco: aplicamos transform en el contenedor en vez del pseudo
      const el = bg;

      document.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth - 0.5) * 30; // rango -15px a +15px
        const y = (e.clientY / window.innerHeight - 0.5) * 30; // rango -15px a +15px
        el.style.setProperty('--bg-shift-x', `${x}px`);
        el.style.setProperty('--bg-shift-y', `${y}px`);
      });
    })();
  </script>

</body>

</html>