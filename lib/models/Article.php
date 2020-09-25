<?php
require_once('lib/models/Model.php');
class Article extends Model
{
    /**
     * Retourne la liste des articles triés par date de création
     * @return array
     */
    public function getAll() : array
    {
        $resultats = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
        return $resultats->fetchAll();
    }

    /**
     * Retourne l'article dont l'id est indiqué
     * @param integer $id
     * @return array|bool l'article si trouvé, false sinon
     */
    public function get(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
        $query->execute(['article_id' => $id]);
        return $query->fetch();
    }
    /**
     * Supprime l'article avec l'id indiqué
     * @param integer $id
     * @return void
     */
    public function delete(int $id) : void
    {
        $query = $this->pdo->prepare('DELETE FROM articles WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}