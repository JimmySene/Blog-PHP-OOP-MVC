<?php
require_once('lib/models/Model.php');
class Comment extends Model
{
    /**
     * Retourne tous les commentaires de l'article dont l'id est indiqué
     * @param integer $id
     * @return array
     */
    public function getAll(int $id) : array
    {
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $id]);
        return $query->fetchAll();
    }

    /**
     * Retourne le commentaire avec l'identifiant indiqué
     * @param integer $id
     * @return array|bool le commentaire si on le trouve, sinon false
     */
    public function get(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    /**
     * Supprime un commentaire grâce à son identifiant
     * @param integer $id
     * @return void
     */
    public function delete(int $id) : void
    {
        $query = $this->pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
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