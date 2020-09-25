<?php
require_once('lib/database.php');
require_once('lib/utils.php');
require('lib/models/Comment.php');
/**
 * DANS CE FICHIER ON CHERCHE A SUPPRIMER LE COMMENTAIRE DONT L'ID EST PASSE EN PARAMETRE GET !
 * 
 * On va donc vérifier que le paramètre "id" est bien présent en GET, qu'il correspond bien à un commentaire existant
 * Puis on le supprimera !
 */

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ! Fallait préciser le paramètre id en GET !");
}

$id = $_GET['id'];

$commentModel = new Comment();
$commentaire = $commentModel->get($id);
if (!$commentaire) {
    die("Aucun commentaire n'a l'identifiant $id !");
}

$article_id = $commentaire['article_id'];

$commentModel->delete($id);

redirect("article.php?id=" . $article_id);
