<?php

namespace Models;

require_once('lib/models/Model.php');

class Comment extends Model
{
    protected $table = "comments";
    /**
     * Retourne tous les commentaires de l'article dont l'id est indiqué
     * @param integer $id
     * @return array
     */
    public function getAllWithArticle(int $id) : array
    {
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $id]);
        return $query->fetchAll();
    }

    /**
     * Insère un commentaire dans l'article grâce à son id
     * @param integer $article_id
     * @param string $content
     * @param string $author
     * @return void
     */
    public function insert(int $article_id, string $content, string $author) : void
    {
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}