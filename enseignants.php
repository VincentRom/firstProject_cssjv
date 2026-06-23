<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// 1. Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=sql102.infinityfree.com;dbname=if0_42206483_cssjv_db;charset=utf8', 'if0_42206483', 'hzgg01zpMdpGkG');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// 2. REQUÊTE SQL : On sélectionne toutes les colonnes nécessaires pour nos blocs
$reponse = $bdd->query('SELECT nom, prenoms, matiere, telephone, email, matriculeNum, diplome_haut FROM enseignants ORDER BY nom ASC');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Notre équipe enseignante</title>
    <link rel="stylesheet" href="styleTeachers.css">
</head>
<body>
     <header class="container">
        <div class="nomEcole">
            <div class="conteneurImage">
                <img src="assets/1779537355182.png" alt="logo CSSJV">
                <h4>Une histoire d'excellence et d'engagement</h4>
            </div>
        </div>
        <div>            
           <button class="hamburger" id="hamburger">☰</button>
           <nav class="elementEntete">
                <ul>
                   <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
                   <li><a href="#">À propos</a></li>
                   <li class="cacheMenu"><a href="classes.html">Classes <i class="fa-solid fa-caret-down"></i></a></li>
                   <li><a href="#">Administration <i class="fa-solid fa-caret-down"></i></a></li>
                   <li><a href="enseignants.php">Nos enseignants</a></li>
                   <li><a href="#">Contact</a></li>
                </ul>
           </nav>
        </div>
    </header>

    <main class="page-equipe">
        <h2 class="titre-page">Notre équipe enseignante</h2>
        
        <div class="grille-equipe">
            <?php
            // BOUCLE SQL : Crée un bloc textuel pour chaque enseignant trouvé en BDD
            while ($donnees = $reponse->fetch()) {
            ?>
                <div class="carte-prof">
                    <div class="carteprofImg">
                        <i class="fa-solid fa-user-tie fa-3x"></i>
                    </div>
                    
                    <h3>
                        Prof. <?php echo htmlspecialchars($donnees['nom']) . ' ' . htmlspecialchars($donnees['prenoms']); ?>
                    </h3>
                    
                    <hr> <!-- sépare visuellement nom et prénom des autres infos -->
                    
                    <p><strong><i class="fa-solid fa-book-bookmark"></i> Matière :</strong> <?php echo htmlspecialchars($donnees['matiere']); ?></p>
                    <p><strong><i class="fa-solid fa-id-card"></i> Matricule :</strong> <?php echo htmlspecialchars($donnees['matriculeNum']); ?></p>
                    <p><strong><i class="fa-solid fa-graduation-cap"></i> Diplôme :</strong> <?php echo htmlspecialchars($donnees['diplome_haut']); ?></p>
                    <p><strong><i class="fa-solid fa-phone"></i> Tél :</strong> <?php echo htmlspecialchars($donnees['telephone']); ?></p>
                    <p style="margin: 5px 0; font-size: 0.9em; color: #666; word-break: break-all;"><strong><i class="fa-solid fa-envelope"></i> Email :</strong> <?php echo htmlspecialchars($donnees['email']); ?></p>
                </div>
            <?php
            }
            $reponse->closeCursor(); // Ferme la connexion SQL pour cette requête
            ?>
        </div>
    </main>

    <footer>
        <div class="downInfo">
            <h3>Nos spécialités</h3>
            <ul>
                <li><a href="#">Musique</a></li>
                <li><a href="#">Informatique</a></li>
                <li><a href="#">Loi d'attraction</a></li>
                <li><a href="#">Karaté</a></li>
            </ul>
        </div>
        <div class="downInfo">
            <h3>Nos distinctions</h3>
            <ul>
                <li><a href="#">Trophée MESP21</a></li>
                <li><a href="#">Trophée SIWOG</a></li>
                <li><a href="#">Gratitude présidentielle</a></li>
                <li><a href="#">Lire plus</a></li>
            </ul>
        </div>
        <div class="downInfo">
            <h3>Nos réseaux sociaux</h3>
                <a href="#"><i class="fa-brands fa-square-facebook"></i><span>Facebook</span></a> <br>
                <a href="#"><i class="fa-brands fa-instagram"></i><span>Instagram</span></a> <br>
                <a href="#"><i class="fa-brands fa-youtube"></i><span>Youtube</span></a><br>
                <a href="#"><i class="fa-brands fa-linkedin"></i><span>LinkedIn</span></a>
        </div>
    </footer>

    <script>
        const bouton = document.getElementById('hamburger');
        const menu = document.querySelector('.elementEntete');
        bouton.addEventListener('click', function() {
            menu.classList.toggle('actif');
        });
    </script>
</body>
</html>