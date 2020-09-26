<?php 

namespace Controllers;

class Article extends Controller
{
    protected $modelName = \Models\Article::class;

    public function index()
    {
        $articles = $this->model->getAll('created_at DESC');
        $pageTitle = "Accueil";
        \Renderer::render('articles/index', compact('pageTitle', 'articles'));
    }

    public function show()
    {
        $article_id = null;

        // Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }
        
        // On peut désormais décider : erreur ou pas ?!
        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }
        
        $article = $this->model->get($article_id);
        
        $commentModel = new \Models\Comment();
        $commentaires = $commentModel->getAllWithArticle($article_id);
        
        $pageTitle = $article['title'];
        \Renderer::render('articles/show', compact('pageTitle', 'article', 'commentaires', 'article_id'));
    }

    public function delete()
    {
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }
        
        $id = $_GET['id'];
        
        $article = $this->model->get($id);
        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }
        
        $this->model->delete($id);
        
        \Http::redirect('index.php');
    }

    public function add()
    {
        $pageTitle = "Ajouter un article";
        \Renderer::render('articles/add', compact('pageTitle'));
    }

    public function save()
    {
        if(!empty($_POST['title']) && !empty($_POST['introduction']) && !empty($_POST['content']))
        {
            $this->model->save($_POST);
        } 

        \Http::redirect('/');
    }
}