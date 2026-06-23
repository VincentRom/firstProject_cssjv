<?php
// 1. Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=cssjv_db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// 2. Vérification et récupération des données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenoms = htmlspecialchars($_POST['prenoms']);
    $matiere = htmlspecialchars($_POST['matiere']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['email']); // Ton ajout stratégique
    $naissanceDate = $_POST['naissanceDate'];
    $matriculeNum = htmlspecialchars($_POST['matriculeNum']);
    $diplome_haut = htmlspecialchars($_POST['diplome_haut']);
    
    // Génération du mot de passe temporaire (égal au matricule) et hachage
    $mot_de_passe_hache = password_hash($matriculeNum, PASSWORD_DEFAULT);

    // 3. LA REQUÊTE SQL D'INSERTION (Requête préparée pour la sécurité)
    $req = $bdd->prepare('INSERT INTO enseignants (nom, prenoms, matiere, telephone, email, naissanceDate, matriculeNum, diplome_haut, motDePasse) 
                          VALUES (:nom, :prenoms, :matiere, :telephone, :email, :naissanceDate, :matriculeNum, :diplome_haut,:motDePasse)');
    
    // Execution de la requête SQL
    $req->execute(array(
        'nom' => $nom,
        'prenoms' => $prenoms,
        'matiere' => $matiere,
        'telephone' => $telephone,
        'email' => $email,
        'naissanceDate' => $naissanceDate,
        'matriculeNum' => $matriculeNum,
        'diplome_haut' => $diplome_haut,
        'motDePasse' => $mot_de_passe_hache
    ));

    echo "L'enseignant a bien été enregistré en BDD ! Redirection...";
    header("Refresh: 2; url=recrutement.html");
}
?>