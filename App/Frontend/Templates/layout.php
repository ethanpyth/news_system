<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Web/css/bootstrap.min.css">
    <title>
        <?php if (!isset($title)) { ?>
        News System
        <?php 
        } else {
            echo $title; 
        }
        ?>
    </title>
</head>
<body>
    <div class="header">
        <h1 class="navbar-brand"><a href="/">News System</a></h1>
        <p>Comment ca "il n'y a presque rien"?</p>
    </div>
    <div>
        <ul>
            <li><a href="/">Accueil</a></li>
            <?php if ($user->isAuthenticated()) {?>
                <li><a href="/admin/"></a></li>
                <li><a href="/admin/news-insert.html">Ajouter une news</a></li>
            <?php } ?>
        </ul>
    </div>
    <div>
        <div>
            <?php if ($user->hasFlash()) echo '<p style="text-align:center;">' . $user->getFlash() . '</p>'; ?>
            <?php echo $content; ?>
        </div>
    </div>
    <?php ?>
</body>
</html>