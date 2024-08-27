<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title ?? 'Mon Portfolio'?></title>
    <!-- Styles CSS -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Icônes FontAwesome -->
    <script src="https://kit.fontawesome.com/de5f823271.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <!-- En-tête -->
        <header class="d-flex justify-content-between align-items-center py-3">
            <h1>MON PORTFOLIO</h1>
            <div>
                <?php
                use App\Entities\User;
                if (isset($_SESSION['user'])):
                    $user = User::fromArray($_SESSION['user']);
                ?>
                    <!-- Message de bienvenue et bouton de déconnexion -->
                    <span class="me-3">Bonjour, <?= htmlspecialchars($user->getUsername()) ?>!</span>
                    <a href="index.php?controller=auth&action=logout" class="btn btn-danger">Se déconnecter</a>
                <?php endif; ?>
            </div>
        </header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">Mon portfolio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" aria-current="page" class="nav-link active">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?controller=creation&action=index" class="nav-link">Mes créations</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Contenu principal -->
        <main>
            <?=$content?>
        </main>
        <!-- Pied de page -->
        <footer class="text-center">
            <p>Mon portfolio Copyright &copy;2021</p>
        </footer>
    </div>
    <!-- Scripts JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>