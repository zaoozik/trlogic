<html>
<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/reset.css">
    <link>
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="navbar-brand">TR LOGIC</div>
    <form class="form-inline">
        <label for="languageSelect">Язык</label>
        <select class="form-control" id="languageSelect">
            <option>Русский</option>
            <option>English</option>
        </select>
    </form>
</nav>

<div class="container-fluid wrapper" id="content">

        <?= $content ?>

</div>

<footer class="footer ">
    <!-- Copyright -->
    <div class="footer-copyright">© 2020 TR LOGIC</div>
    <!-- Copyright -->
</footer>


</body>
</html>
