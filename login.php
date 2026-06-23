<?php
session_start();

// Mot de passe admin défini en dur (à changer selon ton choix)
$MOT_DE_PASSE_ADMIN = 'cssjv2026';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['password'] === $MOT_DE_PASSE_ADMIN) {
        $_SESSION['admin_connecte'] = true;
        header('Location: recrutement.php');
        exit();
    } else {
        $erreur = "Mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accès Administration</title>
</head>
<body>
    <h2>Espace réservé à l'administration</h2>
    <?php if (!empty($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>
    <form method="POST" action="login.php">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>