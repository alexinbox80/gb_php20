<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title;?></title>
</head>
<body>
<header id="">
    <h1><?=$title;?></h1>
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">index page</a>
                </li>
                <li>
                    <a href="other.php">another page</a>
                </li>
            </ul>
        </nav>
</header>
<section id="">
    <div class="content">
        <?=$content;?>
    </div>
</section>
<footer id="">
    <p class="footer">
        <?=$keywords;?>
        footer
    </p>
</footer>
</body>
</html>
