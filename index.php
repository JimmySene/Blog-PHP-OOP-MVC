<?php
require_once('lib/database.php');
require_once('lib/utils.php');
/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * 
 * On va donc se connecter à la base de données, récupérer les articles du plus récent au plus ancien (SELECT * FROM articles ORDER BY created_at DESC)
 * puis on va boucler dessus pour afficher chacun d'entre eux
 */

$articles = getAllArticles();

/**
 * 3. Affichage
 */
$pageTitle = "Accueil";
render('articles/index', compact('pageTitle', 'articles'));
