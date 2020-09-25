<?php 

namespace Controllers;

require_once('lib/utils.php');
require_once('lib/models/Article.php');
require_once('lib/models/Comment.php');
require_once('lib/controllers/Controller.php');

class Comment extends Controller
{
    protected $modelName = \Models\Comment::class;

    public function save()
    {
        $author = null;
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }
        
        $content = null;
        if (!empty($_POST['content'])) {
            $content = htmlspecialchars($_POST['content']);
        }
        
        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }
        
        if (!$author || !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }
        
        $articleModel = new \Models\Article();
        $article = $articleModel->get($article_id);

        
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }
        
        
        $this->model->insert($article_id, $content, $author);
    
        redirect('article.php?id=' . $article_id);
    }

    public function delete()
    {
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }
        
        $id = $_GET['id'];
        
        
        $commentaire = $this->model->get($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }
        
        $article_id = $commentaire['article_id'];
        
        $this->model->delete($id);
        
        redirect("article.php?id=" . $article_id);
    }
}