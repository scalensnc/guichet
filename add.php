<?php
// add.php

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données du formulaire
    $commune = htmlspecialchars($_POST['Commune']);
    $lien = htmlspecialchars($_POST['Lien']);

    // Charge le contenu du fichier JSON
    $jsonFile = 'data.json';
    if (file_exists($jsonFile)) {
        $data = json_decode(file_get_contents($jsonFile), true);
    } else {
        $data = [];
    }

    // Ajoute la nouvelle entrée au tableau
    $data[] = [
        'Commune' => $commune,
        'Lien' => $lien,
    ];

    // Enregistre les données mises à jour dans le fichier JSON
    if (file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT))) {
        // Renvoie une réponse JSON
        echo json_encode(['success' => true]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'enregistrement des données.']);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Aucune donnée reçue.']);
    exit();
}
?>
