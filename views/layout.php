<html>
<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link>
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="navbar-brand">TR LOGIC</div>
    <?= $language_select ?>
</nav>

<div class="container-fluid wrapper" id="content">

        <?= $content ?>

</div>

<footer class="footer ">
    <div class="footer-copyright">© 2020 TR LOGIC</div>
</footer>


</body>
</html>

<script src="/assets/js/layout.js"></script>